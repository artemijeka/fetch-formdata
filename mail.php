<?
header('Content-type: text/plain; charset=utf-8');

//Config:
$to = 'artem.kuznecov.samara@yandex.ru'; //через запятую
$from = 'noreply@some-site.ru';

$jsonFormData = file_get_contents('php://input');

$arFormData = json_decode($jsonFormData, true);

$message = '<html>
<head>
<title>Заказ звонка от: ' . $arFormData['phone'] . '</title>
</head>
<body>
<h3>Заказ звонка от: </h3>
<h3>' . $arFormData['country'] . ' ' . $arFormData['phone'] . '</h3>
<h3>Форма: </h3>
<h3>' . $arFormData['title'] . '</h3>
</body>
</html>';

$subject = 'Заявка с формы: ' . $arFormData['title'];

$headers = 'From: no-reply <' . $from . ">\r\n";
// $headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

mail($to, $subject, $message, $headers);