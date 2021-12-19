(function () {
  //для изоляции пространства имён
  document.addEventListener('DOMContentLoaded', function () {
    //действуем после загрузки DOM
    try {
      //чтобы скрипт не падал, для каждого блока желательно ставить try catch (синхронная конструкция)
      const form = document.querySelector('form');
      form.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = {};

        for (const [symbols, value] of formData) {
          data[symbols] = value;
        }

        console.log(data);
        sendForm(data, showSuccessSend, showPreloader);
      });

      function sendForm(data, callback, beforeSend) {
        if (beforeSend) beforeSend();
        fetch('https://jsonplaceholder.typicode.com/posts', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json; charset=utf-8'
          },
          body: JSON.stringify(data)
        }).then(response => {
          console.log(response);
          return response.json();
        }).then(callback);
      }

      function showPreloader() {
        return 'PRELOADER...';
      }

      function showSuccessSend(jsonResponse) {
        console.log('SUCCESS!!!');
        console.log(jsonResponse);
      } //if (!something) {//создание собственной ошибки
      //  throw new Error("Описываем нашу пользовательскуюи ошибку");//throw прокинет нашу ошибку в catch (возможные конструкторы: Error ReferenceError SyntaxError TypeError URIError EvalError RangeError InternalError?!)
      //}

    } catch (err) {
      //обрабатываем ошибки, если объект ошибки не нужен, мы можем пропустить его, используя 'catch {' вместо 'catch(err) {'  
      console.log('ОШИБКА: ');
      console.log(err);
      console.log(err.name);
      console.log(err.message);
      console.log(err.stack);
    } finally {//срабатывает при любом выходе из try..catch, в том числе и return (секцию finally часто используют, когда мы начали что-то делать и хотим завершить это вне зависимости от того, будет ошибка или нет)
    } //более короткие конструкции try..catch и try..finally также корректны, try...finally без секции catch также полезна, мы применяем её, когда не хотим здесь обрабатывать ошибки (пусть выпадут), но хотим быть уверены, что начатые процессы завершились


    window.onerror = function (message, url, line, col, error) {
      //«глобальный» обработчик ошибок, чтобы ловить ошибки, которые «выпадают наружу»
      console.log(error);
      console.log(`${message}\n в ${line}:${col} на ${url}`);
    };
  });
})();
