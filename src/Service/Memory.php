<?php
namespace App\Service;

class Memory
{

    public static function proc()
    {
        exec('cat /proc/meminfo', $output);

        $memory = [];
        foreach ($output as $item) {
            $row = explode(':', $item, 2);
            $value = round( (int) str_replace('kB', '', $row[1]) / 1000, 2);
            $memory[$row[0]] = trim($value);
        }

        return $memory;
    }

    public static function formatted()
    {
        $proc = self::proc();


    }

}
