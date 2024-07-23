<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getEnumValues')) {
    function getEnumValues($table, $column)
    {
        $result = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'");
        $type = $result[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $enum[] = trim($value, "'");
        }

        return $enum;
    }
}
