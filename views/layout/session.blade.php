<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

        @yield('title')
        
    </title>
    @section('content-link')
        <link rel="stylesheet" href="css/login.css">
    @show
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
</head>

<body>

    @yield('content')

    <script src="js/script.js"></script>
</body>

</html>