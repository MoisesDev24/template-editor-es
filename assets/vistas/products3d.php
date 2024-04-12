<?php
session_start();

if (isset ($_SESSION["emailAccount"])) {
    $email = $_SESSION["emailAccount"];

    require_once __DIR__ . "/../app/config/main.php";

    $sql_usuarios = "SELECT * FROM wp_account WHERE account_correo = '$email';";
    $conexion_bd = conexion();
    $consulta_usuario = mysqli_query($conexion_bd, $sql_usuarios);

    if (!$consulta_usuario) {
        mostrarError("Error al consultar la base de datos.");
    }

    $nombreUsuario = mysqli_fetch_array($consulta_usuario);

    if (!$nombreUsuario) {
        mostrarError("Usuario no encontrado.");
    }

    $sql_productos = "SELECT * FROM render_product WHERE ID_user = '$email';";
    $consulta_productos = mysqli_query($conexion_bd, $sql_productos);

    if (!$consulta_productos) {
        mostrarError("Error al consultar la base de datos.");
    }

    $productos = [];

    while ($producto = mysqli_fetch_assoc($consulta_productos)) {
        $productos[] = $producto;
    }
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
    <meta name="description"
        content="En Kalstein France, ubicada en Paris – Francia, somos una empresa con gran experiencia en la fabricación y exportación de equipos para laboratorios de alta calidad, que tienen la honestidad, la responsabilidad y la comunicación como base en el desarrollo de cada uno de nuestros productos. ">
    <meta name="keywords" content="palabras clave, relevantes, para, el, sitio">
    <meta name="author" content="Kalstein Equipos para Laboratorios C.A.">
    <meta name="robots" content="index, follow">
    <meta name="copyright" content="Kalstein Equipos para Laboratorios C.A." />

    <!-- Titulo del sitio web -->
    <title>Editor - Tienda Virtual</title>

    <!-- Enlaces a hojas de estilo -->
    <link rel="stylesheet" href="../css/editorHeader.css">
    <link rel="stylesheet" href="../css/alerta.css">
    <link rel="stylesheet" href="../css/products3d.css">
    <link rel="stylesheet" href="../css/tooltip.css">

    <!-- Icono del sitio (favicon) -->
    <link rel="icon" href="../img/favicon/favicon.ico" type="image/x-icon">

    <!-- Etiquetas Open Graph para compartir en redes sociales (opcional) -->
    <meta property="og:title" content="Editor - Tienda Virtual">
    <meta property="og:description"
        content="En Kalstein France, ubicada en Paris – Francia, somos una empresa con gran experiencia en la fabricación y exportación de equipos para laboratorios de alta calidad, que tienen la honestidad, la responsabilidad y la comunicación como base en el desarrollo de cada uno de nuestros productos. ">
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
    include ("../includes/header_dos.php");
    ?>

    <main class="wrapper">
        <!-- MODAL DEL PERFIL -->
        <div class="modal_perfil_usuario">
            <a href="https://plataforma.kalstein.net/distribuidor/configuracion/">Perfil</a>
        </div>

        <?php
        include ("../includes/barra_lateral_dos.php");
        ?>

        <div class="contenido">
            <div class="resultado_formulario"></div>

            <h1 class="titulo_secundario">RENDERIZA TUS IMÁGENES EN 3D</h1>

            <div class="contenedor_datos">
                <div class="contenedor_products3d">
                    <div class="contenedor_parrafo">
                        <p>
                            A continuación, debe elegir cuáles de sus Productos quiere renderizar, para obtener un
                            Modelo 3D del mismo, y así poder visualizarlos en su Tienda:
                        </p>
                    </div>

                    <div class="contenedor_inputs_radio">
                        <label class="switch">
                            <input type="checkbox" id="checkboxUnico">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <!-- Individual upload form -->
                    <form action="../app/controllers/products3d_controller.php" data-tipo="formulario4" method="POST"
                        class="formulario_products3d formUploadSingle formulario_ajax sombra"
                        enctype="multipart/form-data" id="formUploadSingle" style="display:none;">
                        <!-- Form Header -->
                        <div class="form_header_container">
                            <h2 class="titulo_products3d">Elige el Producto que quieres Renderizar.</h2>
                            <span class="max_ten_products">Máx. 5 Productos</span>

                            <button type="button" class="btn_selec_img_ind myBtn">
                                Seleccionar
                            </button>
                        </div>

                        <div class="container_father" id="container_father">
                            <!-- Aqui se insertan los elementos desde JavaScript -->
                        </div>

                        <!-- Modal Images Select -->
                        <div id="myModal" style="display:none;">
                            <div class="contenedor_modal_products">
                                <div class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <span class="close">&times;</span>

                                        <div class="selects">
                                            <input type="search" name="searchP" id="searchP"
                                                placeholder="Buscar Imagen" />
                                        </div>

                                        <!-- Galery Products -->
                                        <div class="gallery-container">
                                            <?php
                                            require_once "../app/sql/sql_renderProducts.php";

                                            if (mysqli_num_rows($consulta_productsToRender) > 0) {
                                                $contador = 1;
                                                while ($renderProducts = mysqli_fetch_array($consulta_productsToRender)) {

                                                    echo '
                                                        <div class="gallery-item" id="renderProduct' . $contador . '">
                                                            <img src="' . $renderProducts["product_image"] . '" alt="' . $renderProducts["product_name_es"] . '">
                                                        </div>
                                                    ';

                                                    $contador++;
                                                }
                                            } else {
                                                echo '
                                                    <div class="gallery-item">
                                                        <img src="../img/banner-default.png" alt="Img Frame">
                                                    </div>
                                                ';
                                            }
                                            ?>
                                        </div>

                                        <button id="selectImageBtn">
                                            Seleccionar Imagen
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden file input -->
                        <input type="hidden" id="hiddenImageUrl" name="imageURL" required>
                        <input type="hidden" id="hiddenImageUrlTwo" name="imageURLTwo">
                        <input type="hidden" id="hiddenImageUrlThree" name="imageURLThree">
                        <input type="hidden" id="hiddenImageUrlFour" name="imageURLFour">
                        <input type="hidden" id="hiddenImageUrlFive" name="imageURLFive">

                        <!-- Buttoms -->
                        <div class="contenedor_datos_botones">
                            <button type="reset" class="btn_limpiar" id="btn_limpiar">Limpiar</button>
                            <button type="submit" class="btn_aceptar">Guardar</button>
                        </div>
                    </form>

                </div>
                <div class="sombra mt-2">
                    <div class="table100">
                        <h3 class="titulo-table">Productos en solicitud a ser renderizados</h3>
                        <table>
                            <thead>
                                <tr class="table100-head">
                                    <th class="column1">Imagen</th>
                                    <th class="column2">Fecha de solicitud</th>
                                    <th class="column3">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td class="column1">
                                        <img class="img_table" src="<?= htmlspecialchars($producto['image_url']) ?>"
                                            alt="Imagen de producto">
                                    </td>
                                    <td class="column2">
                                        <?= htmlspecialchars($producto['fecha_solicitud']) ?>
                                    </td>
                                    <td class="column3">
                                        <?= htmlspecialchars($producto['estado']) ?>
                                        <?php if ($producto['estado'] === 'Renderizado'): ?>
                                            <a href="<?= htmlspecialchars($producto['resultado_renderP']) ?>" download class="btn_download_model">
                                                <i class="fas fa-download dwl-icon"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- Enlaces a scripts JavaScript -->
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js" defer></script>
    <script src="../js/products3d.js" defer></script>
    <script src="../js/ajaxProducts3d.js" defer></script>
    <script src="../js/tooltip.js" defer></script>

    <?php
    $conexion = null;
    ?>
</body>

</html>