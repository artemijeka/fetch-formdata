(function () {//для изоляции пространства имён
  document.addEventListener('DOMContentLoaded', function () {//действуем после загрузки DOM

    // ОТПРАВКА ФОРМ START
    // Config:
    const action = '/wp-admin/admin-ajax.php?action=wp_mail_sender';
    const formAll = document.querySelectorAll('.form');

    for (let form of formAll) {

      try {

        form.addEventListener('submit', function (e) {
          e.preventDefault();

          const form__name = form.querySelector('[name="name"]');
          const form__phone = form.querySelector('[name="phone"]');
          const form__email = form.querySelector('[name="email"]');
          const iti__selectedFlag = form.querySelector('.iti__selected-flag');
          let iti__selectedFlag_title = null;
          if (iti__selectedFlag) {
            iti__selectedFlag_title = iti__selectedFlag.getAttribute('title')
          }

          const formPrivacy = form.querySelector('.i-form-privacy');
          if (formPrivacy) {
            const formPrivacyInput_checked = form.querySelector('[name="privacy"]').checked;
            if (!formPrivacyInput_checked) {
              formPrivacy.classList.add('--shake', '--warning');
              setTimeout(() => { formPrivacy.classList.remove('--shake', '--warning'); }, 1000);
              return;
            }
          }

          const formData = new FormData(e.target);
          const data = {};
          data['country'] = iti__selectedFlag_title;

          for (const [name, value] of formData) {
            data[name] = value;
          }

          if (form__name && !data.name) {
            form__name.classList.add('--shake', '--warning');
            setTimeout(() => { form__name.classList.remove('--shake', '--warning'); }, 1000);
            return;
          }

          if (form__email && !data.email) {
            form__email.classList.add('--shake', '--warning');
            setTimeout(() => { form__email.classList.remove('--shake', '--warning'); }, 1000);
            return;
          }

          if (form__phone && !data.phone) {
            form__phone.classList.add('--shake', '--warning');
            setTimeout(() => { form__phone.classList.remove('--shake', '--warning'); }, 1000);
            return;
          }

          console.log(data);
          console.log(JSON.stringify(data));

          sendForm(data, showResultSendingForm, showPreloaderSendingForm);
        });

        function sendForm(data, callback = null, beforeSending = null) {
          if (beforeSending) beforeSending();

          fetch(action, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json; charset=utf-8',
            },
            body: JSON.stringify(data),
          })
            .then((response) => {
              response.json();
              return response;
            })
            .then((jsonResponse) => {
              if (callback) callback(jsonResponse);
            })
            .catch((err) => { console.log(err); })
            .finally(() => { });
        }

        function showPreloaderSendingForm() {
          console.log('PRELOADER..........................................................');
        }

        function showResultSendingForm(jsonResponse) {
          console.log(jsonResponse);
          console.log(jsonResponse.ok);
          console.log(jsonResponse.status);
          if (jsonResponse.ok) {
            console.log('SUCCESS! FORM SENT!');
            const mailSendIndicator = document.createElement('div');
            const mailSendIndicatorImg = document.createElement('img');
            mailSendIndicatorImg.setAttribute('src', '/images/animations/mail_sent/lime_200_once.gif');
            // mailSendIndicatorImg.setAttribute('rel', 'preload');
            mailSendIndicator.append(mailSendIndicatorImg);
            form.append(mailSendIndicator);
            // const mailSendIndicator = document.querySelector('.form__send-indicator');
            mailSendIndicator.classList.add('form__send-indicator', '--active');
            form.reset();
            setTimeout(() => {
              mailSendIndicator.classList.remove('--active');
              mailSendIndicator.remove();
            }, 3000);
          } else {
            console.log('ERROR! FORM NOT SENT!');
            const mailSendIndicator = document.createElement('div');
            const mailSendIndicatorImg = document.createElement('img');
            mailSendIndicatorImg.setAttribute('src', '/images/animations/mail_error/200_once.gif');
            // mailSendIndicatorImg.setAttribute('rel', 'preload');
            mailSendIndicator.append(mailSendIndicatorImg);
            form.append(mailSendIndicator);
            mailSendIndicator.classList.add('form__send-indicator', '--active');
            setTimeout(() => {
              mailSendIndicator.classList.remove('--active');
              mailSendIndicator.remove();
            }, 3000);
          }
        }

      } catch (err) {

        console.group('ОШИБКА В ОБРАБОТКЕ ФОРМЫ: ');
        console.log(err.name);
        console.log(err.message);
        console.log(err.stack);
        console.log(err);
        console.groupEnd();

      } finally { }
    }
    // ОТПРАВКА ФОРМ END



    window.onerror = function (message, url, line, col, error) {
      console.log(error);
      console.log(`${message}\n в ${line}:${col} на ${url}`);
    };
  });
})();