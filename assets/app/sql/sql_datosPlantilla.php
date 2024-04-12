<?php
    require '/home/he270716/public_html/plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
    // Variables de Sesion del Usuario
    if ($emailShop != NULL) {
        $email = $emailShop;
    } else {
        $email = $_SESSION["emailAccount"];
    }

    // Consulta para obtener los Datos de la tabla tienda_virtual
    $sql = "
        SELECT * FROM tienda_virtual AS tv 
        INNER JOIN idioma_tienda AS i ON tv.ID_idioma = i.ID_idioma 
        WHERE ID_user = '$email';
    ";

    $consulta = mysqli_query($conexion, $sql);
    $datos_plantilla = mysqli_fetch_array($consulta);

    $ruta_imagen_logo = !empty($datos_plantilla['logo_t']) ? $datos_plantilla['logo_t'] : '../img/kalstein_logo.png';
    $ruta_imagen_banner = !empty($datos_plantilla['banner_t']) ? $datos_plantilla['banner_t'] : '../img/banner.png';
    $ruta_imagen_quienesS = !empty($datos_plantilla['img_quienes_s']) ? $datos_plantilla['img_quienes_s'] : '../img/france-copia.png';
    $ruta_imagen_mision = !empty($datos_plantilla['img_mision']) ? $datos_plantilla['img_mision'] : '../img/kalstein_logo.png';
    $ruta_imagen_vision = !empty($datos_plantilla['img_vision']) ? $datos_plantilla['img_vision'] : '../img/france-copia.png';


    // CONSULTA PARA LOS DOS PRIMEROS ITEMS...
    // limitar a productos sin render o en general
    $sql_productos_limit = "SELECT * FROM wp_k_products WHERE product_maker = '$email' AND product_validate_status = 'validated' LIMIT 0,2;";
    $consulta_productos_limit = mysqli_query($conexion, $sql_productos_limit);

    // CONSULTA PARA OBTENER TODOS LOS PRODUCTOS...(SOLO 9 ELEMENTOS)
    $sql_productos_img = "SELECT * FROM wp_k_products WHERE product_maker = '$email' AND product_validate_status = 'validated' LIMIT 0,9;";
    $consulta_productos_img = mysqli_query($conexion, $sql_productos_img);


    // CONSULTA PARA OBTENER EL TERCER ITEM...
    $sql_productos_indiv = "SELECT * FROM wp_k_products WHERE product_maker = '$email' AND product_validate_status = 'validated' LIMIT 1 OFFSET 2;";
    $consulta_prod_indiv = mysqli_query($conexion, $sql_productos_indiv);

    // SEGUNDA CONSULTA PARA OBTENER TODOS LOS PRODUCTOS...(SOLO 9 ELEMENTOS)
    $sql_productos_img_dos = "SELECT * FROM wp_k_products WHERE product_maker = '$email' AND product_validate_status = 'validated' LIMIT 0,9;";
    $consulta_productos_img_dos = mysqli_query($conexion, $sql_productos_img_dos);


    // CONSULTA PARA OBTENER LOS ITEMS 3 Y 4...
    $sql_productos_limit_dos = "SELECT * FROM wp_k_products WHERE product_maker = '$email' AND product_validate_status = 'validated' LIMIT 3,2;";
    $consulta_prod_limit = mysqli_query($conexion, $sql_productos_limit_dos);


    // TERCERA CONSULTA PARA OBTENER TODOS LOS PRODUCTOS...
    $sql_productos = "SELECT * FROM wp_k_products WHERE product_maker = '$email' AND product_validate_status = 'validated';";
    $consulta_productos = mysqli_query($conexion, $sql_productos);

    $sql_render_products = "
        SELECT wp_k_products.*, render_product.resultado_renderP
        FROM wp_k_products
        LEFT JOIN render_product ON wp_k_products.product_image = render_product.image_url
        WHERE wp_k_products.product_maker = '$email' AND product_validate_status = 'validated'
        ORDER BY wp_k_products.product_name_es ASC;
    ";

    $consulta_render_products = mysqli_query($conexion, $sql_render_products);

    // Consulta para obtener los Datos del Perfil del Usuario
    $sql_tipo_usuario = "SELECT * FROM wp_account WHERE account_correo = '$email';";

    $consulta_tipo_usuario = mysqli_query($conexion, $sql_tipo_usuario);
    $tipo_usuario = mysqli_fetch_array($consulta_tipo_usuario);
?>