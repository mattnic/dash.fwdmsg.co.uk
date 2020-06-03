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
            $memory[$row[0]] = trim($row[1]);
        }

        return $memory;
    }

    public static function formatted()
    {
        $proc = self::proc();


    }

}
