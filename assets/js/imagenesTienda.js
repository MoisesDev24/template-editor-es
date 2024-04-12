//==========================================================
$(document).ready(function () {

    // FUNCION PARA EL MINI MENU DE LA IZQUIERDA...
    (function(){
        const botonesMenu = $(".opciones_item");
        const elementosContenidos = $(".contenedor_imagen");
        
        // Mostrar el primer elemento en el inicio
        elementosContenidos.hide();
        elementosContenidos.first().show();

        botonesMenu.on("click", function(){
            // Ocultar todos los elementos de contenido
            elementosContenidos.hide();

            // Obtener el índice del botón clickeado
            const indice = botonesMenu.index($(this));

            // Mostrar el elemento de contenido correspondiente al botón clickeado
            elementosContenidos.eq(indice).show();
        });
    }());

    // FUNCION PARA LA PREVISUALIZACION DE LAS IMAGENES...
    (function(){
        // Obtener todos los elementos de tipo archivo
        const inputFiles = document.querySelectorAll('.input-file');

        // Agregar un evento de cambio a cada elemento de tipo archivo
        inputFiles.forEach(function (inputFile) {
            inputFile.addEventListener('change', function () {
                // Obtener el contenedor de vista previa correspondiente
                const contenedorVistaPrevia = this.closest('.contenedor_imagen').querySelector('.contenedor_vista_previa');

                // Limpiar la vista previa anterior
                contenedorVistaPrevia.innerHTML = '';

                // Verificar si se ha seleccionado un archivo
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        // Crear un elemento de imagen y establecer la fuente como la vista previa del archivo
                        const img = document.createElement('img');
                        img.src = e.target.result;

                        // Agregar la imagen al contenedor de vista previa
                        contenedorVistaPrevia.appendChild(img);
                    };

                    // Leer el archivo como una URL de datos
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        // Agregar un evento al botón de reset
        const btnReset = document.querySelectorAll('.btn_limpiar');
        btnReset.forEach(function (btn) {
            btn.addEventListener('click', function () {
                // Obtener el contenedor de vista previa correspondiente
                const contenedorVistaPrevia = this.closest('.contenedor_imagen').querySelector('.contenedor_vista_previa');

                // Limpiar la vista previa
                contenedorVistaPrevia.innerHTML = '';

                // Limpiar el input file
                const inputFile = this.closest('.contenedor_imagen').querySelector('.input-file');
                inputFile.value = ''; // Establecer el valor del input file a una cadena vacía
            });
        });
    }());
});
