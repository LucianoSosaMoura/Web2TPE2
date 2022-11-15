<?php

require_once "Model/FeaturedModel.php";
require_once "Model/CiudadModel.php";
require_once "View/ApiView.php";

class ApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new FeaturedModel();
        $this->ciudadModel = new CiudadModel();
        $this->view = new ApiView();

        // lee el body del request
        $this->data = file_get_contents("php://input");

    }

    private function getData() {
        return json_decode($this->data);
    }

    public function obtenerDestacadas() {
        if (isset($_GET['sort'])){
            if (isset($_GET['order'])){
                $order=$_GET['order'];
                if ($order!='desc' && $order!='asc'){
                    return $this->view->response("Ingrese un ordenamiento valido", 400); 
                }
            }
            if (!$order){
                $order="asc";
            }
            $sort=$_GET['sort'];
            if ($sort==='idDestacada' || $sort==='operacion' || $sort==='descripcion' || $sort==='precio' || $sort==='nombreCiudad'){
                if (isset($_GET['operacion'])){
                    $operacion=$_GET['operacion'];
                    if ($operacion==='venta' || $operacion==='alquiler'){
                        if (isset($_GET['limit']) && (isset($_GET['offset']))){
                            $limit=$_GET['limit'];
                            $offset=$_GET['offset'];
                            $destacadas=$this->model->getDestacadasFiltradasOrdenadasPaginadas($operacion, $sort, $order, $limit, $offset);
                            return $this->view->response($destacadas, 200); 
                        }
                    $destacadas=$this->model->getDestacadasFiltradasOrdenadas($operacion, $sort,$order);
                    return $this->view->response($destacadas, 200); 
                    }else{
                        return $this->view->response("Ingrese una operación válida (venta o alquiler)", 400);
                    }
                }
                $destacadas=$this->model->getDestacadasOrdenadas($sort,$order);
                return $this->view->response($destacadas, 200); 
                }
            
            else{
                return $this->view->response("Ingrese un sort valido", 400); 
            }
        }
        
        if (isset($_GET['operacion'])){
            $operacion=$_GET['operacion'];
            if ($operacion==='venta' || $operacion==='alquiler'){
            $destacadas=$this->model->getDestacadasFiltradas($operacion);
            return $this->view->response($destacadas, 200); 
            }else{
                return $this->view->response("Ingrese una operación válida (venta o alquiler)", 400);
            }
        }
        if (isset($_GET['limit']) && (isset($_GET['offset']))){
            $limit=$_GET['limit'];
            $offset=$_GET['offset'];
            $destacadas=$this->model->getDestacadasPaginadas($limit,$offset);
            return $this->view->response($destacadas, 200); 
        }
        
        $destacadas = $this->model->getDestacadas();
        return $this->view->response($destacadas,200);
    }

    public function obtenerDestacada($params = null) {
            // obtengo el id del arreglo de params
            $id = $params[':ID'];
            $destacada = $this->model->getDestacada($id);
    
            // si no existe devuelvo 404
            if ($destacada)
                $this->view->response($destacada, 200);
            else 
                $this->view->response("La propiedad destacada con el id $id no existe", 404);
    }
        
    public function eliminarDestacada($params = null) {
        $id = $params[":ID"];  
        $destacada = $this->model->getDestacada($id);

        if(!empty($destacada)) {
        $this->model->deleteDestacada($id);
        $this->view->response("La propiedad destacada con el id $id fue eliminada.",200); 
        } else {
                $this->view->response("La propiedad destacada con el id $id no existe.",404);    
        }
    }

    public function insertarDestacada() {
        // obtengo el body del request (json)
        $destacada = $this->getData();
        $ciudadDestacada = $destacada->ciudad;
        $ciudades = $this->ciudadModel->getIdCiudades();
        $coincide = false;


        if (empty ($destacada->operacion) || empty ($destacada->descripcion) || empty($destacada->precio) || empty($destacada->ciudad)) {
        $this->view->response("Complete los datos", 400);
        } else {
            foreach ($ciudades as $ciudad) {
                 if ($ciudad->idCiudad === $ciudadDestacada){
                    $coincide = true;
                    $id = $this->model->insertDestacada($destacada->operacion, $destacada->descripcion, $destacada->precio, $destacada->ciudad);
                    $destacada = $this->model->getDestacada($id);
                    $this->view->response("La propiedad destacada con el id $id fue creada.", 201);
                } 
            }  
            if (!$coincide){
                $this->view->response("La ciudad indicada no fue encontrada", 404);
            }      
          }
    }
        
    public function actualizarDestacada($params = []) {
        $id = $params[':ID'];
        $destacada = $this->model->getDestacada($id);
        if ($destacada){
            $body = $this->getData();
            $ciudadDestacada = $body->ciudad;
            $ciudades = $this->ciudadModel->getIdCiudades();
            $coincide = false;
                    
            if (empty ($body->operacion) || empty ($body->descripcion) || empty($body->precio) || empty($body->ciudad)) {
                $this->view->response("Complete los datos", 400);
            } else {
                    foreach ($ciudades as $ciudad) {
                        if ($ciudad->idCiudad === $ciudadDestacada){
                            $coincide = true;
                            $this->model->updateDestacada($body->operacion, $body->descripcion, $body->precio, $body->ciudad, $id);
                            $this->view->response("La propiedad destacada con el id $id fue actualizada con éxito.", 200);
                        } 
                    }  
                    if (!$coincide){
                        $this->view->response("La ciudad indicada no fue encontrada", 404);
                    }      
              }
        }
        else 
            $this->view->response("La propiedad destacada con el id $id no fue encontrada", 404);
    }

}
  


