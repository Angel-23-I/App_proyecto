function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const caja = document.getElementById("caja");
    
    if (usuario.value == "" || nombre.value == "" || caja.value == ""){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    }
    
    else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Usuario registrado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      });
                      frm.reset();
                      $("#nuevo_usuario") .modal("hide");
                      tblUsuarios.ajax.reload();
                }else if(res == "modificado"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Usuario modificado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      });
                      $("#nuevo_usuario") .modal("hide");
                      tblUsuarios.ajax.reload();
                } else {
                    alertas(res.msg, res.icono);
                }
            }
        }
    }
}

function registrarCli(e) {
    console.log(e);
    e.preventDefault();
    const documento = document.getElementById("documento");
    const nombre = document.getElementById("nombre");
    const celular = document.getElementById("celular");
    const direccion = document.getElementById("direccion");
    
    if (documento.value == "" || nombre.value == "" || celular.value == "" || direccion.value == ""){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    } else {
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmCliente");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Cliente registrado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      });
                      frm.reset();
                      $("#nuevo_cliente") .modal("hide");
                      tblClientes.ajax.reload();
                }else if(res == "modificado"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Cliente modificado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      });
                      $("#nuevo_cliente") .modal("hide");
                      tblClientes.ajax.reload();
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

function registrarPro(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const nombre = document.getElementById("nombre");
    const precio_compra = document.getElementById("precio_compra");
    const precio_venta = document.getElementById("precio_venta");
    const id_medida = document.getElementById("medida");
    const id_categoria = document.getElementById("categoria");
    
    if (codigo.value == "" || nombre.value == "" || precio_compra.value == "" || precio_venta == ""){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    }
    
    else {
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            //console.log(this.responseText);
            if (this.readyState == 4 && this.status == 200) {
                //console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res == "si"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Producto registrado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      });
                      frm.reset();
                      $("#nuevo_producto") .modal("hide");
                      tblProductos.ajax.reload();
                }else if(res == "modificado"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Producto modificado con exito",
                        showConfirmButton: false,
                        timer: 3000
                      });
                      $("#nuevo_producto") .modal("hide");
                      tblProductos.ajax.reload();
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

