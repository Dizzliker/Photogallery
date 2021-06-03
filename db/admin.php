<?
    require_once "./Db.php";
    require_once "./connect.php";

    $login = $_POST['login'];
    $password = $_POST['password'];

    DB::adminLogin($login, $password);

    header("Location: ../adminPanel.php");
?>