<?  
    require_once "./db/Db.php";
    require_once "./db/connect.php";

    $title = "Gallery";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?require_once "./views/head.php";?>
    <link href="./css/photo.css" rel="stylesheet" />
</head>
<body>
    <?require_once "./views/header.php";?>

    <div class="container">
        <?
            $id = $_GET['id'];
            $card = Db::getOneCard("id", $id);
        ?>

        <div class="card">
            <div class="card__photo">
                <img src="<?=$card[0]['src']?>" alt="" class="card__img">
            </div>

            <div class="card__info">
                <div class="card__text">
                    <h2 class="card__title"><?=$card[0]['title']?></h2>

                    <ul class="card__info-list">
                        <li>
                            Категория: 
                            <?=$card[0]['category_name']?>
                        </li>
                        <li>
                            Автор: 
                            <?=$card[0]['author_name']?>
                        </li>
                        <li>
                            Дата публикации: 
                            <?=$card[0]['date'];?>
                        </li>
                        <li>
                            Поделиться: 
                            <script src="https://yastatic.net/share2/share.js"></script>
                            <div style="margin-top: 5px" class="ya-share2" 
                            data-curtain data-size="l"
                            data-services="vkontakte,telegram,whatsapp"></div>
                        </li>
                    </ul>
                </div>
               

                <div class="card__actions">
                    <a href="<?=$card[0]['src']?>" class="btn btn-download" download="">Скачать</a>
                    <a href="#" class="btn btn-like">
                        <img src="./img/like.svg" alt="" class="icon-like">
                        Мне нравится
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="feedback">
        <h2>Оставить комментарий</h2>
        <?if ($_SESSION['user']):?>
        <form action="./db/addComment.php?id=<?=$_GET['id']?>" method="POST">
            <div class="feedback__user">
                <img src="./img/user.svg" class = "feedback__img" alt="">
            </div>
            <div class="feedback_container">
                <h2><?=$_SESSION['user']['login']?></h2>
                <textarea placeholder="Введите свой текст здесь" name="text"></textarea>
                <button>Оставить комментарий</button>
            </div>
        </form>
        <?else:?>
            <div class="non-auth-user">
                <p>
                    Для того, чтобы оставить комментарий необходимо <a href="#" class="btn-show-form">Авторизоваться</a>
                </p>
            </div>
        <?endif;?>
    </section>

    <section class="comments">
        <h2>Комментарии</h2>

        <?
            $comments = Db::getAllComments($id);

            if ($comments) {
                foreach ($comments as $comment) {
                    echo "
                        <div class='comment'>
                            <div class='comment__user'>
                                <img src='./img/user.svg' alt='Картинка'>
                            </div>
    
                            <div class='comment__container'>
                                <h3>$comment[login]</h3>
    
                                <div class='comment__text'>
                                    <p>
                                        $comment[text]
                                    </p>
                                </div>
                            </div>
                        </div>
                    ";
                }
            } else {
                echo "
                    <div class='no-comments'>
                        <p>Пока нет ни одного комментария</p>
                    </div>
                ";
            }
        ?>
        
    </section>

    <script src="./js/photo.js" type="module"></script>
</body>
</html>