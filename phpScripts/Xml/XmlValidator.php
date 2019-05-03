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
    private $validator;
    private $xsd;

    public function __construct($xsdPath)
    {   
        $this->validator =  new DOMDocument();
        $this->xsd = $xsdPath;
    }

    /**
     * Display Error if Resource is not validated
     *
     * @return array
     */
    public function getErrors()
    {
        return libxml_get_errors();
    }

    /**
     *  Validates the xml file with the xsd
     *  @param xmlFile path to the file
     *  @return boolean
     */
    public function validate($xmlFile)
    {
        libxml_use_internal_errors(true); //Doesnt show the errors automatically

        if (!file_exists($this->getXsd())) {
            throw new Exception("XSD missing");
            return false;
        }

        $this->validator->load($xmlFile, LIBXML_NOBLANKS);

        if (!$this->validator->schemaValidate($this->getXsd())) //Errors in the xml file
        {
           return false;
        }
        else{              //No errors
            return true;
        }
    }



    /**
     * @return mixed
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param mixed $validator
     *
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
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
}
