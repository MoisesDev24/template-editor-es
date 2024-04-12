//==========================================================
document.addEventListener("DOMContentLoaded", function () {
  // Funcion del Checkbox
  document
    .getElementById("checkboxUnico")
    .addEventListener("change", function () {
      let formUploadSingle = document.getElementById("formUploadSingle");
      let parrafo = document.querySelector(".contenedor_parrafo");

      if (this.checked) {
        formUploadSingle.style.display = "flex";
        parrafo.style.display = "none";
      } else {
        formUploadSingle.style.display = "none";
        parrafo.style.display = "block";
      }
    });

  // Abrir y cerrar Modal de los Productos
  (function () {
    // Get the modal
    let modal = document.getElementById("myModal");

    // Get the button that opens the modal
    let btn = document.querySelector(".myBtn");

    // Get the <span> element that closes the modal
    let span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function () {
      modal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
  })();

  // Seleccionar un Producto
  (function () {
    let selectedImageSrc = ""; // Almacenará la src de la imagen seleccionada
    let matrizImagenes = [];

    function generarElementosHTML() {
      console.log("Generando elementos HTML"); // Para depuración

      const contenedor = document.getElementById("container_father");
      contenedor.innerHTML = ""; // Limpiar el contenedor existente

      matrizImagenes.forEach((src, index) => {
        // Añadir los event listeners después de añadir los elementos al DOM
        const uniqueId1 = `uploadBtn${index}1`;
        const uniqueId2 = `uploadBtn${index}2`;
        const uniqueId3 = `uploadBtn${index}3`;
        const divId = `imgDiv${index}`; // ID único para el div contenedor

        // Actualizar los nombres para incluir el índice
        const name1 = `foto_lateral_izq${index}`;
        const name2 = `foto_lateral_der${index}`;
        const name3 = `foto_parte_tras${index}`;

        const elementoHTML = `
                    <div id="${divId}" class="container_preview_thumbnail" style="display: none;">
                        <div class="container_preview">
                            <div class="contenedor_previsualizar_img">
                                <figure class="previsualizar_img">
                                    <img src="${src}" alt="Imagen seleccionada">
                                </figure>
                            </div>
                        </div>
                        <div class="container_preview_two">
                            <h2 class="image_thumbnail_title_two">Subir Fotos del Producto</h2>
                            <small class="required">Es obligatorio subir las 3 imágenes</small>
                            <!-- Inputs de tipo file para cargar fotos, ahora con IDs y names dinámicos -->
                            <input type="file" name="${name1}" id="${uniqueId1}" class="inputFileUp_input" accept="image/*">
                            <label for="${uniqueId1}" class="inputFileUp">Lateral Izquierdo</label>

                            <input type="file" name="${name2}" id="${uniqueId2}" class="inputFileUp_input" accept="image/*">
                            <label for="${uniqueId2}" class="inputFileUp">Lateral Derecho</label>

                            <input type="file" name="${name3}" id="${uniqueId3}" class="inputFileUp_input" accept="image/*">
                            <label for="${uniqueId3}" class="inputFileUp">Parte Trasera</label>

                            <div class="image_thumbnail_container">
                                <div class="image_thumbnail">
                                    <!-- Las miniaturas de las imágenes seleccionadas se mostrarán aquí -->
                                </div>
                            </div>
                        </div>
                    </div>
                `;

        const div = document.createElement("div");
        div.innerHTML = elementoHTML;
        contenedor.appendChild(div);

        document
          .getElementById(uniqueId1)
          .addEventListener("change", handleImageUpload);
        document
          .getElementById(uniqueId2)
          .addEventListener("change", handleImageUpload);
        document
          .getElementById(uniqueId3)
          .addEventListener("change", handleImageUpload);
      });
    }

    // Delegación de eventos para manejar clics en imágenes de forma dinámica
    document.addEventListener("click", function (e) {
      if (e.target.matches(".gallery-item img")) {
        const img = e.target;
        selectedImageSrc = img.src;

        if (matrizImagenes.includes(selectedImageSrc)) {
          const indexToRemove = matrizImagenes.findIndex(
            (imagen) => imagen === selectedImageSrc
          );
          matrizImagenes = matrizImagenes.filter(
            (imagen) => imagen !== selectedImageSrc
          );
          img.parentElement.style.border = "none";

          // Encontrar y eliminar el div correspondiente
          const divToRemove = document.getElementById(`imgDiv${indexToRemove}`);
          if (divToRemove) {
            divToRemove.parentNode.removeChild(divToRemove);
          }
        } else {
          if (matrizImagenes.length < 5) {
            // Asegurarse de que solo se pueden añadir hasta 5 imágenes
            matrizImagenes.push(selectedImageSrc);
            img.parentElement.style.border = "2px solid #213280";

            // Llamado a la función para actualizar el HTML con las imágenes seleccionadas
            generarElementosHTML();
          } else {
            alert("Solo puedes seleccionar hasta 5 imágenes.");
          }
        }
        console.log("array", matrizImagenes);
      }
    });

    document
      .getElementById("selectImageBtn")
      .addEventListener("click", function (e) {
        e.preventDefault();
        console.log("Botón seleccionar imagen presionado");

        let modal = document.getElementById("myModal");
        let itemElementsGenerate = document.querySelectorAll(
          ".container_preview_thumbnail"
        );

        // Nombres de los ID tal como están definidos en tu HTML
        const inputIds = [
          "hiddenImageUrl",
          "hiddenImageUrlTwo",
          "hiddenImageUrlThree",
          "hiddenImageUrlFour",
          "hiddenImageUrlFive",
        ];

        if (matrizImagenes.length > 0) {
          matrizImagenes.forEach((src, index) => {
            let hiddenInput = document.getElementById(inputIds[index]);
            if (hiddenInput) hiddenInput.value = src; // Asigna la src de la imagen al valor del input oculto
          });

          // Limpia los valores de los inputs restantes si hay menos de 5 imágenes
          for (let i = matrizImagenes.length; i < inputIds.length; i++) {
            let hiddenInput = document.getElementById(inputIds[i]);
            if (hiddenInput) hiddenInput.value = "";
          }

          modal.style.display = "none";

          // Itera sobre cada elemento de itemElementsGenerate y cambia su estilo a flex
          itemElementsGenerate.forEach((item) => {
            item.style.display = "flex";
          });
        } else {
          alert("Por favor, selecciona una imagen.");
        }
      });
  })();

  // Creacion de las Miniaturas
  function handleImageUpload(event) {
    console.log("Foto cargada");

    const file = event.target.files[0];
    if (!file) {
      return;
    }

    const label = document.querySelector(`label[for="${event.target.id}"]`);
    label.style.display = "none";

    const reader = new FileReader();
    reader.onload = function (e) {
      // Encuentra el contenedor `container_preview_thumbnail` más cercano
      const container = event.target
        .closest(".container_preview_thumbnail")
        .querySelector(".image_thumbnail");

      const item = document.createElement("div");
      item.classList.add("image_thumbnail_item");
      item.setAttribute("data-input-id", event.target.id); // Asociamos el input

      item.innerHTML = `
                <figure class="img_thumbnail_container">
                    <img src="${e.target.result}" alt="Imagen Cargada">
                </figure>
                <h3 class="image_thumbnail_title">Foto del Producto</h3>
                <svg class="delete_product" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 384 512">
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                </svg>
            `;

      container.appendChild(item);

      // Asignación del evento click al SVG después de crearlo
      item
        .querySelector(".delete_product")
        .addEventListener("click", function () {
          removeThumbnailItem(this);
        });
    };

    reader.readAsDataURL(file);
  }

  // Funcion para remover una Miniatura
  function removeThumbnailItem(element) {
    // Obtenemos el div de la miniatura mas cercano y su identificador de input asociado
    const thumbnailItem = element.closest(".image_thumbnail_item");
    const inputId = thumbnailItem.getAttribute("data-input-id");

    // Eliminamos la miniatura
    thumbnailItem.remove();

    // Mostramos nuevamente el label asociado al input
    const label = document.querySelector(`label[for="${inputId}"]`);
    label.style.display = ""; // Esto restablecera el display al valor por defecto, usualmente inline o block
  }

  //Limpiar los inputs de tipo file y las miniaturas de las imágenes
  document.getElementById("btn_limpiar").addEventListener("click", function () {
    console.log("Botón limpiar imágenes presionado");

    const inputs = document.querySelectorAll(".inputFileUp_input");
    inputs.forEach((input) => {
      input.value = null;
      const label = document.querySelector(`label[for="${input.id}"]`);
      label.style.display = "";
    });

    const items = document.querySelectorAll(".image_thumbnail_item");
    items.forEach((item) => item.remove());

    // Limpiar los valores de los inputs ocultos
    const hiddenInputs = document.querySelectorAll(
      'input[type="hidden"].hiddenImageUrl'
    );

    hiddenInputs.forEach((input) => {
      input.value = "";
    });

    // Limpiar el array de imágenes
    matrizImagenes = [];
    console.log("array", matrizImagenes);

    //limpiar la preview de las imagenes
    const contenedor = document.getElementById("container_father");
    contenedor.innerHTML = "";

    // limpiar la seleccion de la imagen
    selectedImageSrc = "";
  });
});
