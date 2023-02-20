<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('/assets/css/user/index.css')}}" rel="stylesheet">
  <link href="{{asset('/assets/css/user/logo.css')}}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <title>ホーム</title>
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

    <div>
      <nav>
        <form action="/search" method="GET">
          @csrf
          <select class="search-item" name="area_id" id="area_id">
            <option value="" selected hidden>All area</option>
            @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
          </select>

          <select class="search-item" name="genre_id" id="genre_id">
            <option value="" selected hidden>All genre</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
          </select>

          <input type="image" src="img/search-icon.jpeg" alt="">
          <input class="search-item" type="search" name="name" value="{{ old('name') }}" placeholder="Search...">
        </form>
      </nav>
    </div>

  </header>

  @if(isset($shops))
  <div class="shop">
    <div class="shop-card-content">
      @foreach( $shops as $shop )
        <div class="shop-card">
          <form action="detail/{{ $shop->id }}" method="GET">
            @csrf

            <img class="picture" src="{{ Storage::url($shop->image_url) }}" alt="画面が見つかりません">

            <div class="shop-detail">
              <h2 class="shop-detail-til between">{{ $shop->name }}</h2>

              <div class="shop-detail-txt between">
                @foreach( $areas as $area )
                  @if( $shop->area_id === $area->id )
                    <p>#{{$area->name}}</p>
                  @endif
                @endforeach

                @foreach( $genres as $genre )
                  @if( $shop->genre_id === $genre->id )
                    <p>#{{$genre->name}}</p>
                  @endif
                @endforeach
              </div>
              <div class="shop-detail-btn between">
                <button class="detail-btn">詳しく見る</button>
              </div>
            </div>
          </form>

          <div class="heart-content">
            @if($shop->likes()->where('user_id', Auth::id())->exists())
              <form action="unlike/{{$shop->id}}" method="POST">
                @csrf
                <button @click="unlike(shopId)" class="like-btn heart"></button>
              </form>
            @else
              <form action="like/{{$shop->id}}" method="POST">
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