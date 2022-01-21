<?

// ОТПРАВКА ФОРМ - START
header( 'Content-type: text/plain; charset=utf-8' );

define( 'URI', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );

//Config:
$to = 'admin@site.ru';
$from_email = 'noreply@tsite.ru';
$from_name = 'Bot';

$jsonFormData = file_get_contents('php://input');

$arFormData = json_decode($jsonFormData, true);

$message_name = ($arFormData['name']) ? '<h4>ИМЯ: ' . $arFormData['name'] . '</h4>' : '';
$message_phone = ($arFormData['phone']) ? '<h4>ТЕЛЕФОН: ' . $arFormData['country'] . ' ' . $arFormData['phone'] . '</h4>' : '';
$message_email = ($arFormData['email']) ? '<h4>EMAIL: ' . $arFormData['email'] . '</h4>' : '';
$message_budget = ($arFormData['budget']) ? '<h4>БЮДЖЕТ: ' . $arFormData['budget'] . '</h4>' : '';
$message_website = ($arFormData['website']) ? '<h4>САЙТ: ' . $arFormData['website'] . '</h4>' : '';
$message_socials = ($arFormData['socials']) ? '<h4>СОЦСЕТИ: ' . $arFormData['socials'] . '</h4>' : '';
$message_privacy = ($arFormData['privacy']) ? '<h4>П. КОНФИДЕНЦИАЛЬНОСТИ: СОГЛАСЕН</h4>' : '<h4>П. КОНФИДЕНЦИАЛЬНОСТИ: НЕ СОГЛАСЕН</h4>';
$message_subscribe = ($arFormData['subscribe']) ? '<h4>ПОДПИСКА: ДА</h4>' : '<h4>ПОДПИСКА: НЕТ</h4>';
$message_from = ($arFormData['from']) ? '<h4>СО СТРАНИЦЫ: <a href="//' . $arFormData['from'] . '">https://' . $arFormData['from'] . '</a></h4>' : '';

$message = '<html>
              <head>
                <title>Заявка с сайта ' . $arFormData['phone'] . '</title>
              </head>
              <body>
                <h2>ФОРМА: ' . $arFormData['title'] . '</h2>
                ' . $message_name . '
                ' . $message_phone . '
                ' . $message_email . '
                ' . $message_budget . '
                ' . $message_website . '
                ' . $message_socials . '
                ' . $message_privacy . '
                ' . $message_subscribe . '
                ' . $message_from . '
              </body>
            </html>';

$subject = 'Заявка с формы: ' . $arFormData['title'];

$headers = 'From: ' . $from_name . ' <' . $from_email . ">\r\n";
// $headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

mail($to, $subject, $message, $headers);
// ОТПРАВКА ФОРМ - END