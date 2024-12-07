<?php
class ClientesModel extends Query{

    private $documento, $nombre, $celular, $direccion, $id, $estado;
    public function __construct(){
       parent::__construct();
    }

    public function getClientes(){
        $sql = "SELECT * FROM clientes";
        //$sql = "SELECT u.*, c.id as direccion, c.caja FROM clientes u INNER JOIN caja c WHERE u.direccion = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCliente(int $documento, string $nombre, string $celular, string $direccion){
        $this->documento = $documento;
        $this->nombre = $nombre;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $verificar = "SELECT * FROM clientes WHERE documento = '$this->documento'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO clientes(documento, nombre, celular, direccion) VALUES (?,?,?,?)";
            $datos = array($this->documento, $this->nombre, $this->celular, $this->direccion);
            $data = $this->save($sql, $datos);
            if ($data == 1){
                $res = "ok";
            }else{
                $res = "error";
            }
            
        } else {
            $res = "existe";
        }
        return $res;

    }


    public function modificarCliente(int $documento, string $nombre, string $celular, string $direccion, int $id){
        $this->documento = $documento;
        $this->nombre = $nombre;
        $this->celular = $celular;
        $this->id = $id;
        $this->direccion = $direccion;
        $sql = "UPDATE clientes SET documento = ?, nombre = ?, celular = ?, direccion = ? WHERE id = ?";
        $datos = array($this->documento, $this->nombre, $this->celular, $this->direccion, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1){
            $res = "modificado";
        }else{
            $res = "error";
        }
            
        return $res;

    }

    public function editarCli(int $id){
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionCli(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE clientes SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    
}
?>