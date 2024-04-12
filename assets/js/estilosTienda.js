//==========================================================
$(document).ready(function () {

	// FUNCION PARA MOSTRAR EL COLOR SELECCIONADO EN EL TEXTO...
	let colorPicker = document.getElementById("color_picker");
	let colorContainer = colorPicker.parentElement;
	let colorDisplay = document.getElementById("color_display");
	colorPicker.addEventListener("input", function(){
		colorDisplay.style.color = this.value;
		colorContainer.style.backgroundColor = this.value;
	});

	let colorPickerDos = document.getElementById("color_picker_dos");
	let colorContainerDos = colorPickerDos.parentElement;
	let colorDisplayDos = document.getElementById("color_display_dos");
	colorPickerDos.addEventListener("input", function(){
		colorDisplayDos.style.color = this.value;
		colorContainerDos.style.backgroundColor = this.value;
	});

	// Agregamos el evento al botón de reset
    let btnReset = document.querySelector('.btn_limpiar');
    btnReset.addEventListener('click', function() {
        // Restablecer los valores predeterminados de los selectores de color
        colorPicker.value = "#000000";
        colorDisplay.style.color = colorPicker.value;
        colorContainer.style.backgroundColor = colorPicker.value;

        colorPickerDos.value = "#000000";
        colorDisplayDos.style.color = colorPickerDos.value;
        colorContainerDos.style.backgroundColor = colorPickerDos.value;
    });

});