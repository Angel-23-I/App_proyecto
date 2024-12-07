</div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Admin fruver 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona Logout para cerrar la sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="<?php echo base_url; ?>Usuarios/salir">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <div id="cambiarPass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Modificar contraseña</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmCambiarPass" onsubmit="frmCambiarPass(event);">
                        <div class="form-group">
                            <label for="clave_actual">Contraseña Actual</label>
                            <input id="clave_actual" class="form-control" type="password" name="clave_actual" placeholder="Contraseña Actual">
                        </div>
                        <div class="form-group">
                            <label for="clave_nueva">Contraseña Nueva</label>
                            <input id="clave_nueva" class="form-control" type="password" name="clave_nueva" placeholder="Contraseña nueva">
                        </div>
                        <div class="form-group">
                            <label for="confirmar_clave">Confirmar Contraseña Nueva</label>
                            <input id="confirmar_clave" class="form-control" type="password" name="confirmar_clave" placeholder="Confirmar contraseña">
                        </div>
                        <button class="btn btn-primary" type="submit">Modificar</button>
                    </form>
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

    <!-- Datatables-->
    <script src="<?php echo base_url; ?>Assets/Datatables/dataTables.min.js"></script>

    <!-- Page level plugins 
    <script src="<?php echo base_url; ?>Assets/vendor/chart.js/Chart.min.js"></script>

    // Page level custom scripts 
    <script src="<?php echo base_url; ?>Assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/demo/chart-pie-demo.js"></script>-->
    <script>
    const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/select2.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/funciones.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/registrar.js"></script>


</body>

</html>