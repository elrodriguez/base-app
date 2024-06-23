<?php

use Carbon\Carbon;

if (!function_exists('date_time_format')) {
    function date_time_format($date = null)
    {
        if ($date == null) {
            return Carbon::now()->format('d/m/Y \a \l\a\s H:i \h\o\r\a\s');
        } else {
            return Carbon::parse($date)->format('d/m/Y \a \l\a\s H:i \h\o\r\a\s');
        }
    }
}

if (!function_exists('formatShortMonth')) {
    function formatShortMonth($fecha)
    {
        // Convierte la fecha en un objeto Carbon
        $fechaCarbon = Carbon::parse($fecha);

        // Obtén el día del mes, el nombre del mes y el año
        $dia = $fechaCarbon->format('d');
        $nombreMes = $fechaCarbon->format('M');
        $anio = $fechaCarbon->format('Y');

        // Mapea los nombres de los meses en español
        $nombresMeses = [
            'Jan' => 'Ene',
            'Feb' => 'Feb',
            'Mar' => 'Mar',
            'Apr' => 'Abr',
            'May' => 'May',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Ago',
            'Sep' => 'Sep',
            'Oct' => 'Oct',
            'Nov' => 'Nov',
            'Dec' => 'Dic',
        ];

        // Traduce el nombre del mes
        $nombreMesTraducido = $nombresMeses[$nombreMes] ?? $nombreMes;

        // Formatea la fecha en el formato deseado
        $fechaFormateada = "{$dia}, {$nombreMesTraducido} {$anio}";

        return $fechaFormateada;
    }
}

if (!function_exists('timeElapsed')) {
    function timeElapsed($fecha)
    {
        // Convertir la fecha a un objeto Carbon si es una cadena
        if (is_string($fecha)) {
            $fecha = Carbon::parse($fecha);
        }

        // Obtener la diferencia en segundos
        $diferenciaSegundos = Carbon::now()->diffInSeconds($fecha);

        // Determinar si es un tiempo pasado o futuro
        $tiempoAtras = $diferenciaSegundos < 0 ? true : false;
        $diferenciaSegundos = abs($diferenciaSegundos); // Tomar el valor absoluto

        // Redondear hacia abajo la diferencia de segundos
        $diferenciaSegundos = floor($diferenciaSegundos);

        // Calcula el tiempo transcurrido
        if ($diferenciaSegundos < 60) {
            return $diferenciaSegundos . ' segundos ' . ($tiempoAtras ? 'atrás' : 'adelante');
        } elseif ($diferenciaSegundos < 3600) {
            $minutos = floor($diferenciaSegundos / 60);
            return $minutos . ' minutos ' . ($tiempoAtras ? 'atrás' : 'adelante');
        } elseif ($diferenciaSegundos < 86400) {
            $horas = floor($diferenciaSegundos / 3600);
            return $horas . ' horas ' . ($tiempoAtras ? 'atrás' : 'adelante');
        } elseif ($diferenciaSegundos < 604800) {
            $dias = floor($diferenciaSegundos / 86400);
            return $dias . ' días ' . ($tiempoAtras ? 'atrás' : 'adelante');
        } else {
            $semanas = floor($diferenciaSegundos / 604800);
            return $semanas . ' semanas ' . ($tiempoAtras ? 'atrás' : 'adelante');
        }
    }
}
