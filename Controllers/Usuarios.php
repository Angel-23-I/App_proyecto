<?php
class Usuarios extends Controller{
    public function __construct() {
       session_start();
       parent::__construct(); 
    }
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
       }
        $data['cajas'] = $this->model->getCajas();
        $this->views->getView($this, "index", $data);
    }
    public function listar() {
       $data = $this->model->getUsuarios();
       for ($i=0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 1) {
            $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="btnEliminarUser('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
            <div/>';
        }else{
            $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-success" type="button" onclick="btnReingresarUser('.$data[$i]['id'].');"><i class="fas fa-circle"></i></button>
            <div/>';
        }
       }
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
       die();
    }
    public function validar()
    {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos estan vacios";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256",$clave);
            $data = $this->model->getUsuario($usuario, $hash);
            if($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $msg = "ok";
            }else{
                $msg = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);
        if (empty($usuario) || empty($nombre) || empty($caja)) {
            $msg = "Todos los campos son obligatorios";
        }else{
            if ($id == "") {
                if($clave != $confirmar){
                $msg = array('msg' => 'Las contraseñas no coinciden', 'icono' => 'error');
                }else{
                    $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $caja);
                    if ($data == "ok") {
                    $msg = "si";
                    } else if($data == "existe") {
                    $msg = array('msg' => 'El usuario ya existe', 'icono' => 'error');
                    } else {
                    $msg = array('msg' => 'Error al registrar el usuario', 'icono' => 'error');
                    }
                }   
            }else{
                $data = $this->model->modificarUsuario($usuario, $nombre, $caja, $id);
                if ($data == "modificado") {
                $msg = "modificado";
                } else {
                $msg = "Error al modificar el usuario";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id) {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id) {
        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id) {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al reingresar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function cambiarPass() {
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];
        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($nueva != $confirmar) {
                $msg = "Las contraseñas no coinciden";
            } else {
                $id = $_SESSION['id_usuario'];
                $hash = hash("SHA256", $actual);
                $data = $this->model->getPass($hash, $id);
                if (!empty($data)) {
                    $verificar = $this->model->modificarPass(hash("SHA256", $nueva), $id);
                    if ($verificar == 1) {
                        $msg = 'ok';
                    } else {
                        $msg = "Error al modificar la contraseña";
                    }
                } else {
                    $msg = "La contraseña actual es incorrecta";
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir(){
        session_destroy();
        header("location: ".base_url);
    }

}
?>

