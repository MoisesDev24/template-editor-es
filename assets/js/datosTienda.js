//=================================================================================
jQuery(document).ready(function($) {
    const dropContainer = document.getElementById("drop-area");
    const fileInput = document.getElementById("logo_tienda");
    const imgInsertada = document.getElementById("img_insertada");

    dropContainer.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropContainer.classList.add("drag-active");
    }, false);

    dropContainer.addEventListener("dragenter", () => {
        dropContainer.classList.add("drag-active");
    });

    dropContainer.addEventListener("dragleave", () => {
        dropContainer.classList.remove("drag-active");
    });

    dropContainer.addEventListener("drop", (e) => {
        e.preventDefault();
        dropContainer.classList.remove("drag-active");
        fileInput.files = e.dataTransfer.files;
        showMyImage(fileInput);
    });

    fileInput.addEventListener("change", () => {
        showMyImage(fileInput);
    });

    function showMyImage(input) {
        dropContainer.classList.add("has-image");
    }

    if (imgInsertada) {
        dropContainer.classList.add("has-image");
    }

    const inputFile = document.getElementById('logo_tienda');
    const contenedorVistaPrevia = document.querySelector('.contenedor_vista_previa');

    inputFile.addEventListener('change', function () {
        contenedorVistaPrevia.innerHTML = '';
        if (imgInsertada) {
            dropContainer.removeChild(imgInsertada);
        }

        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = "100%";

                contenedorVistaPrevia.appendChild(img);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });

    $(document).ready(function() {
        let btnLimpiar = $(".btn_limpiar");
        let inputsText = $(".form_datos_item > input");
        let inputsTextareas = $(".form_datos_item_extra > textarea");
    
        btnLimpiar.on("click", function(){
            console.log("Limpiar inputs");

            inputsText.each(function() {
                $(this).attr('value', '');
            });

            inputsTextareas.each(function() {
                $(this).val('').text('');
            });
        });
    });
});
