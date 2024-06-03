<?php include("connect.php");session_start();if($_SESSION['account'] != true){header("Location: login.php");};if(isset($_POST['logout'])){session_destroy(); header("Location: login.php");};$sql = "SELECT * FROM reservasi_kamar INNER JOIN jenis_kamar ON reservasi_kamar.kamar_id = jenis_kamar.kamar_id"; $query = $connect->query($sql);
if(isset($_POST['submit'])){
    $total = $harga * $_POST['jumlah'];
    $sql = "INSERT INTO reservasi_kamar (kamar_id, nama, cekin, cekout, no_identitas, no_hp, jumlah_kamar, total, catatan) VALUES ('{$_POST['jenis']}', '{$_POST['nama']}', '{$_POST['cekin']}', '{$_POST['cekout']}', '{$_POST['identitas']}', '{$_POST['no_hp']}', '{$_POST['jumlah']}', '$total', '{$_POST['catatan']}')";
    $query2 = $connect->query($sql2);
    if($query2){
        header("Location: admin.php");
    };
};
if(isset($_POST['del'])){
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
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="./">Ekspro Dashboard</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Float Right-->
            <div class="d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><form action="" method="POST"><input type="submit" name="logout" class="dropdown-item" value="Logout"></form></li>
                    </ul>
                </li>
            </ul>
        </nav>
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
                                            <td><?= $row['cekin']?></td>
                                            <td><?= $row['cekout']?></td>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form -->
                            <form action="#" method="post" class="bg-white p-md-5 p-4 mb-5 border">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="name">Nama lengkap</label>
                  <input type="text" id="nama" class="form-control" name="nama">
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="identitas">No Identitas</label>
                  <input type="text" id="identitas" class="form-control" maxlength="13" name="identitas" minlength="13" maxlength="13">
                </div>
              </div>
          
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="no_hp">No Handphone</label>
                  <input type="tel" id="no_hp" class="form-control" name="no_hp" maxlength="16">
                </div>
                <div class="col-md-6 form-group">
                  <label for="jumlah" class="text-black font-weight-bold">Jumlah Kamar</label>
                  <input type="number" name="jumlah" id="jumlah" class="form-control">
                  
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="cekin">Check In</label>
                  <input type="date" id="cekin" class="form-control" name="cekin">
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="cekout">Check Out</label>
                  <input type="date" id="cekout" class="form-control" name="cekout">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="jenis" class="font-weight-bold text-black">Jenis Kamar</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="jenis" id="jenis" class="form-control">
                    <option selected disabled value="">-- Pilih salah satu --</option>
                      <?php foreach($queryk as $row){ ?>
                      <option class="text-black" value="<?=$row['kamar_id'];?>"><?=$row['jenis_kamar'];};?></option>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="submit" class="btn btn-success text-white font-weight-bold">Masukkan</button>
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
