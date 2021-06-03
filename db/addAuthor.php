<?
    require_once "./Db.php";
    require_once "./connect.php";

    $author = $_POST['author'];

    Db::insertToTable("author", [
        'name' => $author,
    ]);

    header("Location: ../adminPanel.php");
?>