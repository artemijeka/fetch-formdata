<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>



  <form class="become-client__form form --become-client">
    <!-- <div class="form__container"> -->
    <input name="name" type="text" class="form__input" placeholder="Как вас зовут? *">
    <input name="email" type="text" class="form__input" placeholder="E-mail *">
    <input name="phone" type="text" class="form__phone" placeholder="(999) 999 99 99 *">
    <input name="budget" type="text" class="form__input" placeholder="Примерный бюджет:">
    <input name="service" type="text" class="form__input" placeholder="Какая услуга интересна:">
    <input name="website" type="text" class="form__input" placeholder="Ссылка на сайт, если есть:">
    <input name="socials" type="text" class="form__input" placeholder="Ссылки на соцсети, если есть:">
    <input name="title" value="«Стать клиентом Emisart»" type="text" class="--hidden" hidden="hidden">
    <input name="from" value="<?= URI ?>" type="text" class="--hidden" hidden="hidden">
    <!-- </div> -->
    <span class="clear"></span>
    <label class="form__privacy i-form-privacy">
      <input type="checkbox" name="privacy" class="form__privacy-check">
      <span class="form__privacy-text i-form-privacy-title">Нажимая на кнопку вы соглашаетесь с &nbsp;<a class="form__privacy-link" href="<?php the_field('polit', 'option'); ?>">политикой конфиденциальности</a></span>
    </label>
    <label class="form__privacy">
      <input type="checkbox" name="subscribe" class="form__privacy-check">
      <span class="form__privacy-text">Хочу получать на почту материалы об интернет-маркетинге раз в 2 недели</a></span>
    </label>
    <input type="submit" class="form__submit button" value="Заказать звонок">
  </form><!-- /.form -->



  <script src="./script.babel.js"></script>
</body>
</html>