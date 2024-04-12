<?php
    session_start();

    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    } else {
        echo "<script>
        alert('Inicia sesión.');

        window.location.replace('https://plataforma.kalstein.net/acceder/'); 
        </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="En Kalstein France, ubicada en Paris – Francia, somos una empresa con gran experiencia en la fabricación y exportación de equipos para laboratorios de alta calidad, que tienen la honestidad, la responsabilidad y la comunicación como base en el desarrollo de cada uno de nuestros productos. ">
    <meta name="keywords" content="palabras clave, relevantes, para, el, sitio">
    <meta name="author" content="Kalstein Equipos para Laboratorios C.A.">
    <meta name="robots" content="index, follow">
    <meta name="copyright" content="Kalstein Equipos para Laboratorios C.A."/>

    <!-- Titulo del sitio web -->
    <title>Editor - Tienda Virtual</title>

    <!-- Enlaces a hojas de estilo -->
    <link rel="stylesheet" href="assets/css/editorHeader.css">
    <link rel="stylesheet" href="assets/css/editor.css">
    <link rel="stylesheet" href="assets/css/tooltip.css">

    <!-- Icono del sitio (favicon) -->
    <link rel="icon" href="assets/img/favicon/favicon.ico" type="image/x-icon">

    <!-- Etiquetas Open Graph para compartir en redes sociales (opcional) -->
    <meta property="og:title" content="Editor - Tienda Virtual">
    <meta property="og:description" content="En Kalstein France, ubicada en Paris – Francia, somos una empresa con gran experiencia en la fabricación y exportación de equipos para laboratorios de alta calidad, que tienen la honestidad, la responsabilidad y la comunicación como base en el desarrollo de cada uno de nuestros productos. ">
    <meta property="og:image" content="url_de_la_imagen">
    <meta property="og:url" content="URL_del_sitio">
    <meta property="og:type" content="website">

    <!-- Estilos CSS adicionales (por ejemplo, fuentes externas) -->
    <link href="assets/css/fonts/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet">
    <link href="assets/css/fonts/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet">
    <link href="assets/css/fonts/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet">
</head>
<body>

    <?php
        require_once "assets/app/config/main.php";
        $conexion = conexion();
    ?>

    <?php
        include("assets/app/sql/sql_datosTienda.php");
        include("assets/includes/header.php");
    ?>

    <main class="wrapper">
        <!-- MODAL DEL PERFIL -->
        <div class="modal_perfil_usuario">
            <a href="https://plataforma.kalstein.net/distribuidor/configuracion/">Perfil</a>
        </div>

        <?php
            include("assets/includes/barra_lateral.php");
        ?>

        <div class="contenido">
            <h1 class="titulo">RESÚMEN DE TU TIENDA VIRTUAL</h1>

            <div class="contenedor_resumen">
                <div class="contenedor_progress_bar">
                    <?php
                        $progressClass = 'estado_cero'; // Establece el estado inicial

                        $condiciones_cumplidas = 0;

                        // Verificar estado uno
                        if (
                            isset($datos_tienda['titulo_t'], $datos_tienda['subtitulo_t'], $datos_tienda['descripcion'], $datos_tienda['logo_t'], $datos_tienda['ID_idioma']) &&
                            $datos_tienda['titulo_t'] != "" && $datos_tienda['subtitulo_t'] != "" && $datos_tienda['descripcion'] != "" && $datos_tienda['logo_t'] != "" && $datos_tienda['ID_idioma'] != ""
                        ) {
                            $condiciones_cumplidas++;
                        }

                        // Verificar estado dos
                        if (
                            isset($datos_tienda['color_p'], $datos_tienda['color_s']) && $datos_tienda['color_p'] != "" && $datos_tienda['color_s'] != ""
                        ) {
                            $condiciones_cumplidas++;
                        }

                        // Verificar estado tres
                        if (
                            isset($datos_tienda['banner_t']) && $datos_tienda['banner_t'] != ""
                        ) {
                            $condiciones_cumplidas++;
                        }

                        // Determinar el Progreso de la barra
                        if ($condiciones_cumplidas >= 3) {
                            $progressClass = 'estado_tres';
                        } elseif ($condiciones_cumplidas >= 2) {
                            $progressClass = 'estado_dos';
                        } elseif ($condiciones_cumplidas >= 1) {
                            $progressClass = 'estado_uno';
                        }
                    ?>

                    <div class="progress_bar <?php echo $progressClass; ?>"></div>

                    <div class="contenedor_grid">
                        <div class="grid_item">
                            <span class="item_titulo">Datos</span>
                            <div class="contenedor_iconos">
                                <?php
                                    if (isset($datos_tienda['titulo_t'], $datos_tienda['subtitulo_t'], $datos_tienda['descripcion'], $datos_tienda['logo_t'], $datos_tienda['ID_idioma']) &&
                                        $datos_tienda['titulo_t'] != "" && $datos_tienda['subtitulo_t'] != "" && $datos_tienda['descripcion'] != "" && $datos_tienda['logo_t'] != "" && $datos_tienda['ID_idioma'] != "") {
                                        echo '
                                            <div class="check">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                        ';
                                    } else {
                                        echo '
                                            <div class="process">
                                                <i class="fa-solid fa-rotate-right"></i>
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                            <?php
                                if (isset($datos_tienda['titulo_t'], $datos_tienda['subtitulo_t'], $datos_tienda['descripcion'], $datos_tienda['logo_t'], $datos_tienda['ID_idioma']) &&
                                    $datos_tienda['titulo_t'] != "" && $datos_tienda['subtitulo_t'] != "" && $datos_tienda['descripcion'] != "" && $datos_tienda['logo_t'] != "" && $datos_tienda['ID_idioma'] != "") {
                                    echo '
                                        <span class="item_status">Completado</span>
                                    ';
                                } else {
                                    echo '
                                        <span class="item_status-gray">Pendiente</span>
                                    ';
                                }
                            ?>
                        </div>

                        <div class="grid_item">
                            <span class="item_titulo">Estilos</span>
                            <div class="contenedor_iconos">
                                <?php
                                    if (isset($datos_tienda['color_p'], $datos_tienda['color_s']) &&
                                        $datos_tienda['color_p'] != "" && $datos_tienda['color_s'] != "") {
                                        echo '
                                            <div class="check">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                        ';
                                    } else {
                                        echo '
                                            <div class="process">
                                                <i class="fa-solid fa-rotate-right"></i>
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                            <?php
                                if (isset($datos_tienda['color_p'], $datos_tienda['color_s']) &&
                                    $datos_tienda['color_p'] != "" && $datos_tienda['color_s'] != "") {
                                    echo '
                                        <span class="item_status">Completado</span>
                                    ';
                                } else {
                                    echo '
                                        <span class="item_status-gray">Pendiente</span>
                                    ';
                                }
                            ?>
                        </div>

                        <div class="grid_item">
                            <span class="item_titulo">Imágenes</span>
                            <div class="contenedor_iconos">
                                <?php
                                    if (isset($datos_tienda['banner_t']) && $datos_tienda['banner_t'] != "") {
                                        echo '
                                            <div class="check">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                        ';
                                    } else {
                                        echo '
                                            <div class="process">
                                                <i class="fa-solid fa-rotate-right"></i>
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                            <?php
                                if (isset($datos_tienda['banner_t'], $datos_tienda['img_quienes_s'], $datos_tienda['img_mision'], $datos_tienda['img_vision']) &&
                                    $datos_tienda['banner_t'] != "" && $datos_tienda['img_quienes_s'] != "" && $datos_tienda['img_mision'] != "" && $datos_tienda['img_vision'] != "") {
                                    echo '
                                        <span class="item_status">Completado</span>
                                    ';
                                } else {
                                    echo '
                                        <span class="item_status-gray">Pendiente</span>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="contenedor_items_resumen">
                    <div class="resumen_item_grande">
                        <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                            <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                        </svg>
                        <div class="contenedor_tooltip">
                            <div class="tooltip">
                                <p>
                                    Aquí puedes observar el contenido de la sección "Datos de la Tienda".
                                </p>
                            </div>
                        </div>

                        <a href="assets/vistas/datosTienda.php">
                            <h2 class="resumen_titulo">Datos de la Tienda</h2>
                        </a>

                        <div class="resumen_datos">
                            <span>Logo de la tienda</span>
                            <span>Título de la Tienda</span>
                            <span>Descripción corta de la Tienda</span>
                            <span>Subtítulo de la Tienda</span>
                            <span>Idioma de la Tienda</span>

                            <span>¿Quiénes Somos?</span>
                            <span>Misión</span>
                            <span>Visión</span>
                        </div>
                    </div>

                    <div class="resumen_item">
                        <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                            <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                        </svg>
                        <div class="contenedor_tooltip">
                            <div class="tooltip">
                                <p>
                                    Aquí puedes observar el contenido de la sección "Estilos".
                                </p>
                            </div>
                        </div>

                        <a href="assets/vistas/estilos.php">
                            <h2 class="resumen_titulo">Estilos</h2>
                        </a>

                        <div class="resumen_datos">
                            <span>Color Principal</span>

                            <span>Color Secundario</span>
                        </div>
                    </div>

                    <div class="resumen_item">
                        <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                            <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                        </svg>
                        <div class="contenedor_tooltip">
                            <div class="tooltip">
                                <p>
                                    Aquí puedes observar el contenido de la sección "Imágenes".
                                </p>
                            </div>
                        </div>

                        <a href="assets/vistas/imagenes.php">
                            <h2 class="resumen_titulo">Imágenes</h2>
                        </a>

                        <div class="resumen_datos">
                            <span>Banner Principal</span>
                            <span>¿Quiénes Somos?</span>
                            <span>Misión</span>
                            <span>Visión</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
 
    <!-- Enlaces a scripts JavaScript -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js" defer></script>
    <script src="assets/js/tooltip.js" defer></script>

    <?php
        $conexion = null;
    ?>
</body>
</html>