<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" type="image/gif" href="favicon.ico" />
   <script src="{{  mix('js/admin.js')}}"></script>

    <title>Admin page</title>

    <link href="{{ mix('css/admin.css')}}" rel="stylesheet"/>
  </head>
  <body>
    <div id="maincont" class="container">
        @yield('content')
    </div> <!-- /container -->
    <br/><br/>
  </body>
</html>
