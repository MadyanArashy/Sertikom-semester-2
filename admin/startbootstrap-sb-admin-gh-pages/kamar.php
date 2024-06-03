<?php include("connect.php"); session_start(); if($_SESSION['account'] != true){header("Location: login.php");};if(isset($_POST['logout'])){session_destroy();header("Location: login.php");};

function randStr($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{$str = '';$count = strlen($charset);while($length--){$str .= $charset[mt_rand(0, $count-1)];}return $str;};


$sql = "SELECT * FROM jenis_kamar";
$query = $connect->query($sql);

if(isset($_POST['submit'])){
    # buat id untuk halaman kamar
    $halaman = randStr(5); $sqlhal = "SELECT halaman_id FROM jenis_kamar WHERE halaman_id = '$halaman'";$queryhal = $connect->query($sqlhal);
    while($queryhal->num_rows>0){$hal = randStr(5);};

    $sql2 = "INSERT INTO jenis_kamar (jenis_kamar, harga, keterangan, image, halaman_id) VALUES ('{$_POST['jenis']}', '{$_POST['harga']}', '{$_POST['keterangan']}', '{$_POST['image']}', '$halaman')";
    $query2 = $connect->query($sql2);
    if($query2){
        header("Location: kamar.php");
    };
};

if(isset($_POST['del'])){
    $sql2 = "DELETE FROM jenis_kamar WHERE kamar_id='{$_POST['del']}'";
    $query3 = $connect->query($sql2);
    if($query3){
        header("Location: kamar.php");
    }
};
if(isset($_POST['edit'])){
    if($_POST['image'] != null){$img = ", image = '{$_POST['image']}'";} else{$img = '';};
    $sql2 = "UPDATE jenis_kamar SET jenis_kamar = '{$_POST['jenis']}', harga = '{$_POST['harga']}', keterangan = '{$_POST['keterangan']}'$img WHERE kamar_id='{$_POST['edit']}'";
    $query3 = $connect->query($sql2);
    if($query3){
        header("Location: kamar.php");
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
        <a class="navbar-brand ps-3" href="index.php">Ekspro Dashboard</a>
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
                    <h1 class="mt-4">Dashboard Jenis-Jenis Kamar</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard Jenis-Jenis Kamar</li>
                    </ol>

                    <!-- Data Table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Table Jenis Kamar
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Jenis Kamar</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Keterangan</th>
                                        <th>ID unik</th>
                                        <th>Popularitas</th>
                                        <th>Hapus/Ubah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($query as $row){ ?>
                                    <tr>
                                        <td><?= $row['jenis_kamar']?></td>
                                        <td><?= $row['harga']?></td>
                                        <td><?= $row['image']?></td>
                                        <td><?= $row['keterangan']?></td>
                                        <td><?= $row['halaman_id']?></td>
                                        <td><?= $row['popularitas'] ?></td>
                                        <td>
                                            <form action="" method="POST" class="d-flex gap-2">
                                                <button type="submit" value="<?= $row['kamar_id']?>" name="del" class="btn btn-danger">Hapus</button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $row['kamar_id']?>">Ubah</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php }; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Jenis Kamar</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Keterangan</th>
                                        <th>ID unik</th>
                                        <th>Popularitas</th>
                                        <th>Hapus/Ganti</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                        <!-- Tambahkan Data -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambahkan</button>
                    </div>  
                    <!-- Modal 1 -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="tambahLabel">Tambahkan Kamar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <!-- Form -->
                        <form action="#" method="post" class="bg-white p-md-5 p-4 mb-5 border">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                <label class="text-black font-weight-bold" for="jenis">Jenis Kamar</label>
                                <input type="text" id="jenis" class="form-control" name="jenis">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                <label class="text-black font-weight-bold" for="harga">Harga</label>
                                <input type="text" id="harga" class="form-control" name="harga">
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-md-12 form-group">
                                <label class="text-black font-weight-bold" for="image">Foto</label>
                                <input type="file" id="image" class="form-control" name="image">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12 form-group">
                                <label class="text-black font-weight-bold" for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control " cols="30" rows="8"></textarea>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Masukkan</button>
                            </div>
                            </form>
                            </div>
                            </div>
                        </div> <!-- Akhir Modal -->

                    <!-- Modal 2 (Edit) --><?php foreach($query as $row){?>
                    <div class="modal fade" id="edit<?= $row['kamar_id']?>" tabindex="-1" aria-labelledby="editLabel<?= $row['kamar_id']?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editLabel<?= $row['kamar_id']?>">Ubah Data Kamar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <!-- Form -->
                            
                            <form action="#" method="post" class="bg-white p-md-5 p-4 mb-5 border">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                    <label class="text-black font-weight-bold" for="jenis">Jenis Kamar</label>
                                    <input type="text" id="jenis" class="form-control" name="jenis" value="<?= $row['jenis_kamar'];?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                    <label class="text-black font-weight-bold" for="harga">Harga</label>
                                    <input type="text" id="harga" class="form-control" name="harga" value="<?= $row['harga'];?>">
                                    </div>
                                </div>  

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                    <label class="text-black font-weight-bold" for="image">Foto</label>
                                    <input type="file" id="image" class="form-control" name="image" value="<?= $row['image'];?>">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12 form-group">
                                    <label class="text-black font-weight-bold" for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control " cols="30" rows="8"><?= $row['keterangan'];?></textarea>
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" value="<?= $row['kamar_id']?>" name="edit" class="btn btn-success">Ubah</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    </div><?php };?>

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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>
</html>
