<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
   
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand" style="padding: 20px;">Employee Management</a>

        <div class="container-fluid d-flex justify-content-center">
            <form class="d-flex align-items-center" style="width: 50%;">
                <div class="input-group">
                    <input type="search" class="form-control">
                    <button class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-end" style="max-width: 100%; padding-right: 30px;">
            <div class="position-relative">
                <i class="fa-solid fa-user position-absolute top-50 start-50 translate-middle" style="font-size: 2rem; color: white; cursor: pointer;" id="profile"></i>
                <div id="profileMenu" class="position-absolute end-0 mt-2 bg-white border rounded shadow p-2" style="display: none; min-width: 150px;">
                    <a href="#" class="dropdown-item">Settings</a>
                    <a href="{{ route('user.logout') }}" class="dropdown-item text-danger">Logout</a>
                </div>
            </div>

        </div>
    </nav>

    <div class="d-flex" style="height: calc(100vh - 56px);">
        <!-- Sidebar -->
        <div class="bg-secondary d-flex flex-column" style="width: 250px; padding-top: 100px;">
            <a href="{{ route('nav.index') }}" class="navbar-brand fw-bold text-white ms-5 mb-3">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="#" class="navbar-brand fw-bold text-white ms-5 mb-3">
                <i class="fa-solid fa-list"></i> Categories
            </a>
            <a href="#" class="navbar-brand fw-bold text-white ms-5 mb-3">
                <i class="fa-solid fa-box"></i> Products
            </a>
        </div>
    
      
    

        <div class="flex-fill p-3 d-flex">
            
            @yield('content')
        </div>
    </div>


    <footer>
        @include('layouts.footer')
    </footer>

    @include('layouts.cdn.footerScript')
</body>

</html>
