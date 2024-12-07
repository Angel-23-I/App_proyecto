<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/style.css">

        <!-- Custom styles for this template-->
        <link href="<?php echo base_url; ?>Assets/css/sb-admin-2.min.css" rel="stylesheet">
    <title>Iniciar Sesión</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form id="frmLogin">
                <img src="<?php echo base_url; ?>/Assets/img/logo.jpg">
                <h1>Iniciar sesion</h1>
                <span></span>
                <input type="email" id="usuario" class="form-control" name="usuario" placeholder="Email">
                <input type="password" id="clave" class="form-control" name="clave" placeholder="Contraseña" >
                <div class="alert alert-danger text-center d-none" id="alerta" role="alert">

                </div>
                <a href="#">Olvidaste la contraseña?</a>
                <button type="submit" onclick="frmLogin(event);">Iniciar sesion</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Bienvenido de nuevo!</h1>
                    <p>Ingrese su usuario y contraseña para acceder al sistema</p>
                </div>
            </div>
        </div>
    </div>

     <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url; ?>Assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url; ?>Assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url; ?>Assets/js/sb-admin-2.min.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
</body>

</html>