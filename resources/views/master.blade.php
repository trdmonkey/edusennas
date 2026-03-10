<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- TODO translatable suffix --}}
    <title>lenguaje señas</title>

	@include('layout.partials.main-styles')

    @yield('styles')

    <!-- Estilos para el index: header, hero, main y footer -->
    <link rel="stylesheet" href="/css/fixes.css">

</head>

<body class="app header-fixed sidebar-fixed sidebar-lg-show">
    @yield('header')

    @yield('content')

    @yield('footer')

    @include('layout.partials.wysiwyg-svgs')
    @include('layout.partials.main-bottom-scripts')
    @yield('bottom-scripts')
</body>

</html>