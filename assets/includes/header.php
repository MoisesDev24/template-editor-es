    <header class="cabecera">
        <nav class="navbar">
            <div class="navbar_contenedor_img">
                <a href="dashboard.php" class="navbar_link">
                    <figure class="navbar_img">
                        <img src="assets/img/kalstein_logo.png" alt="logo">
                    </figure>
                </a>
            </div>

            <div class="navbar_contenedor_datos">
                <?php
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
                    if (!empty($tipo_usuario['account_url_image_perfil'])) {
                        echo '
                            <figure class="usuario_img">
                                <img src="../wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$tipo_usuario["account_url_image_perfil"].'" alt="usuario_perfil">
                            </figure>
                        ';
                    } else {
                        echo '
                            <figure class="usuario_img">
                                <img src="assets/img/logo_user_3.png" alt="usuario_perfil">
                            </figure>
                        ';
                    }
                ?>
            </div>
        </nav>
    </header>