<?php

//только php код по ТЗ
require_once('./php-script/delete.php');
require_once('./explorer.php');
?>

<html>
  <head>
    <link rel="stylesheet" href="./style/style.css">
  </head>
  <body>

    <div class="context-menu-open">
      <ul>
        <li onclick="buttonDelete()">
          <a id="del" href="#">Удалить
        </li>
        <li>Ссылка 2</li>
        <li>Ссылка 3</li>
      </ul>
    </div>
    
    <script src="./script/rightclick.js"></script>
  </body>