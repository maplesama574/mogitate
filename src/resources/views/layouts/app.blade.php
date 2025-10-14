<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header-inner">
            <a class="header-logo" href="/">mogitate</a>
        </div>
    </header>

    <main>
    @yield('content')
    </main>
    
</body>
</html>