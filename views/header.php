<!-- Шапка для каждой страницы -->

<header>
    <div class="header__content">
        <a href="/" class="logo">Главная страница</a>
        <form action="#" method="post" class="form-search">
            <input type="text" placeholder="Поиск" class="input-search"/>
            <button>
                <img src="./img/loupe.svg" alt="Найти">
            </button>
        </form>
        <?if (!$_SESSION['user']):?>
        <div class="sign-in">
            <!-- Если пользователь не авторизован,
            показыем ему текст входа -->
            <img src="./img/user.svg" alt="">
            <p>
                Войти
            </p>
        </div>
            <!-- Иначе показываем выход из акка -->
        <?else:?>
        <div class="logout-box">
            <a href="./db/logout.php" title="Нажмите чтобы выйти из аккаунта">
                <img src="./img/exit.svg" alt="">
            </a>
            <p>
                <?=$_SESSION['user']['login'];?>
            </p> 
        </div>
        <?endif;?>
</header>

<!-- Форма авторизации и регистрации -->
<?require_once "./views/signInForm.php";?>
<?require_once "./views/signUpForm.php";?>

<!-- Скрипты для показа, скрытия формы -->
<script src="../js/auth.js" type="module"></script>

<script src="./js/register.js"></script>
<script src="./js/login.js"></script>