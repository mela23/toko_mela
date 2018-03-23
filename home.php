<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
	<title></title>
</head>
<body>

	<div class="hero">
		<div class="container">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="assets/img/slider/1.jpg" alt="..." width="100%">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
      <img src="assets/img/slider/2.jpg" alt="..." width="100%">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
      <img src="assets/img/slider/3.jpg" alt="..." width="100%">
      <div class="carousel-caption">
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
		</div>
	</div>
	<!-- menampilkan display produk terbaru -->
	<div class="produk">
		<div class="container">
			<h1>Produk</h1>
			<hr>
			<div class="row">
				<?php foreach ($data_produk as $key => $value): ?>

					<div class="col-md-3">
						<div class="thumbnail">
							<img src="assets/img/produk/<?php echo $value['foto_produk']; ?>">
							<div class="caption text-center">
								<h2><?php echo $value['nama_produk'] ?></h2>
								<p><strong>Rp<?php echo number_format($value['harga_produk']) ?></strong></p>
								<p>
									<a href="index.php?halaman=beli&id=<?php echo $value['id_produk']; ?>" class="btn btn-success">Beli</a>
									<a href="index.php?halaman=detail_produk&id=<?php echo $value ['id_produk'] ?>" class="btn btn-default">Detail</a>
								</p>
							</div>
						</div>
					</div>
				<?php endforeach ?>

			</div>
		</div>
	</div>
</body>
</html>