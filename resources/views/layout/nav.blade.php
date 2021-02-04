<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=divice-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edg">
        <title>Pharma</title>
        <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.css')}}">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    </head>
    <body class=" bg-azure">
        @auth
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-white text-center" id="sidebar-wrapper">
                <div class="sidebar-heading"><img src="{{asset('assets/img/drug.svg')}}" width="50">
                    <span class="ml-3">Pharma</span>
                </div>
                <div class="list-group list-group-flush siderbar1">
                  @foreach($sidebar as $item)
                  
                  <a href="{{Str::lower(str_replace(' ','',$item->name))}}" class="btn-azure-secondaryf active btn rounded-0 mt-2 w-100">
                    <i style="position: absolute; left:0; " class="{{$item->icon}} ml-5"></i>
                    {{ __($item->name)}}</a>
                  @endforeach
                    <form action="logout" method="POST">
                        @csrf
                        <button class=" btn rounded-0 mt-2 w-100" >
                            <i class="ion-log-out ml-5" style="position: absolute; left:0; "></i>
                            logout
                        </button>
                    </form>
                </div>
            </div>
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-xl navbar-light bg-white p-2 right-0 ">
                    <button class="btn btn-azure-secondary rounded-0 btn-sm ml-2" id="menu-toggle"><<</button>
                </nav>
                <div class="container-fluid">
                    @endauth
                @yield('content')
                @auth
                </div>
            </div>
        </div>
        @endauth
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <script>
            
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                if(document.getElementById("menu-toggle").textContent == "<<"){
                    document.getElementById("menu-toggle").innerHTML = ">>";
                }else{
                    document.getElementById("menu-toggle").innerHTML = "<<";
                }
            });
          /*   $('.siderbar1 a').on('click', function(e) {
            e.preventDefault();
            $('.siderbar1 a').removeClass('btn-azure-secondary btn-azure-secondaryf');
            $(this).addClass('btn-azure-secondary');
            }); */
        </script>
        
    </body>
</html>