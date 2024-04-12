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
    <link rel="stylesheet" href="../css/datosTienda.css">
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

            <h1 class="titulo_secundario">AÑADE INFORMACIÓN A LA TIENDA</h1>

            <div class="contenedor_datos">
                <form action="../app/controllers/infoTienda_controller.php" data-tipo="formulario1" method="POST" class="form_datos formulario_ajax" enctype="multipart/form-data">
                    <!-- Datos Generales -->
                    <div class="form_datos_informacion">
                        <?php
                            $sql = "
                                SELECT * FROM tienda_virtual AS tv 
                                INNER JOIN idioma_tienda AS i ON tv.ID_idioma = i.ID_idioma 
                                WHERE ID_user = '$email';
                            ";
                            $consultaDatos = mysqli_query($conexion, $sql);
                            $datos = mysqli_fetch_array($consultaDatos);

                            if(!empty($datos['logo_t'])) {
                                $contenidoIcono = '';
                                $bottomLabel = '8%';
                            }

                            $tituloT = (!empty($datos['titulo_t'])) ? $datos['titulo_t'] : '';
                        ?>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Añade el título de tu Tienda Virtual.
                                    </p>
                                </div>
                            </div>

                            <label for="titulo_tienda">
                                Título de la Tienda
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                </svg>
                            </label>

                            <input type="text" placeholder="Kalstein Equipos para Laboratorios C.A." name="titulo_tienda" id="titulo_tienda" minlength="5" maxlength="60" value="<?php echo htmlspecialchars($tituloT); ?>" required>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Añade el subtítulo de tu Tienda Virtual.
                                    </p>
                                </div>
                            </div>

                            <label for="subtitulo_tienda">
                                Subtítulo de la Tienda
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                </svg>
                            </label>

                            <?php
                                $subtituloT = (!empty($datos['subtitulo_t'])) ? $datos['subtitulo_t'] : '';
                            ?>
                            <input type="text" placeholder="¡Calidad 100% Garantizada!" name="subtitulo_tienda" id="subtitulo_tienda" minlength="5" maxlength="70" value="<?php echo htmlspecialchars($subtituloT); ?>" required>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Añade el idioma de tu Tienda Virtual.
                                    </p>
                                </div>
                            </div>

                            <label for="idioma_tienda">
                                Idioma
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                </svg>
                            </label>

                            <select name="idioma_tienda" id="idioma_tienda" required>
                                <option value="">- Seleccionar -</option>
                                <?php
                                    $sql = "SELECT * FROM idioma_tienda;";
                                    $consulta = mysqli_query($conexion, $sql);

                                    while ($mostrar_idioma = mysqli_fetch_array($consulta)) { 
                                        $selected = ($mostrar_idioma['ID_idioma'] == $datos['ID_idioma']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $mostrar_idioma['ID_idioma'];?>" <?php echo $selected; ?>>
                                    <?php echo $mostrar_idioma['nombre_idioma'];?>    
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Añade la misión de tu Empresa o Producto.
                                    </p>
                                </div>
                            </div>

                            <label for="mision_tienda">
                                Misión
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                </svg>
                            </label>

                            <?php
                                $misionT = (!empty($datos['mision'])) ? $datos['mision'] : '';
                            ?>
                            <input type="text" placeholder="Escribe aquí..." name="mision_tienda" id="mision_tienda" minlength="150" value="<?php echo htmlspecialchars($misionT); ?>" required>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Añade la visión de tu Empresa o Producto.
                                    </p>
                                </div>
                            </div>

                            <label for="vision_tienda">
                                Visión
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                </svg>
                            </label>

                            <?php
                                $visionT = (!empty($datos['vision'])) ? $datos['vision'] : '';
                            ?>
                            <input type="text" placeholder="Escribe aquí..." name="vision_tienda" id="vision_tienda" minlength="150" value="<?php echo htmlspecialchars($visionT); ?>" required>
                        </div>

                        <div class="form_datos_item">
                            <label for="facebook_tienda">
                                Facebook
                            </label>

                            <?php
                                $facebookT = (!empty($datos['facebook_t'])) ? $datos['facebook_t'] : '';
                            ?>
                            <input type="text" placeholder="Pega tu enlace de Facebook aquí..." name="facebook_tienda" id="facebook_tienda" value="<?php echo htmlspecialchars($facebookT); ?>">
                        </div>

                        <div class="form_datos_item">
                            <label for="twitter_tienda">
                                Twitter (X)
                            </label>

                            <?php
                                $twitterT = (!empty($datos['twitter_t'])) ? $datos['twitter_t'] : '';
                            ?>
                            <input type="text" placeholder="Pega tu enlace de Twitter aquí..." name="twitter_tienda" id="twitter_tienda" value="<?php echo htmlspecialchars($twitterT); ?>">
                        </div>

                        <div class="form_datos_item">
                            <label for="instagram_tienda">
                                Instagram
                            </label>

                            <?php
                                $instagramT = (!empty($datos['instagram_t'])) ? $datos['instagram_t'] : '';
                            ?>
                            <input type="text" placeholder="Pega tu enlace de Instagram aquí..." name="instagram_tienda" id="instagram_tienda" value="<?php echo htmlspecialchars($instagramT); ?>">
                        </div>
                    </div>

                    <!-- Seccion de la derecha -->
                    <div class="form_datos_informacion_extra">
                        <!-- Logo de la Tienda -->
                        <div class="form_datos_logo logo_titulo">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Añade el logo de tu Empresa o Producto. Este debe medir entre 550x220px de ancho, y 250x50px de alto.
                                    </p>
                                </div>
                            </div>

                            <label for="logo_tienda" style="bottom: <?php echo $bottomLabel; ?>;">
                                Subir un Logo
                            </label>

                            <div class="form_datos__logo drop-container" id="drop-area">
                                <?php
                                    if (!empty($datos['logo_t'])) {
                                        // Si tienes una ruta de imagen, muestra la imagen y el input para cambiarla
                                        echo '
                                            <img src="'.htmlspecialchars($datos['logo_t']).'" id="img_insertada" alt="Logo de la tienda">
                                            <input type="hidden" name="imagen_actual" id="imagen_actual" value="'.$datos['logo_t'].'">
                                        ';
                                    }
                                ?>
                                <input type="file" name="logo_tienda" id="logo_tienda" accept="image/*">
                                <div class="contenedor_vista_previa"></div>
                            </div>

                            <div>
                                <svg class="tooltip_btn_small tooltip_logo" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="form_datos_item">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Añade una descripción de tu Empresa o Producto.
                                    </p>
                                </div>
                            </div>

                            <label for="descripcion_tienda">
                                Descripción
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                </svg>
                            </label>

                            <?php
                                $descripcionT = (!empty($datos['descripcion'])) ? $datos['descripcion'] : '';
                            ?>
                            <input type="text" placeholder="Más de 20 años en el Mercado" name="descripcion_tienda" id="descripcion_tienda" minlength="200" required value="<?php echo htmlspecialchars($descripcionT); ?>">
                        </div>

                        <div class="form_datos_item_extra">
                            <div class="contenedor_tooltip_small">
                                <div class="tooltip_small">
                                    <p>
                                        Añade la identidad de tu Empresa o Producto.
                                    </p>
                                </div>
                            </div>

                            <label for="quienes_somos">
                                ¿Quiénes Somos?
                                <svg class="tooltip_btn_small" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                                </svg>
                            </label>

                            <?php
                                $quienesSomosT = (!empty($datos['quienes_somos_t'])) ? $datos['quienes_somos_t'] : '';
                            ?>
                            <textarea name="quienes_somos" id="quienes_somos" cols="30" rows="13" minlength="150" required><?php echo htmlspecialchars($quienesSomosT); ?></textarea>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="contenedor_datos_botones">
                        <button type="reset" class="btn_limpiar">Limpiar</button>
                        <button type="submit" class="btn_aceptar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
 
    <!-- Enlaces a scripts JavaScript -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js" defer></script>
    <script src="../js/datosTienda.js" defer></script>
    <script src="../js/ajaxInfoTienda.js" defer></script>
    <script src="../js/tooltip_dos.js" defer></script>

    <?php
        $conexion = null;
    ?>
</body>
</html>