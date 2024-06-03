<?php include("1head.php") ;$sql = "SELECT * FROM jenis_kamar";$query = $connect->query($sql);
?>

    <section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Rooms</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="./">Home</a></li>
              <li>&bullet;</li>
              <li>Rooms</li>
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
    
    <section class="section bg-light" id="next">
    <h2 class="text-center heading ">Kamar</h2>
      <div class="container d-flex flex-wrap justify-content-md-evenly">
        <?php foreach($query as $row){$harga = number_format($row['harga'], '0', ',', '.');?>
          <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
            <a href="suite.php?q=<?= $row['halaman_id']?>" class="room">
              <figure class="img-wrap">
                <img src="images/<?= $row['image']?>" alt="Foto kamar hotel" class="img-fluid mb-3">
              </figure>
              <div class="p-3 text-center room-info">
                <h2><?= $row['jenis_kamar']?></h2>
                <span class="letter-spacing-1"><?= "Rp.{$harga} / per malam"?></span>
              </div>
            </a>
          </div>
          <?php };?>

        </div
    </section>
    
    
    <?php include("1foot.php") ?>