<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Przepisy</title>
    </head>
    <body>
        <a href="/login">Admin</a>
        <script type="text/javascript">
            window.location.replace("/login");
        </script>
    </body>
</html>
