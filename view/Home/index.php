<?php 
	require_once("../../config/conexion.php");
	if(isset($_SESSION["user_id"])){
?>
<!DOCTYPE html>
<html>
    <?php require_once('../MainHead/head.php') ?>
	<title>Home</title>
</head>
<body class="with-side-menu">
    <?php require_once('../MainHeader/header.php') ?>
    <!--.site-header-->

	<div class="mobile-menu-left-overlay"></div>

    <?php require_once('../MainNav/nav.php') ?>
    <!--.side-menu-->

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-sm-4">
	                        <article class="statistic-box green">
	                            <div>
	                                <div class="number" id="lbltotal"></div>
	                                <div class="caption"><div>Total de Tickets</div></div>
	                            </div>
	                        </article>
	                    </div>
						<div class="col-sm-4">
	                        <article class="statistic-box yellow">
	                            <div>
	                                <div class="number" id="lbltotalabierto"></div>
	                                <div class="caption"><div>Total de Tickets Abiertos</div></div>
	                            </div>
	                        </article>
	                    </div>
						<div class="col-sm-4">
	                        <article class="statistic-box red">
	                            <div>
	                                <div class="number" id="lbltotalcerrado"></div>
	                                <div class="caption"><div>Total de Tickets Cerrados</div></div>
	                            </div>
	                        </article>
	                    </div>
					</div>
				</div>
			</div>

			<section class="card">
				<header class="card-header">
					Grafico Estadístico
				</header>
				<div class="card-block">
					<div id="divgrafico" style="height: 250px;"></div>
				</div>
			</section>
			
		</div>
	</div>
	<!-- Contenido -->

	<!-- JS -->
    <?php require_once('../MainJs/js.php') ?>
	<script src="home.js"></script>

</body>
</html>
<?php 
	}else{
		header("Location:".Connect::ruta()."index.php");
	}
?>