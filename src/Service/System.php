<?php
namespace App\Service;

class System
{

    public static function all()
    {
        return [
            'hostname'      => self::hostname(),
            'public_ip'     => self::publicIP(),
            'private_ip'    => self::privateIP(),
            'uptime'        => self::uptime(),
            'upsince'       => self::upsince(),
        ];
    }

    /**
     * Get the Hostname
     */
    public static function hostname()
    {
        return @exec('cat /etc/hostname');
    }

    /**
     * Get the Public IP
     */
    public static function publicIP()
    {
        return @exec('curl ifconfig.me');
    }

    /**
     * Set the Private IP
     */
    public static function privateIP()
    {
        return @exec("hostname -I | awk '{print $1}'");
    }

    /**
     * Get Uptime Pretty
     */
    public static function uptime()
    {
        return @exec("uptime -p");
    }

    /**
     * Get Uptime Since
     */
    public static function upsince()
    {
        return @exec("uptime -s");
    }

}
