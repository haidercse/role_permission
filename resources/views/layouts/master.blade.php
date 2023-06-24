<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from html.codedthemes.com/mash-able/dark/menu-horizontal-static.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 May 2019 15:54:19 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

    <title>@yield('title')</title>

      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="#">
      <meta name="keywords" content="Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="#">
      <link rel="icon" href="{{ asset('images/default/index.ico') }}" type="image/x-icon">
      <!-- Favicon icon -->
      @include('layouts.partials.styles')
      @yield('custom-styles')
  </head>
  <!-- Menu horizontal static layout -->

{{-- onload="initNotification()" --}}

  <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <div id="pcoded" class="pcoded">

        <div class="pcoded-container">
            <!-- Menu header start -->
              @include('layouts.partials.nav')
            <!-- Menu header end -->

            <div class="pcoded-main-container">

               {{-- sub nav bar start  --}}
               @include('layouts.partials.sub_nav')
               {{-- sub nav bar end  --}}


                <div class="pcoded-wrapper">
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <!-- Main-body start -->
                            <div class="main-body" >
                                <div class="page-wrapper">
                                    <!-- Page header start -->



                                    <!-- Page header end -->
                                    <!-- Page body start -->
                                    <div class="page-body">

                                       @yield('content')

                                    </div>
                                </div>
                                <!-- Page body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->

                        {{-- <div id="styleSelector">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.scripts')

@stack('custom-scripts')

</body>

<!-- Mirrored from html.codedthemes.com/mash-able/dark/menu-horizontal-static.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 May 2019 16:02:25 GMT -->
</html>
