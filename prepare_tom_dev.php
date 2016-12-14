<?php

require_once('functions.php');
require_once('TomXML.php');
require_once('DeveloperXML.php');
require_once('DocumentTypeXML.php');

// break if no file in request
if (empty($_FILES['file']['tmp_name'])) {
    die("Not file found");
}

// parse excel data to array
$filename = $_FILES['file']['tmp_name'];
$rows = parse_excel_file($filename);

// arrays for result data
$toms = [];
$developers = [];
$documentTypes = [];

foreach ($rows as $key => $row) {

    // skip first row
    if ($key === 0) {
        continue;
    }

    $tom = substr($row[1], 0, 250);
    $developer = substr($row[4], 0, 250);
    $documentType = substr($row[0], 0, 250);

    if (!empty($tom) && $exist = array_search($tom, $toms) === false) {
        $toms[] = $tom;
    }

    if (!empty($developer) && $exist = array_search($developer, $developers) === false) {
        $developers[] = $developer;
    }

    if (!empty($documentType) && $exist = array_search($documentType, $documentTypes) === false) {
        $documentTypes[] = $documentType;
    }
}

// prepare files
$tomXML = new TomXML();
$tomFile = $tomXML->prepare($toms)->save();

$developerXML = new DeveloperXML();
$developerFile = $developerXML->prepare($developers)->save();

$documentTypeXML = new DocumentTypeXML();
$documentTypeFile = $documentTypeXML->prepare($documentTypes)->save();

// pack files to archive
$files = array($tomFile, $developerFile, $documentTypeFile);
$zipName = 'files.zip';
$zipPath = sys_get_temp_dir() . '/' . $zipName;
$zip = new ZipArchive;
$zip->open($zipPath, ZipArchive::CREATE);
foreach ($files as $file) {
    $zip->addFile($file, basename($file));
}
$zip->close();

// send response
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . $zipName);
header('Content-Length: ' . filesize($zipPath));
readfile($zipPath);