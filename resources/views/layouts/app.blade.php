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

        
        @include('layouts.header',['overlay'=>(isset($overlay))? $overlay :null])
       

  
        @yield('hero')
        @yield('page-title')
      

       
        <section class="body-content">

            @yield('content')

        </section>
        

      
        @include('layouts.footer')
        

    </div>
    @include('layouts.js')
    
</body>

</html>
