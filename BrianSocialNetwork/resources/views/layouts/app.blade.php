<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nai-Chat </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Nai-Chat
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                      @if (Auth::check())
                        <li><a href="{{ url('/home')}}">Home</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              <i class="fas fa-bell"></i>
                              <span class="badge" style="background:red;position:relative;top:-10px;left:-10px;">
                                {{App\notifications::where('status',1)
                                                          ->where('user_hero',Auth::user()->id)
                                                          ->count()}}
                              </span>
                            </a>
                            <?php $note = DB::table('users')->leftJoin('notifications','users.id','notifications.user_logged')->where('user_hero',Auth::user()->id)->where('status',1)->orderBy('notifications.created_at','desc')->get(); ?>
                            <ul class="dropdown-menu" role="menu">
                              @foreach($note as $notes)
                              <li>
                                 <a href="{{url('/notifications')}}/{{$notes->id}}"><img style="margin:5px;" src="{{ url('../')}}/img/{{$notes->pic}}" width="50px" height="50px" class="img-rounded"> <b style="color:green;"> {{ucwords($notes->name)}}</b> {{$notes->note}}</a>
                              </li>
                              @endforeach
                            </ul>
                        </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <img src="{{ url('../')}}/img/{{Auth::user()->pic}}" width="20px" height="20px" class="img-circle">
                                  <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                  <!-- <li>
                                    <div class="">
                                      Signed in as <br>
                                      {{ ucwords(Auth::user()->name) }}
                                    </div>
                                  </li> -->
                                  <li><a href="{{ url('/profile')}}/{{ Auth::user()->slug }}">Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
