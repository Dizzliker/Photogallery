<?
    require_once "./Db.php";
    require_once "./connect.php";

    $id = $_POST['author'];

    Db::deleteFromTable('author', 'id', $id);

    header("Location: ../adminPanel.php");
?>