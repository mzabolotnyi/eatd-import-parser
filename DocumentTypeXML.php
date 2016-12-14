<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 07.12.2016
 * Time: 12:20
 */

require_once('XML.php');

class DocumentTypeXML extends XML
{
    CONST FILE_NAME = 'document-types.xml';

    /**
     * Prepare object $xml
     *
     * @param $toms
     * @return DocumentTypeXML
     */
    public function prepare($documentTypes)
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $list = $xml->appendChild($xml->createElement('list'));

        foreach ($documentTypes as $documentType) {
            $value = $list->appendChild($xml->createElement('value'));
            $value->appendChild($xml->createTextNode($documentType));
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