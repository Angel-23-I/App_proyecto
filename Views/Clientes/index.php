<?php include "Views/Templates/header.php"; ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmCliente();">Nuevo <i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblClientes">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Celular</th>
            <th>Direccion</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCliente">
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="hidden" id="id" name="id">
                        <input id="documento" class="form-control" type="text" name="documento" placeholder="Documento de identidad">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del usuario">
                    </div>
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input id="celular" class="form-control" type="text" name="celular" placeholder="Numero de celular">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <textarea id="direccion" class="form-control" name="direccion" placeholder="Direccion" rows="3"></textarea>
                    </div>

                    <button class="btn btn-primary" type="button" onClick="registrarCli(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>