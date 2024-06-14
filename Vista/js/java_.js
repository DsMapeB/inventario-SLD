$(document).ready(function(){
  cargarRol2();
  cargarRol3();
  cargarNit();
  cargarNitEdit();
  cargarUsuario1();
  cargarCliente1();
  cargarProducto1();
  cargarUsuario2();
  cargarCliente2();
  cargarProducto2();
  cleanURLAfterMessage();
  cargarCod();

})

// Función para limpiar la URL después de mostrar mensajes
function cleanURLAfterMessage() {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('error')) {
      // Mostrar el mensaje de SweetAlert2
      setTimeout(function() {
          // Limpiar solo los parámetros relacionados con los mensajes
          urlParams.delete('error');
          window.history.replaceState({}, document.title, window.location.pathname + '?' + urlParams.toString());
      }, 2000); // Ajusta el tiempo según sea necesario
  }
}

//-------------------------- Login y Registro --------------------------
function cargarRol3(){
  $.post("Modelo/cargarRol3.php", {}, function (mensaje){
    $("#cargo").html(mensaje);
});
}

//--------------------------perfil--------------------------
function cargarRol2(){
  $.post("Modelo/cargarRol2.php", {}, function (mensaje2){
    $("#rol2").html(mensaje2);
  });
}
function consultarUsu(){
  var url = "index.php?accion=consultarUsu";
  $("#Usuario").load(url);
}
function editarperfil(){
  var url = "index.php?accion=editarPerfil";
  $("#modalEditperfil").load(url);
}
function eliminarUsu(numero, nombre){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger me-2"
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: "Eliminar Trabajador",
    text: "Estas seguro de eliminar el Trabajador/a " + nombre + "?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Deseo Eliminarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.get("index.php", { accion: 'eliminarusu', numero: numero}, function (){
      swalWithBootstrapButtons.fire({
        title: "El Trabajador/a " + nombre + " ha sido Eliminado Exitosamente!",
        icon: "success"
      }).then(() => {
        // Recarga la página después de la confirmación de eliminación
        location.reload();
      });
    });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire({
        title: "Cancelado",
        text: "Tu Trabajador esta a salvo :)",
        icon: "error"
      });
    }
  });
}

function editarUsuario(val){
  var url = "index.php?accion=editarUsu&numero="+val;
  $("#modaleditusu").load(url);
}

//--------------------------roles--------------------------
function consultarRol(){
  var url = "index.php?accion=consultarRol";
  $("#consulRol").load(url);
}
function editarRol(val){
  var url = "index.php?accion=editarRol&numero="+val;
  $("#modaleditRol").load(url);
}
function eliminarRole(numero, nombre){
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger me-2"
  },
  buttonsStyling: false
});
swalWithBootstrapButtons.fire({
  title: "Eliminar Rol",
  text: "Estas seguro de eliminar el Rol "+ nombre +"?",
  icon: "warning",
  showCancelButton: true,
  confirmButtonText: "Si, Deseo Eliminarlo!",
  cancelButtonText: "No, Cancelar!",
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    $.get("index.php", { accion: 'eliminarRol', numero: numero}, function (){
      swalWithBootstrapButtons.fire({
        title: "El Rol " + nombre + " ha sido Eliminado Exitosamente!",
        icon: "success"
      }).then(() => {
        // Recarga la página después de la confirmación de eliminación
        location.reload();
      });
    });
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire({
      title: "Cancelado",
      text: "Tu Rol esta a salvo :)",
      icon: "error"
    });
  }
});
}



//---------------------------Cliente----------------------------
function consultarcli(){
  var url = "index.php?accion=consultarCli";
  $("#cliente").load(url);
}
function editarcli(val){
  var url = "index.php?accion=editarCli&numero="+val;
  $("#modaleditcli").load(url);
}

function eliminarcli(numero3, nombreclie){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger me-2"
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: "Eliminar Cliente",
    text: "Estas seguro de Eliminar al Cliente "+ nombreclie + "?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Deseo eliminarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.get("index.php", { accion: 'eliminarcli', numero3: numero3 }, function () {
        swalWithBootstrapButtons.fire({
        title: "El Cliente " + nombre + " ha sido Eliminado Exitosamente!",
        icon: "success"
        }).then(() => {
          // Recarga la página después de la confirmación de eliminación
          location.reload();
        });
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire({
        title: "Cancelado",
        text: "Tu cliente esta a Salvo :)",
        icon: "error"
      });
    }
  });

}

//------------------------Proveedor--------------------------
function consultarpro(){
  var url = "index.php?accion=consultarPro";
  $("#proveedor").load(url);
}
function editarprove(val){
  var url = "index.php?accion=editarProvee&numero="+val;
  $("#modalEditprove").load(url);
}
function eliminarpro(numero, nombre){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger me-2"
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: "Eliminar Proveedor",
    text: "Estas seguro de Eliminar el Proveedor " + nombre + "?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Deseo Eliminar!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.get("index.php", { accion: 'eliminarpro', numero: numero }, function (){
      swalWithBootstrapButtons.fire({
        title: "El Proveedor " + nombre + " ha sido Eliminado Exitosamente!",
        icon: "success"
      }).then(() => {
        // Recarga la página después de la confirmación de eliminación
        location.reload();
      });
    });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire({
        title: "Cancelado",
        text: "Tu Proveedor esta a salvo :)",
        icon: "error"
      });
    }
  });
}

//-----------------------------------Producto---------------------------------
function consultarprodu(){
  var url = "index.php?accion=consultarprodu";
  $("#producto").load(url);
}
function editarprodu(val){
  var url = "index.php?accion=editarprodu&numero="+val;
  $("#modalEditProdu").load(url);
} 
function eliminarprodu(numero4, nombre){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger me-2"
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: "Eliminar Producto",
    text: "Estas seguro de Eliminar el Producto " + nombre + "?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Deseo Eliminarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.get("index.php", {accion: 'eliminarprodu', numero4: numero4}, function (){
      swalWithBootstrapButtons.fire({
        title: "El Producto " + nombre + " ha sido Eliminado Exitosamente!",
        icon: "success"
      }).then(() => {
        // Recarga la página después de la confirmación de eliminación
        location.reload();
      });
    });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire({
        title: "Cancelado",
        text: "Tu Producto esta a salvo :)",
        icon: "error"
      });
    }
  });
  }

function cargarNit(){
  $.post("Modelo/cargarNit.php", {} , function(mensaje){
    $("#nit").html(mensaje);
  });
}
function cargarNitEdit(){
  $.post("Modelo/cargarNit.php", {} , function(mensaje){
    $("#nitEdit").html(mensaje);
  });
}

//---------------------------Venta---------------------------------
function consultarven(){
  var url = "index.php?accion=consultarVen";
  $("#venta").load(url);
}
function editarven(val){
  var url = "index.php?accion=editarVen&numero="+val;
  $("#modalEditVen").load(url);
}
function eliminarventa(numero5, producto){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger me-2"
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons.fire({
    title: "Eliminar Venta",
    text: "Estas seguro de Eliminar la Venta " + numero5 + "?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Deseo Eliminarla!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.get("index.php", {accion: 'eliminarven', numero5: numero5}, function (){
      swalWithBootstrapButtons.fire({
        title: "La Venta " + numero5 + " ha sido Eliminada Exitosamente!",
        icon: "success"
      }).then(() => {
        // Recarga la página después de la confirmación de eliminación
        location.reload();
      });
    });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire({
        title: "Cancelado",
        text: "Tu Venta esta a salvo :)",
        icon: "error"
      });
    }
  });
}

function cargarUsuario1(){
  $.post("Modelo/cargarUsu.php", {} , function (mensaje){
    $("#idUsu").html(mensaje);
  });
}
function cargarCliente1(){
  $.post("Modelo/cargarCli.php", {} , function (mensaje){
    $("#docclie").html(mensaje);
  });
}
function cargarProducto1(){
  $.post("Modelo/cargarProdu.php", {} , function (mensaje){
    $("#codprodu").html(mensaje);
  });
}
function cargarUsuario2(){
  $.post("Modelo/cargarUsu.php", {} , function (mensaje){
    $("#idUsu2").html(mensaje);
  });
}
function cargarCliente2(){
  $.post("Modelo/cargarCli.php", {} , function (mensaje){
    $("#docclie2").html(mensaje);
  });
}
function cargarProducto2(){
  $.post("Modelo/cargarProdu.php", {} , function (mensaje){
    $("#codprodu2").html(mensaje);
  });
}
function cargarCod() {
  $.post("Modelo/cargarCod.php", {}, function(mensaje) {
      $("#codven").val(mensaje); // Actualiza el valor del input con el código de venta obtenido
  });
}
