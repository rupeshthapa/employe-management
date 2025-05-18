<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
   
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand" style="padding: 20px;">Employe Management</a>
<div class="container-fluid d-flex justify-content-center">

    <form class="d-flex align-items-center" style="width: 50%">
        <div class="input-group">

            <input type="search" class="form-control">
            <button type="submit" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>

        <i class="fa-solid fa-user"></i>
    </nav>

    @yield('content')

    <footer>
        @include('layouts.footer')
    </footer>

    @include('layouts.cdn.footerScript')
</body>

</html>
