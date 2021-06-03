<?
    require_once "./Db.php";
    require_once "./connect.php";

    $text = $_POST['text'];
    $user_id = $_SESSION['user']['id'];
    $card_id = $_GET['id'];

    Db::insertToTable('comment', [
        "user_id" => $user_id,
        'card_id'=> $card_id,
        'text' => $text,
    ]);

    header("Location: ../photo.php?id=$card_id");
?>