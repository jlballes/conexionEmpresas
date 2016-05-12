<?php

require_once(__DIR__.'/../etc/Db.php');

/**
 *
 */
class Empresa
{
	private $id;
	private $name;

	public function __construct(){
		//TODO
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function create(){
		$db = new Db();
		$conn = $db->connect();
	 
	    $stmt = $conn->prepare("INSERT INTO empresas (nombre) VALUES(:name)");
	    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
	    $stmt->execute();
	}

	public static function getById($id){
		$db = new Db();
		$conn = $db->connect();
	 
	    $stmt = $conn->prepare("SELECT id, nombre FROM empresas WHERE id = :id");
	    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	    $stmt->execute();
	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

	    $instance = new self();
	    $instance->id = $result['id'];
	    $instance->name = $result['nombre'];
	    return $instance;
	}

	public function printAllEmpresas(){
		$db = new Db();
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT idEmpresa1, idEmpresa2, idConexion, posicion, tipoRelacion 
								FROM conexiones
								ORDER BY idConexion, posicion");
	    $stmt->execute();
	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	    return $this->template(__DIR__.'/../templates/listEmpresas.tpl.php', $result);
	}

	public function printEmpresasForm(){
		$vars['order'] = ($_GET['order'] == '0' ? null : $_GET['order']);
		$vars['list'] = $this->getEmpresasRelacionadas($vars['order']);
		$vars['empresas_ids'] = $this->getAllEmpresas();
		$vars['current'] = $this->id;

		return $this->template(__DIR__.'/../templates/listByEmpresa.tpl.php', $vars);

	}

	private function getEmpresasRelacionadas($order){
		$db = new Db();
		$conn = $db->connect();

		if($order != NULL) $orderQuery = ' ORDER BY '.$order;
		else $orderQuery = '';

		$stmt = $conn->prepare("SELECT c.idEmpresa1, e.nombre, c.tipoRelacion 
								FROM empresas e LEFT JOIN conexiones c ON e.id = c.idEmpresa1
								WHERE idEmpresa2 = :id
								UNION
								SELECT c.idEmpresa2, e.nombre, c.tipoRelacion 
								FROM empresas e LEFT JOIN conexiones c ON e.id = c.idEmpresa2
								WHERE idEmpresa1 = :id"
								.$orderQuery);

		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
	    $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private function getAllEmpresas(){
		$db = new Db();
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT id, nombre
								FROM empresas
								ORDER BY nombre");
	    $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	private function template($name, $vars = array()) {
	    ob_start();
	    extract($vars);
	    include $name;
	    $contents = ob_get_contents();
	    ob_end_clean();
	    return $contents;
	}
}




