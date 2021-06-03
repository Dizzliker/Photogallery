<?
    require_once "./Db.php";
    require_once "./connect.php";

    $login = $_POST['login'];
    $password = $_POST['password'];

    DB::login($login, $password);
?>