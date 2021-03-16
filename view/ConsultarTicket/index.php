<?php 
	require_once("../../config/conexion.php");
	if(isset($_SESSION["user_id"])){
?>
<!DOCTYPE html>
<html>
    <?php require_once('../MainHead/head.php') ?>
	<title>Home</>::Consultar tickets</title>
</head>
<body class="with-side-menu">
    <?php require_once('../MainHeader/header.php') ?>
    <!--.site-header-->

	<div class="mobile-menu-left-overlay"></div>

    <?php require_once('../MainNav/nav.php') ?>
    <!--.side-menu-->

	<div class="page-content">
		<div class="container-fluid">
			Blank page.
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<!-- JS -->
    <?php require_once('../MainJs/js.php') ?>
	<script src="consultarTicket.js"></script>

</body>
</html>
<?php 
	}else{
		header("Location:".Connect::ruta()."index.php");
	}
?>