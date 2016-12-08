<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 07.12.2016
 * Time: 12:20
 */
class XML
{
    /**
     * @var DOMDocument
     */
    protected $xml;

    protected function getTempFilePath($filename){
        return sys_get_temp_dir() . '/' . $filename;
    }
}