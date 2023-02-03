<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/detail.css">
  <title>Detail</title>
</head>

<body>
  <div class="left-content">
    <div class="logo">
      <div onClick=" location.href='menu' " class="humbergar">
        <div class="humbergar-top"></div>
        <div class="humbergar-middle"></div>
        <div class="humbergar-bottom"></div>
      </div>
      <h1 class="logo-til">Rese</h1>
    </div>

    <div class="left-content-header">
      <a href="/" class="back-btn"><</a>
      <h2>{{ $detail['name'] }}</h2>
    </div>

    <img class="picture" src="{{ $detail['image_url'] }}" alt="画像がありません">
    <div class="content-item">
      @foreach( $Areas as $Area )
        @if( $detail['area_id'] == $Area['id'] )
          <p>#{{ $Area['name'] }}</p>
        @endif
      @endforeach

      @foreach( $Genres as $Genre )
        @if( $detail['genre_id'] == $Genre['id'] )
          <p>#{{ $Genre['name'] }}</p>
        @endif
      @endforeach
    </div>
    <p class="content-txt">{{ $detail['discription'] }}</p>
  </div>

  <div class="light-content">

    <div>
      <h2 class="light-content-ttl">予約</h2>
    </div>

    <div>
      <form action="reservation" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $detail['user_id'] }}">
        <input type="hidden" name="shop_id" value="{{ $detail['shop_id'] }}">

        <div class="light-content-add">
          <input type="date" name="date" class="date" id="date" value="{{ $today }}" min="{{ $today }}" max="{{ $after_year }}">
          <select name="time" id="time">
            @for( $i=9; $i<=20; ++$i )
              <option value="" selected hidden>時間</option>
              <option value="{{ $i }}:00">{{ $i }}:00</option>
            @endfor
          </select>
          <select name="num_of_users" id="num_of_users">
            @for( $i=1; $i<=10; ++$i )
              <option value="" selected hidden>人数</option>
              <option value="{{ $i }}">{{ $i }}人</option>
            @endfor
          </select>
        </div>

        <div class="light-content-show">
          <table>
            <tr>
              <th>Shop</th>
              <td> <p>{{ $detail['name'] }}</p> </td>
            </tr>
            <tr>
              <th>Date</th>
              <td> <p id="date_view"></p> </td>
            </tr>
            <tr>
              <th>Time</th>
              <td> <p id="time_view"></p> </td>
            </tr>
            <tr>
              <th>Number</th>
              <td> <p id="num_of_users_view"></p> </td>
            </tr>
          </table>
        </div>
        <input class="reservation-btn" type="submit" value="予約する">
      </form>

      @if(count($errors)>0)
        <div class="show-error">
          <p class="error-til">下記内容の問題があります</p>
          @error('date')
            <p class="error-txt"><span class="error-txt-item">・</span> {{ $message }}</p>
          @enderror
          @error('time')
            <p class="error-txt"><span class="error-txt-item">・</span> {{ $message }}</p>
          @enderror
          @error('num_of_users')
            <p class="error-txt"><span class="error-txt-item">・</span> {{ $message }}</p>
          @enderror
          @error('shop_id')
            <p class="error-txt"><span class="error-txt-item">・</span> {{ $message }}</p>
          @enderror
        </div>
      @endif

    </div>

  </div>
</body>

<script src="js/index.js"></script>

</html>