<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/js/app.js')
    <link rel="icon" href="./storage/logos/tcwd.png" type="image/icon type">
    <title>Tangub City Water District</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div id="app">
        @yield('contents')
    </div>
</body>
</html>
<style>
body {
    background-image: url("storage/logos/bg.png");
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100vh;
    position: absolute;
}

    
.montserrat-black-900 {
    font-family: "Montserrat", sans-serif;
    font-weight: 900; 
    font-style: normal;
    font-optical-sizing: auto; 
}

*{
  font-family: "Roboto", sans-serif;
  font-weight: 300;
  font-style: normal;
  font-size: .9rem; 
}


</style>
