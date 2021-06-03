<?
    require_once "./Db.php";
    require_once "./connect.php";

    $title = $_POST['title'];
    $photo = $_FILES['photo'];
    $category = $_POST['category'];
    $author = $_POST['author'];
    $date = date("d.m.Y");

    $path = Db::uploadFile($photo);
    Db::insertToTable('photo', ['src' => $path]);

    $img = Db::getOne('photo', 'src', $path);

    Db::insertToTable('card', [
        'img' => $img['id'],
        'title' => $title,
        'category' => $category,
        'author' => $author,
        'date' => $date,
    ]);

    header("Location: ../adminPanel.php");
?>