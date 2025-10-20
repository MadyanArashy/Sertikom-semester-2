<?php
include("1head.php");
if(isset($_POST['submit'])){

  # ambil harga kamar
  $sqlj = "SELECT harga FROM jenis_kamar WHERE kamar_id = {$_POST['jenis']}";
  $queryj = $connect->query($sqlj);
  foreach($queryj as $j){
  $harga = $j["harga"];
  $tgl1 = new DateTime($_POST['cekin']);
  $tgl2 = new DateTime($_POST['cekout']);
  $selisih = $tgl1->diff($tgl2);
  $menginap = $selisih->days;
  };

  # hitung total harga
  $total = $harga * $_POST['jumlah'] * $menginap;
  
}else if(!isset($_POST['confirm']))(header("Location: reservation.php"));
if(isset($_POST['confirm'])){
  # ambil harga kamar
  $sqlj = "SELECT harga FROM jenis_kamar WHERE kamar_id = {$_POST['jenis']}";
  $queryj = $connect->query($sqlj);
  foreach($queryj as $j){
  $harga = $j["harga"];
  $tgl1 = new DateTime($_POST['cekin']);
  $tgl2 = new DateTime($_POST['cekout']);
  $selisih = $tgl1->diff($tgl2);
  };

  $nama = htmlspecialchars($_POST['nama'] );
  $catatan = htmlspecialchars($_POST['catatan']);
  # total harga (harga x jumlah kamar x hari menginap)
  $total = $harga * $_POST['jumlah'] * $selisih->days;
  
  
  $sql = "INSERT INTO reservasi_kamar (kamar_id, nama, cekin, cekout, no_identitas, no_hp, jumlah_kamar, total, catatan) VALUES ('{$_POST['jenis']}', '{$nama}', '{$_POST['cekin']}', '{$_POST['cekout']}', '{$_POST['identitas']}', '{$_POST['no_hp']}', '{$_POST['jumlah']}', '{$total}', '{$catatan}')";
  $query = $connect->query($sql);
  $sqlpop1 = "SELECT count(*) FROM reservasi_kamar  WHERE kamar_id = '{$_POST['jenis']}'";$querypop1 = $connect->query($sqlpop1);foreach($querypop1 as $q){$popularitas = $q['count(*)'];}
  $sqlpop2 = "UPDATE jenis_kamar SET popularitas = $popularitas WHERE kamar_id = '{$_POST['jenis']}'"; $querypop2 = $connect->query($sqlpop2);
  echo "
  <script>
    alert('Anda telah berhasil reservasi kamar!');
    window.location.href = 'reservation.php#next';
  </script>
  ";
};
if(isset($_POST['rev-edit'])){
  $_SESSION['revisi'] = true;
  $_SESSION['rev-data-1'] = $_POST['nama'];
  $_SESSION['rev-data-2'] = $_POST['identitas'];
  $_SESSION['rev-data-3'] = $_POST['no_hp'];
  $_SESSION['rev-data-4'] = $_POST['jumlah'];
  $_SESSION['rev-data-5'] = $_POST['cekin'];
  $_SESSION['rev-data-6'] = $_POST['cekout'];
  $_SESSION['rev-data-7'] = $_POST['jenis'];
  $_SESSION['rev-data-8'] = $_POST['catatan'];

  header("Location: reservation.php#next");
}
?>
<section class="section contact-section" id="next">
      <div class="container">
        <h1 class="heading-1 text-center font-weight-bold">Konfirmasi</h1>
        <div class="row">
          <div class="col-md-7 mx-auto">
            
            <form action="" method="POST" class="bg-white p-md-5 p-4 mb-5 border">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="name">Nama lengkap</label>
                  <input type="text" id="nama" class="form-control" disabled readonly value="<?= $_POST['nama']?>">
                  <input type="hidden" name="nama" value="<?= $_POST['nama']?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="identitas">No Identitas</label>
                  <input type="text" id="identitas" class="form-control" maxlength="13" minlength="13" maxlength="13" disabled readonly value="<?= $_POST['identitas']?>">
                  <input type="hidden" name="identitas" value="<?= $_POST['identitas']?>">
                </div>
              </div>
          
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="no_hp">No Handphone</label>
                  <input type="tel" id="no_hp" class="form-control" name="no_hp" maxlength="16" disabled readonly value="<?= $_POST['no_hp']?>">
                  <input type="hidden" name="no_hp" value="<?= $_POST['no_hp']?>">
                </div>
                <div class="col-md-6 form-group">
                  <label for="jumlah" class="text-black font-weight-bold">Jumlah Kamar</label>
                  <input type="number id="jumlah" class="form-control" disabled readonly value="<?= $_POST['jumlah']?>">
                  <input type="hidden" name="jumlah" value="<?= $_POST['jumlah']?>">
                  
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="cekin">Check In</label>
                  <input type="date" id="cekin" class="form-control" disabled readonly value="<?= $_POST['cekin']?>">
                  <input type="hidden" name="cekin" value="<?= $_POST['cekin']?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="cekout">Check Out</label>
                  <input type="date" id="cekout" class="form-control" disabled readonly value="<?= $_POST['cekout']?>">
                  <input type="hidden" name="cekout" value="<?= $_POST['cekout']?>">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="jenis" class="font-weight-bold text-black">Jenis Kamar</label>
                  <input type="text" class="form-control" disabled readonly value="<?php $sqlt="SELECT jenis_kamar,harga FROM jenis_kamar WHERE kamar_id = '{$_POST['jenis']}'";$q=$connect->query($sqlt); $ans=$q->fetch_assoc();$harga2 = number_format($ans['harga'], '0', ',', '.'); echo "{$ans['jenis_kamar']} (Rp.{$harga2})"?>" id="jenis">
                  <input type="hidden" name="jenis" value="<?= $_POST['jenis']?>">
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-md-12 form-group">
                  <label class="text-black font-weight-bold" for="catatan">Catatan</label>
                  <textarea id="catatan" class="form-control " cols="30" rows="8" disabled readonly><?= $_POST['catatan']?></textarea>
                  <input type="hidden" name="catatan" value="<?= $_POST['catatan']?>">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h3 class="heading-3">Menginap = <b class="font-weight-bold"><?= $selisih->days?> hari</b></h3>
                  <h3>Total = <b class="font-weight-bold">Rp.<?= number_format($total, '0', ',', '.')?></b></h3>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 d-flex">
                  <button type="submit" name="confirm" class="btn btn-primary text-white font-weight-bold me-3">Konfirmasi</button>
                  <button type="submit" name="rev-edit" class="btn btn-secondary text-white font-weight-bold">Ubah</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>   
<?php include("1foot.php"); ?>