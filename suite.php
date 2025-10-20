<?php 
if(!isset($_GET['q'])) {header("Location: rooms.php");}
include("1head.php");
$sql = "SELECT * FROM jenis_kamar WHERE halaman_id = '{$_GET['q']}'";
$query = $connect->query($sql);
?>
<section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center">
        <h1 class="heading mb-3">Rooms</h1>
        <ul class="custom-breadcrumbs mb-4">
          <li><a href="./">Home</a></li>
          <li>&bullet;</li>
          <li>Kamar</li>
        </ul>
      </div>
    </div>
  </div>

  <a class="mouse smoothscroll" href="#next">
    <div class="mouse-icon">
      <span class="mouse-wheel"></span>
    </div>
      </a>
</section>
    <!-- END section -->
<section class="section bg-primary">
  <div class="container">
    <?php foreach($query as $row){$harga = number_format($row['harga'], '0', ',', '.')?>
  <div class="site-block-half d-block d-lg-flex bg-white">
    <a href="<?= "reservation.php?qbr={$row['halaman_id']}"?>" class="image d-block bg-image-2" style="background-image: url('images/<?= $row['image']?>');"></a>
    <div class="text">
      <span class="d-block mb-4"><span class="display-4 text-primary"><?="Rp.{$harga}"?></span> </br><span class="text-uppercase letter-spacing-2">/ per malam</span> </span>
      <h2 class="mb-4"><?= $row['jenis_kamar']?></h2>
      <p><?= $row['keterangan']?></p>
      <p><a href="<?= "reservation.php?qbr={$row['halaman_id']}"?>" class="btn btn-primary text-white">Reservasi</a> <a href="rooms.php">↩Lihat kamar-kamar lain</a></p>
    </div>
  </div>
  <?php };?>
  </div>
</section>

<?php 
include("1foot.php");
?>