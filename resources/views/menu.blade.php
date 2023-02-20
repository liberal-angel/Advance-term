<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('/assets/css/user/menu.css')}}" rel="stylesheet">
  <title>Menu</title>
</head>

<body>
  <header class="logo">
    <div class="item-logo">
      <div onClick="history.back();" class="humbergar">
        <div class="humbergar-top"></div>
        <div class="humbergar-bottom"></div>
      </div>
    </div>
  </header>

  <div class="menu-content">
    <a href="/" class="Home-Mypage-txt">Home</a>
    <form action="logout" method="POST">
      @csrf
      <input type="submit" value="Logout" class="Logout-txt">
    </form>
    <a href="/mypage" class="Home-Mypage-txt">Mypage</a>
  </div>
  
</body>
</html>