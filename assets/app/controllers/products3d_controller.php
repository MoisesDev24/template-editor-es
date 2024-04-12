<?php
session_start();

//Definir Zona horaria:
date_default_timezone_set("America/Caracas");
$fecha_completa = date("Y/m/d h:i:s A");

if (isset ($_POST["imageURL"]) && !empty ($_POST["imageURL"])) {
	require_once "../config/main.php";

	$imageURL = limpiar_inputs($_POST["imageURL"]);

	if (isset ($_POST["imageURLTwo"]) && !empty ($_POST["imageURLTwo"])) {
		$imageURLTwo = limpiar_inputs($_POST["imageURLTwo"]);
	}

	if (isset ($_POST["imageURLThree"]) && !empty ($_POST["imageURLThree"])) {
		$imageURLThree = limpiar_inputs($_POST["imageURLThree"]);
	}

	if (isset ($_POST["imageURLFour"]) && !empty ($_POST["imageURLFour"])) {
		$imageURLFour = limpiar_inputs($_POST["imageURLFour"]);
	}

	if (isset ($_POST["imageURLFive"]) && !empty ($_POST["imageURLFive"])) {
		$imageURLFive = limpiar_inputs($_POST["imageURLFive"]);
	}

	$email = $_SESSION["emailAccount"];

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

	// Recoger todas las URLs de imágenes en un arreglo
	$imageURLs = [$imageURL]; // Inicia con la primera URL

	// Añadir más URLs si existen
	if (isset ($imageURLTwo)) {
		$imageURLs[] = $imageURLTwo;
	}
	if (isset ($imageURLThree)) {
		$imageURLs[] = $imageURLThree;
	}
	if (isset ($imageURLFour)) {
		$imageURLs[] = $imageURLFour;
	}
	if (isset ($imageURLFive)) {
		$imageURLs[] = $imageURLFive;
	}

	$setsDeImagenes = []; // Para almacenar los sets de imágenes organizados por índice

	// Organizar las imágenes en sets
	foreach ($_FILES as $inputName => $fileInfo) {
		if (preg_match('/^foto_(lateral_izq|lateral_der|parte_tras)(\d+)$/', $inputName, $matches)) {
			$tipoImagen = $matches[1]; // lateral_izq, lateral_der, parte_tras
			$index = $matches[2]; // El índice del set de imágenes

			if (!isset ($setsDeImagenes[$index])) {
				$setsDeImagenes[$index] = ['lateral_izq' => null, 'lateral_der' => null, 'parte_tras' => null];
			}

			$carpeta = "/renderF_" . $tipoImagen . "/";
			procesarImagen($setsDeImagenes[$index][$tipoImagen], $inputName, $carpeta, 480, 480, 2050, 1380, $nombreUsuario);
		}
	}




	// Insertar cada set de imágenes en la base de datos
	$index = 0; // Inicia el índice para acceder a las URLs de las imágenes
	$peticiones = 1;
	$limitePeticiones = 5; // Define el límite de peticiones permitidas por usuario
	foreach ($setsDeImagenes as $set) {
		$currentImageURL = $imageURLs[$index] ?? null; // Usa el índice para obtener la URL de imagen correspondiente, usa null como fallback

		if ($currentImageURL !== null) { // Verifica si hay una URL de imagen para este índice
			$fotoLateralIzq = $set['lateral_izq'];
			$fotoLateralDer = $set['lateral_der'];
			$fotoParteTras = $set['parte_tras'];

			// Verifica primero si el usuario ya ha alcanzado el límite de inserciones permitidas
			$sql_verificacion_limite = "SELECT COUNT(*) AS numero_inserciones FROM render_product WHERE ID_user = '$email'";
			$resultado_verificacion_limite = mysqli_query($conexion_bd, $sql_verificacion_limite);
			$fila = mysqli_fetch_assoc($resultado_verificacion_limite);

			if ($fila['numero_inserciones'] < $limitePeticiones) {
				// Verifica si ya existe un registro con las mismas características
				$sql_verificacion_existencia = "
		                SELECT * FROM render_product 
		                WHERE image_url = '$currentImageURL' 
		                AND fotoLateral_izq = '$fotoLateralIzq' 
		                AND fotoLateral_der = '$fotoLateralDer'
		                AND fotoParte_tras = '$fotoParteTras'
		                AND ID_user = '$email';
		            ";
				$resultado_verificacion_existencia = mysqli_query($conexion_bd, $sql_verificacion_existencia);

				if (mysqli_num_rows($resultado_verificacion_existencia) > 0) {
					// El registro ya existe, manejar según sea necesario
					mostrarError("Un registro con las mismas características ya existe.");
					continue; // Salta a la siguiente iteración del bucle
				} else {
					// Procede con la inserción
					$sql_insert = "INSERT INTO render_product (ID_user, image_url, fotoLateral_izq, fotoLateral_der, fotoParte_tras, limite_peticiones, estado, fecha_solicitud) VALUES ('$email', '$currentImageURL', '$fotoLateralIzq', '$fotoLateralDer', '$fotoParteTras', '$peticiones', 'Pendiente', NOW());";

					if ($conexion_bd->query($sql_insert) === TRUE) {
						// Mostrar mensaje de éxito
						echo '
								<div class="alerta activo">
									<div class="alerta_contenido">
										<img class="icon bien" src="../img/icon/y.svg">
										<div class="mensaje">
											<span class="text text-1" id="exito_alerta">¡Felicidades!</span>
											<span class="text">Su registro ha sido exitoso</span>
										</div>
									</div>
									<span></span>
									<div class="progress activo"></div>
								</div>
							';
					} else {
						echo "Error al insertar datos: " . $conexion_bd->error;
					}
				}
			} else {
				// El límite de inserciones ha sido alcanzado
				mostrarError("Se ha alcanzado el límite máximo de inserciones permitidas por usuario.");
			}
		}

		$index++; // Incrementa el índice para la próxima iteración
		$peticiones++;
	}
} elseif (isset ($_POST['imageURLTwo']) && !empty ($_POST['imageURLTwo']) || isset ($_POST['imageURLThree']) && !empty ($_POST['imageURLThree']) || isset ($_POST['imageURLFour']) && !empty ($_POST['imageURLFour']) || isset ($_POST['imageURLFive']) && !empty ($_POST['imageURLFive'])) {
	mostrarError("Datos insuficientes para procesar la solicitud.");
} else {
	mostrarError("Datos insuficientes para procesar la solicitud.");
}


// Función para procesar la carga de imágenes
function procesarImagen(&$imagen, $nombreCampo, $carpeta, $anchoMin, $altoMin, $anchoMax, $altoMax, $nombreUsuario)
{
	if (isset ($_FILES[$nombreCampo])) {
		$archivo = $_FILES[$nombreCampo];
		$nombre = $archivo['name'];
		$tipo = $archivo['type'];
		$rutaProvisional = $archivo['tmp_name'];
		$tamano = $archivo['size'];
		$dimensiones = getimagesize($rutaProvisional);
		$ancho = $dimensiones[0];
		$alto = $dimensiones[1];

		$newCarpeta = 'https://plataforma.kalstein.net/template-editor/assets/img/users/' . $carpeta;
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

function mostrarError($mensaje)
{
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
