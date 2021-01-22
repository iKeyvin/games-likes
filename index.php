<?php
session_start();
require 'db/dbconexion.php';

$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$sql = "SELECT * FROM videojuegos ORDER BY id_videojuego DESC LIMIT $start, $limit";
$res = mysqli_query($conexion,  $sql);

$result1 = $conexion->query("SELECT count(id_videojuego) AS id_videojuego FROM videojuegos");
$custCount = $result1->fetch_all(MYSQLI_ASSOC);
$total = $custCount[0]['id_videojuego'];
$pages = ceil($total / $limit);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'includes/head.php' ?>
	<title>Games & Likes</title>
</head>

<body>
	<!--- Navigation -->
	<?php include 'includes/navbar.php' ?>
	<!--- Image Slider -->
	<?php include 'includes/slider.php' ?>

	<!--- Main Page Heading -->
	<div class="col-12 text-center mt-5">
		<h2 class="text-dark pt-4">Novedades</h2>
		<div class="line border-top border-primary w-25 mx-auto my-3"></div>
	</div>

	<!--- Three Column Section -->
	<div class="container">
		<div class="row my-5">
			<?php if (mysqli_num_rows($res) > 0) {
				while ($videojuegos = mysqli_fetch_assoc($res)) {
					$id = $videojuegos['id_videojuego'] ?>
					<div id="module" class="col-md-4 my-4">
						<img src="uploads/<?= $videojuegos['imagen'] ?>" alt="" class="zoom w-100">
						<h4 class="my-4"><?= $videojuegos['nombre'] ?></h4>
						<h6>Fecha: <?= $videojuegos['fecha_pub'] ?></h6>
						<p class="collapse" id="collapseExample" aria-expanded="false"><?= $videojuegos['informacion'] ?></p>

						<form action="videojuegos.php" method="post">
                                <input type="hidden" name="id_videojuego" value="<?= $videojuegos['id_videojuego'] ?>">
                                <button type="submit" name="fullVideojuego" class="btnmas btn btn-outline-dark btn-md">Leer más</button>
                            </form>
					</div>

			<?php }
			} ?>

		</div>
	</div>

	<!--- Start Footer -->
	<?php include 'includes/footer.php' ?>
	<!--- Script Source Files -->
	<?php include 'includes/scripts.php' ?>
</body>

</html>