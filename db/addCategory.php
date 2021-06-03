<?
    require_once "./Db.php";
    require_once "./connect.php";

    $category = $_POST['category'];

    Db::insertToTable("category", [
        'name' => $category,
    ]);

    header("Location: ../adminPanel.php");
?>