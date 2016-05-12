<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once(__DIR__.'/model/Empresa.php');



if(isset($_GET['relaciones'])){
	$e = new Empresa();
	echo $e->printAllEmpresas();
}
else{
	$e2 = Empresa::getById($_GET['empresa']);
	echo $e2->printEmpresasForm($_GET['order']);
}

?>