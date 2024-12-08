<?php
// Подключение к базе данных
$servername = "DB"; // Или IP-адрес вашего сервера
$username = "Daniil"; // Имя пользователя БД
$password = "zxc987412365"; // Пароль БД
$dbname = "user_registration"; // Имя БД

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хешируем пароль

// Подготовка и выполнение SQL-запроса
$sql = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$sql->bind_param("sss", $username, $email, $password);

if ($sql->execute()) {
    echo "Регистрация прошла успешно!";
} else {
    echo "Ошибка: " . $sql->error;
}

// Закрытие соединения
$sql->close();
$conn->close();
?>