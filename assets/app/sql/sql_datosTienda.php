<?php
	// Variables de Sesion del Usuario
	if ($emailShop != NULL){
        $email = $emailShop;
    }else{
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

	// Consulta para obtener los Datos del Perfil del Usuario
    $sql_tipo_usuario = "SELECT * FROM wp_account WHERE account_correo = '$email';";

    $consulta_tipo_usuario = mysqli_query($conexion_bd, $sql_tipo_usuario);
    $tipo_usuario = mysqli_fetch_array($consulta_tipo_usuario);

    $conexion_bd = null;
?>