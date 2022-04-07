<?php

namespace App\Helpers;

class CodeGenerator
{
    protected $charts = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function get_code($key)
    {
        $random_num = $this->get_random_num($key);

        $base62_num = $this->get_base62($random_num);

        $random_key = $this->charts[rand(0, 61)];

        $code = $random_key . $base62_num;

        return $code;
    }

    private function get_random_num($key)
    {
        list($ms, $s) = explode(' ', microtime());

        $s -= 1608000000;

        $ms = round($ms * 1000);

        $ms = ($ms < 100) ? $ms * 10 : $ms;

        $num = (int) ($s . $ms);

        $num += $key;

        return $num;
    }

    private function get_base62($c)
    {
        $status = true;
        $base62_num = '';

        do {
            if ($c > 62) {
                $r = $c % 62;
                $c = intdiv($c, 62);

                $base62_num .= $this->charts[$r];
            } else {
                $status = false;

                $base62_num .= $this->charts[$c];
            }
        } while ($status);

        $base62_num = strrev($base62_num);

        return $base62_num;
    }
}
