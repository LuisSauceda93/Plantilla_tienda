	<script src="js/slider.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/stickUp.js"></script>
	<script src="js/scripts.js"></script>
	<script src="js/carro.js"></script>
	<script type="text/javascript">

	var $form = $("#formulario"),
			$form2 = $("#formulario2"),
	    $button = $("#mostrar-form"),
			$button2 = $("#mostrar-img");
<!--
function mostrarFormulario(){
	$form.slideToggle();
  return false;
}

function mostrarFormulario2(){
	$form2.slideToggle();
  return false;
}

function toggle(elemento) {
			if(elemento.value=="Si") {
					document.getElementById("factura").style.display = "block";
			 }else{
					document.getElementById("factura").style.display = "none";
				}
		}

$button2.click(mostrarFormulario2);
$button.click(mostrarFormulario);


function limitar(e, contenido, caracteres)
			 {
					 // obtenemos la tecla pulsada
					 var unicode=e.keyCode? e.keyCode : e.charCode;

					 // Permitimos las siguientes teclas:
					 // 8 backspace
					 // 46 suprimir
					 // 13 enter
					 // 9 tabulador
					 // 37 izquierda
					 // 39 derecha
					 // 38 subir
					 // 40 bajar
					 if(unicode==8 || unicode==46 || unicode==13 || unicode==9 || unicode==37 || unicode==39 || unicode==38 || unicode==40)
							 return true;

					 // Si ha superado el limite de caracteres devolvemos false
					 if(contenido.length>=caracteres)
							 return false;

					 return true;
			 }
</script>


    <!-- Añadir clase activa a elemento menú de página actual -->
		<script>
		$(document).ready(function()
			{
				$('.menu a[href="<?php echo url() ?>"]').addClass('active');
			});
		</script>
