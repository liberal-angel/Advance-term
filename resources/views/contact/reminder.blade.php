<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <ul>
    <ol>
      <p>
        こんにちわ {{ $user['name'] }} さん
      </p>
    </ol>
    <ol>
      <p>
        あなたのメールは{{ $user['email'] }}
      </p>
    </ol>
    <ol>
      <p>
        本日は予約日、当日です。ご来店お待ちしております。
      </p>
    </ol>
  </ul>
</body>
</html>