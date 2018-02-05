<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
    @include('includes.sidebar')
    @yield('content')
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>