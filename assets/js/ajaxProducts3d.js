// ==========================================================================
// Ajax para el Renderizado de los Productos de la Tienda...

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".formulario_ajax").forEach((formulario) => {
    formulario.addEventListener("submit", async function (e) {
      e.preventDefault(); // Previene el comportamiento por defecto del formulario

      if (!validarInputsFiles(this)) {
        // Directamente muestra la alerta si la validación de inputs falla
        accionarAlerta();
        return;
      }

      const enviar = confirm("¿Quieres enviar los Datos?"); // Podrías considerar una modal custom en el futuro
      if (!enviar) return;

      try {
        const datos = new FormData(this);
        const metodo = this.getAttribute("method");
        const accion = this.getAttribute("action");

        const respuesta = await fetch(accion, {
          method: metodo,
          mode: "cors",
          cache: "no-cache",
          body: datos,
        }).then((res) => res.text());

        procesarRespuesta(respuesta);
        console.log(respuesta);
        accionarAlerta(); // Muestra una alerta de éxito tras el envío exitoso
        // Revisar si en la respuesta existe un span con el texto de error
        if (respuesta.includes("error")) return;

        setTimeout(recargarPagina, 2800);
      } catch (error) {
        console.error("Error al procesar la solicitud:", error);
        accionarAlerta(); // Muestra una alerta en caso de error
      }
    });
  });
});

function validarInputsFiles(formulario) {
  console.log("toy aki");
  const inputsFiles = formulario.querySelectorAll("input[type='file']");
  for (const inputFile of inputsFiles) {
    if (inputFile.files.length === 0) {
      return false;
    }
  }
  return true;
}

function procesarRespuesta(respuesta) {
  const contenedor = document.querySelector(".resultado_formulario");
  if (!contenedor) {
    console.error("El contenedor no se encontró en el DOM.");
    return;
  }

  contenedor.innerHTML = respuesta;
  // Aquí no es necesario llamar a accionarAlerta() porque ya se llama en el try/catch
}

function accionarAlerta() {
  const toast = document.querySelector(".alerta");
  const progress = document.querySelector(".progress");
  toast.classList.add("activo");
  progress.classList.add("activo");

  setTimeout(() => {
    toast.classList.remove("activo");
  }, 2000);

  setTimeout(() => {
    progress.classList.remove("activo");
  }, 2300);
}

function recargarPagina() {
  window.location.reload();
}
