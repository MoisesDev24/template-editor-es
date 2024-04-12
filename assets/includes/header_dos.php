    <header class="cabecera">
        <nav class="navbar">
            <div class="navbar_contenedor_img">
                <a href="../../dashboard.php" class="navbar_link">
                    <figure class="navbar_img">
                        <img src="../img/kalstein_logo.png" alt="logo">
                    </figure>
                </a>
            </div>

            <div class="navbar_contenedor_datos">
                <?php
                    $sql = "SELECT * FROM tienda_virtual WHERE ID_user = '$email';";
                
                    $conexion = conexion();
                    $consulta = mysqli_query($conexion, $sql);
                    $datos_tienda = mysqli_fetch_array($consulta);
                    
                    if (isset($datos_tienda['ID_slug'])) {
                        echo '
                            <a href="'.$datos_tienda['ID_slug'].'" class="btn_tienda_public">
                                Ver Tienda
                                <i class="fa-solid fa-store"></i>
                            </a>
            
                            <a href="'.$datos_tienda['ID_slug'].'" class="btn_tienda_public_small">
                                <i class="fa-solid fa-store"></i>
                            </a>
                        ';
                    }
                ?>

                <a href="https://plataforma.kalstein.net/dashboard/" class="btn_guardar">
                    Salir del Editor
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>

                <a href="https://plataforma.kalstein.net/dashboard/" class="btn_guardar_small">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>

                <?php
                    // Consulta para obtener los Datos del Perfil del Usuario
                    $sql_tipo_usuario = "SELECT * FROM wp_account WHERE account_correo = '$email';";

                    $consulta_tipo_usuario = mysqli_query($conexion, $sql_tipo_usuario);
                    $tipo_usuario = mysqli_fetch_array($consulta_tipo_usuario);

                    if (!empty($tipo_usuario['account_url_image_perfil'])) {
                        echo '
                            <figure class="usuario_img">
                                <img src="../../../wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$tipo_usuario["account_url_image_perfil"].'" alt="usuario_perfil">
                            </figure>
                        ';
                    } else {
                        echo '
                            <figure class="usuario_img">
                                <img src="../img/logo_user_3.png" alt="usuario_perfil">
                            </figure>
                        ';
                    }
                ?>
            </div>
        </nav>
    </header>