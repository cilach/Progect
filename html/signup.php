<?php
require_once '../includ/database.php';
if(isset($_POST['submit'])){
	$login = mysqli_real_escape_string($link, trim($_POST['login']));
	$password1 = mysqli_real_escape_string($link, trim($_POST['password1']));
	$password2 = mysqli_real_escape_string($link, trim($_POST['password2']));
        $email= mysqli_real_escape_string($link, trim($_POST['email']));
	if(!empty($login) && !empty($password1) && !empty($password2)&& !empty($email) && ($password1 == $password2)) {
		$query = "SELECT * FROM `user` WHERE login = '$login'";
		$data = mysqli_query($link, $query);
		if(mysqli_num_rows($data) == 0) {
			$query ="INSERT INTO `user` (login, password,email) VALUES ('$login', SHA('$password2'),('$email'))";
			mysqli_query($link,$query);
			echo 'Всё готово, можете авторизоваться';
			mysqli_close($link);
			exit();
		}
		else {
			echo 'Логин уже существует';
		}

	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>OnlineStore_Practice</title>
    <link href="../css/reset.css" rel="stylesheet" />
    <link href="../css/default.css" rel="stylesheet" />
    <link href="../css/authorization.css" rel="stylesheet" />
</head>
<body>

    <!--Заголовок-->
    <header>
        <h1 class="site_name">Garden Furniture in Ukraine</h1>
        <div id="authentefication">
            <form action="../php/login.php">
                <input type="text" name="login" class="login" placeholder="Login">
                <input type="text" name="password" class="login" placeholder="Password">
                <button type="submit" class="btn_filter">Войти</button>
            </form>
        </div>
    </header>

    <!--Меню-->
    <div id="menu">
        <ul>
            <li><a href="#">Товары</a></li>
            <li><a href="#">Контакты</a></li>
            <li><a href="#">О нас</a></li>
        </ul>
        <form id="search">
            <input type="text" name="searchText" placeholder="Поиск товаров" />
            <button type="submit" name="searchButton">Искать</button>
        </form>
    </div>

    <!--Форма для регистрации-->
    <main>
        <article>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="signup">
                ФИО:<br /><input type="text" name="login" /><br />
                Email:<br /><input type="text" name="email" /><br />
                Пароль:<br /><input type="text" name="password1" /><br />
                Повторите пароль:<br /><input type="text" name="password2" /><br />
                <button type="submit" name="submit">Зарегистрироваться</button>
            </form>
        </article>
    </main>

    <!--Footer-->
    <footer>
        <p>&copy;2018</p>
    </footer>
</body>
</html>
