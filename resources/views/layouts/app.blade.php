<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="user" content="{{ Auth::user() }}">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title>SocialApp</title>
</head>

<body>
  <div id="app">
    
  @include('partials.nav')

  <main class="py-4">
    @yield('content')
  </main>
</div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>