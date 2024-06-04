<?php date_default_timezone_set('Asia/Jakarta'); include("connect.php"); session_start(); if($_SESSION['account'] != true){header("Location: login.php");};if(isset($_POST['logout'])){session_destroy(); header("Location: login.php");} 

$sql = "SELECT * FROM admins";
$query = $connect->query($sql);

if(isset($_POST['submit'])){
    $sqlad = "SELECT username, fullname FROM admins WHERE username = '{$_SESSION['account']}'";$queryad = $connect->query($sqlad);foreach($queryad as $qad){$ad_user=$qad['username'];$ad_full=$qad['fullname'];};
    $jd = $_POST['username'];
    $waktu = date("Y-m-d H:i:s");

    $perubahan = ('<span class="text-success">Menambahkan</span> data [Admin] "'.$jd.'"');
    $sql2 = "INSERT INTO aktivitas (admin_username, admin_fullname, perubahan, waktu) VALUES ('{$ad_user}', '{$ad_full}', '{$perubahan}', '{$waktu}')";
    $connect->query($sql2);
    $sql2 = "INSERT INTO admins (username, fullname, password, db_password) VALUES ('{$_POST['username']}', '{$_POST['fullname']}', '{$_POST['password']}', 'DyCsIlAe')";
    $query2 = $connect->query($sql2);
    if($query2){
        header("Location: admin.php");
    };
};

if(isset($_POST['del'])){
    $sqlad = "SELECT username, fullname FROM admins WHERE username = '{$_SESSION['account']}'";$queryad = $connect->query($sqlad);foreach($queryad as $qad){$ad_user=$qad['username'];$ad_full=$qad['fullname'];};
    $sqljd = "SELECT username FROM admins WHERE admin_id = '{$_POST['del']}'";$queryjd = $connect->query($sqljd);foreach($queryjd as $qjd){$jd=$qjd['username'];};
    $waktu = date("Y-m-d H:i:s");

    $perubahan = ('<span class="text-danger">Menghapus</span> data [Admin] "'.$jd.'"');
    $sql2 = "INSERT INTO aktivitas (admin_username, admin_fullname, perubahan, waktu) VALUES ('{$ad_user}', '{$ad_full}', '{$perubahan}', '{$waktu}')";
    $connect->query($sql2);

    $sql2 = "DELETE FROM admins WHERE admin_id='{$_POST['del']}'";
    $query3 = $connect->query($sql2);
    if($query3){
        header("Location: admin.php");
    }
};
if(isset($_POST['edit'])){
    $sqlad = "SELECT username, fullname FROM admins WHERE username = '{$_SESSION['account']}'";$queryad = $connect->query($sqlad);foreach($queryad as $qad){$ad_user=$qad['username'];$ad_full=$qad['fullname'];};
    $sqljd = "SELECT username FROM admins WHERE admin_id = '{$_POST['edit']}'";$queryjd = $connect->query($sqljd);foreach($queryjd as $qjd){$jd=$qjd['username'];};
    $waktu = date("Y-m-d H:i:s");

    $perubahan = ('<span class="text-info">Mengubah</span> data [Admin] "'.$jd.'"');
    $sql2 = "INSERT INTO aktivitas (admin_username, admin_fullname, perubahan, waktu) VALUES ('{$ad_user}', '{$ad_full}', '{$perubahan}', '{$waktu}')";
    $connect->query($sql2);

    $sql2 = "UPDATE admins SET username = '{$_POST['username']}', fullname = '{$_POST['fullname']}', password = '{$_POST['password']}' WHERE admin_id='{$_POST['edit']}'";
    $query3 = $connect->query($sql2);
    if($query3){
        header("Location: admin.php");
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
                        <h1 class="mt-4">Dashboard Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard Admin</li>
                        </ol>

                        <!-- Data Table -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Table Admin
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama penuh</th>
                                            <th>Password</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                    foreach($query as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $row['username']; ?></td>
                                            <td><?= $row['fullname']; ?></td>
                                            <td><?= $row['password']; ?></td>
                                            <td>
                                                <form action="" method="POST" class="d-flex gap-2">
                                                    <button type="submit" value="<?= $row['admin_id']?>" name="del" class="btn btn-danger">Hapus</button>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $row['admin_id']?>">Ubah</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php }; ?>
                                    </tbody>
                                   
                                    <tfoot>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama penuh</th>
                                            <th>Password</th>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="username" type="text" name="username" placeholder="Username" required aria-required="true"/>
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Nama Penuh" required aria-required="true"/>
                                    <label for="fullname">Nama Penuh</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password" type="text" name="password" placeholder="Password" required aria-required="true"/>
                                    <label for="password">Password</label>
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

                         
                            <!-- Modal 2 (Edit) -->
                            <?php foreach($query as $row){?>
                                <div class="modal fade" id="edit<?= $row['admin_id']?>" tabindex="-1" aria-labelledby="edit<?= $row['admin_id']?>Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="edit<?= $row['admin_id']?>Label">Ubah Data Admin</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="username" type="text" name="username" placeholder="Username" required aria-required="true" value="<?= $row['username'] ?>"/>
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Nama Penuh" required aria-required="true"/ value="<?= $row['fullname'] ?>">
                                    <label for="fullname">Nama Penuh</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password" type="text" name="password" placeholder="Password" required aria-required="true"/ value="<?= $row['password'] ?>">
                                    <label for="password">Password</label>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success" name="edit" value="<?= $row['admin_id'];?>">Ubah</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        </div> <!-- Akhir Modal -->
                            <?php };?>
                
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
