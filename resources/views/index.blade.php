<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <title>Home</title>
</head>

<body>
  <header> <!-- ロゴ -->
    <div class="logo">
      <div onClick=" location.href='menu' " class="humbergar">
        <div class="humbergar-top"></div>
        <div class="humbergar-middle"></div>
        <div class="humbergar-bottom"></div>
      </div>
      <h1 class="logo-til">Rese</h1>
    </div>

    <div>
      <nav> <!-- 検索フォーム -->
        <form action="/search" method="GET">
          @csrf
          <select class="search-item" name="area_id" id="area_id">
            <option value="" selected hidden>All area</option>
            @foreach($Areas as $Area)
                <option value="{{ $Area->id }}">{{ $Area->name }}</option>
            @endforeach
          </select>

          <select class="search-item" name="genre_id" id="genre_id">
            <option value="" selected hidden>All genre</option>
            @foreach($Genres as $Genre)
                <option value="{{ $Genre->id }}">{{ $Genre->name }}</option>
            @endforeach
          </select>

          <input type="image" src="img/search-icon.png" alt="">
          <input class="search-item" type="search" name="name" value="{{ old('name') }}" placeholder="Search...">
        </form>
      </nav>
    </div>

  </header>

  @if(isset($Shops))
  <div class="shop"> <!-- ショップカード -->
    <div class="shop-card-content">
      @foreach( $Shops as $Shop )
        <div class="shop-card">
          <form action="detail" method="get">
            @csrf
            <!-- データ出力 -->
            <input type="hidden" value="{{$User->id}}" name="user_id">
            <input type="hidden" value="{{$Shop->id}}" name="shop_id">
            <input type="hidden" value="{{$Shop->name}}" name="name">
            <input type="hidden" value="{{$Shop->area_id}}" name="area_id">
            <input type="hidden" value="{{$Shop->genre_id}}" name="genre_id">
            <input type="hidden" value="{{$Shop->discription}}" name="discription">
            <input type="hidden" value="{{$Shop->image_url}}" name="image_url">

            <img class="picture" src="{{$Shop->image_url}}" alt="画像が見つかりません">

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
            @if($Shop->likes()->where('user_id', Auth::id())->exists())
              <form action="unlike/{{$Shop->id}}" method="POST">
                @csrf
                <button @click="unlike(shopId)" class="like-btn heart"></button>
              </form>
            @else
              <form action="like/{{$Shop->id}}" method="POST">
                @csrf
                <button @click="like(shopId)" class="like-btn un-heart"></button>
              </form>
            @endif
          </div>

        </div>
      @endforeach
    </div>
  </div>
  @endif

</body>

<script>
  export default {
    data() {
      return {
        shop: {},
      };
    },
    method: {
      like(function(shopId){
        axios.shop(`/like/${shopId}`).then(({ data }) => {
          console.log(data);
        });
      }),
    },
  };

  export default {
    data() {
      return {
        shop: {},
      };
    },
    method: {
      unlike(function(shopId){
        axios.shop(`/unlike/${shopId}`).then(({ data }) => {
          console.log(data);
        });
      }),
    },
  };
</script>

</html>