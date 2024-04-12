// ==========================================================================
// Ajax para los estilos de la Tienda...

const matriz_de_formularios = document.querySelectorAll(".formulario_ajax");

function formularioAjax(e) {
    e.preventDefault();

    let enviar = confirm("¿Quieres enviar los Datos?");

    if (enviar == true) {
        let datos = new FormData(this);
        let metodo = this.getAttribute("method");
        let accion = this.getAttribute("action");

        let encabezados = new Headers();

		let config = { // Configuraciones para la petición
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

			    const toast = document.querySelector(".alerta");
			    const closeIcon = document.querySelector(".cerrar");
			    const progress = document.querySelector(".progress");

			    let timer1, timer2;

			    function accionarAlerta() {
			        toast.classList.add("activo");
			        progress.classList.add("activo");

			        timer1 = setTimeout(() => {
			            toast.classList.remove("activo");
			        }, 2000);

			        timer2 = setTimeout(() => {
			            progress.classList.remove("activo");
			        }, 2300);
			    }

			    accionarAlerta();
			    setTimeout(recargarPagina, 2500);
			} else {
			    console.error("El contenedor no se encontró en el DOM.");
			}
        });
    }
}

matriz_de_formularios.forEach(formulario => {
	formulario.addEventListener("submit", formularioAjax);
});

function recargarPagina() {
	window.location.href='../../dashboard.php';
}
