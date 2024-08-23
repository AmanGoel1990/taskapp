<html>
    <head>
        <title>Todo App</title>
        <link rel="Stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
    </head>
    <body>
        @yield('content')
    </body>
    </html>