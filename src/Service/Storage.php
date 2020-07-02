<?php
namespace App\Service;

class Storage
{

    public static function get()
    {
        exec('df -hTP -t ext4 -t nfs4', $rawstorage);

        $x=0;
        $storage = array('head' => [], 'data' => []);
        foreach ($rawstorage as $item) {
            $item = str_replace(' ', '§', $item);
            $item = preg_replace("/(§)\\1+/", "$1", $item);
            $item = str_replace('§', ' ', $item);

            $temp = explode(' ', $item);
            if ($x===0) {
                $head = array();
                foreach ($temp as $heading) {
                    if ($heading !== 'on')
                        $head[] = $heading;
                }

                $storage['head'] = $head;
            } else {
                $storage['data'][] = $temp;
            }
            $x++;
        }

        return $storage;
    }

}
