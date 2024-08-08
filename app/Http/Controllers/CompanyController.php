<?php

namespace App\Http\Controllers;

use App\Helpers\Invoice\Certificates\Convert;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function show()
    {
        $company = Company::with('district.province.department')->first();
        $ubigeo = Department::with('provinces.districts')->get();

        return Inertia::render('Company/Show', [
            'company'   => $company ? $company : [],
            'ubigeo'    => $ubigeo->toArray(),
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
            'email'  => 'required|max:150',
            'mode'  => 'required'
        ]);

        //dd($request->get('mode'));

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
                'mode'              => $request->get('mode'),
                'ubigeo'            => $request->get('ubigeo')
            ]
        );

        Company::where('ruc', '<>', $request->get('ruc'))->delete();

        return redirect()->route('company_show');
    }

    public function getdata()
    {
        $company = Company::first();
        return response()->json($company);
    }

    public function convertUploadCertificate(Request $request)
    {
        $convert = new Convert();

        $company = Company::first();

        $pass = $request->get('password');
        $destination = 'uploads/company';
        $file = $request->file('certificate');
        $extension = $file->getClientOriginalExtension();
        $file_name = date('YmdHis') . 'ARA.' . $extension;

        $path = $request->file('certificate')->storeAs(
            $destination,
            $file_name,
            'public'
        );

        $cer = public_path('storage/' . $path);
        $response = $convert->cpem($cer, $pass, $company->ruc);

        if ($response['success']) {

            $company->certificate_sunat = $response['file_name'];
            $company->save();
        }

        $this->deleteFile($cer);

        return response()->json([
            'certificate' => $response
        ]);
    }

    public function deleteFile($filename)
    {
        // Verifica si el archivo existe
        //dd($filename);
        if (file_exists($filename)) {
            // Elimina el archivo
            unlink($filename);

            // Devuelve una respuesta exitosa
            return true;
        } else {
            // Devuelve una respuesta de error si el archivo no existe
            return false;
        }
    }

    public function saveSunatCredentials(Request $request)
    {
        $this->validate($request, [
            'key_sunat' => 'required|max:140',
            'user_sunat' => 'required|max:140',
        ]);

        $company = Company::first();

        $company->key_sunat = $request->get('key_sunat');
        $company->user_sunat = $request->get('user_sunat');

        $company->save();
    }

    public function saveSocialNetworks(Request $request)
    {
        // $this->validate($request, [
        //     'key_sunat' => 'required|max:140',
        //     'user_sunat' => 'required|max:140',
        // ]);

        $company = Company::first();

        $company->social_networks = $request->get('social_networks');

        $company->save();
    }

    public function uploadImages(Request $request)
    {
        $company = Company::first();

        $destination = 'uploads/company';
        $logo = $request->get('logo');
        $file176x32 = $request->get('logo_document');
        $logoNegative = $request->get('logo_negative');
        $logoDark = $request->get('logo_dark');
        $isotipo = $request->get('isotipo');
        $isotipoNegative = $request->get('isotipo_negative');
        $isotipoDark = $request->get('isotipo_dark');

        if ($isotipoNegative) {
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $isotipoNegative));

            if (PHP_OS == 'WINNT') {
                $tempFile = tempnam(sys_get_temp_dir(), 'img');
            } else {
                $tempFile = tempnam('/var/www/html/img_temp', 'img');
            }

            file_put_contents($tempFile, $fileData);
            $mime = mime_content_type($tempFile);

            $name = uniqid('', true) . '.' . str_replace('image/', '', $mime);
            $file = new UploadedFile(realpath($tempFile), $name, $mime, null, true);

            if ($file) {
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $original_name = str_replace(" ", "_", $original_name);
                $extension = $file->getClientOriginalExtension();
                $file_name = time() . rand(100, 999) . '.' . $extension;
                $path_isotipo_negative = Storage::disk('public')->putFileAs($destination, $file, $file_name);
                $company->isotipo_negative = $path_isotipo_negative;
                $company->save();
            }
        }

        if ($isotipoDark) {
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $isotipoDark));

            if (PHP_OS == 'WINNT') {
                $tempFile = tempnam(sys_get_temp_dir(), 'img');
            } else {
                $tempFile = tempnam('/var/www/html/img_temp', 'img');
            }

            file_put_contents($tempFile, $fileData);
            $mime = mime_content_type($tempFile);

            $name = uniqid('', true) . '.' . str_replace('image/', '', $mime);
            $file = new UploadedFile(realpath($tempFile), $name, $mime, null, true);

            if ($file) {
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $original_name = str_replace(" ", "_", $original_name);
                $extension = $file->getClientOriginalExtension();
                $file_name = time() . rand(100, 999) . '.' . $extension;
                $path_isotipo_dark = Storage::disk('public')->putFileAs($destination, $file, $file_name);
                $company->isotipo_dark = $path_isotipo_dark;
                $company->save();
            }
        }

        if ($isotipo) {
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $isotipo));

            if (PHP_OS == 'WINNT') {
                $tempFile = tempnam(sys_get_temp_dir(), 'img');
            } else {
                $tempFile = tempnam('/var/www/html/img_temp', 'img');
            }

            file_put_contents($tempFile, $fileData);
            $mime = mime_content_type($tempFile);

            $name = uniqid('', true) . '.' . str_replace('image/', '', $mime);
            $file = new UploadedFile(realpath($tempFile), $name, $mime, null, true);

            if ($file) {
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $original_name = str_replace(" ", "_", $original_name);
                $extension = $file->getClientOriginalExtension();
                $file_name = time() . rand(100, 999) . '.' . $extension;
                $path_isotipo = Storage::disk('public')->putFileAs($destination, $file, $file_name);
                $company->isotipo = $path_isotipo;
                $company->save();
            }
        }

        if ($logoDark) {
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $logoDark));

            if (PHP_OS == 'WINNT') {
                $tempFile = tempnam(sys_get_temp_dir(), 'img');
            } else {
                $tempFile = tempnam('/var/www/html/img_temp', 'img');
            }

            file_put_contents($tempFile, $fileData);
            $mime = mime_content_type($tempFile);

            $name = uniqid('', true) . '.' . str_replace('image/', '', $mime);
            $file = new UploadedFile(realpath($tempFile), $name, $mime, null, true);

            if ($file) {
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $original_name = str_replace(" ", "_", $original_name);
                $extension = $file->getClientOriginalExtension();
                $file_name = time() . rand(100, 999) . '.' . $extension;
                $path_logo_dark = Storage::disk('public')->putFileAs($destination, $file, $file_name);
                $company->logo_dark = $path_logo_dark;
                $company->save();
            }
        }

        if ($logoNegative) {
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $logoNegative));

            if (PHP_OS == 'WINNT') {
                $tempFile = tempnam(sys_get_temp_dir(), 'img');
            } else {
                $tempFile = tempnam('/var/www/html/img_temp', 'img');
            }

            file_put_contents($tempFile, $fileData);
            $mime = mime_content_type($tempFile);

            $name = uniqid('', true) . '.' . str_replace('image/', '', $mime);
            $file = new UploadedFile(realpath($tempFile), $name, $mime, null, true);

            if ($file) {
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $original_name = str_replace(" ", "_", $original_name);
                $extension = $file->getClientOriginalExtension();
                $file_name = time() . rand(100, 999) . '.' . $extension;
                $path_logo_negative = Storage::disk('public')->putFileAs($destination, $file, $file_name);
                $company->logo_negative = $path_logo_negative;
                $company->save();
            }
        }

        if ($logo) {
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $logo));

            if (PHP_OS == 'WINNT') {
                $tempFile = tempnam(sys_get_temp_dir(), 'img');
            } else {
                $tempFile = tempnam('/var/www/html/img_temp', 'img');
            }

            file_put_contents($tempFile, $fileData);
            $mime = mime_content_type($tempFile);

            $name = uniqid('', true) . '.' . str_replace('image/', '', $mime);
            $file = new UploadedFile(realpath($tempFile), $name, $mime, null, true);

            if ($file) {
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $original_name = str_replace(" ", "_", $original_name);
                $extension = $file->getClientOriginalExtension();
                $file_name = time() . rand(100, 999) . '.' . $extension;
                $path_logo = Storage::disk('public')->putFileAs($destination, $file, $file_name);
                $company->logo = $path_logo;
                $company->save();
            }
        }

        if ($file176x32) {
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file176x32));

            if (PHP_OS == 'WINNT') {
                $tempFile = tempnam(sys_get_temp_dir(), 'img');
            } else {
                $tempFile = tempnam('/var/www/html/img_temp', 'img');
            }

            file_put_contents($tempFile, $fileData);
            $mime = mime_content_type($tempFile);

            $name = uniqid('', true) . '.' . str_replace('image/', '', $mime);
            $file = new UploadedFile(realpath($tempFile), $name, $mime, null, true);

            if ($file) {
                $original_name = strtolower(trim($file->getClientOriginalName()));
                $original_name = str_replace(" ", "_", $original_name);
                $extension = $file->getClientOriginalExtension();
                $file_name = time() . rand(100, 999) . '.' . $extension;
                $path_logo_document = Storage::disk('public')->putFileAs($destination, $file, $file_name);
                $company->logo_document = $path_logo_document;
                $company->save();
            }
        }
    }
}
