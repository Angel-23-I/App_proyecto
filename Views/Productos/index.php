<?php include "Views/Templates/header.php"; ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos</h1>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmProducto();">Nuevo <i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblProductos">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Foto</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProducto">
                    <div class="form-group">
                        <label for="codigo">Codigo</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Descripcion</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Producto">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="precio_compra">Precio Compra</label>
                            <input id="precio_compra" class="form-control" type="text" name="precio_compra" placeholder="$$$">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="precio_venta">Precio Venta</label>
                            <input id="precio_venta" class="form-control" type="text" name="precio_venta" placeholder="$$$">
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medida">Medidas</label>
                                <select id="medida" class="form-control" name="medida">
                                <?php foreach ($data['medidas'] as $row) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categorias</label>
                                <select id="categoria" class="form-control" name="categoria">
                                <?php foreach ($data['categorias'] as $row) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="card">
                                <div class="card-body">
                                <label for="imagen" id="icon-image" class="btn btn-primary"><i class="fas fa-image"></i></label>
                                <span id="icon-cerrar"></span>
                                <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event)">
                                <input type="hidden" id="foto_actual" name="foto_actual">
                                <img class="img-thumbnail" id="img-preview">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" onClick="registrarPro(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>