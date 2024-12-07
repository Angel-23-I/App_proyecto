let tblUsuarios, tblClientes, tblProductos;
document.addEventListener("DOMContentLoaded", function() {
    $('#cliente').select2();
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
            },
            {
            'data' : 'usuario'
            },
            {
            'data' : 'nombre'
            },
            {
            'data' : 'caja'
            },
            {
            'data' : 'estado'
            },
            {
            'data' : 'acciones'
            }
        ]
    });
    //Fin de tabla usuarios
    tblClientes = $('#tblClientes').DataTable( {
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
            },
            {
            'data' : 'documento'
            },
            {
            'data' : 'nombre'
            },
            {
            'data' : 'celular'
            },
            {
            'data' : 'direccion'
            },
            {
            'data' : 'estado'
            },
            {
            'data' : 'acciones'
            }
        ]
    });

    //Fin tabla clientes
    tblProductos = $('#tblProductos').DataTable( {
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
            },
            {
            'data' : 'imagen'
            },
            {
            'data' : 'codigo'
            },
            {
            'data' : 'descripcion'
            },
            {
            'data' : 'precio_venta'
            },
            {
            'data' : 'cantidad'
            },
            {
            'data' : 'estado'
            },
            {
            'data' : 'acciones'
            }
        ]
    });

    //Fin tabla productos
    $('#t_historial_c').DataTable( {
        ajax: {
            url: base_url + "Compras/listar_historial",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
            },
            {
            'data' : 'total'
            },
            {
            'data' : 'fecha'
            },
            {
            'data' : 'acciones'
            }
        ],
    });

    //Fin tabla historial compras
    $('#t_historial_v').DataTable( {
        ajax: {
            url: base_url + "Compras/listar_historial_venta",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
            },
            {
            'data' : 'nombre'
            },
            {
            'data' : 'total'
            },
            {
            'data' : 'fecha'
            },
            {
            'data' : 'acciones'
            }
        ],
    });



})


function frmCambiarPass(e) {
    e.preventDefault();
    const actual = document.getElementById('clave_actual').value;
    const nueva = document.getElementById('clave_nueva').value;
    const confirmar = document.getElementById('confirmar_clave').value;

    if (actual == '' || nueva == '' || confirmar == '') {
        alertas('Todos los campos son obligatorios', 'warning');
    } else {
        if (nueva != confirmar) {
            alertas('Las contraseñas no coinciden', 'warning');
        } else {
            const url = base_url + "Usuarios/cambiarPass";
        const frm = document.getElementById("frmCambiarPass");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == 'ok'){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Clave modificada con exito",
                        showConfirmButton: false,
                        timer: 3000
                      });
                      $("#cambiarPass") .modal("hide");
                      frm.reset();
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      });
                }
            }
        }
        }
    }
}
function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}
function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    const url = base_url + "Usuarios/editar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                usuario = document.getElementById("id").value = res.id;
                usuario = document.getElementById("usuario").value = res.usuario;
                nombre = document.getElementById("nombre").value = res.nombre;
                caja = document.getElementById("caja").value = res.id_caja;
                document.getElementById("claves").classList.add("d-none");
                $("#nuevo_usuario").modal("show");
            }
        }
}

function btnEliminarUser(id) {
    Swal.fire({
        title: "Estas seguro?",
        text: "El estado del usuario cambiara a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        if(res == "ok"){
                            Swal.fire({
                                title: "Eliminado!",
                                text: "El usuario ha sido cambiado a inactivo.",
                                icon: "success"
                              });
                              tblUsuarios.ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Error!",
                                text: res,
                                icon: "error"
                              });
                        }
                    }
                }

        }
      });
}
function btnReingresarUser(id) {
    Swal.fire({
        title: "Estas seguro?",
        text: "El estado del usuario cambiara a activo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        if(res == "ok"){
                            Swal.fire({
                                title: "Hecho!",
                                text: "El usuario ha sido cambiado a activo.",
                                icon: "success"
                              });
                              tblUsuarios.ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Error!",
                                text: res,
                                icon: "error"
                              });
                        }
                    }
                }

        }
      });
}
//Fin Usuarios
function frmCliente() {
    document.getElementById("title").innerHTML = "Nuevo Cliente";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    //document.getElementById("frmUsuario").reset();
    $("#nuevo_cliente").modal("show");
    document.getElementById("id").value = "";
}
function btnEditarCli(id) {
    document.getElementById("title").innerHTML = "Actualizar cliente";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    const url = base_url + "Clientes/editar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("documento").value = res.documento;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("celular").value = res.celular;
                document.getElementById("direccion").value = res.direccion;
                $("#nuevo_cliente").modal("show");
            }
        }
}

function btnEliminarCli(id) {
    Swal.fire({
        title: "Estas seguro?",
        text: "El estado del cliente cambiara a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/eliminar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        if(res == "ok"){
                            Swal.fire({
                                title: "Eliminado!",
                                text: "El cliente ha sido cambiado a inactivo.",
                                icon: "success"
                              });
                              tblClientes.ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Error!",
                                text: res,
                                icon: "error"
                              });
                        }
                    }
                }

        }
      });
}
function btnReingresarCli(id) {
    Swal.fire({
        title: "Estas seguro?",
        text: "El estado del usuario cambiara a activo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/reingresar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        if(res == "ok"){
                            Swal.fire({
                                title: "Hecho!",
                                text: "El cliente ha sido cambiado a activo.",
                                icon: "success"
                              });
                              tblClientes.ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Error!",
                                text: res,
                                icon: "error"
                              });
                        }
                    }
                }

        }
      });
}

//Fin cajas

//Fin medidas

//Fin categorias

function frmProducto() {
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmProducto").reset();
    document.getElementById("id").value = "";
    $("#nuevo_producto").modal("show");
    deleteImg();
}
function btnEditarPro(id) {
    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    const url = base_url + "Productos/editar/"+id;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("codigo").value = res.codigo;
                document.getElementById("nombre").value = res.descripcion;
                document.getElementById("precio_compra").value = res.precio_compra;
                document.getElementById("precio_venta").value = res.precio_venta;
                document.getElementById("medida").value = res.id_medida;
                document.getElementById("categoria").value = res.id_categoria;
                document.getElementById("img-preview").src = base_url + 'Assets/img/'+ res.foto;
                document.getElementById("icon-cerrar").innerHTML = `<button class="btn btn-danger" onclick="deleteImg();"><i class="fas fa-times"></i></button>`;
                document.getElementById("icon-image").classList.add("d-none");
                document.getElementById("foto_actual").value = res.foto;
                $("#nuevo_producto").modal("show");
            }
        }
}

function btnEliminarPro(id) {
    Swal.fire({
        title: "Estas seguro?",
        text: "El estado del producto cambiara a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/eliminar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        if(res == "ok"){
                            Swal.fire({
                                title: "Eliminado!",
                                text: "El Producto ha sido cambiado a inactivo.",
                                icon: "success"
                              });
                              tblProductos.ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Error!",
                                text: res,
                                icon: "error"
                              });
                        }
                    }
                }

        }
      });
}
function btnReingresarPro(id) {
    Swal.fire({
        title: "Estas seguro?",
        text: "El estado del Producto cambiara a activo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, activalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/reingresar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        if(res == "ok"){
                            Swal.fire({
                                title: "Hecho!",
                                text: "El producto ha sido cambiado a activo.",
                                icon: "success"
                              });
                              tblProductos.ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Error!",
                                text: res,
                                icon: "error"
                              });
                        }
                    }
                }

        }
      });
}

function preview(e) {
    //console.log(e.target.files);
    const url = e.target.files[0];
    const urlTemp = URL.createObjectURL(url);
    document.getElementById("img-preview").src = urlTemp;
    document.getElementById("icon-image").classList.add("d-none");
    document.getElementById("icon-cerrar").innerHTML = `<button class="btn btn-danger" onclick="deleteImg();"><i class="fas fa-times"></i></button>
    ${url['name']}`;
}

function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
}

function buscarCodigo(e) {
    e.preventDefault();
    const cod = document.getElementById("codigo").value;
    if (cod != '') {
        if (e.which == 13) {
            const url = base_url + "Compras/buscarCodigo/"+ cod;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    //console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res) {
                        document.getElementById("nombre").value = res.descripcion;
                        document.getElementById("precio").value = res.precio_compra;
                        document.getElementById("id").value = res.id;
                        document.getElementById("cantidad").removeAttribute('disabled');
                        document.getElementById("cantidad").focus();
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Producto no encontrado",
                            showConfirmButton: false,
                            timer: 2000
                         });
                         document.getElementById("codigo").value = '';
                         document.getElementById("codigo").focus();
                    }
                }
            }
        }
    } else {
        alertas('Ingrese el codigo', 'warning');
    }
}

function buscarCodigoVenta(e) {
    e.preventDefault();
    const cod = document.getElementById("codigo").value;
    if (cod != '') {
        if (e.which == 13) {
            const url = base_url + "Compras/buscarCodigo/"+ cod;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    //console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res) {
                        document.getElementById("nombre").value = res.descripcion;
                        document.getElementById("precio").value = res.precio_venta;
                        document.getElementById("id").value = res.id;
                        document.getElementById("cantidad").removeAttribute('disabled');
                        document.getElementById("cantidad").focus();
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Producto no encontrado",
                            showConfirmButton: false,
                            timer: 2000
                         });
                         document.getElementById("codigo").value = '';
                         document.getElementById("codigo").focus();
                    }
                }
            }
        }
    } else {
        alertas('Ingrese el codigo', 'warning');
    }
}

function calcularPrecio(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    document.getElementById("sub_total").value = precio * cant;
    if(e.which == 13) {
        if (cant > 0) {
            const url = base_url + "Compras/ingresar";
            const frm = document.getElementById("frmCompra");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    //console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res == 'ok'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Prodcuto agregado",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        frm.reset();
                        cargarDetalle();
                    } else if (res == 'modificado'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Prodcuto actualizado",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        frm.reset();
                        cargarDetalle();
                    }
                    document.getElementById("cantidad").setAttribute('disabled', 'disabled');
                    document.getElementById("codigo").focus();
                }
            }
        }
    }
}

function calcularPrecioVenta(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    document.getElementById("sub_total").value = precio * cant;
    if(e.which == 13) {
        if (cant > 0) {
            const url = base_url + "Compras/ingresarVenta";
            const frm = document.getElementById("frmVenta");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    //console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res == 'ok'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Prodcuto agregado",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        frm.reset();
                        cargarDetalleVenta();
                    } else if (res == 'modificado'){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Prodcuto actualizado",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        frm.reset();
                        cargarDetalleVenta();
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: res,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                    document.getElementById("cantidad").setAttribute('disabled', 'disabled');
                    document.getElementById("codigo").focus();
                }
            }
        }
    }
}

if(document.getElementById('tblDetalle')){
    cargarDetalle();
}

if(document.getElementById('tblDetalleVenta')){
    cargarDetalleVenta();
}

function cargarDetalle() {
    const url = base_url + "Compras/listar/detalle";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle.forEach(row => {
                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['cantidad']}</td>
                <td>${row['precio']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['id']}, 1);"><i class="fas fa-trash-alt"></i></button>
                </td>
                </tr>`;
            });
            document.getElementById("tblDetalle").innerHTML = html;
            document.getElementById("total").value = res.total_pagar.total;
        }
    }
}

function cargarDetalleVenta() {
    const url = base_url + "Compras/listar/detalle_temp";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle.forEach(row => {
                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['cantidad']}</td>
                <td>${row['precio']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['id']}, 2);"><i class="fas fa-trash-alt"></i></button>
                </td>
                </tr>`;
            });
            document.getElementById("tblDetalleVenta").innerHTML = html;
            document.getElementById("total").value = res.total_pagar.total;
        }
    }
}

function deleteDetalle(id, accion) {
    let url;
    if (accion == 1) {
        url = base_url + "Compras/delete/"+id;   
    } else {
        url = base_url + "Compras/deleteVenta/"+id;
    }
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if(res == 'ok'){
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Prodcuto eliminado",
                    showConfirmButton: false,
                    timer: 2000
                });
                cargarDetalle();
                if (accion == 1) {
                    cargarDetalle();  
                } else {
                    cargarDetalleVenta(); 
                }
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Error al eliminar el producto",
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    }
}

function procesar(accion){
    Swal.fire({
        title: "Estas seguro de realizar la acción?",
        text: "Se guardara la compra/venta!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, confirmar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
            let url;
            if (accion == 1) {
                    url = base_url + "Compras/registrarCompra";
                } else {
                    const id_cliente = document.getElementById('cliente').value;
                    url = base_url + "Compras/registrarVenta/"+ id_cliente;
                }
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        if(res.msg == "ok"){
                            Swal.fire({
                                title: "Hecho!",
                                text: "Se ha generado la acción.",
                                icon: "success"
                              });
                              let ruta;
                              if (accion == 1) {
                                ruta = base_url + 'Compras/generarPdf/' + res.id_compra;
                              } else {
                                ruta = base_url + 'Compras/generarPdfVenta/' + res.id_venta;
                              }
                              window.open(ruta);
                              setTimeout(() => {
                                window.location.reload();
                              }, 300);
                        }else{
                            Swal.fire({
                                title: "Error!",
                                text: res,
                                icon: "error"
                              });
                        }
                    }
                }

        }
      });
}

function modificarEmpresa() {
    const frm = document.getElementById('frmEmpresa');
    const url = base_url + "Administracion/modificar";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                //console.log(this.responseText);
                const res = JSON.parse(this.responseText);
            if (res == 'ok') {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Se han modificado los datos correctamente",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Error al modificar los datos",
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    }
}


function alertas(mensaje, icono){
    Swal.fire({
        position: "top-end",
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 2000
    });
}