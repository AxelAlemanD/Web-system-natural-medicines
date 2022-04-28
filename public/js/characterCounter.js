// Agrega contador
window.onload=function() {
    let inputs		= document.querySelectorAll('input[type="text"]');
    let textareas	= document.querySelectorAll('textarea');

    agregarContador(inputs);
    agregarContador(textareas);
}

/*
    Agrega contador debajo de inputs recibidos
*/
function agregarContador(camposEntrada) {
    let contadorCaracteres				= document.createElement("p");
    contadorCaracteres.style.cssText	= "font-size:12px;color:grey;font-weight:400;text-align:right;";
    
    for (let i = 0; i < camposEntrada.length; i++) {
        
        let copiaContador = contadorCaracteres.cloneNode(true);

        camposEntrada[i].setAttribute("onfocus", "mostrarContador(event)");
        camposEntrada[i].setAttribute("onblur", "ocultarContador(event)");
        camposEntrada[i].setAttribute("onkeyup", "actualizarContador(event)");
        camposEntrada[i].insertAdjacentElement("afterend", copiaContador);
    }
}

/*
    Actualiza el valor del contador
*/
function actualizarContador(event){
    let input		= event.target;
    console.log('input');
    let contador	= event.target.nextSibling;
    
    contador.innerText = input.value.length + "/" + input.getAttribute('maxlength');
}

/*
    Muestra el contador cuando el foco esta sobre el input
*/
function mostrarContador(event) {
    let contador = event.target.nextSibling;
    contador.style.visibility = "visible"; 
}


/*
    Oculta el contador cuando el input pierde el foco
*/
function ocultarContador(event) {
    let contador = event.target.nextSibling;
    contador.style.visibility = "hidden"; 
}