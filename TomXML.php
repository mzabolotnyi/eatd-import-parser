<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 07.12.2016
 * Time: 12:20
 */

require_once('XML.php');

class TomXML extends XML
{
    CONST FILE_NAME = 'toms.xml';

    /**
     * Prepare object $xml
     *
     * @param $toms
     * @return TomXML
     */
    public function prepare($toms)
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $table = $xml->appendChild($xml->createElement('table'));

        foreach ($toms as $tom) {
            $row = $table->appendChild($xml->createElement('row'));
            $name = $row->appendChild($xml->createElement('field_52'));
            $name->appendChild($xml->createTextNode($tom));
        }

        $xml->formatOutput = true;

        $this->xml = $xml;

        return $this;
    }

    /**
     * Save xml to temp directory and return path on success
     *
     * @return bool|string
     */
    public function save()
    {
        $filename = $this->getTempFilePath(self::FILE_NAME);

        if ($this->xml->save($filename)) {
            return $filename;
        } else {
            return false;
        }
    }
}