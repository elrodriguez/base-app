<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Dental\Entities\DentAppointment;

class CalendarController extends Controller
{
    public function index()
    {
        $period = request()->get('period', 'month');

        $dentAppointments = $this->getDentAppointments($period);
        return Inertia::render(
            'Calendar/Index',
            [
                'eventsDB' => $dentAppointments
            ]
        );
    }

    public function getDentAppointments($period)
    {
        // Obtener la fecha actual
        $now = Carbon::now();

        // Inicializar la consulta base
        $query = DentAppointment::query();

        // Aplicar el filtro según el período
        if ($period === 'day') {
            $query->whereDate('date_appointmen', $now);
        } elseif ($period === 'week') {
            $query->whereBetween('date_appointmen', [$now->startOfWeek(), $now->endOfWeek()]);
        } elseif ($period === 'month') {
            //dd($now->startOfMonth()->format('Y-m-d'));
            $query->whereBetween('date_appointmen', [$now->startOfMonth()->format('Y-m-d'), $now->endOfMonth()->format('Y-m-d')]);
        }

        // Ejecutar la consulta y obtener los resultados
        $query->with('patient');
        $eventDentalAppointments = $query->get();
        //dd($eventDentalAppointments);

        // Devolver los resultados (por ejemplo, a una vista o como JSON)
        return $eventDentalAppointments;
    }
}
