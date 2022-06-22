<?php

namespace App\Service;

class ByteFormater
{
    public function format(float $bytes): string
    {
        $symbols = array('Octets', 'Ko', 'Mo', 'Go', 'To', 'Po', 'Eo', 'Zo', 'Yo');
        $exp = floor(log($bytes) / log(1024));
        return number_format($bytes / pow(1024, floor($exp)), 2, ',', ' ') . ' ' . $symbols[$exp];
    }
}