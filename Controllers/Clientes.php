<?php
class Clientes extends Controller{
    public function __construct() {
       session_start();
       if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
       }
       parent::__construct(); 
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar() {
       $data = $this->model->getClientes();
       for ($i=0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 1) {
            $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarCli('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="btnEliminarCli('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
            <div/>';
        }else{
            $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-success" type="button" onclick="btnReingresarCli('.$data[$i]['id'].');"><i class="fas fa-circle"></i></button>
            <div/>';
        }

       }
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
       die();
    }

    public function registrar()
    {
        $documento = $_POST['documento'];
        $nombre = $_POST['nombre'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];
        $id = $_POST['id'];
        if (empty($documento) || empty($nombre) || empty($celular) || empty($direccion)) {
            $msg = "Todos los campos son obligatorios";
        }else{
            if ($id == "") {
                    $data = $this->model->registrarCliente($documento, $nombre, $celular, $direccion);
                    if ($data == "ok") {
                    $msg = "si";
                    } else if($data == "existe") {
                    $msg = "El documento ya existe";
                    } else {
                    $msg = "Error al registrar el cliente";
                    }   
            }else{
                $data = $this->model->modificarCliente($documento, $nombre, $celular, $direccion, $id);
                if ($data == "modificado") {
                $msg = "modificado";
                } else {
                $msg = "Error al modificar el cliente";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id) {
        $data = $this->model->editarCli($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id) {
        $data = $this->model->accionCli(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el Cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id) {
        $data = $this->model->accionCli(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al reingresar el Cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

}
?>