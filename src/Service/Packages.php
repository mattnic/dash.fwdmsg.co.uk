<?php
namespace App\Service;

class Packages
{

    public static function all()
    {
        return [
            'available'     => self::getAvailable(),
            'restart'       => self::getRestart(),
            'packages'      => self::getPackages(),
        ];
    }

    /**
     *
     */
    private static function getAvailable()
    {
        $updates = '0;0';
        exec('/usr/lib/update-notifier/apt-check --human-readable | grep -P \'([\d]+)\' -o', $exec);
        if (is_array($exec)) {
            $updates = '';
            foreach ($exec as $item) {
                if ($updates !== '') { $updates .= ';'; }
                $updates .= $item;
            }
        }

        $available = explode(';', $updates);

        return [
            'total'     => $available[0],
            'security'  => $available[1],
        ];
    }

    /**
     * @return array
     */
    public static function getPackages()
    {
        @exec('apt list --upgradable', $updates);

        $packages = array();
        if (count($updates) > 1) {
            unset($updates[0]);

            foreach ($updates as $update) {
                $temp1 = explode('/', $update, 2);
                $name = $temp1[0];

                $temp2 = explode(' ', $temp1[1], 3);
                $latest = $temp2[1];

                preg_match('/from: (.*)\]/', $temp2[2], $temp3);
                $current = $temp3[1];

                $packages[] = [
                    'name'     => $name,
                    'current'  => $current,
                    'latest'   => $latest,
                ];
            }
        }

        return $packages;
    }

    /**
     * @return bool
     */
    public static function getRestart()
    {
        $restart = "false";
        $exec = exec('test -f "/var/run/reboot-required" && echo true || echo false' );
        if ($exec === "true") { $restart = "true"; }

        return $restart;
    }
}
