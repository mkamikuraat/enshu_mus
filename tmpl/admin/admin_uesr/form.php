【●●の部分を埋めてください。】

<?php

  echo <<<_BODY_
  <body>
  <form action="admin_user.php" method="post">
  <p>
  ■お名前<br>
  <input type="text" name="name" size="40">
  </p>
  <p>
  ■メールアドレス<br>
  <input type="text" name="mail" size="40">
  </p>

  <input type="submit" value="確認する">
  <input type="hidden" name="mode" value="post">
  </form>
  </body>
  _BODY_;
  exit;

?>