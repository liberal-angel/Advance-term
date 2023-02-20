<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('/assets/css/admin/logo.css')}}" rel="stylesheet">
  <link href="{{asset('/assets/css/admin/detail.css')}}" rel="stylesheet">
  <title>予約状況</title>
</head>

<body>

  <header>
    <div class="top">
      <div class="logo">
        <div class="humbergar">
          <div class="humbergar-top"></div>
          <div class="humbergar-middle"></div>
          <div class="humbergar-bottom"></div>
        </div>
        <h1 class="logo-til">Rese</h1>
      </div>

      <div class="top-til">
        <h2 class="header-til">
          予約状況
        </h2>
        <a href="../index" class="btn">戻る</a>
      </div>
    </div>
  </header>
  
  <div class="reservation-content">
    @foreach( $reservations as $i => $reservation )
        @if( $reservation->shop_id === $shop->id )
          <table>
            <tr>
              <th>
                <p>{{ $i+1 }}</p>
              </th>
              <td>
                @foreach( $users as $user )
                  @if( $user->id === $reservation->user_id )
                    <p>{{ $user->name }} 様</p>
                  @endif
                @endforeach
              </td>
              <td> {{ $reservation->num_of_users }} 名 </td>
              <td> {{ $reservation->start_at }} </td>
              <td>
                <form action="mail" method="POST">
                  @csrf
                  @foreach( $users as $user )
                    @if( $user->id === $reservation->user_id )
                      <input type="hidden" name="name" value="{{ $user->name }}">
                      <input type="hidden" name="email" value="{{ $user->email }}">
                      <input type="submit" class="btn" value="メール">
                    @endif
                  @endforeach
                </form>
              </td>
            </tr>
          </table>
        @endif
      @endforeach
  </div>

</body>

</html>