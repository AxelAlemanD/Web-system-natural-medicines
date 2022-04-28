/*
	Comprueba si los inputs tienen datos
*/
function validarInputsVacios() {
	let inputs = document.getElementsByTagName('input');
	for (let i = 2; i < inputs.length; i++) {
		
		if(inputs[i].value.length > 1 && i != 5 && i != 6 && i != 10){
			return true;
		}
	}
	return false;
}


/*
	Muestra ventana de confirmación
*/
function preguntarAntesDeSalir(url, evento) {
	if(validarInputsVacios()){
		evento.preventDefault();
		swal({
		  title:	'Hay elementos sin guardar',
		  text:		"¿Seguro que quieres salir?",
		  icon:		'warning',
		  buttons:	["Cancelar", "Salir"],
		}).then((result) => {
		  if (result) {
			window.location = url;
		  }
		})
	}	
}


/*
	Obtiene href presionado
*/
$("a").click(function(event) {
	let url = '';
		
	if(event.target.tagName === 'SPAN' || event.target.tagName === 'I'){
		url = event.target.parentNode.getAttribute('href');
	}
	else{
		url = event.target.getAttribute('href');
	}
	  	
	preguntarAntesDeSalir(url, event);
}); 