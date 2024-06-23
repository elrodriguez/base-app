<?php

namespace Modules\Dental\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Modules\Dental\Entities\DentAppointment;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Health\Entities\HealDoctor;
use Modules\Health\Entities\HealPatient;

class AppointmentController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(request()->all());
        $appointments = (new DentAppointment())->newQuery();
        $appointments->with('patient');
        $appointments->with('doctor');

        if (request()->has('tag')) {
            if (request()->get('tag') != 'all') {
                if (request()->get('tag') == 'fav') {
                    $appointments->where('important', '=', true);
                } else {
                    $appointments->where('status', '=', request()->get('tag'));
                }
            }
        }

        $appointments->orderBy('date_appointmen', 'DESC');
        $appointments = $appointments->paginate(6)
            ->onEachSide(2);
        //dd($appointments);
        $patients = HealPatient::with('person')->get();
        if (count($patients) > 0) {
            foreach ($patients as $i => $patient) {
                $patients[$i] = array(
                    'code' => $patient->id,
                    'name' => $patient->person->full_name,
                    'email' => $patient->person->email,
                    'telephone' => $patient->person->telephone
                );
            }
        }

        $doctors = HealDoctor::with('person')->get();
        if (count($doctors) > 0) {
            foreach ($doctors as $i => $doctor) {
                $doctors[$i] = array(
                    'code' => $doctor->id,
                    'name' => $doctor->person->full_name,
                    'email' => $patient->person->email,
                    'telephone' => $patient->person->telephone
                );
            }
        }

        return Inertia::render('Dental::Appointments/List', [
            'appointments' => $appointments,
            'filters' => request()->all(),
            'patients' => $patients,
            'doctors' => $doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'patient_id'            => 'required',
                'doctor_id'             => 'required',
                'date_appointmen'       => 'required',
                'time_appointmen'       => 'required',
                'description'           => 'required|max:255',
                'details'               => 'max:255',
                'message'               => 'max:500',
            ]
        );

        $patient = HealPatient::find($request->get('patient_id')['code']);
        $doctor = HealDoctor::find($request->get('doctor_id')['code']);

        $ddate = $request->get('date_appointmen') . ' ' . $request->get('time_appointmen');
        $initialDateTime = Carbon::parse($ddate);

        // Agregar 30 minutos
        $newDateTime = $initialDateTime->addMinutes(30);

        DentAppointment::create([
            'patient_id'            => $request->get('patient_id')['code'],
            'patient_person_id'     => $patient->person_id,
            'doctor_id'             => $request->get('doctor_id')['code'],
            'doctor_person_id'      => $doctor->person_id,
            'date_appointmen'       => $request->get('date_appointmen'),
            'time_appointmen'       => $request->get('time_appointmen'),
            'date_end_appointmen'   => $newDateTime->toDateString(),
            'time_end_appointmen'   => $newDateTime->toTimeString(),
            'email'                 => $request->get('email'),
            'telephone'             => $request->get('telephone'),
            'description'           => $request->get('description'),
            'details'               => $request->get('details'),
            'message'               => $request->get('message'),
            'status'                => 1,
            'created_user_id'       => Auth::id(),
            'sick_time'             => $request->get('sick_time'),
        ]);

        return redirect()->route('odontology_appointments_list')
            ->with('message', __('Cita registrada con éxito'));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('Dental::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('Dental::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //dd($request->all());
        $this->validate(
            $request,
            [
                'patient_id'            => 'required',
                'doctor_id'             => 'required',
                'date_appointmen'       => 'required',
                'time_appointmen'       => 'required',
                'description'           => 'required|max:255',
                'details'               => 'max:255',
                'message'               => 'max:500',
            ]
        );

        $patient = HealPatient::find($request->get('patient_id')['code']);
        $doctor = HealDoctor::find($request->get('doctor_id')['code']);

        $ddate = $request->get('date_appointmen') . ' ' . $request->get('time_appointmen');
        $initialDateTime = Carbon::parse($ddate);

        // Agregar 30 minutos
        $newDateTime = $initialDateTime->addMinutes(30);

        DentAppointment::find($id)->update([
            'patient_id'            => $request->get('patient_id')['code'],
            'patient_person_id'     => $patient->person_id,
            'doctor_id'             => $request->get('doctor_id')['code'],
            'doctor_person_id'      => $doctor->person_id,
            'date_appointmen'       => $request->get('date_appointmen'),
            'time_appointmen'       => $request->get('time_appointmen'),
            'date_end_appointmen'   => $newDateTime->toDateString(),
            'time_end_appointmen'   => $newDateTime->toTimeString(),
            'email'                 => $request->get('email'),
            'telephone'             => $request->get('telephone'),
            'description'           => $request->get('description'),
            'details'               => $request->get('details'),
            'message'               => $request->get('message'),
            'updated_user_id'       => Auth::id(),
            'sick_time'             => $request->get('sick_time'),
        ]);

        return redirect()->route('odontology_appointments_list')
            ->with('message', __('Cita Actualizada con éxito'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = null;
        $success = false;
        try {
            // Usamos una transacción para asegurarnos de que la operación se realice de manera segura.
            DB::beginTransaction();

            // Verificamos si existe.
            $item = DentAppointment::findOrFail($id);

            // Si no hay detalles asociados, eliminamos.
            $item->delete();

            // Si todo ha sido exitoso, confirmamos la transacción.
            DB::commit();

            $message =  'Cita eliminada correctamente';
            $success = true;
        } catch (\Exception $e) {
            // Si ocurre alguna excepción durante la transacción, hacemos rollback para deshacer cualquier cambio.
            DB::rollback();
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        DentAppointment::find($id)->update([
            'status' => $request->get('status')
        ]);
    }
    public function updateImportant(Request $request, $id)
    {
        DentAppointment::find($id)->update([
            'important' => $request->get('important')
        ]);
    }
}
