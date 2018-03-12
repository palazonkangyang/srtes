		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">

				@if (\Request::is('tes') || \Request::is('tes/*'))
					<title>Training Evaluation System - @yield('title')</title>
				@else
					<title>Approval System - @yield('title')</title>
				@endif

        <link rel="shortcut icon" href="images/favicon.ico" />
