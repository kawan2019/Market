<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=divice-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edg">
        <title>Pharma</title>
        <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.css')}}">
        <link
            rel="stylesheet"
            href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    </head>
    <body class="bg-gradient-success">
        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-white text-center" id="sidebar-wrapper">
                <div class="sidebar-heading"><img src="{{asset('assets/img/drug.svg')}}" width="50">
                    <span class="ml-3">Pharma</span>
                </div>
                <div class="list-group list-group-flush">
                  @foreach($sidebar as $item)
                  <a href="{{Str::lower(str_replace(' ','',$item->name))}}" class="btn btn-success rounded-0 mt-2 w-100">
                    
                    <i style="position: absolute; left:0; " class="{{$item->icon}} ml-5"></i>
                    
                    {{$item->name}}</a>
                  @endforeach
                    
                </div>
            </div>
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-white p-2">
                    <button class="btn btn-success" id="menu-toggle">Toggle Menu</button>
                </nav>
                <div class="container-fluid">
                @yield('content')
                </div>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>
</html>