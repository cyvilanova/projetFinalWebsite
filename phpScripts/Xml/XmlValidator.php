<?php

/****************************************
Fichier : XmlValidator.php
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

class XmlValidator
{

    private $xsd;
    private $reader;
    private $errorDetails;

    public function __construct($xsdPath)
    {
        $this->xsd = $xsdPath;
        $this->reader = new XMLReader();
    }

    /**
     * Formats the xml error in a string
     * @return a new error string
     */
    private function libxmlDisplayError($error)
    {
        $errorString = "Error $error->code in $error->file (Line:{$error->line}):";
        $errorString .= trim($error->message);
        return $errorString;
    }

    /**
     * @return array
     */
    private function libxmlDisplayErrors()
    {
        $errors = libxml_get_errors();
        $result = [];
        foreach ($errors as $error) {
            $result[] = $this->libxmlDisplayError($error);
        }
        return $result;
    }

    /**
     * Display Error if Resource is not validated
     *
     * @return array
     */
    public function displayErrors()
    {
        return $this->errorDetails;
    }

    /**
     *  Validates the xml file with the xsd
     *  @param xmlFile path to the file
     *  @return boolean
     */
    public function validate($xmlFile)
    {
        if (!file_exists($this->xsd)) {
            throw new Exception("XSD missing");
            return false;
        }

        $this->reader->open($xmlFile);
        $this->reader->setSchema($this->xsd);

        libxml_use_internal_errors(true);

        while ($this->reader->read()) {
            if (!$this->reader->isValid()) {
                $this->errorDetails = $this->libxmlDisplayErrors();
            } else {
                return true;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getXsd()
    {
        return $this->xsd;
    }

    /**
     * @param mixed $xsd
     *
     */
    public function setXsd($xsd)
    {
        $this->xsd = $xsd;
    }

    /**
     * @return mixed
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * @param mixed $reader
     *
     */
    public function setReader($reader)
    {
        $this->reader = $reader;
    }

    /**
     * @return mixed
     */
    public function getErrorDetails()
    {
        return $this->errorDetails;
    }

    /**
     * @param mixed $errorDetails
     *
     */
    public function setErrorDetails($errorDetails)
    {
        $this->errorDetails = $errorDetails;
    }
}
