<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Register</title>
</head>

<body>
  <div>
    <header>
      <div class="item-logo">
        <div class="humbergar">
          <div class="humbergar-top"></div>
          <div class="humbergar-middle"></div>
          <div class="humbergar-bottom"></div>
        </div>
        <h1 class="logo-til">Rese</h1>
      </div>
    </header>
    <x-guest-layout>
      <div class="login-content">
        <div class="login-card">
          <x-auth-card>
            <div class="list-item-til">
              <h1 class="list-til">Register</h1>
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('user.register') }}">
              @csrf

              <div class="list-item-input">
                <table>
                  <tr> <!-- Name -->
                    <th> <img src="img/human-icon.png" alt="画像がありません"> </th>
                    <td>
                      <x-input id="name" class="add_txt" type="text" name="name" :value="old('name')" required autofocus placeholder="Username"/>
                    </td>
                  </tr>
                  <tr> <!-- Email Address -->
                    <th> <img src="img/mail-icon.png" alt="画像がありません"> </th>
                    <td>
                      <x-input id="email" class="add_txt" type="email" name="email" :value="old('email')" required placeholder="Email"/>
                    </td>
                  </tr>
                  <tr> <!-- Password -->
                    <th> <img src="img/lock-icon.png" alt="画像がありません"> </th>
                    <td>
                      <x-input id="password" class="add_txt" type="password" name="password" required autocomplete="new-password" placeholder="Password"/>
                    </td>
                  </tr>
                  <tr> <!-- Confirm Password -->
                    <th> <img src="img/lock-icon.png" alt="画像がありません"> </th>
                    <td>
                      <x-input id="password_confirmation" class="add_txt" type="password" name="password_confirmation" required placeholder="Again-Password"/>
                    </td>
                  </tr>
                </table>
                <div class="list-item-btn">
                    <input class="list-btn" type="submit" value="登録">
                </div>
              </div>
              
            </form>
          </x-auth-card>
        </div>
      </div>
    </x-guest-layout>
  </div>
</body>
