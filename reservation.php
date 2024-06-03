<?php include("1head.php"); 
$sqlk = "SELECT * FROM jenis_kamar";
$queryk = $connect->query($sqlk);
if(isset($_SESSION['revisi']) && $_SESSION['revisi'] === true){$rev = 1;}else{$rev=0;}

?>

    <section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Reservasi</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="./">Home</a></li>
              <li>&bullet;</li>
              <li>Reservation</li>
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

    <section class="section contact-section" id="next">
      <div class="container">
        <div class="row">
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            
            <form action="confirm.php" method="post" class="bg-white p-md-5 p-4 mb-5 border">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="name">Nama lengkap</label>
                  <input type="text" id="nama" class="form-control" name="nama" required <?php if($rev){echo "value='{$_SESSION['rev-data-1']}'";}?>>
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="identitas">No Identitas</label>
                  <input type="text" id="identitas" class="form-control" maxlength="13" name="identitas" minlength="13" maxlength="13" required <?php if($rev){echo "value='{$_SESSION['rev-data-2']}'";}?>>
                </div>
              </div>
          
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="no_hp">No Handphone</label>
                  <input type="tel" id="no_hp" class="form-control" name="no_hp" maxlength="16" required <?php if($rev){echo "value='{$_SESSION['rev-data-3']}'";}?>>
                </div>
                <div class="col-md-6 form-group">
                  <label for="jumlah" class="text-black font-weight-bold">Jumlah Kamar</label>
                  <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required <?php if($rev){echo "value='{$_SESSION['rev-data-4']}'";}?>>
                  
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="cekin">Check In</label>
                  <input type="date" id="cekin" class="form-control" name="cekin" placeholder="dd/mm/yy" required <?php if($rev){echo "value='{$_SESSION['rev-data-5']}'";}?>>
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="cekout">Check Out</label>
                  <input type="date" id="cekout" class="form-control" name="cekout" required <?php if($rev){echo "value='{$_SESSION['rev-data-6']}'";}?>>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="jenis" class="font-weight-bold text-black">Jenis Kamar</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="jenis" id="jenis" class="form-control" required>
                      <?php if(isset($_GET['qbr'])){$jk_auto=1;}else{$jk_auto=0;}?>
                      <option disabled <?php if(!$jk_auto && !$rev){echo"selected";} ?> value="">-- Pilih salah satu --</option>
                      <?php foreach($queryk as $row){ $harga2 = number_format($row['harga'], '0', ',', '.');?>
                      <option <?php if(($jk_auto && $_GET['qbr'] == $row['halaman_id']) || $rev && $_SESSION['rev-data-7'] == $row['kamar_id']){echo"selected";} ?> class="text-black" value="<?=$row['kamar_id'];?>"><?="{$row['jenis_kamar']} ({$harga2})";?></option>
                      <?php };?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-md-12 form-group">
                  <label class="text-black font-weight-bold" for="catatan">Catatan</label>
                  <textarea name="catatan" id="catatan" class="form-control " cols="30" rows="8"><?php if($rev){echo "{$_SESSION['rev-data-8']}";}?></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <button type="submit" name="submit" class="btn btn-info text-white py-3 px-5 font-weight-bold">Selanjutnya</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
              <div class="col-md-10 ml-auto contact-info">
                <p><span class="d-block">Address:</span> <span class="text-black"> Jl Poras No 7, Sindang Barang Loji</span></p>
                <p><span class="d-block">Phone:</span> <span class="text-black"> ( 0251 ) 834 - 6223  </span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>   
    <?php include("1foot.php"); 
    # Hapus semua data $_SESSION
    if($rev){
      for($x = 1; $x <= 8; $x++){
        unset( $_SESSION['rev-data-'.$x]);
      };
      unset($_SESSION['revisi']);
    };
    ;?>