<?php 
	require_once("../../config/conexion.php");
	if(isset($_SESSION["user_id"])  and  $_SESSION["user_rol"]==2 ){
?>
<!DOCTYPE html>
<html>
    <?php require_once('../MainHead/head.php') ?>
	<title>Home</>::Mantenimiento Usuario</title>
</head>
<body class="with-side-menu">
    <?php require_once('../MainHeader/header.php') ?>
    <!--.site-header-->

	<div class="mobile-menu-left-overlay"></div>

    <?php require_once('../MainNav/nav.php') ?>
    <!--.side-menu-->

<!-- contenido -->
	<div class="page-content">
		<div class="container-fluid">
		<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Consultar Ticket</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Mantenimiento Usuarios</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
            <button type="button" id="btnAdd" class="btn btn-inline btn-inline btn-primary">Agregar Nuevo Usuario</button>

			<table id="user_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 25%;">Nombre</th>
							<th style="width: 20%;">Correo</th>
							<th class="d-none d-sm-table-cell" style="width: 40%;">contraseña</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Rol</th>
							<th class="d-none d-sm-table-cell" style="width: 2%;">Editar</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Eliminar</th>
							<!-- <th class="text-center" style="width: 5%;"></th> -->
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
		</div>

		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<!-- JS -->

    <?php require_once("modalmantenimiento.php") ?>
    <?php require_once("../MainJs/js.php") ?>
	<script type="text/javascript" src="mantenimiento.js"></script>

</body>
</html>
<?php 
	}else{
		header("Location:".Connect::ruta()."index.php");
	}
?>