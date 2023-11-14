<!-- Menu de navegación -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/fotosdellocal/logo.png" width="50" height="50" class="d-inline-block align-top" alt="DeltaBike"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarTop" aria-controls="navBarTop" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navBarTop">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  text-info" href="index.php">Deltabike</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-info" href="index.php#marcas">Marcas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-info" href="index.php#fotos">Fotos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-info" href="index.php#productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-info" href="index.php#contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-info" href="index.php#redes">Redes</a>
                    </li>
                </ul>

                <a href="checkout.php" class="btn btn-info btn-sm me-2">
                    <i class="fas fa-shopping-cart"></i> Carrito <span id="num_cart" class="badge bg-black"><?php echo $num_cart; ?></span>
                </a>

                <?php if (isset($_SESSION['user_id'])) { ?>

                    <div class="dropdown">
                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="btn_session" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> &nbsp; <?php echo $_SESSION['user_name']; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btn_session">
                            <li><a class="dropdown-item" href="compras.php">Mis compras</a></li>
                            <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                        </ul>
                    </div>

                <?php } else { ?>
                    <a href="login.php" class="btn btn-success btn-sm"><i class="fas fa-user"></i> Ingresar</a>
                <?php } ?>

            </div>
        </div>
    </nav>
</header>