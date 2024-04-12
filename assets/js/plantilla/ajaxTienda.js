// ==========================================================================
// Ajax para el Buscador de la Tienda...

const matriz_de_formularios = document.querySelectorAll(".formulario_ajax");

function formularioAjax(e) {
    e.preventDefault();

    let enviar = confirm("¿Quieres realizar la Búsqueda?");

    if (enviar == true) {
        let datos = new FormData(this);
        let metodo = this.getAttribute("method");
        let accion = this.getAttribute("action");

        let encabezados = new Headers();

		let config = { // Configuraciones para la peticion
		    method: metodo,
		    // headers: encabezados
		    mode: "cors",
		    cache: "no-cache",
		    body: datos
		};

		fetch(accion, config)
        .then(respuesta => respuesta.text()) // Promesa 1
        .then(respuesta => { // Promesa 2
            let contenedor = document.querySelector(".resultado_formulario");

			if (contenedor) {
			    contenedor.innerHTML = respuesta;
			} else {
			    console.error("El contenedor no se encontró en el DOM.");
			}
        });
    }
}

matriz_de_formularios.forEach(formulario => {
	formulario.addEventListener("submit", formularioAjax);
});

// ==========================================================================