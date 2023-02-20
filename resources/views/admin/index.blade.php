<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('/assets/css/admin/logo.css')}}" rel="stylesheet">
  <link href="{{asset('/assets/css/admin/index.css')}}" rel="stylesheet">
  <title>管理画面</title>
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

      <h1 class="header-til">
        管理システム
      </h1>

      <div class="top-til">
        @if (Auth::check())
          <p>ログイン中のユーザー: {{$admin->name}} 様</p>
        @endif
        <form action="logout" method="POST">
          @csrf
          <input type="submit" class="btn logout-btn" value="Logout">
        </form>
      </div>

    </div>

  </header>

  <div class="create-content">

    @if($errors->any())
      <div class="show-error">
        <h2 class="error-til">下記内容の問題があります</h2>
        <ul>
          @foreach($errors->all() as $error)
          <li>
            <p class="error-txt">{{ $error }}</p>
          </li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="create" class="create-content-form" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="admin_id" value="{{ $admin->id }}">
      <input type="text" name="name" class="create-add-item" value="{{ old('name') }}" placeholder="店名">
      <select name="area_id" class="create-add-item">
        <option value="" selected hidden>エリア</option>
        @foreach($areas as $area)
          <option value="{{ $area->id }}">{{ $area->name }}</option>
        @endforeach
      </select>

      <select name="genre_id" class="create-add-item">
        <option value="" selected hidden>ジャンル</option>
        @foreach($genres as $genre)
          <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
      </select>
      <textarea name="discription" class="create-add-txt-area" cols="30" rows="5">{{ old('discription') }}</textarea>
      <input type="file" name="image_url">
      <input type="submit" class="btn" value="作成">
    </form>
  </div>

  <div>

    @foreach( $shops as $shop )
      @if( $shop->admin_id === $admin->id )
        <table>
          <tr>
            <form action="update/{{ $shop->id }}" class="update-content" method="POST" enctype="multipart/form-data">
              @csrf
              <th>
                <input type="text" name="name" class="create-add-item" value="{{ $shop->name }}">
              </th>
              <td>
                <select name="area_id" class="create-add-item">
                  @foreach($areas as $area)
                    <option {{ $shop->isSelectedArea($area->id) }} value="{{ $area->id }}"> {{ $area->name }} </option>
                  @endforeach
                </select>
              </td>
              <td>
                <select name="genre_id" class="create-add-item">
                  @foreach($genres as $genre)
                    <option {{ $shop->isSelectedGenre($genre->id) }} value="{{ $genre->id }}"> {{ $genre->name }} </option>
                  @endforeach
                </select>
              </td>
              <td>
                <textarea name="discription" class="create-add-txt-area" cols="30" rows="5">{{$shop->discription}}</textarea>
              </td>
              <td>
                <input type="file" name="image_url">
              </td>
              <td>
                <input type="submit" class="btn" value="更新">
              </td>
            </form>

            <form action="detail/{{ $shop->id }}" method="GET">
              @csrf
              <td>
                <input type="hidden" name="id" value="{{ $shop->id }}">
                <input type="submit" class="btn" value="予約状況">
              </td>
            </form>
          </tr>
        </table>
      @endif
    @endforeach

  </div>

</body>

</html>