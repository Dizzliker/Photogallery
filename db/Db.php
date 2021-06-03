<?
    class DB {
        // Переменная, к-ая храти PDO класс подключения к базе
        protected static $dbh;

        // Метод подключения к базе
        public static function connect(
            $dbname, 
            $host = "localhost", 
            $login = "root", 
            $password = "", 
            $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES =>false,
            ]) 
        {
            self::$dbh = null;
            try {
                self::$dbh = new PDO("mysql:host = $host; dbname=$dbname", $login, $password, $opt);
            } catch (PDOException $e) {
                die($e->getMEssage());
            }
            return self::$dbh;
        }

        // Метод для просмотра ошибок, чтобы массив распечатывался в удобном виде
        public static function printArray($array) {
            echo "<pre>".print_r($array, true)."</pre>";
        }

        // Метод, проверяющий, пустая ли переменная
        public static function checkEmpty($item) {
            if (!empty($item)) {
                return true;
            }
            return false;
        }

        // Метод проверяющий тип переменной 
        public static function checkType($item, $type) {
            if (gettype($item) == $type) {
                return true;
            }
            return false;
        }

        // Метод для поиска карточек по названию или категории
        public static function search($text) {
            $output = "";
            $query = "SELECT *,
            card.id as card_id,
            category.name as category_name
            FROM card 
            JOIN category ON card.category = category.id
            JOIN photo ON card.img = photo.id
            WHERE (title LIKE '%$text%' OR category.name LIKE '%$text%') OR
            (title LIKE '%$text%' AND category.name LIKE '%$text%')";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute();
            $cards = $stmt->fetchAll();
            foreach ($cards as $card) {
                $output .= "
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
            return $output;
        }

        // Метод изменения информацию в таблице, $values - это ассоциативный массив, вида key => value, где 
        // key - название колонки, а value - новое значение этой колонки
        public static function editTableInfo($tableName, $column, $item, $values) {
            $queryText = "";
            $i = 1;
            foreach ($values as $col => $value) {
                if ($i < count($values)) {
                    $queryText .= " $col = '$value' ,";
                } else {
                    $queryText .= " $col = '$value' ";
                }
                $i++;
            }
            $query = "UPDATE $tableName SET" .$queryText." WHERE $column = ?";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute([$item]);
        }

        // Метод получения всех комментарий из базы, специально для админ панели
        public static function getComments() {
            $query = "SELECT *,
            user.id as userId,
            comment.id as comment_id
            FROM comment
            JOIN user ON comment.user_id = user.id";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        // Метод получения комментариев к определенной карточке
        public static function getAllComments($id) {
            $query = "SELECT * FROM comment
            JOIN user ON comment.user_id = user.id
            WHERE comment.card_id = ?";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute([$id]);
            $rows = $stmt->fetchAll();
            return $rows;
        }

        // Метод, который берёт всю информацию из таблицы
        public static function getAll($tableName) {
            $query = "SELECT * FROM $tableName";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        // Метод, который берёт определенную инфомрацию из таблицы, где $column - колонка, по которой ищем
        // а $item - это значение, по которому мы ищем
        public static function getOne($tableName, $column, $item) {
            $query = "SELECT * FROM $tableName WHERE $column = ?";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute([$item]);
            $rows = $stmt->fetch();
            return $rows;
        }

        // Метод формативания даты в нужный вид
        public static function formatDate($date) {
            return date('d M Y', $date);
        }

        // Метод, к-ый берёт информацию из базы с ограничением, где $start - начало ограничения
        // а $end - конец ограничения
        public static function getLimited($tableName, $start, $end) {
            $query = "SELECT * FROM $tableName LIMIT $start, $end";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetch();
            return $rows;
        }

        // Метод, к-ый берёт все карточки из базы 
        public static function getAllCards() {
            $query = "SELECT *, card.id as card_id,
            category.name as category_name
            FROM card 
            JOIN photo ON card.img = photo.id
            JOIN category ON card.category = category.id";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        // Метод, удаляющий информацию из таблицы
        public static function deleteFromTable($tableName, $column, $item) {
            $query = "DELETE FROM $tableName WHERE $column = ?";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute([$item]);
        }

        // Метод, к-ый берёт одну карточку из таблицы (нужен для файла photo.php где мы выводим всего 1 карточку)
        public static function getOneCard($column, $item) {
            $query = "SELECT *, 
            card.id as card_id,
            author.name as author_name,
            category.name as category_name
            FROM card 
            JOIN photo ON card.img = photo.id
            JOIN category ON card.category = category.id
            JOIN author ON card.author = author.id
            WHERE card.".$column." = ?";
            $stmt = self::$dbh->prepare($query);
            $stmt->execute([$item]);
            $rows = $stmt->fetchAll();
            return $rows;
        }

        // Метод загрузки файла (картинки в админ панели)
        public static function uploadFile($file) {
            $filename = $file['name'];
            // Директорая файла после загрузки с инпута
            $path = $file["tmp_name"];
            // Новая директория файла, где он будет храниться
            $newPath = "../img/".$filename;
            // Перемещаем файл из старой директории в новую 
            move_uploaded_file($path, $newPath);
            return $newPath;
        }

        // Метод, вставляющий информацию в таблицу ($items - ассоциативный массив key => value)
        // key - название столбика value - значение
        public static function insertToTable($tableName, $items) {
            if (self::checkType($items, "array")) {
                $columns = "";
                $values = "";
                $i = 1;
                foreach ($items as $key=>$value) {
                    if (count($items) == $i) {
                        $columns .= " $key ";
                        $values .= " '$value' ";
                    } else {
                        $columns .= " $key, ";
                        $values .= " '$value', ";
                    }
                    $i++;
                }

                $query = "INSERT INTO $tableName ($columns) VALUES ($values)";
                self::$dbh->prepare($query)->execute();
            } else {
                return "Второй параметр должен быть массивом";
            }
            
        }

        // Метод регистрации пользователя
        public static function register($nickname, $password, $acceptPassword) {
            if 
            (
                self::checkEmpty($nickname) &&
                self::checkEmpty($password) &&
                self::checkEmpty($acceptPassword)
            ) 
            {
                if (strlen($nickname) < 15) {
                    if ($password === $acceptPassword) {
                        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                        self::insertToTable("user", [
                            'login' => $nickname,
                            'password' => $hashPassword,
                        ]);

                        $info = self::getOne("user", 'login', $nickname);
                        $user = [
                            'id' => $info['id'],
                            'login' => $info['login'],
                        ];

                        $_SESSION['user'] = $user;

                        session_start();
                        echo "Успешно";
                    } else {
                        echo "Пароли должны совпадать";
                    }
                } else {
                    echo "Поле имени должно быть не более 15 символов";
                }
            } else {
                echo "Все поля должны быть заполнены";
            }
        }

        // Метод выхода из аккаунта
        public static function logout($item) {
            unset($item);
        }

        // Метод входа для админа
        public static function adminLogin($login, $password) {
            if 
            (
                self::checkEmpty($login) && 
                self::checkEmpty($password)
            ) 
            {
                $query = "SELECT * FROM `admin` WHERE login = '{$login}' AND password = '{$password}'";
                $stmt = self::$dbh->prepare($query);
                $stmt->execute();
                $rows = $stmt->fetch();
                if ($rows) {
                    $admin = [
                        "id" => $rows['id'],
                        "login" => $rows['login'],
                    ];

                    session_start();

                    $_SESSION['admin'] = $admin;
                }
            } 
        }

        // Метод входа для обычного пользователя
        public static function login($login, $password) {
            if 
            (
                self::checkEmpty($login) && 
                self::checkEmpty($password)
            ) 
            {
                $query = "SELECT * FROM user WHERE login = '{$login}'";
                $stm = self::$dbh->prepare($query);
                $stm->execute();
                $count = $stm->rowCount();
                if ($count) {
                    $query = "SELECT * FROM user WHERE login = '{$login}' AND password  = '{$password}'";
                    $stm = self::$dbh->prepare($query);
                    $stm->execute();
                    $info = $stm->fetch();
                    $count = $stm->rowCount();
                    if ($count) {
                        $user = [
                            "id" => $info['id'],
                            "login" => $info['login'],
                        ];

                        session_start();

                        $_SESSION['user'] = $user;

                        echo "Успешно";
                    } else {
                        echo "Неправильно введен пароль";
                    }
                } else {
                    echo "Пользователь с таким логином не найден";
                }
            } else {
                echo "Все поля должны быть заполнены";
            }
        }
    }
?>