<?php
include_once("koneksi.php");

$id_user = $_POST['id_user'];
$alamat = $_POST['alamat'];
$pass = md5($_POST['paswd']);

$sql = "SELECT * FROM users WHERE id_user='$id_user' AND alamat='$alamat' AND password='$pass'";

session_start();
if ($_POST["captcha_code"] == $_SESSION["captcha_code"]){
    $login = mysqli_query($con, $sql);
    $ketemu = mysqli_num_rows($login);
    $r = mysqli_fetch_array($login);

    if ($ketemu > 0) {
        $_SESSION['iduser'] = $r['id_user'];
         $_SESSION['alamat'] = $r['alamat'];
        $_SESSION['passuser'] = $r['password'];
        echo "USER BERHASIL LOGIN<br>";
        echo "id user =", $_SESSION['iduser'], "<br>";
        echo "alamat =", $_SESSION['alamat'], "<br>";
        echo "password=", $_SESSION['passuser'], "<br>";
        echo "<a href=logout.php><b>LOGOUT</b></a></center>";
    }else {
        echo "<center>Login gagal! username & password tidak benar<br>";
        echo "<a href=form_login.php><b>ULANGILAGI</b></a></center>";
    }
    mysqli_close($con);
}else {
    echo "<center>Login gagal! captcha tidak benar<br>";
    echo "<a href=form_login.php><b>ULANGILAGI</b></a></center>";
}
?>