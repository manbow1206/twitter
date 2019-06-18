<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title >{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--TODO: スタイルシート研究中-->
    <link href="{{ asset('css/modaal.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-size:30px">
                    TweetApp
                    <!--{{ config('app.name', 'Laravel') }}-->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="padding-top : 20px ;font-size:20px">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="padding-top : 20px ;font-size:20px">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <li class="nav-item" style="display:flex; justify-content: center;align-items: center;" style="font-size:30px">
                              <a class="navbar-brand" href="/users/index" >
                                  {{ __('User List') }}
                                  <!-- {{ config('app.name', 'Laravel') }} -->
                              </a>
                              <a class="navbar-brand" href="/profile" >
                                  {{ __('My Profile') }}
                              </a>
                              <a class="navbar-brand" href="/" >
                                  {{ __('TimeLine') }}
                                  <!-- {{ config('app.name', 'Laravel') }} -->
                              </a>
                          </li>

                            <li class="nav-item dropdown" style="padding-top:13px">
                                <a id="navbarDropdown"  style="font-size: 20px" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </li>

                            <!--XXX: 研究中
                            <div id="inline" style="display:none;" >
                                <h4>ツイートする</h4>

                                {!! Form::open(['id' => 'formTweet', 'url' => 'new', 'enctype' => 'multipart/form-data']) !!}
                                    {!! Form::textarea('body', null, ['name' => 'content', 'class' => 'form-control', 'placeholder' => '今なにしてる？', 'rows' => '4']) !!}
                                    <button id="btnTweet" type="button" class="btn btn-primary" style="margin-top:10px;float:right;margin-bottom:10px">
                                        {{ __('ツイート') }}
                                    </button>
                                {!! Form::close() !!}
                            </div>
                          -->


                        @endguest
                        <div class="mb-4" style="padding-top: 15px">
                      <a href="{{ route('posts.create') }}" class="btn btn-outline-primary" style="display:flex; justify-content: center;align-items: center; ">
                         let`s Tweet!
                      </a>
                    </div>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<!--XXX: 研究中-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><!-- Scripts（Jquery） -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Scripts（bootstrapのjavascript） -->
  <script src="{{ asset('js/modaal.min.js') }}" defer></script>


  <script>
      $(function(){

          $('.inline').modaal({
              width: 600,
              hide_close: true,
            // type: 'ajax',	// コンテンツのタイプを指定
            animation_speed: '500', 	// アニメーションのスピードをミリ秒単位で指定
            // background: '#fff',	// 背景の色を白に変更
            overlay_opacity: '0.75',	// 背景のオーバーレイの透明度を変更
            // fullscreen: 'true',	// フルスクリーンモードにする
            background_scroll: 'true',	// 背景をスクロールさせるか否か
            loading_content: 'Now Loading, Please Wait.'	// 読み込み時のテキスト表示
          });

          $("#btnTweet").click(function() {
              $("#formTweet").submit();
          });
      });
  </script>


  <script src="{{ asset('js/like.js') }}"></script>
  <script>
    var token = '{{ Session::token() }}';
    var url_like = '{{ route('like') }}';
    var url_unlike = '{{ route('unlike') }}';
  </script>




</body>
</html>
