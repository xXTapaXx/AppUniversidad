<!--Creamos el layout del login principal para implementarlo en las demas views-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--Implementamos los css y javascript con codigo blade-->
    {{ HTML::style('css/bootstrap.css'); }}
    {{ HTML::style('css/bootstrap-theme.css'); }}
     @yield('css')

    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}

     @yield('js')


    <title>@yield('title_browser')- Universidad Tecnica Nacional</title>

</head>
<body>

      @yield('menu')

      <!--div con class top-->
      <div clas="top">
         @yield('tittle')<!--Aqui va el contenido que va a tener top con el contenido tittle-->
      </div><!--fin div top-->

       <!--div con class container-->
        <div class="container">
           @yield('content')<!--Aqui va el contenido que va a tener container con el contenido content-->
        </div><!--fin div container-->

         <!--div con class footer-->
          <div class="footer">
             @yield('foot')<!--Aqui va el contenido que va a tener footer con el contenido foot-->
          </div><!--fin div footer-->


          <script type="javascript">

                @yield('function_js')


          </script>

</body>
</html>