<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function show()
    {
        $company = Company::first();
        return Inertia::render('Company/Show', [
            'company' => $company ? $company : []
        ]);
    }
    public function updateCreate(Request $request)
    {
        $this->validate($request, [
            'ruc' => 'required|max:12',
            'name' => 'required|max:300',
            'business_name' => 'required|max:300',
            'tradename'  => 'required|max:300',
            'fiscal_address'  => 'required|max:300',
            'phone'  => 'required|max:15',
            'email'  => 'required|max:150'
        ]);

        $path = '';
        $destination = 'uploads/company';
        $file = $request->file('logo');
        if ($file) {
            $original_name = strtolower(trim($file->getClientOriginalName()));
            $original_name = str_replace(" ", "_", $original_name);
            $extension = $file->getClientOriginalExtension();
            $file_name = 'logo.png';
            $path = $request->file('logo')->storeAs(
                $destination,
                $file_name,
                'public'
            );
        }

        Company::updateOrCreate(
            ['ruc' =>  $request->get('ruc')],
            [
                'name'              => $request->get('name'),
                'business_name'     => $request->get('business_name'),
                'tradename'         => $request->get('tradename'),
                'fiscal_address'    => $request->get('fiscal_address'),
                'phone'             => $request->get('phone'),
                'representative'    => $request->get('representative'),
                'email'             => $request->get('email'),
                'logo'              => $path ? $path : Company::where('ruc', '=', $request->get('ruc'))->first()->logo
            ]
        );

        Company::where('ruc', '<>', $request->get('ruc'))->delete();

        return redirect()->route('company_show')
            ->with('message', __('Empresa registrada con éxito'));
    }

    public function getdata()
    {
        $company = Company::first();
        return response()->json($company);
    }
}
