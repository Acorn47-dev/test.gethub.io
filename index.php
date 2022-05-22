<!doctype html>
<html lang="en-US">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <title>My title</title>

  <body>
    <?php
  if (isset($_COOKIE['id'])) {
    Header("Location: /php/home.php");
    exit();
  }
  ?>
    <script type="text/javascript">
      document.ondragstart = noselect;
      document.onselectstart = noselect;
      document.oncontextmenu = noselect;

      function noselect() {
        return false;
      }

    </script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <div class="content">
      <div class="switches-btn">
        <p><img src="/images/logowithoutbackground.png" class="switches-btn__logo"></p>
        <p>
          <div class="switches-btn__nametitle nametitle">CheapWin</div>
        </p>
        <p>
          <div class="switches-btn__reg reg" style="color: white">Регистрация</div>
        </p>
        <div class="switches-btn__list">
          <div class="switches-btn__list child">
            <button class="switch-btn active" id="reg" onclick="regtap()">регистрация</button>
          </div>
          <div class="switches-btn__list child">
            <button class="switch-btn noactive" id="signin" onclick="signintap()">вход</button>
          </div>
        </div>
        <form name="form" id="form" method="post">
          <p><input style="font-weight: bold" id="login" class="input-form" type="text" name="login"
              placeholder="Логин"></p>
          <p><input style="font-weight: bold" id="email" class="input-form" type="text" name="email"
              placeholder="Email"></p>
          <p><input style="font-weight: bold" id="password" class="input-form" type="text" name="password"
              placeholder="Пароль"></p>
          <p><input style="font-weight: bold" id="repeatpassword" class="input-form" type="text" name="repeatpassword"
              placeholder="Повторите пароль"></p>
          <div class="form-group">
            <input type="checkbox" id="checkbox" onclick="show_popap_index('dialog-2')">
            <label for="checkbox">пройти captcha</label>
          </div>
          <button class="reg-form" type="submit">зарегистрироваться</button>
        </form>
      </div>
    </div>
    <div class="dialog" id="dialog-1">
      <div class="dialog__container">
        <div class="dialog__window window">
          <div class="window__header">
            Ошибка!
            <di class="window__close">x</di>
          </div>
          <center>
            <p>
              <fonts class="betroomdiscriptiontext">Ошибка входа!</fonts>
            </p>
          </center>
        </div>
      </div>
    </div>
    <div class="dialog" id="dialog-2">
      <div class="dialog__container container">
        <div class="dialog__window window">
          <div class="window__header">
            Captcha
            <span class="window__close">x</span>
          </div>
          <center>
            <p>
              <fonts class="betroomdiscriptiontext">Решите пример на экране и запишите ответ</fonts>
            </p>
            <p>
              <fonts class="fontcaptcha" id="example"></fonts>
            </p>
            <p> <input style="font-weight: bold" id="captchainput" type="text" placeholder="введите ваш ответ"></p>
            <p><button onclick="sendcaptcha()">отправить</button></p>
          </center>
        </div>
      </div>
    </div>
    <script src="/js/index.js"></script>
  </body>

</html>
