<?
    require_once "./db/Db.php";
    require_once "./db/connect.php";

    $title = "Admin panel";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?require_once "./views/head.php";?> 
    <link href="./css/admin.css" rel="stylesheet" />
</head>
<body>
   
    <?if (!$_SESSION['admin']):?>
    <div class="form__sign-in">
    <form action="./db/admin.php" method="post">
        <h2>Вход</h2>
        <input type="text" placeholder="Введите логин" name="login" required/>
        <input type="password" placeholder="Введите пароль" name="password" required/>

        <button>Войти</button>
    </form>
    </div>
    <?else:?>
    <div class="admin-logout">
        <img src="./img/exit(blue).svg" alt="">
        <a href="./db/adminLogout.php">Выйти</a>
    </div>
    <div class="admin-app">

    <?
            $editUserId = $_GET['editUser'];

            if ($editUserId):
                
            $user = Db::getOne("user", 'id', $editUserId);
        ?>

            <form action="./db/editUserInfo.php?id=<?=$editUserId?>" method="POST">
                <h2>Изменить информацию о пользователе</h2>
                <label for="">Логин пользователя</label>
                <input type="text" value='<?=$user['login']?>' name="login" />

                <button>Сохранить</button>
            </form>

        <?endif;?>

    <form action="./db/addCard.php" method="POST" enctype="multipart/form-data">
        <h2>Добавить картинку</h2>
        <input type="file" accept="image/*" name="photo" required/> 
        <input type="text" placeholder="Заголовок картинки" name="title" required/>
        <select name="category" id="" required>
            <option value="none" hidden>Выберите категорию</option>
            <?
                $rows = Db::getAll("category");
                foreach ($rows as $row) {
                    echo "
                        <option value='$row[id]'>$row[name]</option>
                    ";
                }
            ?>
        </select>

        <select name="author" id="" required>
            <option value="none" hidden>Выберите автора</option>
            <?
                $authors = Db::getAll("author");

                foreach ($authors as $author) {
                    echo "
                        <option value='$author[id]'>$author[name]</option>
                    ";
                }
            ?>
        </select>
        <button>Сохранить</button>
    </form>

    <form action="./db/addAuthor.php" method="POST">
        <h2>Добавить автора</h2>

        <input type="text" placeholder="Введите имя автора" name="author">

        <button>Сохранить</button>
    </form>

    <form action="./db/addCategory.php" method="POST">
        <h2>Добавить категорию</h2>

        <input type="text" placeholder="Введите категорию" name="category"/>

        <button>Сохранить</button>
    </form>

    <form action="./db/deleteCard.php" method="POST">
        <h2>Удалить карточку</h2>

        <input type="text" placeholder="Введите id карточки" name="id" />

        <button>Удалить</button>
    </form>

    <form action="./db/deleteAuthor.php" method="POST">
        <h2>Удалить автора</h2>
        <option value="none" hidden>Выберите автора к-го нужно удалить</option>
        <select name="author" id="">
            <?
                $authors = Db::getAll("author");

                foreach ($authors as $author) {
                    echo "
                    <option value='$author[id]'>
                        $author[name]
                    </option>
                ";
                }
            ?>
        </select>

        <button>Удалить</button>
    </form>

    </div>

    <div class="tables">
        <h2>Все комментарии</h2>
        <table border='1'>
            <th>Комметарий к карточке</th>
            <th>Пользователь</th>
            <th>Текст комментария</th>
            <th>Действия</th>
            <?
                $comments = Db::getComments();

                foreach ($comments as $comment) {
                    echo "
                        <tr>
                            <td><a href='./photo.php?id=$comment[card_id]'>Карточка</td>
                            <td>$comment[login]</td>
                            <td>$comment[text]</td>
                            <td><a href='./db/deleteComment.php?id=$comment[comment_id]'>Удалить комментарий</td>
                        </tr>
                    ";
                }
            ?>
        </table>

        <h2>Все пользователи</h2>    

        <table border='1'>
            <th>id пользователя</th>
            <th>Имя пользователя</th>
            <th colspan="2">Действия</th>
            <?
                $users = Db::getAll("user");

                foreach ($users as $user) {
                    echo "
                        <tr>
                            <td>$user[id]</td>
                            <td>
                                $user[login]
                            </td>
                            <td>
                                <a href='./adminPanel.php?editUser=$user[id]'>
                                    Редактировать информацию
                                </a>
                            </td>
                            <td><a href='./db/deleteUser.php?id=$user[id]'>Удалить пользователя</td>
                        </tr>
                    ";
                }
            ?>
        </table>   
    </div>    
    <?endif;?>
</body>
</html>