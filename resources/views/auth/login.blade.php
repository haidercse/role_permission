 {{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

 <!DOCTYPE html>
 <html lang="en">


 <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

 <head>
     <title>Ticketing System | AppinionBD LTD</title>
     <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 9]>
    <![endif]-->
     <!-- Meta -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="description" content="#">
     <meta name="keywords"
         content="Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
     <meta name="author" content="#">
     <!-- Favicon icon -->

     @include('layouts.partials.styles')




 </head>

 <body class="fix-menu">
     <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
         <!-- Container-fluid starts -->
         <div class="container">
             <div class="row">
                 <div class="col-sm-12">

                     <!-- Authentication card start -->
                     <div class="login-card card-block auth-body m-auto">

                         <form method="post" id="myform" class="md-float-material" action="{{ route('login') }}">
                             @csrf
                             <div class="auth-box">
                                 <div class="row m-b-20">
                                     <div class="col-md-12">
                                         <img src="{{ asset('images/default/appinion.png') }}" alt="small-logo.png">
                                     </div>
                                     <div class="col-md-12">
                                         <h3 class="text-center txt-primary"><span
                                                 style="color: #CF3546; font-weight: bold;">Appinion </span> Ticketing
                                             System</h3>

                                     </div>

                                 </div>
                                 <hr />
                                 @if ($errors->any())
                                 <div class="text-danger">
                                     {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                             <p class="mb-0">{{ $error }}</p>
                                         @endforeach
                                     </ul>

                                 </div>
                             @endif
                                 <div class="input-group">
                                     <input type="text" name="username" required="required" class="form-control"
                                         placeholder="Your User Name">
                                     <span class="md-line"></span>
                                 </div>
                                 <div class="input-group">
                                     <input type="password" name="password" required="required" class="form-control"
                                         placeholder="Password">
                                     <span class="md-line"></span>
                                 </div>
                                 <div class="row m-t-25 text-left">
                                     <div class="col-sm-7 col-xs-12">
                                         <div class="checkbox-fade fade-in-primary">
                                             <label>
                                                 <input type="checkbox" value="">
                                                 <span class="cr"><i
                                                         class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                 <span class="text-inverse">Remember me</span>
                                             </label>
                                         </div>
                                     </div>
                                     <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                         <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse">
                                             Forgot Your Password?</a>
                                     </div>
                                 </div>
                                 <div class="row m-t-30">
                                     <div class="col-md-12">
                                         <button type="submit" id="submit_form"
                                             class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign
                                             in</button>
                                     </div>
                                 </div>
                                 <hr />
                                 <div class="row">
                                     <div class="col-12">
                                         <p class="text-inverse text-center m-b-0">Thank you and enjoy our Application.
                                         </p>
                                         <p class="text-inverse text-center"><b>Appinion BD Limited</b></p>
                                     </div>
                                 </div>

                             </div>
                         </form>
                         <!-- end of form -->
                     </div>
                     <!-- Authentication card end -->
                 </div>
                 <!-- end of col-sm-12 -->
             </div>
             <!-- end of row -->
         </div>
         <!-- end of container-fluid -->
     </section>


 </body>



 </html>
