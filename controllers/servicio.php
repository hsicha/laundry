<?php
class Servicio extends Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->view->js=array('servcio/js/servicio.js');
    }
    function index(){
       

        $this->view->title="Servicios";
        $this->view->title2="Registro de Servcios";
       $this->view->renderAdmin('servicio/index');

    }
    function ListaServicios(){
        $obtenerLista=$this->model->ListarServicio();
        print $obtenerLista;
    }
    function Registrar(){
        $categoria_mayus = $_POST['descripcion'];
		$categoria_mayus = strtoupper($categoria_mayus);
		if (isset($_POST['idServicio']) && empty($_POST['idServicio'])) {
			$mensajeOk=false;
			if (isset($_POST['descripcion'])) {
				$data = array('DESCRIPCION' => strtoupper(trim($categoria_mayus)));
				$mensaje = $this->model->InsertarServicio($data);
				if($mensaje=="Registrado correctamente"){
					$mensajeOk=true;
					$mensajeError=$mensaje;
				}else{
					$mensajeError=$mensaje;
				}
			}else{
				$mensajeError='Por favor ingrese una categoría';
			}
			$salidaJson=array('respuesta' => $mensajeOk,'mensaje' => $mensajeError, 'valor'=>$categoria_mayus);
			echo json_encode($salidaJson);
		}else{
			header("Location: " . URL . "servicio");
		}
    }
}




?>