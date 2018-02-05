<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
<div class="row">
    <div class="col-sm-12 gray-back main-div-border">
        @yield('content')
    </div>
</div>

</body>
</html>