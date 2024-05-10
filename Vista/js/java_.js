function consultarusu(){
  var url = "index.php?accion=consultarUsu";
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
function consultarcli(){
  var url = "index.php?accion=consultarCli";
  $("#cliente").load(url);
}
function eliminarcli(numero3){
  if (confirm("Estas seguro de eliminar el Cliente " + numero3 + "?")){
    $.get("index.php", { accion: 'eliminarcli', numero3: numero3}, function (mensaje){
      alert(mensaje);
      location.reload();
    });
  }
}
function consultarpro(){
  var url = "index.php?accion=consultarPro";
  $("#proveedor").load(url);
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
function consultarven(){
  var url = "index.php?accion=consultarVen";
  $("#venta").load(url);
}