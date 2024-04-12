//===============================================================
// FUNCIONES BÁSICAS:

(function(){
	const btnPerfil = $(".usuario_img");
	const modalPerfil = $(".modal_perfil_usuario");

	btnPerfil.on("click", function(){
		modalPerfil.css("display","flex");
	});

	modalPerfil.on("mouseleave", function(){
		$(this).hide();
	});
}());