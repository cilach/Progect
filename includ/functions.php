<?php

function get_categories($link){
    
    $sql = "SELECT * FROM products";
    $result = mysqli_query($link, $sql);
   $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $categories;
}
$categories = get_categories($link);

