<?php
# dapatkan tanggal + waktu = date("Y-m-d H:i:s")
date_default_timezone_set('Asia/Jakarta');
include("connect.php");session_start();if($_SESSION['account'] != true){header("Location: login.php");};
if(isset($_POST['logout'])){session_destroy(); header("Location: login.php");};
$sql = "SELECT * FROM aktivitas ORDER BY waktu DESC";
$query = $connect->query($sql);
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
                        <h1 class="mt-4">Dashboard Aktivitas Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard Aktivitas Admin</li>
                        </ol>                    
                       
                        <!-- Data Table -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Table Aktivitas Admin
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama lengkap</th>
                                            <th>Perubahan</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($query->num_rows > 0) {
                                        while($row = $query ->fetch_assoc()) {?>
                                        <tr>
                                            <td><?= $row['admin_username']?></td>
                                            <td><?= $row['admin_fullname']?></td>
                                            <td><?= $row['perubahan']?></td>
                                            <td><?= $row['waktu']?></td>
                                        </tr>
                                        <?php };};?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama lengkap</th>
                                            <th>Perubahan</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus semua data?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="submit" class="btn btn-danger text-white font-weight-bold">Lanjut</button>
                                </div>
                            </div>
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
