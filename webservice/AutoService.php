<?php
	class AutoService {
		const OK = "OK";
		const DATABASE_ERROR = "DATABASE_ERROR";
		const NOT_FOUND = "NOT_FOUND";
		const INVALID_INPUT = "INVALID_INPUT";
		const VERSION_OUTDATED = "VERSION_OUTDATED";

		
		public function readAutos(){
		
			$link = new mysqli("localhost","root","","yoman");
			if ($link->connect_error !== NULL) {
					return AutoService::DATABASE_ERROR;
			}
			$link->set_charset("utf8");
			
			$select_statement = "SELECT id, kennzeichen, marke, modell, besitzer, ".
								"erstzulassung, letzter_tuev, ".
							    "TIMESTAMPDIFF(YEAR, erstzulassung, NOW()) AS auto_alter, ".
								"letzter_tuev <= CURDATE()-INTERVAL 730 DAY as tuev_faellig, ".
								"notizen, service, version ".
								"FROM automobile ".
								"ORDER BY erstzulassung ASC";
				
				$result_set = $link->query($select_statement);
			
				$automobile = array();	
				$automobil = $result_set->fetch_object("Automobil");
				while($automobil !== NULL) {
					$automobile[] = $automobil;
					$automobil = $result_set->fetch_object("Automobil");
				}
				
			$link->close();
			return $automobile;
		}
		
public function readAuto($id){
		
			$link = new mysqli("localhost","root","","yoman");
				if ($link->connect_error !== NULL) {
					return AutoService::DATABASE_ERROR;
					}
			$link->set_charset("utf8");
			
			$select_statement = "SELECT id, kennzeichen, marke, modell, besitzer, ".
								"erstzulassung, letzter_tuev, ".
							    "TIMESTAMPDIFF(YEAR, erstzulassung, NOW()) AS auto_alter, ".
								"letzter_tuev <= CURDATE()-INTERVAL 730 DAY as tuev_faellig, ".
								"notizen, service, version ".
								"FROM automobile ".
								"WHERE id = $id";
				
				$result_set = $link->query($select_statement);
				
				$automobil = $result_set->fetch_object("Automobil");
					if ($automobil === NULL) {
						return AutoService::NOT_FOUND;
					}	
			$link->close();
			return $automobil;
		}

public function deleteAuto($id){
		
			$link = new mysqli("localhost","root","","yoman");
				if ($link->connect_error !== NULL) {
					return AutoService::DATABASE_ERROR;
					}
			$link->set_charset("utf8");
			
			$select_statement = "DELETE FROM automobile WHERE id = $id";
				
			$link->query($select_statement);
				
			$link->close();
		}		

public function createAuto($automobil){
		
			if ($automobil->kennzeichen === "") {
				$result = new CreateAutoResult();
				$result->status_code = AutoService::INVALID_INPUT;
				$result->validation_messages["kennzeichen"] = "Es dürfen nur zugelassene Autos eingetragen werden, Du Idiot.";									
				return $result;
			}
	
			$link = new mysqli("localhost","root","","yoman");
				if ($link->connect_error !== NULL) {
					return AutoService::DATABASE_ERROR;
					}
			$link->set_charset("utf8");
			$insert_statement =	"INSERT INTO automobile SET ".
								"kennzeichen = '$automobil->kennzeichen', ".
								"marke = '$automobil->marke', ".
								"modell = '$automobil->modell', ".
								"besitzer = '$automobil->besitzer', ".
								"erstzulassung = '$automobil->erstzulassung', ".
								"letzter_tuev = '$automobil->letzter_tuev', ".
								"notizen = '$automobil->notizen', ".
								"version = 1";
								
			$link->query($insert_statement);
			$id = $link->insert_id;
			$link->close();
			$result = new CreateAutoResult();
			$result->status_code = AutoService::OK;
			$result->id = $id;
			return $result;		
		}
		
public function updateAuto($automobil){
		
			if ($automobil->kennzeichen === "") {
				$result = new CreateAutoResult();
				$result->status_code = AutoService::INVALID_INPUT;
				$result->validation_messages["kennzeichen"] = "Es dürfen nur zugelassene Autos eingetragen werden, Du Idiot.";									
				return $result;
			}
	
			$link = new mysqli("localhost","root","","yoman");
				if ($link->connect_error !== NULL) {
					return AutoService::DATABASE_ERROR;
					}
			$link->set_charset("utf8");
			$insert_statement =	"INSERT INTO automobile SET ".
								"kennzeichen = '$automobil->kennzeichen', ".
								"marke = '$automobil->marke', ".
								"modell = '$automobil->modell', ".
								"besitzer = '$automobil->besitzer', ".
								"erstzulassung = '$automobil->erstzulassung', ".
								"letzter_tuev = '$automobil->letzter_tuev', ".
								"notizen = '$automobil->notizen', ".
								"version = 1";
								
			$link->query($insert_statement);
			$id = $link->insert_id;
			$link->close();
			$result = new CreateAutoResult();
			$result->status_code = AutoService::OK;
			$result->id = $id;
			return $result;		
		}
		
	}
?>