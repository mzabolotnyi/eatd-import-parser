<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 07.12.2016
 * Time: 15:54
 */

/*
 * Считывает данные из любого excel файла и созадет из них массив.
 * $filename (строка) путь к файлу от корня сервера
 */
function parse_excel_file( $filename ){
    // подключаем библиотеку
    require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

    $result = array();

    // получаем тип файла (xls, xlsx), чтобы правильно его обработать
    $file_type = PHPExcel_IOFactory::identify( $filename );
    // создаем объект для чтения
    $objReader = PHPExcel_IOFactory::createReader( $file_type );
    $objPHPExcel = $objReader->load( $filename ); // загружаем данные файла в объект
    $result = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив

    return $result;
}

/*
 * Считывает данные из xml файла томов в массив ['id' => 'name']
 */
function parse_xml_file_toms($filename)
{
    $result = array();

    $xml = simplexml_load_file($filename);

    foreach ($xml->row as $node) {
        $id = (int)$node->attributes()['id'];
        $name = $node->field_52->__toString();
        $result[$id] = $name;
    }

    return $result;
}

/*
 * Считывает данные из xml файла разработчиков в массив ['id' => 'name']
 */
function parse_xml_file_developers($filename)
{
    $result = array();

    $xml = simplexml_load_file($filename);

    foreach ($xml->row as $node) {
        $id = (int)$node->attributes()['id'];
        $name = $node->field_53->__toString();
        $result[$id] = $name;
    }

    return $result;
}

/*
 * Считывает данные из xml файла типов в массив ['id' => 'name']
 */
function parse_xml_file_types($filename)
{
    $result = array();

    $xml = simplexml_load_file($filename);

    foreach ($xml->value as $node) {
        $id = (int)$node->attributes()['id'];
        $name = $node->__toString();
        $result[$id] = $name;
    }

    return $result;
}
