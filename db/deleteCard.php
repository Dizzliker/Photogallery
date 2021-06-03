<?
    require_once "./Db.php";
    require_once "./connect.php";

    $id = $_POST['id'];

    Db::deleteFromTable('card', 'id', $id);

    header("Location: ../adminPanel.php");
?>