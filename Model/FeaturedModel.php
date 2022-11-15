<?php

class FeaturedModel {

    private $db;
    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', ''); 
    }

    function getDestacadas(){
        $sentencia = $this->db->prepare('SELECT destacadas.*, ciudades.nombre as nombreCiudad FROM destacadas INNER JOIN ciudades ON destacadas.ciudad = ciudades.idCiudad');
        $sentencia->execute();
        $destacadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $destacadas;
    } 

    function getDestacadasOrdenadas($sort, $order){
        $sentencia = $this->db->prepare("SELECT destacadas.*, ciudades.nombre as nombreCiudad FROM destacadas INNER JOIN ciudades ON destacadas.ciudad = ciudades.idCiudad ORDER BY $sort $order");
        $sentencia->execute();
        $destacadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $destacadas;
    } 

    function getDestacadasFiltradas($operacion){
        $sentencia = $this->db->prepare('SELECT destacadas.*, ciudades.nombre as nombreCiudad FROM destacadas INNER JOIN ciudades ON destacadas.ciudad = ciudades.idCiudad WHERE operacion=?');
        $sentencia->execute(array($operacion));
        $destacadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $destacadas;
    } 

    function getDestacadasFiltradasOrdenadas($operacion, $sort, $order){
        $sentencia = $this->db->prepare("SELECT destacadas.*, ciudades.nombre as nombreCiudad FROM destacadas INNER JOIN ciudades ON destacadas.ciudad = ciudades.idCiudad WHERE operacion=? ORDER BY $sort $order");
        $sentencia->execute(array($operacion));
        $destacadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $destacadas;
    } 

    function getDestacadasFiltradasOrdenadasPaginadas($operacion, $sort, $order, $limit, $offset){
        $sentencia = $this->db->prepare("SELECT destacadas.*, ciudades.nombre as nombreCiudad FROM destacadas INNER JOIN ciudades ON destacadas.ciudad = ciudades.idCiudad WHERE operacion=? ORDER BY $sort $order LIMIT $limit OFFSET $offset");
        $sentencia->execute(array($operacion));
        $destacadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $destacadas;
    } 

    function getDestacadasPaginadas($limit, $offset){
        $sentencia = $this->db->prepare("SELECT destacadas.*, ciudades.nombre as nombreCiudad FROM destacadas INNER JOIN ciudades ON destacadas.ciudad = ciudades.idCiudad LIMIT $limit OFFSET $offset");
        $sentencia->execute();
        $destacadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $destacadas;
    } 

    function getDestacada($id){
        $sentencia = $this->db->prepare('SELECT destacadas.*, ciudades.nombre as nombreCiudad FROM destacadas INNER JOIN ciudades ON destacadas.ciudad = ciudades.idCiudad WHERE idDestacada=?');
        $sentencia->execute(array($id));
        $destacada = $sentencia->fetch(PDO::FETCH_OBJ);
        return $destacada;
    }

    function insertDestacada($operacion, $descripcion, $precio, $ciudad) {
        $sentencia = $this->db->prepare("INSERT INTO destacadas(operacion, descripcion, precio, ciudad) VALUES(?, ?, ?, ?)");
        $sentencia->execute(array($operacion, $descripcion, $precio, $ciudad));
        return $this->db->lastInsertId();
    }   

    function deleteDestacada($id){
        $sentencia = $this->db->prepare("DELETE FROM destacadas WHERE idDestacada=?");
        $sentencia->execute(array($id));
    }

    public function updateDestacada($operacion, $descripcion, $precio, $ciudad, $id){
        $sentencia = $this->db->prepare("UPDATE destacadas SET operacion=?,descripcion=?,precio=?, ciudad=? WHERE idDestacada=?");
        $sentencia->execute(array($operacion, $descripcion, $precio, $ciudad, $id));
    }

}