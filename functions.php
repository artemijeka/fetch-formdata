<?

/************************* НАСТРОЙКИ ДЛЯ WordPress wp-content/themes/emisart/functions.php *************************/

// ОТПРАВКА ФОРМ - START
define('URI', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

// add_filter('wp_mail_charset', function ($content_type) {
// 	return 'utf-8';
// });
// add_filter('wp_mail_content_type', function () {
// 	return 'text/html';
// });
// add_filter('wp_mail_from', function () {
// 	return 'noreply@test.emisart-server.ru';
// });
// add_filter('wp_mail_from_name', function () {
// 	return 'Noreply';
// });

add_action('wp_ajax_wp_mail_sender','wp_mail_sender');
add_action('wp_ajax_nopriv_wp_mail_sender','wp_mail_sender');

function wp_mail_sender() {
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
	$message_from = ($arFormData['from']) ? '<h4>СО СТРАНИЦЫ: <a href="//' . $arFormData['from'] . '">https://'.$arFormData['from'].'</a></h4>' : '';

	$message = '<html>
								<head>
									<title>Заявка с сайта ' . $arFormData['phone'] . '</title>
								</head>
								<body>
									<h2>ФОРМА: ' . $arFormData['title'] . '</h2>
									'.$message_name.'
									'.$message_phone.'
									'.$message_email.'
									'.$message_budget.'
									'.$message_website.'
									'.$message_socials.'
									'.$message_privacy.'
									'.$message_subscribe.'
									'.$message_from.'
								</body>
							</html>';

	$subject = 'Заявка с формы: ' . $arFormData['title'];

	remove_all_filters( 'wp_mail_from' );
  remove_all_filters( 'wp_mail_from_name' );

	$headers = 'From: '.$from_name.' <' . $from_email . ">\r\n";
	// $headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	// $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

	$attachments = array();

	wp_mail( $to, $subject, $message, $headers, $attachments );
}
// ОТПРАВКА ФОРМ - END