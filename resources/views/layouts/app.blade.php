<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraDemo</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
    <section class="container mx-auto">
         <nav class="bg-white p-6 flex justify-between mb-6">
            <ul class="flex items-center">
                <li><a href="{{ route('home') }}" class="p-3 {{ Route::is( 'home' ) ? 'text-blue-500' : '' }}">@lang('site.Home')</a></li>
                <li><a href="{{ route('dashboard') }}" class="p-3 {{ Route::is( 'dashboard' ) ? 'text-blue-500' : '' }}">@lang('site.Dashboard')</a></li>
                <li><a href="{{ route('products') }}" class="p-3 {{ Route::is( 'products' ) ? 'text-blue-500' : '' }}">@lang('site.Products')</a></li>
                <li><a href="{{ route('posts') }}" class="p-3 {{ Route::is( 'posts' ) ? 'text-blue-500' : '' }}">@lang('site.Posts')</a></li>
            </ul>
            <ul class="flex items-center">
                @auth
                    <li><a href="" class="p-3">{{ auth()->user()->name }}</a></li>
                    <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                        @csrf
                        <button type="submit">@lang('site.Logout')</button>
                    </form>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}" class="p-3 {{ Route::is( 'login' ) ? 'text-blue-500' : '' }}">@lang('site.Login')</a></li>
                    <li><a href="{{ route('register') }}" class="p-3 {{ Route::is( 'register' ) ? 'text-blue-500' : '' }}">@lang('site.Register')</a></li>
                @endguest
                <li> 
                    <form action="{{ route('language') }}" method="post" id="lang-switcher" name="lang">
                        @csrf
                        <select name="change" id="font-options" onchange="document.forms.lang.submit()">
                            <option {{(App::isLocale('en')) ? 'selected' : ''}} value="en">EN</option>
                            <option {{(App::isLocale('ru')) ? 'selected' : ''}} value="ru">RU</option>
                        </select>                            
                    </form> 
                </li>
            </ul>
        </nav>
   
        @yield('content')

        <div id="example"></div>
        
    </section>
    <script>
        window.toReact = "<?php echo app()->getLocale(); ?>";
        @auth
            window.userName = "<?php echo auth()->user()->name; ?>";
        @endauth
        @guest
            window.userName = "NONE";
        @endguest
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>