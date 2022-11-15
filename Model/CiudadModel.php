<?php

class CiudadModel{

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', ''); 
        
    }

    function getCiudades(){
        $sentencia = $this->db->prepare("SELECT * FROM ciudades");
        $sentencia->execute();
        $ciudades = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $ciudades;
    }

    function getIdCiudades(){
        $sentencia = $this->db->prepare("SELECT idCiudad FROM ciudades");
        $sentencia->execute();
        $ciudades = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $ciudades;
    }

    public function addCiudad($nombre, $provincia, $cantidadHabitantes){
        $sentencia = $this->db->prepare("INSERT INTO ciudades(nombre, provincia, cantidadHabitantes) VALUES (?,?,?)");
        $sentencia->execute(array($nombre, $provincia, $cantidadHabitantes));
    }

    public function deleteCiudad($idCiudad){
        $sentencia = $this->db->prepare("DELETE FROM ciudades WHERE idCiudad=?");
        $sentencia->execute(array($idCiudad));
    }

    public function viewCiudad($idCiudad){
        $sentencia = $this->db->prepare("SELECT * FROM propiedades WHERE idCiudad=?");
        $sentencia->execute(array($idCiudad));
        $ciudad = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $ciudad;
    }
    
    function updateCiudad($nombre, $provincia, $cantidadHabitantes, $id){
        $sentencia = $this->db->prepare("UPDATE ciudades SET nombre=?,provincia=?,cantidadHabitantes=? WHERE idCiudad=?");
        $sentencia->execute(array($nombre, $provincia, $cantidadHabitantes, $id));
    }
}