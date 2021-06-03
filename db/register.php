<?
    require_once "./Db.php";
    require_once "./connect.php";

    $login = $_POST['login'];
    $password = $_POST['password'];
    $acceptPassword = $_POST['acceptPassword'];

    DB::register($login, $password, $acceptPassword);
?>