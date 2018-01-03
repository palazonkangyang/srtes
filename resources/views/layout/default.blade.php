<!doctype html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="expires" content="0">
        
        @include('layout.assets.head')
        @include('layout.assets.css')

    </head>
    <body>
    <!--[if lt IE 9]>
        <div class="lt-ie9-bg">
            <p class="browsehappy">You are using an <strong>outdated</strong> browser.</p>
            <p>Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        </div>
    <![endif]-->
    
        <div class="main-container">            
            <div id="content">
                <section class="view-container animate-fade-up">
                    @yield('content')

                </section>
            </div>
        </div>

        @include('layout.assets.js')
    </body>
</html>
