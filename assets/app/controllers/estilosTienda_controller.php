<?php
	session_start();
	// Comprobamos que las variables estén definidas o tengan un valor
	if (isset($_POST["color_picker"]) && isset($_POST["color_picker_dos"])) {
		require_once "../config/main.php";
	}

	// Almacenando datos
	$color_picker = limpiar_inputs($_POST["color_picker"]);
	$color_picker_dos = limpiar_inputs($_POST["color_picker_dos"]);

	$email = $_SESSION["emailAccount"];

	// Verificando Campos Obligatorios
	if ($color_picker == "" || $color_picker_dos == "") {
		
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

	// Verificar si la Tienda ya existe en la Base de Datos
	$sql = "
		SELECT * FROM tienda_virtual 
		WHERE ID_user = '$email';
	";

	$conexion_bd = conexion();
	$consulta = mysqli_query($conexion_bd, $sql);

	if (mysqli_num_rows($consulta) > 0) {
		$obtenerTienda = mysqli_fetch_array($consulta);

		$sql_update = "
		    UPDATE tienda_virtual 
		    SET color_p = '$color_picker', 
		    color_s = '$color_picker_dos' 
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
			(ID_user,ID_idioma,color_p,color_s) 
			VALUES 
			('$email', 1,'$color_picker','$color_picker_dos')
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