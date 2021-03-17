<?php 
	require_once("../../config/conexion.php");
	if(isset($_SESSION["user_id"])){
?>
<!DOCTYPE html>
<html>
    <?php require_once('../MainHead/head.php') ?>
	<title>Home</>::Nuevo ticket</title>
</head>
<body class="with-side-menu">
    <?php require_once('../MainHeader/header.php') ?>
    <!--.site-header-->

	<div class="mobile-menu-left-overlay"></div>

    <?php require_once('../MainNav/nav.php') ?>
    <!--.side-menu-->
        <!-- content -->
        <div class="page-content">
		<div class="container-fluid">

			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Nuevo Ticket</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Nuevo Ticket</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<p>
					Desde esta ventana podra generar nuevos tickets.
				</p>

				<h5 class="m-t-lg with-border">Ingresar Información</h5>

				<div class="row">
					<form method="post" id="ticket_form">

						<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="categori_id"  >Categoria</label>
								<select id="categori_id" name="categori_id" class="form-control" >
								</select>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="ticket_title">Titulo</label>
								<input type="text" class="form-control" id="ticket_title" name="ticket_title" placeholder="Ingrese Titulo">
							</fieldset>
						</div>
						<div class="col-lg-12">
							<fieldset class="form-group">
								<label class="form-label semibold" for="ticket_description">Descripción</label>
								<div class="summernote-theme-1" >
									<textarea id="ticket_description" name="ticket_description" class="summernote" name="name"></textarea>
								</div>
							</fieldset>
						</div>
						<div class="col-lg-12">
							<button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Guardar</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>

	<!-- JS -->
    <?php require_once('../MainJs/js.php') ?>
	<script src="newTicket.js"></script>

</body>
</html>
<?php 
	}else{
		header("Location:".Connect::ruta()."index.php");
	}
?>