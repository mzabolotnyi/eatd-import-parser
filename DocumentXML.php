<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 07.12.2016
 * Time: 12:20
 */

require_once('XML.php');

class DocumentXML extends XML
{
    CONST FILE_NAME = 'documents.xml';

    /**
     * Prepare object $xml
     *
     * @param $documents
     * @return TomXML
     */
    public function prepare($documents)
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $table = $xml->appendChild($xml->createElement('table'));

        foreach ($documents as $document) {

            $row = $table->appendChild($xml->createElement('row'));

            // number
            $field = $row->appendChild($xml->createElement('field_54'));
            $field->appendChild($xml->createTextNode($document['number']));

            // title
            $field = $row->appendChild($xml->createElement('field_55'));
            $field->appendChild($xml->createTextNode($document['title']));

            // image
            $field = $row->appendChild($xml->createElement('field_57'));

            $file = $field->appendChild($xml->createElement('file'));

            $fileName = $xml->createAttribute('name');
            $fileName->value = 'main';

            $file->appendChild($fileName);
            $file->appendChild($xml->createTextNode($document['image']));

            // type
            $field = $row->appendChild($xml->createElement('field_58'));
            $field->appendChild($xml->createTextNode($document['type']));

            // toms
            $field = $row->appendChild($xml->createElement('merge_data_10'));
            if (!empty($document['tomID'])) {
                $relation = $field->appendChild($xml->createElement('relation'));
                $relation->appendChild($xml->createTextNode($document['tomID']));
            }

            // developers
            $field = $row->appendChild($xml->createElement('merge_data_11'));
            if (!empty($document['developerID'])) {
                $relation = $field->appendChild($xml->createElement('relation'));
                $relation->appendChild($xml->createTextNode($document['developerID']));
            }
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