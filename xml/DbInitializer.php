<?php
	include_once("XmlValidator.php");
	include_once("../phpScripts/QueryEngine.php");


	class DbInitializer{

		private $xmlValidator;

		public function __construct($xsdPath){
			$this->xmlValidator = new XmlValidator($xsdPath);
		}

		/**
		 * Reads every xml node
		 */
		public function initialize($xmlFile){

			if($this->xmlValidator->validate($xmlFile)){
				echo "yep, ready to start";
				$xml = simplexml_load_file($xmlFile);
				$xmlElements = get_object_vars($xml);

				//Key = the name of the table
				//Value = all the times this bloc appears
				foreach ($xmlElements as $key => $value) {

					$tableName = $this->unCamelCase($key);

					foreach ($value as $key => $values) { //values == each bloc as individual
						$insertContent = $values;
						var_dump($values);
						$this->insertInDb($tableName,$values);
					}

				}
			}
			else{
				echo "Nope, can't do that";
			}
		}

		public function insertInDb($tableName,$properties){

			$queryEngine = new QueryEngine();
		    $arrayParameters = (array) $properties;

			if(sizeof($arrayParameters) > 0){
				$query = "INSERT INTO ".$tableName." VALUES(DEFAULT";


	        
	        
		        foreach ($arrayParameters as $key => $value) {
		       		$arrayParameters[":".$key] = $arrayParameters[$key]; //changes the key values to fit the parameter template

		       		$query .= ",:".$key;

		       		unset($arrayParameters[$key]);
		        }

		        $query .= ")";

		        
		        if (!$queryEngine->executeQuery($query, $arrayParameters)) {
		            echo "Error while trying to do something";
		        }
		        

	        }

		}

		public function unCamelCase($word){
			  return preg_replace(
			    '/(^|[a-z])([A-Z])/', 
			    strtolower(strlen("\\1") ? "\\1_\\2" : "\\2"),
			    $word 
			  ); 
		}
	}



$test = new DbInitializer("verification.xsd");
$test->initialize("file.xml");

?>