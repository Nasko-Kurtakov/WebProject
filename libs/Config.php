<?php

class Config
{
    public static function _init(bool $isController)
    {
        $basePath = $isController ? '../' : '../';
        $config = parse_ini_file("${basePath}configs/config.ini", true);
        define('CONFIG', $config);
    }
    
}