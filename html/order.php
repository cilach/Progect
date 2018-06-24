<?php
require_once '../includ/database.php';
if(isset($_POST['issue'])){
	$username = mysqli_real_escape_string($link, trim($_POST['username']));
        $email= mysqli_real_escape_string($link, trim($_POST['email']));
	$phone = mysqli_real_escape_string($link, trim($_POST['phone']));
	$region = mysqli_real_escape_string($link, trim($_POST['region']));
        $city = mysqli_real_escape_string($link, trim($_POST['city']));
	$address = mysqli_real_escape_string($link, trim($_POST['address']));
        $radio1 = mysqli_real_escape_string($link, trim($_POST['radio1']));
	$radio2 = mysqli_real_escape_string($link, trim($_POST['radio2']));
	if(!empty($username) && !empty($email) && !empty($phone)&& !empty($region) && !empty($city) && !empty($address) && !empty($radio1) && !empty($radio2)) {
		
			$query ="INSERT INTO `purchase_history` (region, city,address,username, email,phone) VALUES ('$region', '$city','$address','$username','$email','$phone')";
			mysqli_query($link,$query);
                       
			echo 'Всё готово, заказ оформлен';
			mysqli_close($link);
			exit();
		

	}
}
?>﻿﻿
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>OnlineStore_Practice</title>
    <link href="../css/reset.css" rel="stylesheet" />
    <link href="../css/default.css" rel="stylesheet" />
    <link href="../css/authorization.css" rel="stylesheet" />
    <link href="../css/profile.css" rel="stylesheet" />
    <link href="../css/order.css" rel="stylesheet" />
</head>
<body>

    <!--Заголовок-->
    <header>
        <h1 class="site_name">Garden Furniture in Ukraine</h1>
        <div id="authentefication">
            <a href="http://google.com">User</a>
            <div id="profile_icon"></div>
        </div>
    </header>

    <!--Меню-->
    <div id="menu">
        <ul>
            <li><a href="../index.html">Товары</a></li>
            <li><a href="contacts.html">Контакты</a></li>
            <li><a href="about.html">О нас</a></li>
        </ul>
        <form id="search">
            <input type="text" name="searchText" placeholder="Поиск товаров" />
            <button type="submit" name="searchButton">Искать</button>
        </form>
    </div>

    <!--Форма для регистрации-->

    <main>
        <article>
           
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="input">
                    <h1>Информация</h1>
                    <h3>Им'я, Отчество</h3>
                    <input type="text" name="username" />
                    <h3>Email</h3>
                    <input type="email" name="email" />
                    <h3>Телефон</h3>
                    <input type="text" name="phone" />
                </div>

                <div class="input">
                    <h1>Адрес</h1>
                    <h3>Регион/Область</h3>
                    <input type="text" name="region" />
                    <h3>Город</h3>
                    <input type="text" name="city" />
                    <h3>Адрес</h3>
                    <input type="text" name="address" />
                    <h1>Доставка и оплата</h1>
                    <h3>Выберите удобный способ доставки для данного заказа</h3>
                    <input type="radio" name="radio1"/><span>Доставка с фиксированой стоимостю заказа</span>
                    <h3>Выберите способ оплаты для данного заказа</h3>
                    <input type="radio" name="radio2" /><span>Оплата при доставке</span></br>
                    <button type="submit" name="issue" id="issue">Оформить</button>
               </div>
            </form>
        </article>
    </main>

    <!--Footer-->
    <footer>
        <p>&copy;2018</p>
    </footer>
</body>
</html>
