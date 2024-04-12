<?php
    session_start();

    require '/home/he270716/public_html/plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
    // Variables de Sesion del Usuario
    if ($emailShop != NULL) {
        $email = $emailShop;
    } else {
        $email = $_SESSION["emailAccount"];
    }

    // Obtener el texto de búsqueda de la URL
    $textoBusqueda = isset($_GET['query']) ? $_GET['query'] : '';
    $textoBusqueda = mysqli_real_escape_string($conexion, $textoBusqueda);

    if (isset($_SESSION["emailAccount"])) {

        $sql_buscador = "
            SELECT * FROM wp_k_products 
            WHERE wp_k_products.product_maker = '{$email}' 
            AND product_validate_status = 'validated'
            AND (wp_k_products.product_name_es LIKE '%{$textoBusqueda}%' 
            OR wp_k_products.product_name_en LIKE '%{$textoBusqueda}%' 
            OR wp_k_products.product_name_fr LIKE '%{$textoBusqueda}%');    
        ";

        $consulta_buscadorProductos = mysqli_query($conexion, $sql_buscador);

        // Crear un arreglo para almacenar los productos y un contador para los IDs secuenciales
        $productos = [];

        while ($datos_busqueda = mysqli_fetch_array($consulta_buscadorProductos)) {
            $idSecuencial = 'producto' . $datos_busqueda['product_aid'];

            // Predeterminamos el nombre en español
            $nombreProducto = $datos_busqueda['product_name_es'];

            // Verificamos si el texto de búsqueda está en otro idioma y actualizamos el nombre del producto
            if (stripos($datos_busqueda['product_name_en'], $textoBusqueda) !== false) {
                $nombreProducto = $datos_busqueda['product_name_en'];
            } elseif (stripos($datos_busqueda['product_name_fr'], $textoBusqueda) !== false) {
                $nombreProducto = $datos_busqueda['product_name_fr'];
            }

            $productos[] = [
                'id' => $idSecuencial,
                'image' => $datos_busqueda['product_image'],
                'name' => $nombreProducto
            ];
        }

    } else {
        $ID_slug = isset($_GET['ID_slug']) ? $_GET['ID_slug'] : '';

        // Limpiamos los valores para uso en la consulta SQL para prevenir inyección SQL.
        $ID_slug = mysqli_real_escape_string($conexion, $ID_slug);

        // Asegúrate de reemplazar 'tu_id_slug_aqui' con el ID_slug real que deseas consultar
        $sql_buscador = "
            SELECT wp_k_products.* 
            FROM wp_k_products 
            INNER JOIN tienda_virtual ON wp_k_products.product_maker = tienda_virtual.ID_user
            WHERE tienda_virtual.ID_slug = '{$ID_slug}'
            AND wp_k_products.product_validate_status = 'validated'
            AND (wp_k_products.product_name_es LIKE '%{$textoBusqueda}%' 
            OR wp_k_products.product_name_en LIKE '%{$textoBusqueda}%' 
            OR wp_k_products.product_name_fr LIKE '%{$textoBusqueda}%');
        ";

        $consulta_buscadorProductos = mysqli_query($conexion, $sql_buscador);

        $productos = [];

        while ($datos_busqueda = mysqli_fetch_array($consulta_buscadorProductos)) {
            $idSecuencial = 'producto' . $datos_busqueda['product_aid'];

            // Predeterminamos el nombre en español
            $nombreProducto = $datos_busqueda['product_name_es'];

            // Verificamos si el texto de búsqueda está en otro idioma y actualizamos el nombre del producto
            if (stripos($datos_busqueda['product_name_en'], $textoBusqueda) !== false) {
                $nombreProducto = $datos_busqueda['product_name_en'];
            } elseif (stripos($datos_busqueda['product_name_fr'], $textoBusqueda) !== false) {
                $nombreProducto = $datos_busqueda['product_name_fr'];
            }

            $productos[] = [
                'id' => $idSecuencial,
                'image' => $datos_busqueda['product_image'],
                'name' => $nombreProducto
            ];
        }
    }

    $conexion = null;

    // Devolver los productos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($productos);
?>