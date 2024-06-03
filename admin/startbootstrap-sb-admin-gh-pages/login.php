<?php
include("connect.php");
session_start();
if(isset($_SESSION['account'])){header("Location: ./");};
if(isset($_POST['submit'])) {
    $sql = "SELECT * FROM admins WHERE username = '{$_POST['username']}' AND password = '{$_POST['password']}' AND db_password = '{$_POST['db_password']}' ";
    $query = $connect->query($sql);
    if($query->num_rows>0){
        $_SESSION['account'] = true;
        header("Location: index.php");
    };
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/login-style.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" type="username" name="username" placeholder="Username" required aria-required="true"/>
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Password" required aria-required="true"/>
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="database-password" type="text" name="db_password" placeholder="DB Password" required aria-required="true"/>
                                                <label for="database-password">DB Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                                <input type="submit" class="btn btn-primary" name="submit" value="Login!">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Ekspro Hotel 2024</div>
                            <div>
                                <a href="https://wa.me/6289650098411">Whatsapp</a>
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
    </body>
</html>
