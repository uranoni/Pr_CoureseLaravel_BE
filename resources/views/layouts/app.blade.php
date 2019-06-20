<!DOCTYPE html>
<html lang="en">

<head>
        @include('layouts.head')
</head>

<body>

    <!--  preloader start -->
        @include('layouts.preloader')
    <!-- preloader end -->

    <div class="wrapper">

        <!--header start-->
        @include('layouts.header')
        <!--header end-->

        <!--hero section-->
        @yield('hero')
       
        <!--hero section-->

        <!--body content start-->
        <section class="body-content">

            @yield('content')

        </section>
        <!--body content end-->

        <!--footer start 1-->
        @include('layouts.footer')
        <!--footer 1 end-->

    </div>
    @include('layouts.js')
    
</body>

</html>
