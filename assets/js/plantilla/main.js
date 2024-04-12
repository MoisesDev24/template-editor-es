//==========================================================
$(document).ready(function(){

    // MENU DE NAVEGACION DESPLEGABLE...
    (function(){
        function toggleMenu(event) {
            // Obtener el menu desplegable especifico del evento
            let menuDesplegable = $(event.currentTarget).closest(".navbar").find(".modal_dropdown");
            menuDesplegable.toggle();
        }

        // Agregar eventos a todos los botones de menu y cerrar menu
        $(".navbar").each(function() {
            let navbar = $(this);
            navbar.find("#boton_menu").on("click", toggleMenu);
            navbar.find(".btn_cerrar_menu").on("click", toggleMenu);
        });
    }());

    // CARRUSEL DE PRODUCTOS...
    $(function() {
        let currentIndex = 0;
        const images = $('.carousel_contenedor_imagen');
        const totalImages = images.length;
        const carouselWrapper = $('.carousel_wrapper');
        const navButtons = $('.navigation_buttons .nav_button');
        const carouselItems = $('.carousel_wrapper .carousel_contenedor_imagen');
    
        // Duplicar las imagenes para hacer el carrusel infinito
        carouselItems.clone().appendTo(carouselWrapper);
    
        navButtons.each(function(index) {
            $(this).data('index', index);
        });
    
        navButtons.click(function() {
            const newIndex = $(this).data('index');
            moveCarousel(newIndex - currentIndex);
            currentIndex = newIndex;
        });
    
        function moveCarousel(direction) {
            currentIndex = (currentIndex + direction + totalImages) % totalImages;
            const newPosition = -(currentIndex * (100 / 3));
            carouselWrapper.css('transform', `translateX(${newPosition}%)`);
    
            // Resalta el boton de la imagen actualmente visible
            navButtons.removeClass('active');
            $(navButtons[currentIndex]).addClass('active');
        }
    
        $('.next').click(function() {
            moveCarousel(1);
        });
    
        $('.prev').click(function() {
            moveCarousel(-1);
        });
    
        // Iniciar el carrusel con el intervalo
        const interval = setInterval(function() {
            moveCarousel(1);
        }, 3000);
    });

    // FUNCION COPIAR URL...
    document.getElementById('copy-btn').addEventListener('click', function(e) {
        e.preventDefault();

        let currentPageUrl = window.location.href;

        let inputElement = document.createElement('input');
        inputElement.setAttribute('value', currentPageUrl);
        document.body.appendChild(inputElement);

        inputElement.select();
        document.execCommand('copy');

        document.body.removeChild(inputElement);

        alert('URL de la página actual copiada al portapapeles: ' + currentPageUrl);
    });

    // Funcion para el menu de navegacion...
    (function(){
        $(".btn_inicio").on("click", function(e){
            e.preventDefault();
            $("#seccion_productos").hide();
            // $("#seccion_nosotros").hide();
            $("#seccion_inicial").show();
        });

        $(".btn_productos").on("click", function(e){
            e.preventDefault();
            $("#seccion_inicial").hide();
            // $("#seccion_nosotros").hide();
            $("#seccion_productos").show();
        });
    }());

    // Funcion para animar los elementos con el Scroll
    window.addEventListener('scroll', function() {
        let elements = document.querySelectorAll('.elementoScroll');
        let elementsTwo = document.querySelectorAll('.elementoScrollDos');
        let tituloPpal = document.querySelectorAll('.titulo_extra');
        let descripcionCorta = document.querySelector('.descripcion_corta');
        let btnArrowUp = document.querySelector('.arrow_up');

        // Obtiene la posicion del elemento respecto al viewport
        let descripcionCortaPosition = descripcionCorta.getBoundingClientRect().top;
        let btnArrowUpPosition = btnArrowUp.getBoundingClientRect().top;

        // Define una posicion de pantalla para animar los elementos
        // Mientras menor sea el valor, mas rapido se mostrara el elemento
        let screenPosition = window.innerHeight / 1.4;
        let screenTwoPosition = window.innerHeight / 0.4;
        let screenTituloPosition = window.innerHeight / 0.9;

        // Si la descripcion corta esta dentro del area visible, agrega la clase para mostrarla
        if (descripcionCortaPosition < window.innerHeight / 1) {
            descripcionCorta.classList.add('showDescripcionCorta');
        } else {
            // Si no, remueve la clase para no mostrarla
            descripcionCorta.classList.remove('showDescripcionCorta');
        }

        // Si el boton para subir esta dentro del area visible, agrega la clase para fijarlo
        if (btnArrowUpPosition < window.innerHeight / 1) {
            btnArrowUp.classList.add('arrow_up_fixed');
        } else {
            // Si no, remueve la clase para no fijarlo
            btnArrowUp.classList.remove('arrow_up_fixed');
        }

        // Para cada elemento en elements, verifica si esta dentro del area visible y actualiza su clase
        elements.forEach(element => {
            let position = element.getBoundingClientRect().top;
            if (position < screenPosition) {
                element.classList.add('showElementos');
            } else {
                element.classList.remove('showElementos');
            }
        });

        // Para cada elemento en elementsTwo, verifica si esta dentro del area visible y actualiza su clase
        elementsTwo.forEach(elementtwo => {
            let position = elementtwo.getBoundingClientRect().top;
            if (position < screenTwoPosition) {
                elementtwo.classList.add('showElementosDos');
            } else {
                elementtwo.classList.remove('showElementosDos');
            }
        });

        // Para cada titulo principal, verifica si esta dentro del area visible y actualiza su clase
        tituloPpal.forEach(tituloP => {
            let tituloPpalPosition = tituloP.getBoundingClientRect().top;
            if (tituloPpalPosition < screenTituloPosition) {
                tituloP.classList.add('showTituloPpal');
            } else {
                tituloP.classList.remove('showTituloPpal');
            }
        });
    });
});