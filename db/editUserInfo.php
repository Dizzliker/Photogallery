<?
    require_once "./Db.php";
    require_once "./connect.php";

    $id = $_GET['id'];
    $login = $_POST['login'];

    Db::editTableInfo('user', 'id', $id, [
        'login' => $login,
    ]);

    header("Location: ../adminPanel.php");
?>