//==========================================================
$(document).ready(function () {

    (function(){
        const btnTooltip = $(".tooltip_btn");

        btnTooltip.on("click", function(){
            const tooltip = $(this).siblings(".contenedor_tooltip");
            tooltip.css("display", "block");

            // Usar el método delay en lugar de setTimeout
            tooltip.delay(3000).hide(0);
        });
    }());    

});
