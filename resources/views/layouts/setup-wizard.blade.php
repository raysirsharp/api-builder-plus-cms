<!DOCTYPE html>
<html lang="">

<head>
	<meta charset="utf-8">
	<title>
	    @yield('title')
	</title>
	<meta name="author" content="Ryan Claxton">
	<meta name="description" content="CrossCut CMS">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="icon" type="image/x-icon" href="{{ asset('images/cross-cut.ico') }}"/>
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	@stack('styles')
</head>

<body>
	<header>
	    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
            <a class="navbar-brand" href="/easy-admin">
                <img src="{{ asset('images/logo.svg') }}" alt="CrossCut CMS">
            </a>
        </nav>
	</header>
	@include('partials.messages')
	<main>
        <div class="px-md-5 px-3 py-5">
            <div class="jumbotron">
                @yield('step-title')
                <div class="text-center col-md-8 offset-md-2">
                    @yield('content')
                </div>
            </div>
        </div>
	</main>
	<footer>
	    @include('partials.footer')
	</footer>
	@stack('scripts')
</body>

</html>
