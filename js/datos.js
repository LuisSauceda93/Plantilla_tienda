


$(document).ready(function(){
var url="/datos_bd.php";
$("").html("");
$.getJSON(url,function(categorias){
$.each(categorias, function(i,categorias){
var datos= "<h3>"+categorias.Nombre+"</h3>"
          +"<p>"+categorias.Descripcion+"</p>";





$(datos).appendTo("#categorias");


});
$("#categorias").clone().insertAfter("#categorias");
});
});
