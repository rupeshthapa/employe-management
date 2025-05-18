<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
   
</head>

<body>
    @yield('content')

    <footer>
        @include('layouts.footer')
    </footer>

    @include('layouts.cdn.footerScript')
</body>

</html>
