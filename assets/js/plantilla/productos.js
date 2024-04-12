//==========================================================
let plugin_dir = 'https://plataforma.kalstein.net/template-editor/assets';

$(document).ready(function () {
  // ============================== Funcion para el Buscador...
  (function () {
    document.querySelector(".form_buscador").addEventListener("submit", function(event){
      event.preventDefault(); // Prevenir el comportamiento por defecto de envío del formulario
    });
    
    // Selecciona todos los campos de búsqueda y botones de limpiar
    const inputsBuscador = document.querySelectorAll(".buscador_input");
    const clearBtns = document.querySelectorAll(".clear-btn");
    let modalDetalles = $(".modal_detalles-blur");

    // Función para mostrar los resultados de la búsqueda
    const mostrarResultados = (resultados, resultadosBusqueda) => {
      resultadosBusqueda.innerHTML = ""; // Limpiar resultados anteriores
      resultadosBusqueda.style.display = "block"; // Mostrar el contenedor

      resultados.forEach((producto) => {
        const div = document.createElement("div");
        div.classList.add("resultado-item");

        const a = document.createElement("a");
        a.href = `#${producto.id}`;
        a.classList.add("btn_search_product");

        const img = document.createElement("img");
        img.src = producto.image;
        img.alt = "img product";

        const span = document.createElement("span");
        span.textContent = producto.name;

        a.appendChild(img);
        a.appendChild(span);
        div.appendChild(a);

        resultadosBusqueda.appendChild(div);

        // Asociar evento de clic al botón específico creado en esta iteración
        a.addEventListener("click", function (e) {
          e.preventDefault();
          console.log("Show Modal Product");

          // Ocultar sección inicial y mostrar sección de productos
          $("#seccion_inicial").hide();
          $("#seccion_productos").show();

          // Ocultar todos los modales y mostrar solo el modal correspondiente
          $(".modal_detalles-blur").hide();
          $(`#${producto.id}`).parent().find(".modal_detalles-blur").show();

          return false;
        });
      });
    };

    inputsBuscador.forEach((inputBuscador) => {
      inputBuscador.addEventListener("input", function(e) {
        e.preventDefault();
        let texto = this.value.trim();
        // Asegúrate de seleccionar el contenedor de resultados relacionado con este campo de búsqueda
        let resultadosBusqueda = this.closest('.contenedor_form_buscador').querySelector('#resultados-busqueda');
    
        // Realizar la búsqueda si hay 3 o más caracteres
        if (texto.length > 2) {
          // Obtiene la URL completa de la página actual
          let urlActual = window.location.href;
      
          // Ajustar la ruta según la estructura de tu proyecto y servidor, incluyendo la URL completa
          let url = plugin_dir + `/app/sql/sql_buscador.php?ID_slug=` +
            encodeURIComponent(urlActual) +
            `&query=` +
            encodeURIComponent(texto);
      
          // Realizar una solicitud al servidor para obtener los resultados de la búsqueda usando $.ajax
          $.ajax({
            url: url,
            type: 'GET', // O POST, dependiendo de tu servidor
            dataType: 'json', // Esperamos una respuesta en formato JSON
            success: function(resultados) {
              mostrarResultados(resultados,resultadosBusqueda);
            },
            error: function(xhr, status, error) {
              console.error("Error al buscar:", error);
            }
          });
        } else {
          // Ocultar el contenedor de resultados si hay menos de 3 caracteres
          resultadosBusqueda.style.display = "none";
        }
      });
    });

    // Aplicar evento de clic a cada botón de limpiar
    clearBtns.forEach((clearBtn) => {
      clearBtn.addEventListener("click", function() {
        // Encuentra el input de búsqueda relacionado con este botón
        let inputBuscador = this.closest('.contenedor_form_buscador').querySelector('.buscador_input');
        inputBuscador.value = "";

        // También asegúrate de seleccionar y ocultar el contenedor de resultados correcto
        let resultadosBusqueda = this.closest('.contenedor_form_buscador').querySelector('#resultados-busqueda');
        resultadosBusqueda.style.display = "none";
      });
    });
  })();

  // =============================== Funcion para mostrar los Detalles de un Producto...
  $(document).ready(function () {
    let btnModalDetalles = $(".btn_detalles");
    let modalDetalles = $(".modal_detalles-blur");
    let btnCerrarDetalles = $(".cerrar_detalles");

    let contenedorProducto = $(".contenedor_producto");

    btnModalDetalles.on("click", function () {
      modalDetalles.hide(); // Oculta todos los modales
      $(this)
        .closest(".contenedor_producto")
        .parent()
        .find(".modal_detalles-blur")
        .show(); // Muestra solo el modal correspondiente
      return false;
    });

    btnCerrarDetalles.on("click", function () {
      $(this).closest(".modal_detalles-blur").hide(); // Oculta solo el modal al que pertenece el botón de cerrar
    });

    contenedorProducto
      .on("mouseenter", function () {
        $(this).find(".producto_contenedor_detalles").show(); // Muestra el modal al posicionar el mouse
      })
      .on("mouseleave", function () {
        $(this).find(".producto_contenedor_detalles").hide(); // Oculta el modal al quitar el mouse
      });

    modalDetalles.on("click", function (e) {
      if ($(e.target).hasClass("modal_detalles-blur")) {
        $(this).hide(); // Oculta solo el modal si se hace clic fuera de su contenido
      }
    });
  });

  $(document).ready(function () {
    // Manejar clic en el botón para ver en 3D
    $(".btn_3d").click(function () {
      let container = $(this).closest(".contenedor_modal_detalles_img");

      // En el mismo contenedor, oculta este botón y muestra el botón 2D
      $(this).hide();
      container.find(".btn_2d").show();

      // En el mismo contenedor, muestra el modelo 3D y oculta la imagen 2D
      container.find(".modal_detalles_img.model_3d").show();
      container.find(".modal_detalles_img.model_2d").hide();
    });

    // Manejar clic en el botón para ver en 2D
    $(".btn_2d").click(function () {
      let container = $(this).closest(".contenedor_modal_detalles_img");

      // En el mismo contenedor, oculta este botón y muestra el botón 3D
      $(this).hide();
      container.find(".btn_3d").show();

      // En el mismo contenedor, muestra la imagen 2D y oculta el modelo 3D
      container.find(".modal_detalles_img.model_2d").show();
      container.find(".modal_detalles_img.model_3d").hide();
    });
  });

  //===================================================== FUNCION CARRUSEL PRODUCTOS...
  // (function(){
  //     let botonesImgs = $('.rango_img_slide').length;
  //     let posicionImgs = 1;

  //     $('.rango_img_slide').hide();
  //     $('.rango_img_slide:first').show();

  //     $('.leftArrow').click(previousImg);
  //     $('.rightArrow').click(nextImg);

  //     function previousImg() {
  //         if (posicionImgs <= 1) {
  //             posicionImgs = botonesImgs;
  //         } else {
  //             posicionImgs--;
  //         }

  //         $('.rango_img_slide').hide();
  //         $('.rango_img_slide:nth-child('+ posicionImgs +')').fadeIn();

  //         console.log(posicionImgs,botonesImgs);
  //     }

  //     function nextImg() {
  //         if (posicionImgs >= botonesImgs) {
  //             posicionImgs = 1;
  //         } else {
  //             posicionImgs++;
  //         }

  //         $('.rango_img_slide').hide();
  //         $('.rango_img_slide:nth-child('+ posicionImgs +')').fadeIn();

  //         console.log(posicionImgs,botonesImgs);
  //     }
  // }());
});
