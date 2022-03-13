<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$name = $_POST['name'];
$message = $_POST['message'];
$email = $_POST['email'];
$file = $_FILES['myfile'];
$subscribeBtn = $_POST['subscribeBtn'];

// форма самого письма 
$title = "Новое обращение сайт Антей";
$body = "
<h2>Новое обращение</h2>
<b>Имя:</b> $name<br>
<b>email:</b> $email<br><br>
<b>Сообщение:</b><br>$message
<b>Файл:</b><br>$file
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

     // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'tourplan344@gmail.com'; // Логин на почте
    $mail->Password   = 'RXAL,Z-2hLtk2EP'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('tourplan344@gmail.com','АНДРЕЙ МЕЖИРИЦКИЙ'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('georgytsetsaridze@yandex.ru');  
    


		// Отправка сообщения
		$mail->isHTML(true);
		$mail->Subject = $title;
		$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
header('location: thankyou.html');

