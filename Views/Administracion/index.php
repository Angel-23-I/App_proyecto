<?php include "Views/Templates/header.php"; ?>
<!-- Page Heading -->
<div class="card">
<div class="card-header bg-dark text-white">
        Datos de la empresa
    </div>
    <div class="card-body">
        <form id="frmEmpresa">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <label for="nombre">Nombre</label>
                <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nombre'] ?>">
            </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="nit">NIT</label>
                <input id="nit" class="form-control" type="text" name="nit" value="<?php echo $data['nit'] ?>">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="telefono">Telefono</label>
                <input id="telefono" class="form-control" type="text" name="telefono" value="<?php echo $data['telefono'] ?>">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="direccion">Direccion</label>
                <input id="direccion" class="form-control" type="text" name="direccion" value="<?php echo $data['direccion'] ?>">
                </div>
                </div>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" class="form-control" rows="3" name="mensaje"><?php echo $data['mensaje'] ?></textarea>
            </div>
            <button class="btn btn-primary" type="button" onclick="modificarEmpresa();">Modificar</button>
        </form>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>