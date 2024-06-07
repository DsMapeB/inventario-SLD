$(document).ready(function(){
  cargarRol();
  cargarRol2();
  cargarRol3();
  cargarRolP();
  cargarNit();
  cargarNitEdit();
  cargarUsuario1();
  cargarCliente1();
  cargarProducto1();
  cargarUsuario2();
  cargarCliente2();
  cargarProducto2();

})

//--------------------------roles--------------------------
function consultarRol(){
  var url = "index.php?accion=consultarRol";
  $("#consulRol").load(url);
}
function editarRol(val){
  var url = "index.php?accion=editarRol&numero="+val;
  $("#modaleditRol").load(url);
}
function eliminarRole(numero){
  if (confirm("Estas seguro de eliminar el Rol " + numero + "?")){
    $.get("index.php", { accion: 'eliminarRol', numero: numero}, function (mensaje){
      alert(mensaje);
      location.reload();
    });
  }
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
function eliminarUsu(numero){
  if (confirm("Estas seguro de eliminar el Usuario " + numero + "?")){
    $.get("index.php", { accion: 'eliminarusu', numero: numero}, function (mensaje){
      alert(mensaje);
      location.reload();
    });
  }
}
function editarUsuario(val){
  var url = "index.php?accion=editarUsu&numero="+val;
  $("#modaleditusu").load(url);
}
function cargarRolP(){
  $.post("Modelo/cargarRolP.php", {}, function (mensaje){
    $("#rolP").html(mensaje);
});
}

//--------------------------Login--------------------------
function cargarRol3(){
  $.post("Modelo/cargarRol3.php", {}, function (mensaje){
    $("#cargo").html(mensaje);
});
}

// --------------------------Usuario------------------------
function consultarusu(){
  var url = "index.php?accion=consultarusu";
  $("#usuario").load(url);
}

function eliminarusu(numero2){
  if (confirm("Estas seguro de eliminar el Usuario " + numero2 + "?")){
    $.get("index.php", { accion: 'eliminarusu', numero2: numero2}, function (mensaje){
      alert(mensaje);
      location.reload();
    });
  }
}
function cargarRol(){
  $.post("Modelo/cargarRol.php", {}, function (mensaje){
    $("#rol").html(mensaje);
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

function eliminarcli(numero3){
  if (confirm("Estas seguro de eliminar el Cliente " + numero3 + "?")){
    $.get("index.php", { accion: 'eliminarcli', numero3: numero3}, function (mensaje){
      alert(mensaje);
      location.reload();
    });
  }
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
function eliminarpro(numero){
  if (confirm("Estas seguro de Eliminar el Proveedor " + numero + "?")){
    $.get("index.php", { accion: 'eliminarpro', numero: numero }, function (mensaje){
      alert(mensaje);
      // Recargar la página después de eliminar para actualizar la tabla
      location.reload();
    });
  }
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
function eliminarprodu(numero4){
  if (confirm("Estas seguro de Eliminar el Producto " + numero4 + "?")){
    $.get("index.php", {accion: 'eliminarprodu', numero4: numero4}, function (mensaje){
      alert(mensaje);
      location.reload();
    })
  }
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
function eliminarventa(numero5){
  if (confirm("Estas seguro de Eliminar la Venta " + numero5 + "?")){
    $.get("index.php", {accion: 'eliminarven', numero5: numero5}, function (mensaje){
      alert(mensaje);
      location.reload();
    })
  }
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