<nav class="navbar">
    <div id="logo">
        <img src="images/logo.svg">
    </div>
    <a class="navbar-brand" href="index.php">AXOCLOTHES</a>
    
    <button class="navbar-toggler btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
            class="navbar-toggler-icon"></span></button>

    <ul class="menu">
        <li><a href="index.php">Inicio</a></li> 
        <li><a href="AllProducts.php">Todos los productos</a></li>
    </ul>

    <a href="chekout.php" class="btn btn-primary btn-sm m-2" type="submit">
        <i class="bi-cart-fill me-1"></i>
        Carrito
        <span id="num_cart" class="badge bg-secondary"></span>
    </a>

    <?php if (isset($_SESSION['user_id'])) { ?>

        <div class="dropdown">
            <button id="btn_session" class="btn btn-success btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-person-circle"></i> &nbsp; <?php echo $_SESSION['user_name']; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="btn_session">
                <li><a class="dropdown-item" href="compras.php">Historial de compra</a></li>
                <li><a class="dropdown-item" href="logout.php">Cerrar sesion</a></li>
            </ul>
        </div>
    <?php } else { ?>
        <a href="login.php" class="btn btn-success btn-sm"><i class="bi bi-person-circle me-2"></i>Ingresar</a>
    <?php } ?>

</nav>