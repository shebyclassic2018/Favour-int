<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0 shrink-to-fit=yes">

<title>@yield('title')</title>
{{-- {{ setting('site_title', config('app.name')) }} --}}

<meta name="description" content="{{ config('app.name') }} {{ config('app.name_after') }}">
<meta name="authors" content="{{ config('app.author_one.name') }}, {{ config('app.author_two') }}">
<meta name="robots" content="noindex, nofollow">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- Fonts and Styles -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

<!-- Icons -->
<link href="{{ asset('media/favicons/favicon.png') }}" rel="shortcut icon">
<link href="{{ asset('media/favicons/favicon-192x192.png') }}" rel="icon" sizes="192x192" type="image/png">
<link href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}" rel="apple-touch-icon" sizes="180x180">


<link rel="stylesheet" href="{{ asset('guest/flag-icons-main/css/flag-icons.min.css') }}">

