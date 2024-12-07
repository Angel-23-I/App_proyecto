<?php

class Compras extends Controller{

    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        }
        $this->views->getView($this, "index");
    }
    public function ventas()
    {
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
       }
        $data = $this->model->getClientes();
        $this->views->getView($this, "ventas", $data);
    }

    public function historial_ventas()
    {
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
       }
        $this->views->getView($this, "historial_ventas");
    }

    public function buscarCodigo($cod)
    {
        $data = $this->model->getProCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresar()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_compra'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalle('detalle',$id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle('detalle',$id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = "ok";
            } else {
                $msg = "Error al ingresar el producto";
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle('detalle',$precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al actualizar el producto";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function ingresarVenta()
    {
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalle('detalle_temp',$id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle('detalle_temp',$id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = "ok";
            } else {
                $msg = "Error al ingresar el producto";
            }
        } else {
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle('detalle_temp',$precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al actualizar el producto";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar($table)
    {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($table, $id_usuario);
        $data['total_pagar'] = $this->model->calcularCompra($table, $id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function delete($id)
    {
        $data = $this->model->deleteDetalle('detalle',$id);
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function deleteVenta($id)
    {
        $data = $this->model->deleteDetalle('detalle_temp',$id);
        if ($data == "ok") {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarCompra()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularCompra('detalle', $id_usuario);
        $data = $this->model->registrarCompra($total['total']);
        if ($data == "ok") {
            $detalle = $this->model->getDetalle('detalle',$id_usuario);
            $id_compra = $this->model->getId('compras');
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $id_pro = $row['id_producto'];
                $sub_total = $cantidad * $precio;
                $this->model->registrarDetalleCompra($id_compra['id'], $id_pro, $cantidad, $precio, $sub_total);
                $stock_actual = $this->model->getProductos($id_pro);
                $stock = $stock_actual['cantidad'] + $cantidad;
                $this->model->actualizarStock($stock, $id_pro);
            }
            $vaciar = $this->model->vaciarDetalle('detalle', $id_usuario);
            if ($vaciar == 'ok') {
                $msg = array('msg' => 'ok', 'id_compra' => $id_compra['id']);
            }
        } else {
            $msg = "Error al registrar la compra";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarVenta($id_cliente)
    {
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularCompra('detalle_temp', $id_usuario);
        $data = $this->model->registrarVenta($id_cliente, $total['total']);
        if ($data == "ok") {
            $detalle = $this->model->getDetalle('detalle_temp',$id_usuario);
            $id_venta = $this->model->getId('ventas');
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $id_pro = $row['id_producto'];
                $sub_total = $cantidad * $precio;
                $this->model->registrarDetalleVenta($id_venta['id'], $id_pro, $cantidad, $precio, $sub_total);
                $stock_actual = $this->model->getProductos($id_pro);
                $stock = $stock_actual['cantidad'] - $cantidad;
                $this->model->actualizarStock($stock, $id_pro);
            }
            $vaciar = $this->model->vaciarDetalle('detalle_temp', $id_usuario);
            if ($vaciar == 'ok') {
                $msg = array('msg' => 'ok', 'id_venta' => $id_venta['id']);
            }
        } else {
            $msg = "Error al registrar la Venta";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPdf($id_compra)
    {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProCompra($id_compra);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P','mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Reporte Compra');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(65,10,utf8_decode($empresa['nombre']), 0, 1, 'C');
        $pdf->Image(base_url . 'Assets/img/logo.jpg', 50, 20, 20, 20);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, 'Nit: ', 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, $empresa['nit'], 0, 1, 'L');


        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Telefono: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');


        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Direccion: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $empresa['direccion'], 0, 1, 'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Compra N°: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $id_compra, 0, 1, 'L');
        $pdf->Ln();

        //Encabezado productos

        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10, 5, 'Cant.', 0, 0, 'L', true);
        $pdf->Cell(30, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Sub Total', 0, 1, 'L', true);
        $total = 0.00;
        $pdf->SetTextColor(0,0,0);
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(30, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
            $pdf->Cell(15, 5, number_format($row['sub_total'], 2, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();

        $pdf->Cell(70, 5, 'Total a pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($total, 2, '.', ','), 0, 1, 'R');
        $pdf->Output();
    }

    public function historial()
    {
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
       }
        $this->views->getView($this, "historial");
    }

    public function listar_historial()
    {
        $data = $this->model->getHistorialCompras();
        for ($i=0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger"  href="'.base_url. "Compras/generarPdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                </div>';
    
           }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar_historial_venta()
    {
        $data = $this->model->getHistorialVentas();
        for ($i=0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger"  href="'.base_url. "Compras/generarPdfVenta/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                </div>';
    
           }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPdfVenta($id_venta)
    {
        $empresa = $this->model->getEmpresa();
        $productos = $this->model->getProVenta($id_venta);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P','mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Reporte Venta');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(65,10,utf8_decode($empresa['nombre']), 0, 1, 'C');
        $pdf->Image(base_url . 'Assets/img/logo.jpg', 50, 20, 20, 20);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, 'Nit: ', 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, $empresa['nit'], 0, 1, 'L');


        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Telefono: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $empresa['telefono'], 0, 1, 'L');


        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Direccion: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $empresa['direccion'], 0, 1, 'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(18, 5, utf8_decode('Venta N°: '), 0, 0, 'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(20, 5, $id_venta, 0, 1, 'L');
        $pdf->Ln();
        //Encabezado clientes

        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(35, 5, 'Nombre', 0, 0, 'L', true);
        $pdf->Cell(35, 5, utf8_decode('Documento'), 0, 1, 'L', true);
        $pdf->SetTextColor(0,0,0);
        $clientes = $this->model->clientesVenta($id_venta);
        $pdf->Cell(35, 5, $clientes['nombre'], 0, 0, 'L');
        $pdf->Cell(35, 5, utf8_decode($clientes['documento']), 0, 1, 'L');
        $pdf->Ln();

        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(35, 5, 'Celular', 0, 0, 'L', true);
        $pdf->Cell(35, 5, utf8_decode('Direccion'), 0, 1, 'L', true);
        $pdf->SetTextColor(0,0,0);
        $clientes = $this->model->clientesVenta($id_venta);
        $pdf->Cell(35, 5, $clientes['celular'], 0, 0, 'L');
        $pdf->Cell(35, 5, $clientes['direccion'], 0, 1, 'L');
        $pdf->Ln();
        //Encabezado productos

        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10, 5, 'Cant.', 0, 0, 'L', true);
        $pdf->Cell(30, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(15, 5, 'Sub Total', 0, 1, 'L', true);
        $total = 0.00;
        $pdf->SetTextColor(0,0,0);
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(30, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
            $pdf->Cell(15, 5, number_format($row['sub_total'], 2, '.', ','), 0, 1, 'L');
        }
        $pdf->Ln();

        $pdf->Cell(70, 5, 'Total a pagar', 0, 1, 'R');
        $pdf->Cell(70, 5, number_format($total, 2, '.', ','), 0, 1, 'R');
        $pdf->Output();
    }
}
?>