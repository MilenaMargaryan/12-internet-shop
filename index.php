<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интернет-магазин</title>
</head>
<body>
<form method="post" action="index.php"> 
    Логин: <input type="text" name="login" required><br> 
    Пароль: <input type="password" name="password" required><br> 
    <input type="submit" value="Войти"> 
    </form> 
  
<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
      $login = $_POST["login"]; 
      $password = $_POST["password"]; 
    }
?> 

<?php
$data = file_get_contents('goods.json');   
$arrGoods = json_decode($data,1); 


if (isset($_GET['delete'])) {
    $goodsIdToDelete = $_GET['delete'];
    unset($arrGoods[$goodsIdToDelete]);
    $arrGoods = array_values($arrGoods);
   }

   if(!empty($_POST)){
    $arrGoods[] = ['category'=>$_POST['category'], 'name'=>$_POST['name'], 'description' => $_POST['description'], 'price' => $_POST['price'], 'imageUrl' => $_POST['imageUrl'], 'stock' => $_POST['stock'], 'offer' => $_POST['offer']];
}  

?>



    <h2>Добавить товар</h2>
    <form action = "<?=$_SERVER['SCRIPT_NAME']?>" method = "POST"> 
    Введите данные о своем товаре: <br>
    <input type="text" name = "category" placeholder="Категория товара" required> <br>
    <input type="text" name = "name" placeholder="Название товара" required> <br>
    <textarea name = "description" placeholder="Описарие товара" required></textarea> <br>
    <input type="number" name = "price" placeholder="Цена товара" required> <br>
    <input name = "imageUrl" placeholder="URL фота товара"> <br>
    <input type="text" name = "stock" placeholder="Количество товара" required> <br>
    <input type="text" name = "offer" placeholder="Скидка на товар"> <br>
    <input type="submit" value="Добавить товар"> 
  </form>


  <h2>Товары по категориям</h2>
    <?php
$categories = [];   
foreach ($arrGoods as $product) {   
    $categories[] = $product['category'];      
}  
$categories1 = array_unique($categories); 
  
foreach ($categories1 as $category) { 
  echo "<h2>$category</h2>";  

  $categoryProducts = array_filter($arrGoods, function ($product) use ($category) {
      return $product['category'] == $category;
  });

  foreach ($categoryProducts as $product) {  
      echo "<h3>" . $product['name'] . "</h3>";  
      echo "<img src='{$product['imageUrl']}' alt='{$product['name']}' style='max-width:200px; max-height:200px;'>";  
      echo "<p>" . $product['description'] . "</p>";  
      echo "<p>" . $product['price'] . " руб. </p>";  
      if ($product['stock']==0){
        echo "<p>Нет в наличии</p>";
      }
      else echo "<p>" . $product['stock'] . " в наличии</p>";
      if (!empty($product['offer'])){
      echo "<p>Действует акция </p>" . "<font color='green'>{$product['offer']} </font></b>"; 
      }
      echo '<br><a href="?delete=<?= $product_id ?>">Удалить</a><br><br>';
      echo "<hr>";  
  }    
}
    ?>
</body>
</html>