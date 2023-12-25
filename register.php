<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <h2>Форма регистрации нового пользователя</h2>
    <form action="index.php" method="post">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="login">Логин:</label>
        <input type="text" id="login" name="login" required><br><br>
        
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="confirm_password">Подтверждение пароля:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>