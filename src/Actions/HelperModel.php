<?php
namespace MshMsh\Actions;

trait HelperModel{


    public function getValOfKey($row, $col)
    {
        $key = explode('_', $col);
        if (!$row->{$key[0]}) {
            return '';
        } elseif (method_exists($row->{$key[0]}, $key[1])) {
            return $row->{$key[0]}->{$key[1]}();
        }
        $str = $row->{$key[0]}->{$key[1]}->{app()->getLocale()} ?? $row->{$key[0]}->{$key[1]} ?? $row->$col ?? '';
        return is_string($str) ? $str : '';
    }
}
