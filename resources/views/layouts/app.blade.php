<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            @yield('title', 'Default Title')
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        @stack("styles")
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
                <a href="{{ route('nav.dashboard.index') }}" class="navbar-brand fw-bold text-white ms-5 mb-3">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
                <a href="{{ route('nav.department.index') }}" class="navbar-brand fw-bold text-white ms-5 mb-3">
                    <i class="fa-solid fa-building"></i> Department
                </a>
                <a href="{{ route('nav.employee.index') }}" class="navbar-brand fw-bold text-white ms-5 mb-3">
                    <i class="fa-solid fa-address-book"></i></i> Employe
                </a>
            
            </div>

            <div class="flex-fill p-3 d-flex"> 
                @yield('content')
            </div>
        </div>


        <footer>
            <h1>This is a footer</h1>
        </footer>

        @stack("modals")

        <!-- Bootstrap Bundle JS (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/YOUR_KIT_ID.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            toastr.options = {
                "positionClass": "toast-top-right",
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000",
                "extendedTimeOut": "1000"
            }

            @if (session('success'))
                toastr.success("{{ session('success') }}")
            @endif

            @if(session('error'))
            toastr.error("{{ session('error') }}")
            @endif
        </script>

        <script>
            const profile = document.getElementById('profile');
            const menu = document.getElementById('profileMenu');

            profile.addEventListener('click', ()=>{
                if(menu.style.display == 'none' || menu.style.display == '' ){
                    menu.style.display = 'block';
                }else{
                    menu.style.display = 'none';
                }
            });
        </script>

        @stack("scripts")
    </body>

</html>
