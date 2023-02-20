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
        こんにちわ {{ $contact['name'] }} さん
      </p>
    </ol>
    <ol>
      <p>
        あなたのメールは{{ $contact['email'] }}
      </p>
    </ol>
    <ol>
      <p>
        問い合わせ内容は以下で受け取りました
      </p>
    </ol>
  </ul>
</body>
</html>