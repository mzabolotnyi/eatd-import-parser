<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 07.12.2016
 * Time: 15:54
 */

/*
 * ��������� ������ �� ������ excel ����� � ������� �� ��� ������.
 * $filename (������) ���� � ����� �� ����� �������
 */
function parse_excel_file( $filename ){
    // ���������� ����������
    require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

    $result = array();

    // �������� ��� ����� (xls, xlsx), ����� ��������� ��� ����������
    $file_type = PHPExcel_IOFactory::identify( $filename );
    // ������� ������ ��� ������
    $objReader = PHPExcel_IOFactory::createReader( $file_type );
    $objPHPExcel = $objReader->load( $filename ); // ��������� ������ ����� � ������
    $result = $objPHPExcel->getActiveSheet()->toArray(); // ��������� ������ �� ������� � ������

    return $result;
}

/*
 * ��������� ������ �� xml ����� ����� � ������ ['id' => 'name']
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
 * ��������� ������ �� xml ����� ������������� � ������ ['id' => 'name']
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
 * ��������� ������ �� xml ����� ����� � ������ ['id' => 'name']
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
