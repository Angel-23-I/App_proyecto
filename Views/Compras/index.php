<?php include "Views/Templates/header.php"; ?>
<!-- Page Heading -->
<div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Nueva Compra</h4>
        </div>
    <div class="card-body">
        <form id="frmCompra">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="codigo"><i class="fas fa-barcode"></i>Codigo</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo producto" onkeyup="buscarCodigo(event);">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="nombre">Descripción</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripcion producto" disabled>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="cantidad">Cant.</label>
                        <input id="cantidad" class="form-control" type="text" name="cantidad" onkeyup="calcularPrecio(event);" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio$" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sub_total">Sub Total</label>
                        <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub total$" disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table table-light table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
        <th>Id</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Sub Total</th>
        <th></th>
    </tr>
    </thead>
    <tbody id="tblDetalle">
    </tbody>
</table>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 ml-auto">
                <div class="form-group">
                    <label for="total" class="font-weight-bold">Total</label>
                    <input id="total" class="form-control" type="text" name="total" placeholder="Total$" disabled>
                    <button class="btn btn-primary mt-2 btn-block" type="button" onclick="procesar(1);">Generar Compra</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>