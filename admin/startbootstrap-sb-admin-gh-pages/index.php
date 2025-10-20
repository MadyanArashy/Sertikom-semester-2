<?php date_default_timezone_set('Asia/Jakarta');include("connect.php");session_start();if($_SESSION['account'] != true){header("Location: login.php");};if(isset($_POST['logout'])){session_destroy(); header("Location: login.php");};$sql = "SELECT * FROM reservasi_kamar INNER JOIN jenis_kamar ON reservasi_kamar.kamar_id = jenis_kamar.kamar_id ORDER BY cekin"; $query = $connect->query($sql);
$sqljk = "SELECT * FROM jenis_kamar";$queryjk = $connect->query($sqljk);
if(isset($_POST['submit'])){
  $sqlad = "SELECT username, fullname FROM admins WHERE username = '{$_SESSION['account']}'";$queryad = $connect->query($sqlad);foreach($queryad as $qad){$ad_user=$qad['username'];$ad_full=$qad['fullname'];};
    $jd = $_POST['nama'];
    $waktu = date("Y-m-d H:i:s");

    $perubahan = ('<span class="text-success">Menambahkan</span> data [Reservasi Kamar] "'.$jd.'"');
    $sql2 = "INSERT INTO aktivitas (admin_username, admin_fullname, perubahan, waktu) VALUES ('{$ad_user}', '{$ad_full}', '{$perubahan}', '{$waktu}')";
    $connect->query($sql2);

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
   
   
   $sqls = "INSERT INTO reservasi_kamar (kamar_id, nama, cekin, cekout, no_identitas, no_hp, jumlah_kamar, total, catatan) VALUES ('{$_POST['jenis']}', '{$nama}', '{$_POST['cekin']}', '{$_POST['cekout']}', '{$_POST['identitas']}', '{$_POST['no_hp']}', '{$_POST['jumlah']}', '{$total}', '{$catatan}')";
   $connect->query($sqls);
   $sqlpop1 = "SELECT count(*) FROM reservasi_kamar  WHERE kamar_id = '{$_POST['jenis']}'";$querypop1 = $connect->query($sqlpop1);foreach($querypop1 as $q){$popularitas = $q['count(*)'];}
   $sqlpop2 = "UPDATE jenis_kamar SET popularitas = $popularitas WHERE kamar_id = '{$_POST['jenis']}'"; $querypop2 = $connect->query($sqlpop2);

   echo "<script>action('reservasi telah dibuat');window.location.href('./')</script>";
   return header("Location: ./");
};
if(isset($_POST['del'])){
  $sqlad = "SELECT username, fullname FROM admins WHERE username = '{$_SESSION['account']}'";$queryad = $connect->query($sqlad);foreach($queryad as $qad){$ad_user=$qad['username'];$ad_full=$qad['fullname'];};
  $sqljd = "SELECT nama FROM reservasi_kamar WHERE reservasi_id = '{$_POST['del']}'";$queryjd = $connect->query($sqljd);foreach($queryjd as $qjd){$jd=$qjd['nama'];};
  $waktu = date("Y-m-d H:i:s");

  $perubahan = ('<span class="text-danger">Menghapus</span> data [Reservasi Kamar] "'.$jd.'"');
  $sql2 = "INSERT INTO aktivitas (admin_username, admin_fullname, perubahan, waktu) VALUES ('{$ad_user}', '{$ad_full}', '{$perubahan}', '{$waktu}')";
  $connect->query($sql2);

  $sql2 = "DELETE FROM reservasi_kamar WHERE reservasi_id='{$_POST['del']}'";
  $query3 = $connect->query($sql2);
  if($query3){
    $sqlpop1 = "SELECT count(*) FROM reservasi_kamar  WHERE kamar_id = '{$_POST['kamar_id']}'";$querypop1 = $connect->query($sqlpop1);foreach($querypop1 as $q){$popularitas = $q['count(*)'];}
  $sqlpop2 = "UPDATE jenis_kamar SET popularitas = $popularitas WHERE kamar_id = '{$_POST['kamar_id']}'"; $querypop2 = $connect->query($sqlpop2);
      header("Location: ./");
  }
};
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Ekspro Hotel</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include("navbar.php") ?>
        <?php include("sidenav.php") ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard Reservasi Kamar</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard Reservasi Kamar</li>
                        </ol>                    
                       
                        <!-- Data Table -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Table Reservasi Kamar
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama lengkap</th>
                                            <th>No. Identitas</th>
                                            <th>No. Handphone</th>
                                            <th>Jenis Kamar</th>
                                            <th>Jumlah Kamar</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Catatan</th>
                                            <th>Total</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($query->num_rows > 0) {
                                        while($row = $query ->fetch_assoc()) {?>
                                        <tr>
                                            <td><?= $row['nama']?></td>
                                            <td><?= $row['no_identitas']?></td>
                                            <td><?= $row['no_hp']?></td>
                                            <td><?= $row['jenis_kamar']?></td>
                                            <td><?= $row['jumlah_kamar']?></td>
                                            <td style="white-space: nowrap;">
                                              <?php
                                              $cekin = new DateTime($row['cekin']);

                                              $hari_cekin = $cekin->format('d'); 
                                              $bulan_cekin = $cekin->format('m'); 
                                              $tahun_cekin = $cekin->format('Y');

                                              switch($bulan_cekin){
                                                case'01':$bulan_cekin="Januari";break;
                                                case'02':$bulan_cekin="Februari";break;
                                                case'03':$bulan_cekin="Maret";break;
                                                case'04':$bulan_cekin="April";break;
                                                case'05':$bulan_cekin="Mei";break;
                                                case'06':$bulan_cekin="Juni";break;
                                                case'07':$bulan_cekin="Juli";break;
                                                case'08':$bulan_cekin="Agustus";break;
                                                case'09':$bulan_cekin="September";break;
                                                case'10':$bulan_cekin="Oktober";break;
                                                case'11':$bulan_cekin="November";break;
                                                case'12':$bulan_cekin="Desember";break;};

                                                echo ("{$row['cekout']} <br> ({$hari_cekin} {$bulan_cekin} {$tahun_cekin})");
                                              ?>
                                            </td>
                                            <td style="white-space: nowrap;">
                                              <?php 
                                              $cekout = new DateTime($row['cekout']);

                                              $hari_cekout = $cekout->format('d'); 
                                              $bulan_cekout = $cekout->format('m'); 
                                              $tahun_cekout = $cekout->format('Y');

                                              switch($bulan_cekout){
                                                case'01':$bulan_cekout="Januari";break;
                                                case'02':$bulan_cekout="Februari";break;
                                                case'03':$bulan_cekout="Maret";break;
                                                case'04':$bulan_cekout="April";break;
                                                case'05':$bulan_cekout="Mei";break;
                                                case'06':$bulan_cekout="Juni";break;
                                                case'07':$bulan_cekout="Juli";break;
                                                case'08':$bulan_cekout="Agustus";break;
                                                case'09':$bulan_cekout="September";break;
                                                case'10':$bulan_cekout="Oktober";break;
                                                case'11':$bulan_cekout="November";break;
                                                case'12':$bulan_cekout="Desember";break;};

                                                echo ("{$row['cekout']} <br> ({$hari_cekout} {$bulan_cekout} {$tahun_cekout})");
                                              ?>
                                            </td>
                                            <td><?= $row['catatan']?></td>
                                            <td><?= $row['total']?></td>
                                    
                                            <td>
                                            <form action="" method="POST" class="d-flex gap-2">
                                                <input type="hidden" name="kamar_id" value="<?= $row['kamar_id']?>">
                                                <button type="submit" value="<?= $row['reservasi_id']?>" name="del" class="btn btn-danger">Hapus</button>
                                            </form>
                                            </td>
                                        </tr>
                                        <?php };};?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama lengkap</th>
                                            <th>No. Identitas</th>
                                            <th>No. Handphone</th>
                                            <th>Jenis Kamar</th>
                                            <th>Jumlah Kamar</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Catatan</th>
                                            <th>Total</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambahkan</button>
                    </div>
                   
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Reservasi Hotel</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form -->
                            <form action="" method="post" class="bg-white p-md-5 p-4 mb-5 border">
                              <div class="row">
                                <div class="col-md-6 form-group">
                                  <label class="text-black font-weight-bold" for="name">Nama lengkap</label>
                                  <input type="text" id="nama" class="form-control" name="nama" required >
                                </div>
                                <div class="col-md-6 form-group">
                                  <label class="text-black font-weight-bold" for="identitas">No Identitas</label>
                                  <input type="text" id="identitas" class="form-control" maxlength="13" name="identitas" minlength="13" maxlength="13" required >
                                </div>
                              </div>
                          
                              <div class="row">
                                <div class="col-md-6 form-group">
                                  <label class="text-black font-weight-bold" for="no_hp">No Handphone</label>
                                  <input type="tel" id="no_hp" class="form-control" name="no_hp" maxlength="16" required >
                                </div>
                                <div class="col-md-6 form-group">
                                  <label for="jumlah" class="text-black font-weight-bold">Jumlah Kamar</label>
                                  <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required >
                                  
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6 form-group">
                                  <label class="text-black font-weight-bold" for="cekin">Check In</label>
                                  <input type="date" id="cekin" class="form-control" name="cekin" placeholder="dd/mm/yy" required >
                                </div>
                                <div class="col-md-6 form-group">
                                  <label class="text-black font-weight-bold" for="cekout">Check Out</label>
                                  <input type="date" id="cekout" class="form-control" name="cekout" required >
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12 form-group">
                                  <label for="jenis" class="font-weight-bold text-black">Jenis Kamar</label>
                                  <div class="field-icon-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="jenis" id="jenis" class="form-control" required>
                                      <option disabled <?="selected"?> value="">-- Pilih salah satu --</option>
                                      <?php foreach($queryjk as $row) {$harga2 = number_format($row['harga']);?>
                                      <option class="text-black" value="<?=$row['kamar_id'];?>"><?="{$row['jenis_kamar']} ({$harga2})";?></option>
                                      <?php };?>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="row mb-4">
                                <div class="col-md-12 form-group">
                                  <label class="text-black font-weight-bold" for="catatan">Catatan</label>
                                  <textarea name="catatan" id="catatan" class="form-control " cols="30" rows="8"></textarea>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 form-group">
                                  <button type="submit" name="submit" class="btn btn-info text-white font-weight-bold">Masukkan</button>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    </div>

                </main>
                
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Expro Hotel</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/simple-datatables.js"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
