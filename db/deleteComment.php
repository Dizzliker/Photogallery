<?
    require_once "./Db.php";
    require_once "./connect.php";

    $id = $_GET['id'];

    Db::deleteFromTable('comment', 'id', $id);

    header("Location: ../adminPanel.php");
?>