<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Taste Recipes - @yield('title')</title>
        @yield('meta')
    </head>
    <body>
        <div class="w-full  fixed bg-white top-0  z-50">
            <div class="w-full py-4 px-12  bg-white  shadow ">
                <a href="{{ route('home') }}"><h3 class="text-xl text-green-600 font-bold ">Tasty Recipes</h3></a>
            </div>
            <div class="px-12 py-2" >
                @include('partial.common.breadcrumb')
            </div>
        </div>

        @section('sidebar')
        <div class="w-full px-12  my-6 mt-28 ">
            @yield('content')

        </div>
    </body>
</html>