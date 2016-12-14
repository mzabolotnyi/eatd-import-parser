<?php

require_once('functions.php');
require_once('DocumentXML.php');

// break if no file in request
if (empty($_FILES['file']['tmp_name'])
    || empty($_FILES['file_toms']['tmp_name'])
    || empty($_FILES['file_developers']['tmp_name'])
    || empty($_FILES['file_types']['tmp_name'])
) {
    die("Not all files found");
}

// parse excel data to array
$filename = $_FILES['file']['tmp_name'];
$rows = parse_excel_file($filename);

// parse xml files data to arrays
$toms = parse_xml_file_toms($_FILES['file_toms']['tmp_name']);
$developers = parse_xml_file_developers($_FILES['file_developers']['tmp_name']);
$types = parse_xml_file_types($_FILES['file_types']['tmp_name']);

// array for result data
$documents = [];

foreach ($rows as $key => $row) {

    // skip first row
    if ($key === 0) {
        continue;
    }

    $type = array_search($row[0], $types);
    $tomID = array_search(substr($row[1], 0, 250), $toms);
    $developerID = array_search(substr($row[4], 0, 250), $developers);
    $number = substr($row[2], 0, 250);
    $title = substr($row[3], 0, 250);
    //$image = $row[5];
    $image = str_replace('\\','/',str_replace('D:\Ges\Out\\','',$row[5]));

    $document = [
        'type' => $type,
        'tomID' => $tomID,
        'developerID' => $developerID,
        'number' => $number,
        'title' => $title,
        'image' => $image,
    ];

    $documents[] = $document;
}

// prepare files
$documentXML = new DocumentXML();
$documentFile = $documentXML->prepare($documents)->save();

// send response
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . DocumentXML::FILE_NAME);
header('Content-Length: ' . filesize($documentFile));
readfile($documentFile);