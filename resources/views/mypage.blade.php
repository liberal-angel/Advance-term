<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/logo.css">
  <link rel="stylesheet" href="css/mypage.css">
  <title>My page</title>
</head>

<body>
  <header>
    <div class="logo">
      <div onClick=" location.href='menu' " class="humbergar">
        <div class="humbergar-top"></div>
        <div class="humbergar-middle"></div>
        <div class="humbergar-bottom"></div>
      </div>
      <h1 class="logo-til">Rese</h1>
    </div>
  </header>

  <div class="middle">
    <h2>{{ $user->name }}さん</h2>
  </div>
  <div class="mypage-detail-content">

    <div class="reservation-check-content">
      <h2>予約状況</h2>
      @if( isset($reservations) )
        <div class="reservation">
          @foreach( $reservations as $i => $reservation )
            @if( $reservation->user_id === $user->id )
              <div class="reservation-detail">

                <div class="reservation-header">
                  <div class="reservation-header-item">
                    <img class="clock-icon" src="img/clock-icon.png" alt="画像がありません">
                    <p class="reservation-til">予約{{ $i+1 }}</p>
                  </div>
                  @if( $now > $reservation->start_at )
                  @else
                    <form action="delete/{{ $reservation['id'] }}" method="POST">
                      @csrf
                      <input class="reservation-delete-btn" type="submit" value="✕">
                    </form>
                  @endif
                </div>

                @if( $now > $reservation->start_at )

                <!-- 来店後の表記 -->
                  <div>
                    @foreach($Shops as $Shop)
                      @if( $reservation->shop_id === $Shop->id )
                        <h2 class="rate-content-til">{{ $Shop->name }}</h2>
                      @endif
                    @endforeach
                    <p>ご来店ありがとうございました！</p>
                    @if(count($errors)>0)
                      <div class="show-error">
                        <p class="error-til">下記内容の問題があります</p>
                        @error('rate')
                          <p class="error-txt"><span class="error-txt-item">・</span> {{ $message }}</p>
                        @enderror
                        @error('comment')
                          <p class="error-txt"><span class="error-txt-item">・</span> {{ $message }}</p>
                        @enderror
                      </div>
                    @endif
                    <div>
                      <form action="rate/{{ $reservation->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
                        <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                        <ul>
                          <ol>
                            <select name="rate" class="add-rate">
                              <option value="" selected hidden>評価</option>
                              <option value="5">★★★★★</option>
                              <option value="4">★★★★</option>
                              <option value="3">★★★</option>
                              <option value="2">★★</option>
                              <option value="1">★</option>
                            </select>
                          </ol>
                          <ol>
                            <textarea name="comment" class="add-comment" cols="25" rows="3" placeholder="コメント"></textarea>
                          </ol>
                          <input type="submit" class="rate-btn" value="送信">
                        </ul>
                      </form>
                    </div>
                  </div>

                @else
                <!-- 来店前の予約表記 -->
                  <div>
                    <form action="update/{{ $reservation->id }}" method="POST">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
                      <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                      <table>
                        <tr>
                          <th>Shop</th>
                          <td>
                            @foreach($Shops as $Shop)
                              @if( $reservation->shop_id === $Shop->id )
                                {{ $Shop->name }}
                              @endif
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <th>Date</th>
                          <td>
                            @if( $reservation->user_id === $user->id )
                              <input type="date" name="date" id="date" value="{{ \Carbon\Carbon::parse($reservation->start_at)->format('Y-m-d') }}" 
                              min="{{ $today }}" max="{{ $after_year }}" class="add-txt">
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th>Time</th>
                          <td>
                            <select name="time" class="add-txt">
                              @if( $reservation['user_id'] === $user->id )
                                @for( $i=9; $i<=20; ++$i )
                                  <option value="{{ \Carbon\Carbon::parse($reservation->start_at)->format('H:i') }}" selected hidden>{{ \Carbon\Carbon::parse($reservation->start_at)->format("H:i") }}</option>
                                  <option value="{{ $i }}:00">{{ $i }}:00</option>
                                @endfor
                              @endif
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <th>Number</th>
                          <td>
                            <select name="num_of_users" class="add-txt">
                              @for( $i=1; $i<=10; ++$i )
                                <option value="{{ $reservation->num_of_users }}" selected hidden>{{ $reservation->num_of_users }}人</option>
                                <option value="{{ $i }}">{{ $i }}人</option>
                              @endfor
                            </select>
                            <input type="submit" class="change-btn" value="予約変更">
                          </td>
                        </tr>
                      </table>
                    </form>
                  </div>
                @endif
              </div>
            @endif
          @endforeach
        </div>
      @endif
    </div>

    <div class="like-shop">
      <h2>お気に入り店舗</h2>
      <div class="shop-card-content"> <!-- ショップカード -->
        @foreach( $Shops as $Shop )
          @if($Shop->likes()->where('user_id', Auth::id())->exists())
            <div class="shop-card">
              <form action="detail" method="GET">
                @csrf
                <!-- データ出力 -->
                <input type="hidden" value="{{$user->id}}" name="user_id">
                <input type="hidden" value="{{$Shop->id}}" name="shop_id">
                <input type="hidden" value="{{$Shop->name}}" name="name">
                <input type="hidden" value="{{$Shop->area_id}}" name="area_id">
                <input type="hidden" value="{{$Shop->genre_id}}" name="genre_id">
                <input type="hidden" value="{{$Shop->discription}}" name="discription">
                <input type="hidden" value="{{$Shop->image_url}}" name="image_url">

                <img class="picture" src="{{$Shop->image_url}}" alt="">

                <div class="shop-detail">
                  <h2 class="shop-detail-til between">{{ $Shop->name }}</h2>

                  <div class="shop-detail-txt between">
                    @foreach( $Areas as $Area )
                      @if( $Shop->area_id === $Area->id )
                        <p>#{{$Area->name}}</p>
                      @endif
                    @endforeach

                    @foreach( $Genres as $Genre )
                      @if( $Shop->genre_id === $Genre->id )
                        <p>#{{$Genre->name}}</p>
                      @endif
                    @endforeach
                  </div>
                  <div class="shop-detail-btn between">
                    <button class="detail-btn">詳しく見る</button>
                  </div>
                </div>
              </form>

              <div class="heart-content">
                <form action="unlike/{{$Shop->id}}" method="POST">
                  @csrf
                  <button @click="unlike(shopId)" class="like-btn heart"></button>
                </form>
              </div>

            </div>
          @endif
        @endforeach
      </div>
    </div>

  </div>
</body>

</html>