<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('/assets/css/admin/logo.css')}}" rel="stylesheet">
  <link href="{{asset('/assets/css/admin/style.css')}}" rel="stylesheet">
  <title>管理者-ログイン</title>
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
                <h1 class="list-til">Admin-Login</h1>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="list-item-input">
              <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <table>
                  <tr>
                    <th>
                      <img src="{{ asset('img/mail-icon.jpeg') }}" alt="画像がありません">
                    </th>
                    <td>
                      <!-- Email Address -->
                      <div>
                        <x-label for="email"/>
                        <x-input id="email" class="add_txt" type="email" name="email" :value="old('email')" required autofocus placeholder="Email"/>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <th>
                      <img src="{{ asset('img/lock-icon.jpeg') }}" alt="画像がありません">
                    </th>
                    <td>
                      <!-- Password -->
                      <div class="mt-4">
                        <x-label for="password"/>
                        <x-input id="password" class="add_txt" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
                      </div>
                    </td>
                  </tr>
                </table>
                <div class="list-item-btn">
                  <input class="list-btn" type="submit" value="ログイン">
                </div>
              </form>
            </div>
          </x-auth-card>
        </div>
      </div>
    </x-guest-layout>
  </div>
</body>

</html>