<?php

	function conexion() {
		$server = "localhost";
		$user = "he270716";
		$password = "RP\$c_myoUeMK";
		$bd = "he270716_wp_es";
		$conexion = mysqli_connect($server,$user,$password,$bd);

		mysqli_set_charset($conexion, "utf8");

		if (!$conexion) {
			die("Ha fallado la conexión" . mysqli_connect_error());
		}

		return $conexion;
	}

	function limpiar_inputs($cadena) {
		$cadena = trim($cadena);
		$cadena = stripcslashes($cadena);

		$cadena = str_ireplace("<script>", "", $cadena);
		$cadena = str_ireplace("</script>", "", $cadena);
		$cadena = str_ireplace("<script src>", "", $cadena);
		$cadena = str_ireplace("<script type=", "", $cadena);
		$cadena = str_ireplace("SELECT * FROM", "", $cadena);
		$cadena = str_ireplace("DELETE FROM", "", $cadena);
		$cadena = str_ireplace("INSERT INTO", "", $cadena);
		$cadena = str_ireplace("DROP TABLE", "", $cadena);
		$cadena = str_ireplace("DROP DATABASE", "", $cadena);
		$cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena = str_ireplace("SHOW TABLES", "", $cadena);
		$cadena = str_ireplace("SHOW DATABASES", "", $cadena);
		$cadena = str_ireplace("<?php", "", $cadena);
		$cadena = str_ireplace("?>", "", $cadena);
		$cadena = str_ireplace("--", "", $cadena);
		$cadena = str_ireplace("^", "", $cadena);
		$cadena = str_ireplace("<", "", $cadena);
		$cadena = str_ireplace("[", "", $cadena);
		$cadena = str_ireplace("]", "", $cadena);
		$cadena = str_ireplace("==", "", $cadena);
		$cadena = str_ireplace(";", "", $cadena);
		$cadena = str_ireplace("::", "", $cadena);
		$cadena = str_ireplace("'", "", $cadena);
		$cadena = trim($cadena);
		$cadena = stripcslashes($cadena);

		return $cadena;
	}

	function verificar_datos($filtro, $cadena) {
		if (preg_match("/^".$filtro."$/", $cadena)) {
			return false;
		} else {
			return true;
		}
	}

?>