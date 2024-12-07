<?php include "Views/Templates/header.php"; ?>
<!-- Page Heading -->
<style>
        .module {
            width: 100%;
            max-width: 600px;
            height: 300px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            padding-top: 30px;
        }

        .module:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
        .module p {
            font-weight: bold;
            margin: 0;
        }
        .module.purple { background-color: #6f42c1; }
        .module.blue { background-color: #007bff; }
        .module.green { background-color: #28a745; }
        .module.orange { background-color: #fd7e14; }
    </style>
<div class="row">
    <div class="col-xl-12 col-md-6">
        <div class="card">
            <div class="card-body d-flex">
            <i class="fas fa-home fa-2x mr-2"></i>
            MENU PRINCIPAL
            </div>
        </div>
    </div>
</div>
<div class="container modules mt-5">
    <div class="row g-3">
        <div class="col-6 d-flex justify-content-center mb-4">
            <button class="module purple btn btn-primary text-center p-3" onclick="window.location.href='<?php echo base_url; ?>Compras'" >
                <p><i class="fas fa-shopping-cart fa-3x mr-2"></i>NUEVA COMPRA</p>
            </button>
        </div>
        <div class="col-6 d-flex justify-content-center mb-4" >
            <button class="module blue btn btn-primary text-center p-3"  onclick="window.location.href='<?php echo base_url; ?>Compras/ventas'">
                <p><i class="fas fa-cash-register fa-3x mr-2"></i>NUEVA VENTA</p>
            </button>
        </div>
        <div class="col-6 d-flex justify-content-center">
            <button class="module green btn btn-primary text-center p-3" onclick="window.location.href='<?php echo base_url; ?>Clientes'">
                <p><i class="fas fa-user-friends fa-3x mr-2"></i>CLIENTES</p>
            </button>
        </div>
        <div class="col-6 d-flex justify-content-center">
            <button class="module orange btn btn-primary text-center p-3" onclick="window.location.href='<?php echo base_url; ?>Productos'">
                <p><i class="fas fa-boxes fa-3x mr-2"></i>PRODUCTOS</p>
            </button>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>