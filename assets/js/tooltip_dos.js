//==========================================================
$(document).ready(function () {

    (function(){
        const btnTooltip = $(".tooltip_btn_small");

        btnTooltip.on("click", function(){
            const tooltip = $(this).parent().parent().find(".contenedor_tooltip_small");
            tooltip.css("display", "block");

            tooltip.delay(3000).hide(0);
        });
    }());

});