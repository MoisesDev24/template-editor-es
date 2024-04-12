<?php
	session_start();

	if (isset($_FILES["banner_p"]) && isset($_FILES["quienes_somos_t"])) {
	    require_once "../config/main.php";
	}

	// Almacenando datos
	$banner_p = "";
	$quienes_somos_t = "";
	$mision_img = "";
	$imagen_vision = "";

	$email = $_SESSION["emailAccount"];

	$sql_usuarios = "SELECT * FROM wp_account WHERE account_correo = '$email';";

	$conexion_bd = conexion();
	$consulta_usuario = mysqli_query($conexion_bd, $sql_usuarios);
	$nombreUsuario = mysqli_fetch_array($consulta_usuario);

	// Funcion para procesar la carga de imagenes
	function procesarImagen(&$imagen, $nombreCampo, $carpeta, $anchoMin, $altoMin, $anchoMax, $altoMax, $nombreUsuario) {
	    if (isset($_FILES[$nombreCampo])) {
	        $archivo = $_FILES[$nombreCampo];
	        $nombre = $archivo['name'];
	        $tipo = $archivo['type'];
	        $rutaProvisional = $archivo['tmp_name'];
	        $tamano = $archivo['size'];
	        $dimensiones = getimagesize($rutaProvisional);
	        $ancho = $dimensiones[0];
	        $alto = $dimensiones[1];

			$newCarpeta ='https://plataforma.kalstein.net/template-editor/assets/img/users/' . $carpeta;
			$carpeta_f = '/home/he270716/public_html/plataforma.kalstein.net/template-editor/assets/img/users/' . $carpeta;

	        $tiposPermitidos = array('image/jpg', 'image/jpeg', 'image/png', 'image/webp');

	        // Validaciones
	        if (!in_array(strtolower($tipo), $tiposPermitidos)) {
	            mostrarError('El archivo no es una imagen.');
	        } elseif ($tamano > 3 * 1024 * 1024) {
	            mostrarError('El tamaño máximo permitido es de 3MB.');
	        } elseif ($ancho > $anchoMax || $alto > $altoMax || $ancho < $anchoMin || $alto < $altoMin) {
	            mostrarError("La imagen debe tener dimensiones entre {$anchoMin}x{$altoMin} y {$anchoMax}x{$altoMax}.");
	        } else {
	            // Procesamiento si pasa todas las validaciones
	            $src = $carpeta_f . $nombreUsuario['account_nombre'] . '_' . $nombre;

	            // Verificar y crear la carpeta si no existe
	            if (!file_exists($carpeta_f)) {
	                mkdir($carpeta_f, 0777, true);
	            }

	            // Verificar si el archivo ya existe y eliminarlo
	            if (file_exists($src)) {
	                unlink($src);
	            }

	            move_uploaded_file($rutaProvisional, $src);
	            $imagen = $newCarpeta . $nombreUsuario['account_nombre'] . '_' . $nombre;
	        }
	    }
	}

	// Procesar cada imagen
	if (!empty($_FILES["banner_p"]["name"])) {
	    procesarImagen($banner_p, 'banner_p', '/banners/', 1000, 350, 1900, 600, $nombreUsuario); 
	}
	
	if (!empty($_FILES["quienes_somos_t"]["name"])) {
	    procesarImagen($quienes_somos_t, 'quienes_somos_t', '/quienes_somos/', 380, 100, 900, 600, $nombreUsuario);
	}

	if (!empty($_FILES["mision_img"]["name"])) {
	    procesarImagen($mision_img, 'mision_img', '/mision/', 380, 100, 900, 600, $nombreUsuario);
	}

	if (!empty($_FILES["imagen_vision"]["name"])) {
	    procesarImagen($imagen_vision, 'imagen_vision', '/vision/', 380, 100, 900, 600, $nombreUsuario);
	}

	function mostrarError($mensaje) {
	    echo '
	        <div class="alerta activo">
	            <div class="alerta_contenido">
	                <img class="icon mal" src="../img/icon/x.svg">
	                <div class="mensaje">
	                    <span class="text text-2">¡Ha ocurrido un error!</span>
	                    <span class="text">'.$mensaje.'</span>
	                </div>
	            </div>
	            <span></span>
	            <div class="progress rojo activo"></div>
	        </div>
	    ';

	    exit();
	}

	// Verificar si la Tienda ya existe en la Base de Datos
	$sql = "
		SELECT * FROM tienda_virtual 
		WHERE ID_user = '$email';
	";

	$consulta = mysqli_query($conexion_bd, $sql);

	if (mysqli_num_rows($consulta) > 0) {
		$obtenerTienda = mysqli_fetch_array($consulta);

		$sql_update = "
		    UPDATE tienda_virtual 
		    SET banner_t = '$banner_p', 
		    img_quienes_s = '$quienes_somos_t', 
		    img_mision = '$mision_img',  
		    img_vision = '$imagen_vision' 
		    WHERE ID_tienda = {$obtenerTienda['ID_tienda']}
		";

		$consulta_update = mysqli_query($conexion_bd, $sql_update);

		if (!$consulta_update) {
			echo '
				<div class="alerta activo">
					<div class="alerta_contenido">
						<img class="icon mal" src="../img/icon/x.svg">

						<div class="mensaje">
							<span class="text text-2">¡Ha ocurrido un error!</span>
							<span class="text">No se han podido actualizar los <b>Datos.</b></span>
						</div>
					</div>

					<div class="progress rojo activo"></div>
				</div>
			';

			exit();
		}
		else {
			echo '
				<div class="alerta activo">
					<div class="alerta_contenido">
						<img class="icon bien" src="../img/icon/y.svg">

						<div class="mensaje">
				    		<span class="text text-1">¡Felicidades!</span>
				    		<span class="text">Sus <b>Datos</b> han sido guardados.</span>
						</div>
					</div>
					
					<span></span>

					<div class="progress activo"></div>
				</div>
			';
		}
	} else {
		$sql_insert = mysqli_query($conexion_bd, "
			INSERT INTO tienda_virtual 
			(ID_user,ID_idioma,banner_t,img_quienes_s,img_mision,img_vision) 
			VALUES 
			('$email', 1, '$banner_p','$quienes_somos_t','$mision_img','$imagen_vision')
		");

		if ($sql_insert) {
			echo '
				<div class="alerta activo">
					<div class="alerta_contenido">
						<img class="icon bien" src="../img/icon/y.svg">

						<div class="mensaje">
				    		<span class="text text-1">¡Felicidades!</span>
				    		<span class="text">Su registro ha sido exitoso</span>
						</div>
					</div>
					
					<span></span>

					<div class="progress activo"></div>
				</div>
			';
		} else {
			echo '
				<div class="alerta activo">
					<div class="alerta_contenido">
						<img class="icon mal" src="../img/icon/x.svg">

						<div class="mensaje">
				    		<span class="text text-2">¡Ha ocurrido un error!</span>
				    		<span class="text">Su registro no ha sido exitoso.</span>
						</div>
					</div>
					
					<span></span>

					<div class="progress rojo activo"></div>
				</div>
			';

			exit();
		}
	}

	$conexion_bd = null;

?>