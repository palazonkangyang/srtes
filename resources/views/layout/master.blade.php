<!doctype html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @include('layout.assets.head')
        @include('layout.assets.css')
        @include('layout.assets.js')

        <!--[if lt IE 9]>
        	<script src="{{URL::asset('js/common/html5shiv.js')}}"></script>
        	<script src="{{URL::asset('js/common/respond.min.js')}}"></script>
        <![endif]-->

    </head>
    <body>
    <!--[if lt IE 9]>
        <div class="lt-ie9-bg">
            <p class="browsehappy">You are using an <strong>outdated</strong> browser.</p>
            <p>Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        </div>
    <![endif]-->

        @include('layout.header')        
                <div class="main-content">
                    @yield('content') 
                </div>
        @include('layout.footer')
    </body>
</html>