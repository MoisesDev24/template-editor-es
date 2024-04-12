<?php
	session_start();
	// Comprobamos que las variables esten definidas o tengan un valor
	if (isset($_POST["titulo_tienda"]) && isset($_POST["subtitulo_tienda"]) && isset($_POST["idioma_tienda"])) {
		require_once "../config/main.php";
	}

	// Almacenando datos
	$titulo_tienda = limpiar_inputs($_POST["titulo_tienda"]);
	$subtitulo_tienda = limpiar_inputs($_POST["subtitulo_tienda"]);
	$idioma_tienda = limpiar_inputs($_POST["idioma_tienda"]);
	$mision_tienda = limpiar_inputs($_POST["mision_tienda"]);
	$vision_tienda = limpiar_inputs($_POST["vision_tienda"]);
	$facebook_tienda = limpiar_inputs($_POST["facebook_tienda"]);
	$twitter_tienda = limpiar_inputs($_POST["twitter_tienda"]);
	$instagram_tienda = limpiar_inputs($_POST["instagram_tienda"]);
	$logo_tienda = "";
	$descripcion_tienda = limpiar_inputs($_POST["descripcion_tienda"]);
	$quienes_somos = limpiar_inputs($_POST["quienes_somos"]);

	$email = $_SESSION["emailAccount"];

	$sql_usuarios = "SELECT account_nombre FROM wp_account WHERE account_correo = '$email';";

	$conexion_bd = conexion();
	$consulta_usuario = mysqli_query($conexion_bd, $sql_usuarios);
	$nombreUsuario = mysqli_fetch_array($consulta_usuario);

	// Verificando Campos Obligatorios
	if ($titulo_tienda == "" || $subtitulo_tienda == "" || $idioma_tienda == "" || $descripcion_tienda == "" || $quienes_somos == "") {
	
		echo '
			<div class="alerta activo">
				<div class="alerta_contenido">
					<img class="icon mal" src="../img/icon/x.svg">

					<div class="mensaje">
						<span class="text text-2">¡Ha ocurrido un error!</span>
						<span class="text">No has llenado todos los campos que son obligatorios.</span>
					</div>
				</div>

				<div class="progress rojo activo"></div>
			</div>
		';

		exit();
	}

	// Verificando y Guardando informacion de la Foto de Perfil
	if (isset($_FILES['logo_tienda']) && $_FILES['logo_tienda']['error'] === UPLOAD_ERR_OK) {
	    $logo = $_FILES['logo_tienda'];
	    $nombre_f = $logo['name'];
	    $tipo_f = $logo['type'];
	    $ruta_provisional_f = $logo['tmp_name'];
	    $tamano_f = $logo['size'];
	    $dimensiones_f = getimagesize($ruta_provisional_f);
	    $ancho_f = $dimensiones_f[0];
	    $alto_f = $dimensiones_f[1];
	    $carpeta_f = '../../img/users/logos_tienda/';
	    
	    // Validacion del tipo de archivo
	    $tipos_permitidos = array('image/jpg', 'image/jpeg', 'image/png', 'image/webp');
	    
	    if (!in_array(strtolower($tipo_f), $tipos_permitidos)) {
	        mostrarError('El archivo no es una imagen.');
	    } elseif ($tamano_f > 3 * 1024 * 1024) {
	        mostrarError('El tamaño máximo permitido es de 3MB.');
	    } elseif ($ancho_f > 600 || $alto_f > 250 || $ancho_f < 220 || $alto_f < 50) {
			mostrarError('La imagen debe tener dimensiones entre 600x250 y 220x50.');
		} else {
	        // Procesamiento si pasa todas las validaciones
	        $src_f = $carpeta_f . $nombreUsuario[0] . '_' . $nombre_f;
	        
	        // Verificar y crear la carpeta si no existe
            if (!file_exists($carpeta_f)) {
                mkdir($carpeta_f, 0777, true);
            }

            // Verificar si el archivo ya existe y eliminarlo
	        if (file_exists($src_f)) {
	            unlink($src_f);
	        }

	        move_uploaded_file($ruta_provisional_f, $src_f);
	        $logo_tienda = 'https://plataforma.kalstein.net/template-editor/assets/img/users/logos_tienda/' . $nombreUsuario[0] . '_' . $nombre_f;
	    }
	} elseif(isset($_POST["imagen_actual"])) {
		$logo_tienda = $_POST["imagen_actual"];
	} else {
		echo '
			<div class="alerta activo">
				<div class="alerta_contenido">
					<img class="icon mal" src="../img/icon/x.svg">

					<div class="mensaje">
						<span class="text text-2">¡Ha ocurrido un error!</span>
						<span class="text">No has agregado una imagen.</span>
					</div>
				</div>

				<div class="progress rojo activo"></div>
			</div>
		';

		exit();
	}

	function mostrarError($mensaje) {
	    echo '
	        <div class="alerta activo">
	            <div class="alerta_contenido">
	                <img class="icon mal" src="../img/icon/x.svg">
	                <div class="mensaje">
	                    <span class="text text-2">¡Ha ocurrido un error!</span>
	                    <span class="text">' . $mensaje . '</span>
	                </div>
	            </div>
	            <span></span>
	            <div class="progress rojo activo"></div>
	        </div>
	    ';
	    exit();
	}

	// Verificar si la Tienda ya existe en la Base de Datos
	$sql = "SELECT * FROM tienda_virtual WHERE ID_user = '$email';";

	$consulta = mysqli_query($conexion_bd, $sql);

	if (mysqli_num_rows($consulta) > 0) {
		$obtenerTienda = mysqli_fetch_array($consulta);

		$sql_update = "
		    UPDATE tienda_virtual 
		    SET titulo_t = '$titulo_tienda', 
		    subtitulo_t = '$subtitulo_tienda', 
		    ID_idioma = '$idioma_tienda', 
		    mision = '$mision_tienda', 
		    vision = '$vision_tienda', 
		    facebook_t = '$facebook_tienda', 
		    twitter_t = '$twitter_tienda', 
		    instagram_t = '$instagram_tienda', 
		    logo_t = '$logo_tienda', 
		    descripcion = '$descripcion_tienda', 
		    quienes_somos_t = '$quienes_somos' 
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
			(ID_tienda,ID_user,titulo_t,subtitulo_t,ID_idioma,mision,vision,facebook_t,twitter_t,instagram_t,logo_t,descripcion,quienes_somos_t) 
			VALUES 
			('', '$email','$titulo_tienda','$subtitulo_tienda','$idioma_tienda','$mision_tienda','$vision_tienda','$facebook_tienda','$twitter_tienda','$instagram_tienda','$logo_tienda','$descripcion_tienda','$quienes_somos')
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




	// if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// 	// Verificar si ya hay una imagen en la base de datos
	// 	$imagen_actual = obtener_imagen_desde_base_de_datos();

	// 	// Verificar si se proporciono una nueva imagen a traves del formulario
	// 	if (!empty($_FILES["imagen"]["name"])) {
	// 		// Si se proporciona una nueva imagen, procesarla normalmente
	// 		$nueva_imagen = subir_nueva_imagen($_FILES["imagen"]);
	// 		// Actualizar los datos en la base de datos con la nueva imagen
	// 		actualizar_datos_con_nueva_imagen($nueva_imagen);
	// 	} elseif (!empty($imagen_actual)) {
	// 		// Si no se proporciona una nueva imagen pero hay una imagen en la base de datos, actualizar datos
	// 		actualizar_datos_sin_nueva_imagen();
	// 	} else {
	// 		// Si no se proporciona una nueva imagen y no hay una imagen en la base de datos, mostrar un mensaje de error o manejar de acuerdo a tus necesidades
	// 		mostrar_error();
	// 	}
	// }

	// // Funcion para obtener la imagen actual de la base de datos
	// function obtener_imagen_desde_base_de_datos() {
	// 	// Aqui iria el codigo para obtener la imagen actual de la base de datos
	// 	// Devuelve la URL o el nombre de archivo de la imagen actual
	// }

	// // Funcion para subir la nueva imagen al servidor
	// function subir_nueva_imagen($imagen) {
	// 	// Aqui iria el codigo para manejar la subida de la nueva imagen
	// 	// Devuelve la URL o el nombre de archivo de la nueva imagen
	// }

	// // Funcion para actualizar los datos en la base de datos con la nueva imagen
	// function actualizar_datos_con_nueva_imagen($nueva_imagen) {
	// 	// Aqui iria el codigo para actualizar los datos en la base de datos
	// 	// utilizando la nueva imagen
	// }

	// // Funcion para actualizar los datos en la base de datos sin una nueva imagen
	// function actualizar_datos_sin_nueva_imagen() {
	// 	// Aqui iria el codigo para actualizar los datos en la base de datos
	// 	// sin modificar la imagen
	// }

	// // Funcion para mostrar un mensaje de error o manejar la falta de imagen
	// function mostrar_error() {
	// 	// Aqui iria el codigo para mostrar un mensaje de error
	// 	// o manejar la falta de imagen en el formulario
	// }

?>