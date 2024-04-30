function consultarpro(){
  var url = "index.php?accion=consultarPro";
  $("#proveedor").load(url);
}
function eliminarpro(numero){
  if (confirm("Estas seguro de Eliminar el proveedor" + numero + "?")){
    $.gest("index.php", { accion: 'eliminarPro', numero: numero }, function (mensaje){
      alert(mensaje);
      // Recargar la página después de eliminar para actualizar la tabla
      location.reload();
    });
  }
}