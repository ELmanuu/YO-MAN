<?php
require "Automobil.php";
require "AutoService.php";
require "vendor\autoload.php";
require "IgnoreCaseMiddleware.php";
require "DenyCachingMiddleware.php";
require "CreateAutoResult.php";

$config = [
    "settings" => [ 
      "displayErrorDetails" => true,
    ],
    "foundHandler" => function() {
      return new \Slim\Handlers\Strategies\RequestResponseArgs();
    }
];

$app = new \Slim\App($config);
$app->add(new IgnoreCaseMiddleware());
//$app->add(new DenyCachingMiddleware());

$app->get(				//Liefert auf get /automobile eine Liste der Autos
  "/automobile",
  function ($request, $response) {
	 $auto_service = new AutoService();
	 $automobile = $auto_service->readAutos();
	 
	 if ($automobile === AutoService::DATABASE_ERROR) {
		 $response = $response->withstatus(500);
		 return $response;
		}
	 
	 foreach ($automobile as $automobil) {									//durchläuft alle Elemente und führt die u.g. Aktion durch
		 $automobil->url = "/yoman/5_WebService/automobile/$automobil->id";	//generiert für je einen Datensatz die URL aus dem String und der ID
		 unset($automobil->id);												//schmeisst die URL aus DIESEM Datensatz
	 }
	 $response = $response->withJson($automobile);
	 return $response;
  });
  
$app->get(				//Liefert auf get /automobile/id ein einzelnes Auto
  "/automobile/{id}",
  function ($request, $response, $id) {
	 $auto_service = new AutoService();
	 $automobil = $auto_service->readAuto($id);
	 
	 if ($automobil === AutoService::DATABASE_ERROR) {
		 $response = $response->withstatus(500);
		 return $response;
		}
		
	 if ($automobil === AutoService::NOT_FOUND) {
		 $response = $response->withStatus(404);
		 return $response;
		}	 

	 $response = $response->withJson($automobil);
	 return $response;  
  });
  
$app->delete(				//Löscht auf delete /automobile/id ein einzelnes Auto
  "/automobile/{id}",
  function ($request, $response, $id) {
	 $auto_service = new AutoService();
	 $automobil = $auto_service->deleteAuto($id);
	 
	// hier noch eine Response wegen Löschen erfolgreich????
	 
  });
 

$app->run();
?>
