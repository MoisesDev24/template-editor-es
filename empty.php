<?php
    /*
    Template Name: Empty Template
    */
    require '/home/he270716/public_html/plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/conexion.php';

    $esquema = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';

    $host = $_SERVER['HTTP_HOST'];

    $uri = $_SERVER['REQUEST_URI'];

    $fullUrl = $esquema . '://' . $host . $uri;

    $sql = "SELECT ID_user FROM tienda_virtual WHERE ID_slug = '$fullUrl'";
    $result = $conexion->query($sql);
    $rowShop = mysqli_fetch_array($result);
    $emailShop = $rowShop['ID_user'] ?? NULL;
?>

<?php
    require_once "/home/he270716/public_html/plataforma.kalstein.net/template-editor/assets/app/config/main.php";
    include ("/home/he270716/public_html/plataforma.kalstein.net/template-editor/assets/app/sql/sql_datosPlantilla.php");
?>

<?php
    if (isset($datos_plantilla['nombre_idioma']) && !empty($datos_plantilla['nombre_idioma'])) {
        $idioma_t = $datos_plantilla['nombre_idioma'];
    } else {
        $idioma_t = "en";
    }

    if (isset($datos_plantilla['descripcion']) && !empty($datos_plantilla['descripcion'])) {
        $descripcion_t = $datos_plantilla['descripcion'];
    } else {
        $descripcion_t = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus reiciendis aspernatur eaque fuga, obcaecati laboriosam laudantium. Accusamus illum, sed asperiores eum libero cupiditate perferendis, dolorum, natus quis laborum culpa nam.";
    }

    if (isset($datos_plantilla['color_p']) && !empty($datos_plantilla['color_p'])) {
        $color_p = $datos_plantilla['color_p'];
    }

    if (isset($datos_plantilla['color_s']) && !empty($datos_plantilla['color_s'])) {
        $color_s = $datos_plantilla['color_s'];
    }
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma_t; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Virtual</title>
    <meta name="description" content="<?php echo $descripcion_t; ?>">
    <meta name="robots" content="index, follow">

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://plataforma.kalstein.net/template-editor/assets/css/plantilla/estilos.css">
    <link rel="stylesheet" href="https://plataforma.kalstein.net/template-editor/assets/css/plantilla/productos.css">
    <link rel="stylesheet" href="https://plataforma.kalstein.net/template-editor/assets/css/plantilla/nosotros.css">

    <!-- Icono del sitio (favicon) -->
    <link rel="icon" href="https://plataforma.kalstein.net/template-editor/assets/img/favicon/favicon.ico"
        type="image/x-icon">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/65a728a07e.js" crossorigin="anonymous"></script>

    <!-- Script de Model Viewer -->
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <?php
        $fondoP = isset($color_p) && $color_p != "" ? $color_p : 'var(--color-primario)';
        $colorP = isset($color_p) && $color_p != "" ? $color_p : 'var(--color-primario)';
        $bordeP = isset($color_p) && $color_p != "" ? $color_p : 'var(--color-primario)';
        $fillP = isset($color_p) && $color_p != "" ? $color_p : 'var(--color-primario)';

        $colorNegro = isset($color_p) && $color_p != "" ? $color_p : 'var(--color-neutro)';

        $fondoS = isset($color_s) && $color_s != "" ? $color_s : 'var(--color-primario)';
        $colorS = isset($color_s) && $color_s != "" ? $color_s : 'var(--color-primario)';
        $bordeS = isset($color_s) && $color_s != "" ? $color_s : 'var(--color-primario)';
        $fillS = isset($color_s) && $color_s != "" ? $color_s : 'var(--color-primario)';
    ?>

    <!-- Estilos de la vista principal -->
    <style>
        .titulo_principal {
            color:
                <?php echo $colorP; ?>
            ;
            text-shadow: 1px 2px 1px var(--color-neutro);
        }

        .titulo_extra {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .btn_welcome {
            border: 2px solid
                <?php echo $colorP; ?>
            ;
            color:
                <?php echo $colorP; ?>
            ;
        }

        .btn_welcome:hover {
            background-color:
                <?php echo $fondoP; ?>
            ;
        }

        .btn_welcome>svg {
            fill:
                <?php echo $fillP; ?>
            ;
        }

        .navbar_item>a {
            color:
                <?php echo $colorNegro; ?>
            ;
        }

        .navbar_item>a:hover {
            background-color:
                <?php echo $colorNegro; ?>
            ;
        }

        .navbar_btn>svg:hover {
            fill:
                <?php echo $fillS; ?>
            ;
        }

        .modal_dropdown {
            background-color:
                <?php echo $fondoP; ?>
            ;
        }

        .prev:hover>svg {
            fill:
                <?php echo $fillP; ?>
            ;
        }

        .next:hover>svg {
            fill:
                <?php echo $fillP; ?>
            ;
        }

        .nav_button.active {
            background-color:
                <?php echo $fondoP; ?>
            ;
        }

        .item_informacion>a {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .item_informacion>a>h2 {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .item_informacion>h2 {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .btn_agg_prod {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .btn_agg_prod>h2 {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .item_informacion_individual>div>h2 {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .boton_ver_mas {
            background-color:
                <?php echo $fondoS; ?>
            ;
        }

        .boton_ver_mas:hover {
            border-color:
                <?php echo $bordeS; ?>
            ;
            color:
                <?php echo $colorS; ?>
            ;
        }

        .boton_ver_mas:hover>svg {
            fill:
                <?php echo $fillS; ?>
            ;
        }

        .precio_producto {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .img_individual_enlace {
            border-color:
                <?php echo $bordeS; ?>
            ;
            color:
                <?php echo $colorS; ?>
            ;
        }

        .img_individual_enlace:hover {
            background-color:
                <?php echo $fondoS; ?>
            ;
        }

        .contenedor_img_individual {
            box-shadow: 1px 1px 5px #000000;
        }

        .fondo_titulo {
            background-color:
                <?php echo $fondoP; ?>
            ;
        }

        .arrow_up {
            background-color:
                <?php echo $fondoP; ?>
            ;
        }
    </style>

    <!-- Estilos de la vista de "Productos" -->
    <style>
        .contenedor_form_buscador {
            background:
                <?php echo $fondoP; ?>
            ;
        }

        .form_buscador:hover,
        .form_buscador:valid {
            border: 1px solid
                <?php echo $colorP; ?>
            ;
        }

        #clear-btn:hover>svg {
            fill:
                <?php echo $colorP; ?>
            ;
        }

        .producto_datos>h2 {
            color:
                <?php echo $colorS; ?>
            ;
        }

        .btn_detalles {
            background-color:
                <?php echo $fondoS; ?>
            ;
        }

        .btn_detalles:hover {
            border: 1px solid
                <?php echo $bordeS; ?>
            ;
            color:
                <?php echo $colorS; ?>
            ;
        }

        .btn_detalles:hover>svg {
            fill:
                <?php echo $fillS; ?>
            ;
        }

        .btn_render_product {
            border: 2px solid
                <?php echo $bordeS; ?>
            ;
            background-color:
                <?php echo $fondoS; ?>
            ;
        }

        .btn_render_product:hover {
            border: 2px solid
                <?php echo $bordeS; ?>
            ;
            color:
                <?php echo $colorS; ?>
            ;
        }

        .cerrar_detalles {
            fill:
                <?php echo $fillS; ?>
            ;
        }

        .leftArrow {
            fill:
                <?php echo $fillS; ?>
            ;
        }

        .rightArrow {
            fill:
                <?php echo $fillS; ?>
            ;
        }

        .modal_detalles_info>h2 {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .modal_detalles_info>h3 {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .modal_detalles_info>h4 {
            color:
                <?php echo $colorP; ?>
            ;
        }
    </style>

    <!-- Estilos de la vista de "Nosotros" -->
    <style>
        .titulo_principal {
            color:
                <?php echo $colorP; ?>
            ;
        }

        .historia_datos>h2 {
            color:
                <?php echo $colorS; ?>
            ;
        }

        .mision_datos>h2 {
            color:
                <?php echo $colorS; ?>
            ;
        }

        .vision_datos>h2 {
            color:
                <?php echo $colorS; ?>
            ;
        }
    </style>

    <!-- Estilos del Model Viewer -->
    <style>
        model-viewer {
            display: flex;
            overflow: hidden;
            position: relative;
            user-select: none;
            height: 100%;
            width: 100%;
            --mv-environment-image: neutral;
            --mv-exposure: 1;
            /* Ajustar si es necesario para controlar la exposición */
            /* background-image: url("../img/LogoActualizado2.png");
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat; */
        }

        .item_doble_img_render {
            width: 100%;
            height: 400px;
            min-height: 390px;
            max-height: 400px;
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <div id="seccion_inicial">
        <header class="cabecera">
            <nav class="navbar" id="navbar">
                <div class="navbar_contenedor_uno">
                    <?php
                    if (!empty($datos_plantilla['logo_t'])) {
                        echo '
                                <a href="#" class="btn_inicio">
                                    <figure class="navbar_img">
                                        <img src="' . $datos_plantilla["logo_t"] . '" alt="logo_empresa">
                                    </figure>
                                </a>
                            ';
                    } else {
                        echo '
                                <figure class="navbar_img">
                                    <img src="https://plataforma.kalstein.net/template-editor/assets/img/logo-default-2.png" alt="logo_empresa">
                                </figure>
                            ';
                    }
                    ?>
                </div>

                <div class="navbar_contenedor_dos">
                    <ul class="navbar_lista">
                        <li class="navbar_item"><a href="#" class="btn_inicio"><span>Tienda</span></a></li>
                        <li class="navbar_item"><a href="#" class="btn_productos"><span>Productos</span></a></li>
                    </ul>
                </div>

                <div class="contenedor_navbar_btn">
                    <button class="navbar_btn" id="boton_menu">
                        <svg xmlns="http://www.w3.org/2000/svg" height="35" width="35" viewBox="0 0 448 512">
                            <path
                                d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                        </svg>
                    </button>
                </div>

                <div class="modal_dropdown">
                    <div class="dropdown">
                        <ul class="dropdown_lista">
                            <li class="navbar_item_drop"><a href="#" class="btn_inicio"><span>Tienda</span></a></li>
                            <li class="navbar_item_drop"><a href="#" class="btn_productos"><span>Productos</span></a>
                            </li>
                        </ul>
                    </div>
                    <svg class="btn_cerrar_menu" xmlns="http://www.w3.org/2000/svg" height="35" width="35"
                        viewBox="0 0 384 512">
                        <path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                    </svg>
                </div>
            </nav>

            <!-- Buscador de los Productos -->
            <div class="contenedor_form_buscador">
                <form action="" method="GET" class="form_buscador formulario_ajax">
                    <input type="search" name="buscador"
                        placeholder="Busca por referencia, catalogo, producto, palabra clave o marca..."
                        class="buscador_input" required>
                    <i class="fa fa-search"></i>
                    <a href="javascript:void(0)" class="clear-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 384 512">
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </a>
                </form>

                <!-- Nuevo contenedor para el modal de resultados -->
                <div id="resultados-busqueda" class="resultados-busqueda"></div>
            </div>

            <div class="banner">
                <figure class="banner_img">
                    <?php
                    if (!empty($datos_plantilla['banner_t'])) {
                        echo '
                                <h1 class="titulo_principal" style="color: ' . (isset($color_p) ? $color_p : 'var(--color-primario)') . ';">
                                    ' . $datos_plantilla['titulo_t'] . '
                                </h1>
                                <img src="' . $datos_plantilla["banner_t"] . '" alt="Banner">
                                <div class="contenedor_btn_welcome">
                                    <a href="#marcador_productos" class="btn_welcome">
                                        <span>Ver Productos</span>
                                    </a>
                                </div>
                            ';
                    } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                        echo '
                                <h1 class="titulo_principal" style="color: ' . (isset($color_p) ? $color_p : 'var(--color-primario)') . ';">
                                    Título de la Tienda
                                </h1>
                                <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-2.png" alt="Banner">
                                <div class="contenedor_btn_welcome">
                                    <a href="#marcador_productos" class="btn_welcome">
                                        <span>Ver Productos</span>
                                    </a>
                                </div>
                            ';
                    } else {
                        echo '
                                <h1 class="titulo_principal" style="color: ' . (isset($color_p) ? $color_p : 'var(--color-primario)') . ';">
                                    Título de la Tienda
                                </h1>
                                <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-2.png" alt="Banner">
                                <div class="contenedor_btn_welcome">
                                    <a href="#marcador_productos" class="btn_welcome">
                                        <span>Ver Productos</span>
                                    </a>
                                </div>
                            ';
                    }
                    ?>
                </figure>
            </div>
        </header>

        <main class="contenedor_principal">
            <!-- Icono informacion -->
            <div class="arrow_paragraph">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 448 512">
                    <path
                        d="M246.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-160-160c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L224 402.7 361.4 265.4c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-160 160zm160-352l-160 160c-12.5 12.5-32.8 12.5-45.3 0l-160-160c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L224 210.7 361.4 73.4c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3z">
                    </path>
                </svg>
                <span>INFORMACIÓN</span>
            </div>

            <!-- Contenedor de la Descripcion -->
            <?php
                if (isset($datos_plantilla['titulo_t']) && !empty($datos_plantilla['titulo_t'])) {
                    echo '
                            <p class="descripcion_corta">
                                ' . $descripcion_t . '
                            </p>
                        ';
                } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                    echo '
                            <h1 class="titulo_extra" style="color: ' . (isset($color_p) ? $color_p : 'var(--color-primario)') . ';">
                                Descripción corta de la Tienda
                            </h1>
                            <p class="descripcion_corta">
                                ' . $descripcion_t . '
                            </p>
                        ';
                } else {
                    echo '
                            <h1 class="titulo_extra" style="color: ' . (isset($color_p) ? $color_p : 'var(--color-primario)') . ';">
                                Descripción corta de la Tienda
                            </h1>
                            <p class="descripcion_corta">
                                ' . $descripcion_t . '
                            </p>
                        ';
                }
            ?>

            <!-- Subtitulo de Conoce nuestros Productos -->
            <h2 class="titulo_secundario" id="marcador_productos">
                ¡Conoce nuestros <strong
                    style="color: <?php if (isset($color_p)) {
                        echo $color_p;
                    } else {
                        echo 'var(--color-primario)';
                    } ?>;">Productos</strong>!
            </h2>

            <!-- Item 1 -->
            <div class="contenedor_item_doble">
                <?php
                    if (mysqli_num_rows($consulta_productos_limit) > 0) {
                        while ($datos_producto_limit = mysqli_fetch_array($consulta_productos_limit)) {
                            echo '
                                    <div class="item_doble elementoScroll">
                                        <a href="#" class="item_doble_enlace btn_productos">
                                            <figure class="item_doble_img">
                                                <img src="' . $datos_producto_limit["product_image"] . '" alt="' . $datos_producto_limit["product_name_es"] . '">
                                            </figure>
                                        </a>

                                    <div class="item_informacion">
                                ';

                            // Truncar el nombre del producto a las primeras 4 palabras
                            $nombre_producto = $datos_producto_limit["product_name_es"];
                            $palabras_producto = explode(' ', $nombre_producto);
                            if (count($palabras_producto) > 4) {
                                $nombre_producto_corto = implode(' ', array_slice($palabras_producto, 0, 4)) . '...';
                            } else {
                                $nombre_producto_corto = $nombre_producto;
                            }
                            echo '<h2>' . $nombre_producto_corto . '</h2>';

                            // Obtener la descripcion y truncarla si excede el limite de caracteres
                            $descripcion = $datos_producto_limit["product_description_es"];
                            $limite_caracteres = 190;
                            if (strlen($descripcion) > $limite_caracteres) {
                                $descripcion_truncada = substr($descripcion, 0, $limite_caracteres);
                                // Encuentra el ultimo espacio dentro del limite de caracteres para evitar cortar palabras
                                $ultimo_espacio = strrpos($descripcion_truncada, ' ');
                                $descripcion_truncada = substr($descripcion_truncada, 0, $ultimo_espacio) . '...';
                                echo '<p>' . $descripcion_truncada . '</p>';
                            } else {
                                echo '<p>' . $descripcion . '</p>';
                            }

                            echo '
                                        <div class="separador_boton_precio">
                                                <a href="#" class="boton_ver_mas btn_productos">
                                                    Ver más
                                                    <svg class="icono_ver_mas" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                                        <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                                    </svg>
                                                </a>
                                                <span class="precio_producto">$' . $datos_producto_limit["product_priceUSD"] . '</span>
                                            </div>
                                        </div>
                                    </div>
                                ';
                        }
                    } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                        echo '
                                <div class="item_doble elementoScroll">
                                    <a href="#" class="item_doble_enlace btn_productos">
                                        <figure class="item_doble_img">
                                            <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="item">
                                        </figure>
                                    </a>
                
                                    <div class="item_informacion">
                                        <h2>Producto 1</h2>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore dolore accusamus esse itaque amet, aperiam quis delectus ut ipsum, officiis earum nobis adipisci, illum quas? Rem quis nemo eos hic.</p>
                                        <div class="separador_boton_precio">
                                            <a href="#" class="boton_ver_mas btn_productos">
                                                Ver más
                                                <svg class="icono_ver_mas" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                                    <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                                </svg>
                                            </a>
                                            <span class="precio_producto">$599,99</span>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="item_doble elementoScroll">
                                    <a href="#" class="item_doble_enlace btn_productos">
                                        <figure class="item_doble_img">
                                            <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="item">
                                        </figure>
                                    </a>
                
                                    <div class="item_informacion">
                                        <h2>Producto 2</h2>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore dolore accusamus esse itaque amet, aperiam quis delectus ut ipsum, officiis earum nobis adipisci, illum quas? Rem quis nemo eos hic.</p>
                                        <div class="separador_boton_precio">
                                            <a href="#" class="boton_ver_mas btn_productos">
                                                Ver más
                                                <svg class="icono_ver_mas" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                                    <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                                </svg>
                                            </a>
                                            <span class="precio_producto">$19,99</span>
                                        </div>
                                    </div>
                                </div>
                            ';
                    }
                ?>
            </div>

            <!-- Item 2 -->
            <div class="contenedor_item_individual">
                <?php
                    if (mysqli_num_rows($consulta_prod_indiv) > 0) {
                        while ($datos_prod_indiv = mysqli_fetch_array($consulta_prod_indiv)) {
                            $parrafos_descripcion_cuatro = explode("\n", $datos_prod_indiv["product_description_es"]);

                            echo '
                                    <div class="item_individual elementoScroll">
                                        <div class="item_informacion_individual">
                                            <div>
                                                <h2>' . $datos_prod_indiv["product_name_es"] . '</h2>';

                            $contador_parrafos = 0;
                            foreach ($parrafos_descripcion_cuatro as $parrafo_cuatro) {
                                echo '<p>' . $parrafo_cuatro . '</p>';
                                $contador_parrafos++;

                                if ($contador_parrafos == 2) {
                                    break;
                                }
                            }

                            echo '
                                            </div>
                                            <div class="separador_boton_precio">
                                                <a href="#" class="boton_ver_mas btn_productos">
                                                    Ver más
                                                    <svg class="icono_ver_mas" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                                        <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                                    </svg>
                                                </a>
                                                <span class="precio_producto">$' . $datos_prod_indiv["product_priceUSD"] . '</span>
                                            </div>
                                        </div>
                    
                                        <a href="#" class="item_individual_enlace btn_productos">
                                            <figure class="item_individual_img">
                                                <img src="' . $datos_prod_indiv["product_image"] . '" alt="' . $datos_prod_indiv["product_name_es"] . '">
                                            </figure>
                                        </a>
                                    </div>
                                ';
                        }
                    } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                        echo '
                                <div class="item_individual elementoScroll">
                                    <div class="item_informacion_individual">
                                        <div>
                                            <h2>Producto 3</h2>
                                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore dolore accusamus esse itaque amet, aperiam quis delectus ut ipsum, officiis earum nobis adipisci, illum quas? Rem quis nemo eos hic.</p>
                                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore dolore accusamus esse itaque amet, aperiam quis delectus ut ipsum, officiis earum nobis adipisci, illum quas? Rem quis nemo eos hic.</p>
                                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore dolore accusamus esse itaque amet, aperiam quis delectus ut ipsum, officiis earum nobis adipisci, illum quas? Rem quis nemo eos hic.</p>
                                        </div>
                                        <div class="separador_boton_precio">
                                            <a href="#" class="boton_ver_mas btn_productos">
                                                Ver más
                                                <svg class="icono_ver_mas" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                                    <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                                </svg>
                                            </a>
                                            <span class="precio_producto">$100,99</span>
                                        </div>
                                    </div>
                
                                    <a href="#" class="item_individual_enlace">
                                        <figure class="item_individual_img">
                                            <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="item">
                                        </figure>
                                    </a>
                                </div>
                            ';
                    }
                ?>
            </div>

            <!-- Item 3 -->
            <div class="contenedor_item_doble">
                <?php
                    function acortarNombre($nombre, $limitePalabras = 4)
                    {
                        $palabras = explode(' ', $nombre);
                        if (count($palabras) > $limitePalabras) {
                            return implode(' ', array_slice($palabras, 0, $limitePalabras)) . '...';
                        } else {
                            return $nombre;
                        }
                    }

                    if (mysqli_num_rows($consulta_prod_limit) > 0) {
                        while ($datos_prod_limit = mysqli_fetch_array($consulta_prod_limit)) {
                            echo '
                                    <div class="item_doble elementoScroll">
                                        <a href="#" class="item_doble_enlace btn_productos">
                                            <figure class="item_doble_img">
                                                <img src="' . $datos_prod_limit["product_image"] . '" alt="' . $datos_prod_limit["product_name_es"] . '">
                                            </figure>
                                        </a>
                        
                                        <div class="item_informacion">
                                            <h2>' . acortarNombre($datos_prod_limit["product_name_es"]) . '</h2>';

                            // Obtener la descripcion y truncarla si excede el limite de caracteres
                            $descripcionDos = $datos_prod_limit["product_description_es"];
                            $limite_caracteres = 190;
                            if (strlen($descripcionDos) > $limite_caracteres) {
                                $descripcionDos_truncada = substr($descripcionDos, 0, $limite_caracteres);
                                // Encuentra el ultimo espacio dentro del limite de caracteres para evitar cortar palabras
                                $ultimo_espacioDos = strrpos($descripcionDos_truncada, ' ');
                                $descripcionDos_truncada = substr($descripcionDos_truncada, 0, $ultimo_espacioDos) . '...';
                                echo '<p>' . $descripcionDos_truncada . '</p>';
                            } else {
                                echo '<p>' . $descripcionDos . '</p>';
                            }

                            echo '
                                            <div class="separador_boton_precio">
                                                <a href="#" class="boton_ver_mas btn_productos">
                                                    Ver más
                                                    <svg class="icono_ver_mas" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                                        <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                                    </svg>
                                                </a>
                                                <span class="precio_producto">$' . $datos_prod_limit["product_priceUSD"] . '</span>
                                            </div>
                                        </div>
                                    </div>
                                ';
                        }
                    }
                ?>
            </div>

            <!-- Boton para subir el Scroll -->
            <a href="#navbar" class="arrow_up">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 512 512">
                    <path
                        d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM135.1 217.4c-4.5 4.2-7.1 10.1-7.1 16.3c0 12.3 10 22.3 22.3 22.3H208v96c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V256h57.7c12.3 0 22.3-10 22.3-22.3c0-6.2-2.6-12.1-7.1-16.3L269.8 117.5c-3.8-3.5-8.7-5.5-13.8-5.5s-10.1 2-13.8 5.5L135.1 217.4z" />
                </svg>
            </a>

            <!-- Subtitulo del Carrusel -->
            <h2 class="titulo_secundario">
                Carrusel de <strong
                    style="color: <?php if (isset($color_p)) {
                        echo $color_p;
                    } else {
                        echo 'var(--color-primario)';
                    } ?>;">Productos</strong>
            </h2>

            <!-- Carrusel de los Productos -->
            <div class="carousel">
                <div class="carousel_wrapper">
                    <?php
                    if (mysqli_num_rows($consulta_productos_img) > 0) {
                        $contador_carrusel = 1;
                        while ($datos_producto_img = mysqli_fetch_array($consulta_productos_img)) {
                            echo '
                                    <a href="#" class="carousel_contenedor_imagen btn_productos">
                                        <figure>
                                            <img src="' . $datos_producto_img["product_image"] . '" alt="Producto ' . $contador_carrusel . '">
                                        </figure>
                                    </a>
                                ';

                            $contador_carrusel++;
                        }
                    } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                        echo '
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 1">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 2">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 3">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 4">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 5">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 6">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 7">
                                    </figure>
                                </a>
                            ';
                    } else {
                        echo '
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 1">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 2">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 3">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 4">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 5">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 6">
                                    </figure>
                                </a>
            
                                <a href="#" class="carousel_contenedor_imagen btn_productos">
                                    <figure>
                                        <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="Producto 7">
                                    </figure>
                                </a>
                            ';
                    }
                    ?>
                </div>

                <?php
                if (mysqli_num_rows($consulta_productos_img) > 0) {
                    $num_imagenes = mysqli_num_rows($consulta_productos_img);
                    echo '<div class="navigation_buttons">';
                    for ($i = 0; $i < $num_imagenes; $i++) {
                        echo '<div class="nav_button" data-index="' . $i . '"></div>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="navigation_buttons">';
                    for ($i = 0; $i < 7; $i++) {
                        echo '<div class="nav_button" data-index="' . $i . '"></div>';
                    }
                    echo '</div>';
                }
                ?>

                <button class="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 320 512">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>
                </button>
                <button class="next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 320 512">
                        <path
                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg>
                </button>
            </div>

            <!-- Subtitulo de la Tienda -->
            <h2 class="titulo_secundario fondo_titulo">
                <?php
                if (isset($datos_plantilla['subtitulo_t']) && !empty($datos_plantilla['subtitulo_t'])) {
                    echo $datos_plantilla['subtitulo_t'];
                } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                    echo '¡Título Secundario de tu Tienda!';
                } else {
                    echo '¡Título Secundario de tu Tienda!';
                }
                ?>
            </h2>

            <!-- Items extras -->
            <div class="contenedor_img_individuales elementoScrollDos">
                <?php
                if (mysqli_num_rows($consulta_productos_img_dos) > 0) {
                    while ($datos_prod_img = mysqli_fetch_array($consulta_productos_img_dos)) {
                        echo '
                                <div class="contenedor_img_individual">
                                    <figure class="img_individual">
                                        <img src="' . $datos_prod_img["product_image"] . '" alt="Productos extras">
                                    </figure>
                                    <a href="#" class="img_individual_enlace btn_productos">
                                        Ver más
                                        <svg class="icono_ver_mas-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                            <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                        </svg>
                                    </a>
                                </div>
                            ';
                    }
                } else {
                    echo '
                            <!-- Item 4 -->
                            <div class="contenedor_img_individual">
                                <figure class="img_individual">
                                    <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="banner two">
                                </figure>
                                <a href="#" class="img_individual_enlace btn_productos">
                                    Ver más
                                    <svg class="icono_ver_mas-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                        <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                    </svg>
                                </a>
                            </div>
            
                            <!-- Item 5 -->
                            <div class="contenedor_img_individual">
                                <figure class="img_individual">
                                    <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="banner three">
                                </figure>
                                <a href="#" class="img_individual_enlace btn_productos">
                                    Ver más
                                    <svg class="icono_ver_mas-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                        <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                    </svg>
                                </a>
                            </div>
            
                            <!-- Item 6 -->
                            <div class="contenedor_img_individual">
                                <figure class="img_individual">
                                    <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="banner two">
                                </figure>
                                <a href="#" class="img_individual_enlace btn_productos">
                                    Ver más
                                    <svg class="icono_ver_mas-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                        <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                    </svg>
                                </a>
                            </div>
                        ';
                }
                ?>
            </div>

            <!-- Contenedor de la informacion de la Empresa -->
            <div class="contenedor_info">
                <h2 class="titulo_secundario">
                    Información de la <strong
                        style="color: <?php if (isset($color_p)) {
                            echo $color_p;
                        } else {
                            echo 'var(--color-primario)';
                        } ?>;">Empresa</strong>
                </h2>

                <div class="historia elementoScroll">
                    <?php
                    if (isset($datos_plantilla['quienes_somos_t']) && !empty($datos_plantilla['quienes_somos_t'])) {
                        echo '
                                <div class="historia_datos">
                                    <h2>¿Quiénes Somos?</h2>
                                    <p>' . $datos_plantilla['quienes_somos_t'] . '</p>
                                </div>
                            ';
                    } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                        echo '
                                <div class="historia_datos">
                                    <h2>¿Quiénes Somos?</h2>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus reiciendis aspernatur eaque fuga, obcaecati laboriosam laudantium. Accusamus illum, sed asperiores eum libero cupiditate perferendis, dolorum, natus quis laborum culpa nam.
                                    </p>
                                </div>
                            ';
                    } else {
                        echo '
                                <div class="historia_datos">
                                    <h2>¿Quiénes Somos?</h2>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus reiciendis aspernatur eaque fuga, obcaecati laboriosam laudantium. Accusamus illum, sed asperiores eum libero cupiditate perferendis, dolorum, natus quis laborum culpa nam.
                                    </p>
                                </div>
                            ';
                    }
                    ?>
                    <figure class="historia_img">
                        <?php
                        if (!empty($datos_plantilla['img_quienes_s'])) {
                            echo '<img src="' . $datos_plantilla["img_quienes_s"] . '" alt="imagen-identidad-empresa">';
                        } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                            echo '
                                    <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="imagen_empresa">
                                    
                                ';
                        } else {
                            echo '<img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="imagen_empresa">';
                        }
                        ?>
                    </figure>
                </div>

                <div class="mision elementoScroll">
                    <?php
                    if (isset($datos_plantilla['mision']) && !empty($datos_plantilla['mision'])) {
                        echo '
                                <div class="mision_datos">
                                    <h2>Nuestra Misión Empresarial</h2>
                                    <p>' . $datos_plantilla['mision'] . '</p>
                                </div>
                            ';
                    } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                        echo '
                                <div class="mision_datos">
                                    <h2>Nuestra Misión Empresarial</h2>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus reiciendis aspernatur eaque fuga, obcaecati laboriosam laudantium. Accusamus illum, sed asperiores eum libero cupiditate perferendis, dolorum, natus quis laborum culpa nam.
                                    </p>
                                </div>
                            ';
                    } else {
                        echo '
                                <div class="mision_datos">
                                    <h2>Nuestra Misión Empresarial</h2>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus reiciendis aspernatur eaque fuga, obcaecati laboriosam laudantium. Accusamus illum, sed asperiores eum libero cupiditate perferendis, dolorum, natus quis laborum culpa nam.
                                    </p>
                                </div>
                            ';
                    }
                    ?>
                    <figure class="mision_img">
                        <?php
                        if (!empty($datos_plantilla['img_mision'])) {
                            echo '<img src="' . $datos_plantilla["img_mision"] . '" alt="imagen-mision-empresa">';
                        } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                            echo '
                                    <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="imagen_empresa">
                                ';
                        } else {
                            echo '<img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="imagen_empresa">';
                        }
                        ?>
                    </figure>
                </div>

                <div class="vision elementoScroll">
                    <?php
                    if (isset($datos_plantilla['vision']) && !empty($datos_plantilla['vision'])) {
                        echo '
                                <div class="vision_datos">
                                    <h2>Nuestra Visión Empresarial</h2>
                                    <p>' . $datos_plantilla['vision'] . '</p>
                                </div>
                            ';
                    } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                        echo '
                                <div class="vision_datos">
                                    <h2>Nuestra Visión Empresarial</h2>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus reiciendis aspernatur eaque fuga, obcaecati laboriosam laudantium. Accusamus illum, sed asperiores eum libero cupiditate perferendis, dolorum, natus quis laborum culpa nam.
                                    </p>
                                </div>
                            ';
                    } else {
                        echo '
                                <div class="vision_datos">
                                    <h2>Nuestra Visión Empresarial</h2>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus reiciendis aspernatur eaque fuga, obcaecati laboriosam laudantium. Accusamus illum, sed asperiores eum libero cupiditate perferendis, dolorum, natus quis laborum culpa nam.
                                    </p>
                                </div>
                            ';
                    }
                    ?>
                    <figure class="vision_img">
                        <?php
                        if (!empty($datos_plantilla['img_vision'])) {
                            echo '<img src="' . $datos_plantilla["img_vision"] . '" alt="imagen-vision-empresa">';
                        } elseif ($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                            echo '
                                    <img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="imagen_empresa">
                                ';
                        } else {
                            echo '<img src="https://plataforma.kalstein.net/template-editor/assets/img/banner-default.png" alt="imagen_empresa">';
                        }
                        ?>
                    </figure>
                </div>
            </div>

            <?php
            // Verifica si el parametro show_button esta presente en la URL
            $showButton = isset($_GET['show_button']) && $_GET['show_button'] === 'true';

            // Si el parametro esta presente, muestra el boton
            if ($showButton) {
                echo '
                        <a href="../../dashboard.php" class="btn_dashboard">
                            <span>Volver al Editor</span>
                        </a>

                        <a href="../../dashboard.php" class="btn_dashboard_dos">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25" viewBox="0 0 640 512">
                                <path d="M36.8 192H603.2c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0H121.7c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224V384v80c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V384 224H320V384H128V224H64zm448 0V480c0 17.7 14.3 32 32 32s32-14.3 32-32V224H512z"/>
                            </svg>
                        </a>
                    ';
            }
            ?>
        </main>
    </div>

    <div id="seccion_productos">
        <header class="cabecera cabecera_extra">
            <nav class="navbar">
                <div class="navbar_contenedor_uno">
                    <?php
                    if (!empty($datos_plantilla['logo_t'])) {
                        echo '
                                <a href="#" class="btn_inicio">
                                    <figure class="navbar_img">
                                        <img src="' . $datos_plantilla["logo_t"] . '" alt="logo_empresa">
                                    </figure>
                                </a>
                            ';
                    } else {
                        echo '
                                <figure class="navbar_img">
                                    <img src="https://plataforma.kalstein.net/template-editor/assets/img/logo-default-2.png" alt="logo_empresa">
                                </figure>
                            ';
                    }
                    ?>
                </div>

                <div class="navbar_contenedor_dos">
                    <ul class="navbar_lista">
                        <li class="navbar_item"><a href="#" class="btn_inicio"><span>Tienda</span></a></li>
                        <li class="navbar_item"><a href="#" class="btn_productos"><span>Productos</span></a></li>
                    </ul>
                </div>

                <div class="contenedor_navbar_btn">
                    <button class="navbar_btn" id="boton_menu">
                        <svg xmlns="http://www.w3.org/2000/svg" height="35" width="35" viewBox="0 0 448 512">
                            <path
                                d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                        </svg>
                    </button>
                </div>

                <div class="modal_dropdown">
                    <div class="dropdown">
                        <ul class="dropdown_lista">
                            <li class="navbar_item_drop"><a href="#" class="btn_inicio"><span>Tienda</span></a></li>
                            <li class="navbar_item_drop"><a href="#" class="btn_productos"><span>Productos</span></a>
                            </li>
                        </ul>
                    </div>
                    <svg class="btn_cerrar_menu" xmlns="http://www.w3.org/2000/svg" height="35" width="35"
                        viewBox="0 0 384 512">
                        <path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                    </svg>
                </div>
            </nav>

            <!-- Buscador de los Productos -->
            <div class="contenedor_form_buscador">
                <form action="" method="GET" class="form_buscador formulario_ajax">
                    <input type="search" name="buscador"
                        placeholder="Busca por referencia, catalogo, producto, palabra clave o marca..."
                        class="buscador_input" required>
                    <i class="fa fa-search"></i>
                    <a href="javascript:void(0)" class="clear-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 384 512">
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </a>
                </form>

                <!-- Nuevo contenedor para el modal de resultados -->
                <div id="resultados-busqueda" class="resultados-busqueda"></div>
            </div>
        </header>

        <div class="contenedor_patron_css">
            <main class="contenedor_principal">
                <h1 class="titulo_extra">PRODUCTOS</h1>

                <!-- Listado de los Productos -->
                <div class="grid-container">
                    <?php
                    if (mysqli_num_rows($consulta_render_products) > 0) {
                        while ($datos_producto = mysqli_fetch_array($consulta_render_products)) {
                            $parrafos_descripcion_dos = explode("\n", $datos_producto["product_description_es"]);
                            $titulo_original = $datos_producto["product_name_es"];

                            // Limpiar espacios en blanco adicionales
                            $titulo_limpio = trim($titulo_original);

                            // Reemplazar &nbsp; con espacio en blanco
                            $titulo_formateado = str_ireplace("&nbsp;", " ", $titulo_limpio);

                            echo '
                                    <div class="grid-item">
                                        <div class="contenedor_producto" id="producto' . $datos_producto["product_aid"] . '">
                                            <figure class="producto_img">
                                                <img src="' . $datos_producto["product_image"] . '" alt="' . $datos_producto["product_name_es"] . '">
                                            </figure>
                        
                                            <div class="producto_contenedor_detalles">
                                                <div class="producto_detalles">
                                                    <div class="producto_datos">
                                                        <h2>'.$titulo_formateado.'</h2>
                                                        <span>' . $datos_producto["product_model"] . '</span>
                                                    </div>
                                                    <div class="producto_botones">
                                                        <a href="#" class="btn_detalles">
                                                            Ver Detalles
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 576 512">
                                                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Modal de los Detalles del Producto -->
                                        <div class="modal_detalles-blur">
                                            <div class="contenedor_modal_detalles">
                                                <svg class="cerrar_detalles" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 384 512">
                                                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                                </svg>
                        
                                                <div class="contenedor_modal_detalles_img">
                                                    <figure class="modal_detalles_img rango_img_slide model_2d">
                                                        <img src="' . $datos_producto["product_image"] . '" alt="detalles-del-producto">
                                                    </figure>
                                ';

                            // Verificamos si el campo resultado_renderP no esta vacio
                            if (!empty($datos_producto["resultado_renderP"])) {
                                echo '
                                            <div class="modal_detalles_img rango_img_slide model_3d">
                                                <model-viewer src="' . $datos_producto["resultado_renderP"] . '" alt="Model - 3D" exposure="1.2" camera-controls autoplay ar camera-orbit="180deg 90deg 100%" field-of-view="30deg" ar-status="not-presenting"></model-viewer>
                                            </div>
                                
                                            <div class="btn_render_product btn_3d">
                                                Ver en 3D
                                            </div>
                                
                                            <div class="btn_render_product btn_2d">
                                                Ver en 2D
                                            </div>
                                        ';
                            }

                            // Continuación del echo después de la consulta
                            echo '
                                        </div>
                
                                        <div class="modal_detalles_info">
                                            <h2>'.$titulo_formateado.'</h2>
                                            
                                            <span>$' . $datos_producto["product_priceUSD"] . '</span>
                                            <h3>Descripción:</h3>
                                    ';

                            foreach ($parrafos_descripcion_dos as $parrafo) {
                                echo '<p>' . $parrafo . '</p>';
                            }

                            if (!empty($datos_producto["product_technical_description_es"])) {
                                echo '
                                                <h4>Características:</h4>
                                                <table class="p-prev-table">' . $datos_producto["product_technical_description_es"] . '</table>
                                            ';
                            }

                            echo '
                                                <div class="contenedor_boton_ver_mas">
                                                    <a href="https://plataforma.kalstein.net/registrarse/?search=' . $datos_producto["product_model"] . '" class="boton_ver_mas btn_cotizar">
                                                        <span>Cotizar</span>
                                                        <svg class="icono_ver_mas" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 448 512">
                                                            <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                        }
                    } /*else if(isset($_SESSION["emailAccount"])) {
                       if($tipo_usuario['account_rol_aid'] == 2 || $tipo_usuario['account_rol_aid'] == 3 || $tipo_usuario['account_rol_aid'] == 4) {
                           echo '
                               <span class="subirtext">No has subido ningún Producto.</span>
                               <a href="https://plataforma.kalstein.net/distribuidor/productos/agregar/" class="btn_agregar_producto" title="Agrega un Producto aquí">
                                   ¡Agrega un Producto!
                               </a>
                           ';
                       } else {
                           echo '
                               <script>
                                   window.location.replace("https://plataforma.kalstein.net/template-editor/assets/vistas/plantilla.php");
                               </script>";
                           ';
                       }
                   } else {
                       echo '
                           <script>
                               window.location.replace("https://plataforma.kalstein.net/template-editor/assets/vistas/plantilla.php");
                           </script>";
                       ';
                   }*/
                    ?>
                </div>

                <!-- Paginacion -->
                <!-- 
                    <ul class="pagination">
                        <li><a href="#">«</a></li>
                        <li><a href="#" class="active">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">6</a></li>
                        <li><a href="#">7</a></li>
                        <li><a href="#">»</a></li>
                    </ul> 
                -->

                <?php
                // Verifica si el parametro show_button esta presente en la URL
                $showButton = isset($_GET['show_button']) && $_GET['show_button'] === 'true';

                // Si el parametro esta presente, muestra el boton
                if ($showButton) {
                    echo '
                            <a href="../../dashboard.php" class="btn_dashboard">
                                <span>Volver al Editor</span>
                            </a>

                            <a href="../../dashboard.php" class="btn_dashboard_dos">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25" viewBox="0 0 640 512">
                                    <path d="M36.8 192H603.2c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0H121.7c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224V384v80c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V384 224H320V384H128V224H64zm448 0V480c0 17.7 14.3 32 32 32s32-14.3 32-32V224H512z"/>
                                </svg>
                            </a>
                        ';
                }
                ?>
            </main>
        </div>
    </div>

    <?php
        include ("/home/he270716/public_html/plataforma.kalstein.net/template-editor/assets/includes/footer_plantilla.php");
    ?>

    <!-- Scripts -->
    <script src="https://plataforma.kalstein.net/template-editor/assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://plataforma.kalstein.net/template-editor/assets/js/plantilla/main.js"></script>
    <script src="https://plataforma.kalstein.net/template-editor/assets/js/plantilla/productos.js"></script>
    <script src="https://plataforma.kalstein.net/template-editor/assets/js/plantilla/footer_plantilla.js"></script>
</body>

</html>