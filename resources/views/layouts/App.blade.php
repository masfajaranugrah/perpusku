<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="shortcut icon" href="{{asset('./assets/compiled/svg/favicon.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('./assets/compiled/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/compiled/css/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/compiled/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/compiled/css/iconly.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/compiled/css/table-datatable.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css" integrity="sha512-/r+0SvLvMMSIf41xiuy19aNkXxI+3zb/BN8K9lnDDWI09VM0dwgTMzK7Qi5vv5macJ3VH4XZXr60ip7v13QnmQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
</head>

<body>
    <div class="preloader" style="display: block;">
        <div class="loading">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
    </div>  

    <div>
        <div class="main-container d-flex"> <div class="main-content">
            {{-- Check if user is logged in --}}
            @if(Auth::check())
                {{-- Check if user is admin --}}
                @if(Auth::user()->jabatan == 'Admin')
                    @include('admin.AdminDashboard._side')
                {{-- Check if user is petugas --}}
                @elseif(Auth::user()->jabatan == 'Petugas')
                    @include('petugas.PetugasDashboard._side')
                @else
                    {{-- If role is not recognized --}}
                    <p>Role tidak dikenali.</p>
                @endif
            @endif

           
                @yield('main')
                <footer class="footer">
                    <p>&copy; {{ date('Y') }} Perpustakaan by Haidar.</p>
                </footer>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
        <script src="{{asset('./assets/extensions/apexcharts/apexcharts.min.js')}}" defer></script>
        <script src="{{asset('./assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}" defer></script>
        <script src="{{asset('./assets/compiled/js/app.js')}}" defer></script>
        <script src="{{asset('./assets/compiled/js/new.js')}}" defer></script> 
        <script src="{{asset('./assets/static/js/components/dark.js')}}" defer></script>
    </div>
</body>
</html>
