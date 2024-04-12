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
    <link rel="stylesheet" href="../css/estilosTienda.css">
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

            <h1 class="titulo_secundario">EDITAR ESTILOS DE LA TIENDA</h1>

            <form action="../app/controllers/estilosTienda_controller.php" data-tipo="formulario2" method="POST" class="contenedor_datos formulario_ajax">
                <?php
                    $sql = "
                        SELECT * FROM tienda_virtual AS tv 
                        INNER JOIN idioma_tienda AS i ON tv.ID_idioma = i.ID_idioma 
                        WHERE ID_user = '$email';
                    ";
                    $consultaDatos = mysqli_query($conexion, $sql);
                    $datos = mysqli_fetch_array($consultaDatos);

                    $colorP = (!empty($datos['color_p'])) ? $datos['color_p'] : '#000000';
                    $colorS = (!empty($datos['color_s'])) ? $datos['color_s'] : '#000000';
                ?>

                <!-- Selectores de Color -->
                <div class="selectores_item">
                    <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                        <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                    </svg>
                    <div class="contenedor_tooltip" style="right: 40px;">
                        <div class="tooltip">
                            <p>
                                Añade un color para los títulos y subtítulos de tu Tienda Virtual.
                            </p>
                        </div>
                    </div>

                    <h2>Color Primario:</h2>
                    <div class="contenedor_selector">
                        <div class="contenedor_color-picker" style="background-color: <?php echo $colorP; ?>;">
                            <input type="color" name="color_picker" id="color_picker" value="<?php echo htmlspecialchars($colorP); ?>" required>
                        </div>
                        <span id="color_display" style="color: <?php echo $colorP; ?>;">Texto de Prueba</span>
                    </div>
                </div>

                <div class="selectores_item">
                    <svg class="tooltip_btn" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                        <path d="M478-240q21 0 35.5-14.5T528-290q0-21-14.5-35.5T478-340q-21 0-35.5 14.5T428-290q0 21 14.5 35.5T478-240Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342-618l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506-526q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                    </svg>
                    <div class="contenedor_tooltip" style="right: 40px;">
                        <div class="tooltip">
                            <p>
                                Añade un color para los detalles de tu Tienda Virtual.
                            </p>
                        </div>
                    </div>

                    <h2>Color Secundario:</h2>
                    <div class="contenedor_selector">
                        <div class="contenedor_color-picker" style="background-color: <?php echo $colorS; ?>;">
                            <input type="color" name="color_picker_dos" id="color_picker_dos" value="<?php echo htmlspecialchars($colorS); ?>" required>
                        </div>
                        <span id="color_display_dos" style="color: <?php echo $colorS; ?>;">Texto de Prueba</span>
                    </div>
                </div>

                <!-- Botones -->
                <div class="contenedor_datos_botones">
                    <button type="reset" class="btn_limpiar">Limpiar</button>
                    <button type="submit" class="btn_aceptar">Guardar</button>
                </div>
            </form>
        </div>
    </main>
 
    <!-- Enlaces a scripts JavaScript -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js" defer></script>
    <script src="../js/estilosTienda.js" defer></script>
    <script src="../js/ajaxEstilosTienda.js" defer></script>
    <script src="../js/tooltip.js" defer></script>

    <?php
        $conexion = null;
    ?>
</body>
</html>