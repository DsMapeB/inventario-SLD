$(document).ready(function(){
  cargarRol();
  cargarNit();
  cargarNitEdit();
  cargarUsuario();
  cargarCliente();
  cargarProducto();
  cleanURLAfterMessage();
  cargarCod();

})

// Función para limpiar la URL después de mostrar mensajes
function cleanURLAfterMessage() {
  const urlParams = new URLSearchParams(window.location.search);
  const paramsToDelete = ['error', 'error2']; // Lista de parámetros a eliminar

  let hasMessageParam = false;

  // Comprobar si alguno de los parámetros existe
  paramsToDelete.forEach(param => {
    if (urlParams.has(param)) {
      hasMessageParam = true;
    }
  });

  if (hasMessageParam) {
    // Mostrar el mensaje de SweetAlert2
    setTimeout(function() {
      // Eliminar los parámetros relacionados con los mensajes
      paramsToDelete.forEach(param => {
        urlParams.delete(param);
      });
      // Actualizar la URL sin recargar la página
      window.history.replaceState({}, document.title, window.location.pathname + '?' + urlParams.toString());
    }, 2000); // Ajusta el tiempo según sea necesario
  }
}

//-------------------------- Login y Registro --------------------------
function cargarRol(){
  $.post("Modelo/cargarRol.php", {}, function (mensaje){
    $("#cargo").html(mensaje);
});
}

function consultaTotal(){
  var url = "index.php?accion=consultaTotal";
  $("#cant").load(url);
}

function fundadores(){
  Swal.fire({
    title: "Fundadores / Creadores",
    text: "Modal with a custom image.",
    html: `
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="Vista/img/fotom.webp" class="w-100" alt="">
            <div class="carousel-caption d-none d-md-block" >
              <h5>Santiago Mape</h5>
              <p id="si">Fundador y Desarrollador del Sistema de Gestion Online de Inventario SLD</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="Vista/img/laug.webp" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Laura Gongora</h5>
              <p id="si">Creadora del Sistema de Gestion Online de Inventario SLD</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="bi bi-chevron-left" style="  color: #000000; font-size: 2rem;" aria-hidden="true"></span>
          <span class="visually-hidden ">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="bi bi-chevron-right" style="  color: #000000; font-size: 2rem;" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    `,
    imageAlt: "Tenemos Problemas al cargar Los Fundadores"
  });
}

function Descarga() {
  // Configuración de SweetAlert2 con estilos de Bootstrap
  const swalConBotonesBootstrap = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success", // Clase para el botón de confirmación
      cancelButton: "btn btn-danger me-2" // Clase para el botón de cancelación
    },
    buttonsStyling: false // Evita que SweetAlert2 aplique estilos propios a los botones
  });

  // Mostrar el cuadro de diálogo de SweetAlert2
  swalConBotonesBootstrap.fire({
    title: "Descarga de Reporte", // Título del cuadro de diálogo
    text: "Al descargar tendrás tu reporte de: Proveedores, Productos y Ventas", // Texto principal
    icon: "warning", // Ícono de advertencia
    showCancelButton: true, // Mostrar botón de cancelar
    confirmButtonText: "Sí, deseo continuar!", // Texto del botón de confirmación
    cancelButtonText: "No, cancelar!", // Texto del botón de cancelación
    reverseButtons: true // Invertir posición de los botones (confirmar y cancelar)
  }).then((result) => {
    // Manejar la acción después de hacer clic en los botones de confirmar o cancelar
    if (result.isConfirmed) {
      // Si se confirma la descarga
        // Mostrar un mensaje de éxito después de iniciar la descarga
        swalConBotonesBootstrap.fire({
          title: "Tu descarga comenzará en unos minutos", // Título del mensaje de éxito
          icon: "success" // Ícono de éxito
        });
          // Recargar la página después de la confirmación de descarga
          window.location.href = "index.php?accion=Descarga";
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      // Si se cancela la descarga
      swalConBotonesBootstrap.fire({
        title: "Cancelado", // Título del mensaje de cancelación
        text: "Tu Reporte está a salvo :)", // Texto adicional del mensaje de cancelación
        icon: "error" // Ícono de error
      });
    }
  });
}





//--------------------------perfil--------------------------

function consultarUsu(){
  var url = "index.php?accion=consultarUsu";
  $("#Usuario").load(url);
}
function editarUsuario(val){
  var url = "index.php?accion=editarUsu&numero="+val;
  $("#modaleditusu").load(url);
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
function editarperfil(){
  var url = "index.php?accion=editarPerfil";
  $("#modalEditperfil").load(url);
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
        title: "El Cliente " + nombreclie + " ha sido Eliminado Exitosamente!",
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

function cargarUsuario(){
  $.post("Modelo/cargarUsu.php", {} , function (mensaje){
    $("#idUsu").html(mensaje);
  });
}
function cargarCliente(){
  $.post("Modelo/cargarCli.php", {} , function (mensaje){
    $("#docclie").html(mensaje);
  });
}
function cargarProducto(){
  $.post("Modelo/cargarProdu.php", {} , function (mensaje){
    $("#codprodu").html(mensaje);
  });
}
function cargarCod() {
  $.post("Modelo/cargarCod.php", {}, function(mensaje) {
      $("#codven").val(mensaje); // Actualiza el valor del input con el código de venta obtenido
  });
}
