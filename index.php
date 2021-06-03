<?
    require_once "./db/Db.php";
    require_once "./db/connect.php";

    $title = "Photogallery";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?require_once "./views/head.php";?>
</head>
<body>
    <?require_once "./views/header.php";?>

    <div class="app">
    <aside>
        <h2 class="aside__header">Категории</h2>

        <ul class="aside__menu">
            <?
                $categories = Db::getAll("category");

                foreach ($categories as $category) {
                    echo "
                        <li>
                            <a href='./index.php?category=$category[id]'>
                                $category[name]
                            </a>
                        </li>
                    ";
                }
            ?>
        </ul>
    </aside>
    
    <section class="cards">
        <?
            $category = $_GET['category'];

            if (empty($category)) {
                $cards = Db::getAllCards();
            } else {
                $cards = Db::getOneCard('category', $category);
            }

            foreach ($cards as $card) {
                echo "
                    <div class='card'>
                        <a href='photo.php?id=$card[card_id]'>
                        <div class='card__photo'>
                            <img src='$card[src]' alt='Картинка'>
                        </div>
                    
                            <div class='card__title'>
                                $card[title]
                            </div>

                            <div class='card__category'>
                                $card[category_name]
                            </div>
                        </a>
                    </div>
                ";
            }
            
        ?>
    </section>         
    </div>

    <script src="./js/search.js"></script>
</body>
</html>