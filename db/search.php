<?
    require_once "./Db.php";
    require_once "./connect.php";

    $text = $_POST['text'];

    $result = Db::search($text);

    echo $result;
?>