// ==========================================================================
// Ajax para las imagenes de la Tienda...

const matriz_de_formularios = document.querySelectorAll(".formulario_ajax");

function validarInputsFiles(formulario) {
    const inputsFiles = formulario.querySelectorAll("input[type='file']");

    for (let i = 0; i < inputsFiles.length; i++) {
        if (inputsFiles[i].files.length === 0) {
            alert("Por favor, seleccione un archivo para cada campo.");
            return false;
        }
    }

    return true;
}

function formularioAjax(e) {
    e.preventDefault();

    let enviar = confirm("¿Quieres enviar los Datos?");

    if (enviar == true) {
        try {
            let datos = new FormData(this);
            let metodo = this.getAttribute("method");
            let accion = this.getAttribute("action");

            let encabezados = new Headers();

            let config = {
                method: metodo,
                mode: "cors",
                cache: "no-cache",
                body: datos
            };

            fetch(accion, config)
                .then(respuesta => respuesta.text())
                .then(respuesta => {
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
                    } else {
                        console.error("El contenedor no se encontró en el DOM.");
                    }
                })
                .catch(error => {
                    console.error("Error al procesar la solicitud:", error);
                });
        } catch (error) {
            console.error("Error al procesar el formulario:", error);
        }
    }
}

matriz_de_formularios.forEach(formulario => {
    formulario.addEventListener("submit", function (e) {
        if (validarInputsFiles(this)) {
            formularioAjax.call(this, e);
        } else {
            e.preventDefault();
        }
    });
});
