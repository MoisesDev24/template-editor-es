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
    <link rel="stylesheet" href="../css/editorHeader.css">
    <link rel="stylesheet" href="../css/alerta.css">
    <link rel="stylesheet" href="../css/imagenesTienda.css">
    <link rel="stylesheet" href="../css/tooltip.css">

    <!-- Icono del sitio (favicon) -->
    <link rel="icon" href="../img/favicon/favicon.ico" type="image/x-icon">

    <!-- Etiquetas Open Graph para compartir en redes sociales (opcional) -->
    <meta property="og:title" content="Editor - Tienda Virtual">
    <meta property="og:description" content="En Kalstein France, ubicada en Paris – Francia, somos una empresa con gran experiencia en la fabricación y exportación de equipos para laboratorios de alta calidad, que tienen la honestidad, la responsabilidad y la comunicación como base en el desarrollo de cada uno de nuestros productos. ">
    <meta property="og:image" content="url_de_la_imagen">
    <meta property="og:url" content="URL_del_sitio">
    <meta property="og:type" content="website">

    <!-- Estilos CSS adicionales (por ejemplo, fuentes externas) -->
    <link href="../css/fonts/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet">
    <link href="../css/fonts/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet">
    <link href="../css/fonts/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet">
</head>
<body>

    <?php
        require_once "../app/config/main.php";
        $conexion = conexion();
    ?>

    <?php
        include("../includes/header_dos.php");
    ?>

    <main class="wrapper">
        <!-- MODAL DEL PERFIL -->
        <div class="modal_perfil_usuario">
            <a href="https://plataforma.kalstein.net/distribuidor/configuracion/">Perfil</a>
        </div>
        
        <?php
            include("../includes/barra_lateral_dos.php");
        ?>

        <div class="contenido">
            <div class="resultado_formulario"></div>

            <h1 class="titulo_secundario">AÑADE IMÁGENES A TU TIENDA</h1>

            <div class="contenedor_datos">
                <div class="contenedor_imagenes">
                    <div class="menu_opciones">
                        <ul class="lista_opciones">
                            <li class="opciones_item"><span>Banner Principal</span></li>
                            <li class="opciones_item"><span>¿Quiénes Somos?</span></li>
                            <li class="opciones_item"><span>Misión</span></li>
                            <li class="opciones_item"><span>Visión</span></li>
                        </ul>
                    </div>

                    <form action="../app/controllers/imagenesTienda_controller.php" data-tipo="formulario3" method="POST" class="formulario_imagenes formulario_ajax" enctype="multipart/form-data">

                        <?php
                            $sql = "
                                SELECT * FROM tienda_virtual AS tv 
                                INNER JOIN idioma_tienda AS i ON tv.ID_idioma = i.ID_idioma 
                                WHERE ID_user = '$email';
                            ";
                            $consultaDatos = mysqli_query($conexion, $sql);
                            $datos = mysqli_fetch_array($consultaDatos);
                        ?>

                        <div class="contenedor_imagen" id="banner_principal">
                            <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                                <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                            </svg>
                            <div class="contenedor_tooltip" style="right: 40px;">
                                <div class="tooltip">
                                    <p>
                                        Añade un banner para tu Tienda Virtual. Este debe medir entre 1900x1000px de ancho, y 600x350px de alto.
                                    </p>
                                </div>
                            </div>

                            <h2 class="titulo_imagenes">Banner Principal</h2>

                            <div class="contenedor_subir_imagen">
                                <label for="banner_p">Subir imagen del Banner principal</label>
                                <div class="input-container">
                                    <?php
                                        if (!empty($datos['banner_t'])) {
                                            echo '
                                                <input type="file" value="'.htmlspecialchars($datos['banner_t']).'" name="banner_p" id="banner_p" class="input-file">                                                
                                            ';
                                        } else {
                                            echo '<input type="file" name="banner_p" id="banner_p" class="input-file">';
                                        }
                                    ?>
                                    <label for="banner_p" class="input-label">
                                        <i class="fa-regular fa-file-image"></i>
                                        Subir archivo<br>
                                        JPG o PNG (Máx. 1900x600px)
                                    </label>
                                </div>
                            </div>

                            <div class="vista_previa_img">
                                <h3 class="titulo_vista_p">Vista previa de la Imagen</h3>
                                <div class="contenedor_vista_previa">
                                    <?php
                                        if (!empty($datos['banner_t'])) {
                                            // Si tienes una ruta de imagen, muestra la imagen y el input para cambiarla
                                            echo '
                                                <img src="' . htmlspecialchars($datos['banner_t']) . '" alt="Logo de la tienda" style="display: block; width: 100%; height: 100%; object-fit: contain;">
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="contenedor_datos_botones">
                                <button type="reset" class="btn_limpiar">Limpiar</button>
                                <button type="submit" class="btn_aceptar">Guardar</button>
                            </div>
                        </div>

                        <div class="contenedor_imagen" id="quienes_somos">
                            <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                                <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                            </svg>
                            <div class="contenedor_tooltip" style="right: 40px;">
                                <div class="tooltip">
                                    <p>
                                        Añade una imagen para la identidad de tu Empresa. Esta debe medir entre 900x380px de ancho, y 600x100px de alto.
                                    </p>
                                </div>
                            </div>

                            <h2 class="titulo_imagenes">¿Quiénes Somos?</h2>

                            <div class="contenedor_subir_imagen">
                                <label for="quienes_somos_t">Subir imagen del segmento de "¿Quiénes Somos?"</label>
                                <div class="input-container">
                                    <?php
                                        if (!empty($datos['img_quienes_s'])) {
                                            echo '
                                                <input type="file" value="'.htmlspecialchars($datos['img_quienes_s']).'" name="quienes_somos_t" id="quienes_somos_t" class="input-file">
                                            ';
                                        } else {
                                            echo '<input type="file" name="quienes_somos_t" id="quienes_somos_t" class="input-file">';
                                        }
                                    ?>
                                    <label for="quienes_somos_t" class="input-label">
                                        <i class="fa-regular fa-file-image"></i>
                                        Subir archivo<br>
                                        JPG o PNG (Máx. 900x600px)
                                    </label>
                                </div>
                            </div>

                            <div class="vista_previa_img">
                                <h3 class="titulo_vista_p">Vista previa de la Imagen</h3>
                                <div class="contenedor_vista_previa">
                                    <?php
                                        if (!empty($datos['img_quienes_s'])) {
                                            // Si tienes una ruta de imagen, muestra la imagen y el input para cambiarla
                                            echo '
                                                <img src="' . htmlspecialchars($datos['img_quienes_s']) . '" alt="Logo de la tienda" style="display: block; width: 100%; height: 100%; object-fit: contain;">
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="contenedor_imagen" id="mision">
                            <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                                <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                            </svg>
                            <div class="contenedor_tooltip" style="right: 40px;">
                                <div class="tooltip">
                                    <p>
                                        Añade una imagen para la misión de tu Empresa. Esta debe medir entre 900x380px de ancho, y 600x100px de alto.
                                    </p>
                                </div>
                            </div>

                            <h2 class="titulo_imagenes">Misión</h2>

                            <div class="contenedor_subir_imagen">
                                <label for="mision_img">Subir imagen del segmento de "Misión"</label>
                                <div class="input-container">
                                    <?php
                                        if (!empty($datos['img_mision'])) {
                                            echo '
                                                <input type="file" value="'.htmlspecialchars($datos['img_mision']).'" name="mision_img" id="mision_img" class="input-file">
                                            ';
                                        } else {
                                            echo '<input type="file" name="mision_img" id="mision_img" class="input-file">';
                                        }
                                    ?>
                                    <label for="mision_img" class="input-label">
                                        <i class="fa-regular fa-file-image"></i>
                                        Subir archivo<br>
                                        JPG o PNG (Máx. 900x600px)
                                    </label>
                                </div>
                            </div>

                            <div class="vista_previa_img">
                                <h3 class="titulo_vista_p">Vista previa de la Imagen</h3>
                                <div class="contenedor_vista_previa">
                                    <?php
                                        if (!empty($datos['img_mision'])) {
                                            // Si tienes una ruta de imagen, muestra la imagen y el input para cambiarla
                                            echo '
                                                <img src="' . htmlspecialchars($datos['img_mision']) . '" alt="Logo de la tienda" style="display: block; width: 100%; height: 100%; object-fit: contain;">
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="contenedor_imagen" id="vision">
                            <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                                <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                            </svg>
                            <div class="contenedor_tooltip" style="right: 40px;">
                                <div class="tooltip">
                                    <p>
                                        Añade una imagen para la visión de tu Empresa. Esta debe medir entre 900x380px de ancho, y 600x100px de alto.
                                    </p>
                                </div>
                            </div>

                            <h2 class="titulo_imagenes">Visión</h2>

                            <div class="contenedor_subir_imagen">
                                <label for="imagen_vision">Subir imagen del segmento de "Visión"</label>
                                <div class="input-container">
                                    <?php
                                        if (!empty($datos['img_vision'])) {
                                            echo '
                                                <input type="file" value="'.htmlspecialchars($datos['img_vision']).'" name="imagen_vision" id="imagen_vision" class="input-file">
                                            ';
                                        } else {
                                            echo '<input type="file" name="imagen_vision" id="imagen_vision" class="input-file">';
                                        }
                                    ?>
                                    <label for="imagen_vision" class="input-label">
                                        <i class="fa-regular fa-file-image"></i>
                                        Subir archivo<br>
                                        JPG o PNG (Máx. 900x600px)
                                    </label>
                                </div>
                            </div>

                            <div class="vista_previa_img">
                                <h3 class="titulo_vista_p">Vista previa de la Imagen</h3>
                                <div class="contenedor_vista_previa">
                                    <?php
                                        if (!empty($datos['img_vision'])) {
                                            // Si tienes una ruta de imagen, muestra la imagen y el input para cambiarla
                                            echo '
                                                <img src="' . htmlspecialchars($datos['img_vision']) . '" alt="Logo de la tienda" style="display: block; width: 100%; height: 100%; object-fit: contain;">
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
 
    <!-- Enlaces a scripts JavaScript -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js" defer></script>
    <script src="../js/imagenesTienda.js" defer></script>
    <script src="../js/ajaxImagenesTienda.js" defer></script>
    <script src="../js/tooltip.js" defer></script>

    <?php
        $conexion = null;
    ?>
</body>
</html>