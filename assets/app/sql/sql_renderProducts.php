<?php
    // Variables de Sesion del Usuario
    if ($emailShop != NULL) {
        $email = $emailShop;
    } else {
        $email = $_SESSION["emailAccount"];
    }

    // Consulta para obtener los Datos de la Tienda
    $sql = "
            SELECT * FROM tienda_virtual 
            WHERE ID_user = '$email';
        ";

    $conexion_bd = conexion();
    $consulta = mysqli_query($conexion_bd, $sql);
    $datos_tienda = mysqli_fetch_array($consulta);

    // ===================================================================================
    // CONSULTA PARA OBTENER TODOS LOS PRODUCTOS...
    $sql_productsToRender = "SELECT * FROM wp_k_products WHERE product_maker = '$email' AND product_validate_status = 'validated' AND NOT EXISTS ( SELECT 1 FROM render_product WHERE render_product.image_url = wp_k_products.product_image ) ORDER BY product_name_es ASC;";
    $consulta_productsToRender = mysqli_query($conexion_bd, $sql_productsToRender);

    $conexion_bd = null;
?>