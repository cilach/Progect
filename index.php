<?php
require_once 'includ/database.php';
require_once 'includ/functions.php';

if(!isset($_COOKIE['user_id'])) {
	if(isset($_POST['submit'])) {
		$user_username = mysqli_real_escape_string($link, trim($_POST['username']));
		$user_password = mysqli_real_escape_string($link, trim($_POST['password']));
		if(!empty($user_username) && !empty($user_password)) {
			$query = "SELECT `user_id` , `username` FROM `signup` WHERE username = '$user_username' AND password = SHA('$user_password')";
			$data = mysqli_query($link,$query);
			if(mysqli_num_rows($data) == 1) {
				$row = mysqli_fetch_assoc($data);
				setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
				setcookie('username', $row['username'], time() + (60*60*24*30));
				$home_url = 'http://' . $_SERVER['HTTP_HOST'];
				header('Location: '. $home_url);
			}
			else {
				echo 'Извините, вы должны ввести правильные имя пользователя и пароль';
			}
		}
		else {
			echo 'Извините вы должны заполнить поля правильно';
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
    <link href="css/reset.css" rel="stylesheet" />
    <link href="css/default.css" rel="stylesheet" />
    <link href="css/products.css" rel="stylesheet" />
    <link href="css/product.css" rel="stylesheet" />
</head>
<body>

    <!--Заголовок-->
    <header>
        <h1 class="site_name"> <a href="html/order.php">Garden Furniture in Ukraine</a></h1>
        <div id="authentefication">
            <?php  if(empty($_COOKIE['username'])) {  ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" name="username" class="login" placeholder="Login">
                <input type="text" name="password" class="login" placeholder="Password">
                <button type="submit" class="btn_filter" name="submit">Войти</button>
                <span> <a href="/html/signup.php">Регистрация</a></span>
            </form>
            <?php  } 
            else { ?>
	<p><a href="includ/myprofile.php">Мой профиль</a></p>
	<p><a href="includ/exit.php">Выйти(<?php echo $_COOKIE['username']; ?>)</a></p>
        <?php  }  ?>
        </div>
    </header>

    <!--Меню-->
    <div id="menu">
        <ul>
            <li><a href="#">Товары</a></li>
            <li><a href="html/contacts.html">Контакты</a></li>
            <li><a href="html/about.html">О нас</a></li>
        </ul>
        <form id="search">
            <input type="text" name="searchText" placeholder="Поиск товаров" />
            <button type="submit" name="searchButton">Искать</button>
        </form>
    </div>

    <!--Товары и Фильтр-->
    <main>

        <!--Товары-->
        <article>
              <?php   $categories = get_categories($link);   ?>
            <!--Название раздела-->
            <h1 class="category_name">Садовая мебель </h1>

            <!--Товары-->
            <div class="flex-container row">
                <?php foreach($categories as $category) :   ?>
                <div class="flex-item color1">
                    
                    
                    <img class="product_image" src="<?=$category["image"]?>" />
                   
                    <br>
                    <a class="product_name" href="http://google.com"><?=$category["name"]?></a>
                   
                   
                    <div class="product_description"><?=$category["description"]?></div>
                    
                    
                    <div class="product_price">
                       
                        <span class="price"><?=$category["price"]?>$</span>
                     
                        
                        <form action="/php/filter.php">
                            <button type="submit" class="product_buy">Добавить в корзину</button>
                        </form>
                    </div>
                </div>
                <?php endforeach;   ?>

        
            </div>
        </article>

        <!--Фильтр-->
        <nav>
            <form action="/php/filter.php">
                Цена:<br>
                <span class="checkbox_text">От </span><input type="text" name="from" style="width:3em;">
                <span class="checkbox_text">до </span><input type="text" name="to" style="width:3em;"><br>
                Тип:<br>
                <input type="checkbox" name="type1" class="checkbox" /> <span class="checkbox_text">Тип 1</span><br />
                <input type="checkbox" name="type2" class="checkbox" /> <span class="checkbox_text"> Тип 2</span><br />
                Цвет:<br />
                <input type="checkbox" name="color1" class="checkbox" /> <span class="checkbox_text"> Цвет 1</span><br />
                <input type="checkbox" name="color2" class="checkbox" /> <span class="checkbox_text"> Цвет 1</span><br />
                <button type="submit" class="btn_filter">Фильтровать</button>
            </form>
        </nav>
    </main>

    <!--Footer-->
    <footer>
        <p>&copy;2018</p>
    </footer>
</body>
</html>
