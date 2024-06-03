<?php
if($_SESSION['account'] == null){
    header("Location: startbootstrap-sb-admin-gh-pages/login.php");
} else {
    header("Location: startbootstrap-sb-admin-gh-pages/");
};
