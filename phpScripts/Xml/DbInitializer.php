<?php

/****************************************
Fichier : DbInitializer.php
Auteur : David Gaulin
Fonctionnalité : Intitialisation BD via XML
Date : 2019-04-30
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
 ****************************************/

include_once "XmlValidator.php";
include_once "../QueryEngine.php";

class DbInitializer
{

    private $xmlValidator;

    public function __construct($xsdPath)
    {
        $this->xmlValidator = new XmlValidator($xsdPath);
    }

    /**
     * Reads every main nodes and puts
     * everything into arrays
     *
     * @param xml file to read from
    */
    public function initialize($xmlFile)
    {

        $isValid = $this->xmlValidator->validate($xmlFile);

        if ($isValid) {
            $xml = simplexml_load_file($xmlFile);
            $xmlElements = get_object_vars($xml);

            //Key = the name of the table
            //Value = all the times this bloc appears
            foreach ($xmlElements as $key => $value) {

                $tableName = $this->unCamelCase($key);

                if (!is_array($value)) {
                    $value = array($value);
                }

                foreach ($value as $key => $values) {
                    //values == each main node as individual
                    $insertContent = $values;
                    $this->insertInDb($tableName, $values);
                }

            }
        } else {
            $this->showErrors();
        }
    }

    /**
     * Inserts a new row in the db
     * from a read node.
     *
     * @param tableName, name of the table to insert in
     * @param properties, list of what goes into the row to insert
    */
    public function insertInDb($tableName, $properties)
    {

        $queryEngine = new QueryEngine();
        $arrayParameters = (array) $properties;

        if (sizeof($arrayParameters) > 0) {
            $query = "INSERT INTO " . $tableName . " VALUES(DEFAULT";

            foreach ($arrayParameters as $key => $value) {
                $arrayParameters[":" . $key] = $arrayParameters[$key]; //changes the key values to fit the parameter template

                $query .= ",:" . $key;

                unset($arrayParameters[$key]);
            }

            $query .= ")";

            if (!$queryEngine->executeQuery($query, $arrayParameters)) {
                echo "Error while trying to do something";
            }

        }

    }

    /**
     * Takes a string and serpent_case it
     *
     * @param word String to serpent_case
     * @return serpent_cased string
    */
    public function unCamelCase($word)
    {
        return preg_replace(
            '/(^|[a-z])([A-Z])/',
            strtolower(strlen("\\1") ? "\\1_\\2" : "\\2"),
            $word
        );
    }

    /**
     * Echo the errors of the XML
     * file.
     */
    private function showErrors()
    {
        $allErrors = $this->xmlValidator->displayErrors();
        echo "Errors in the XML file <br>";
        if($allErrors != null)
        {
            foreach ($allErrors as $key => $value) {
                echo $value . "<br>";
            }   
        }
    }
}

$init = new DbInitializer("../../xml/verification.xsd");
$init->initialize("../../xml/file.xml");
