<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('layouts.header')
    @section('title', 'authentication')
   
</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card p-4 shadow-lg bg-white border-0">
                        <div class="card-body">
                            @yield('content')
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("layouts.cdn.footerScript")
</body>
</html>