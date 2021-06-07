<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'MINI-CRM') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('companies') }}">Companies</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employees') }}">Employees</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Company

        $('#AddCompany').click(function(){
            $('#id').val('');
            $('#old_image').val('');
            $('#CompModel').modal('show');
            $('#com_reg').trigger('reset');
            $('.modal-title').html('Create new Company');
        });

        $(document).on('submit', '#com_reg', function(e) {
            e.preventDefault();
            var form_data = new FormData(this);
            $.ajax({
                url: '{{ route('companies_create') }}',
                method: 'POST',
                data: form_data,
                processData: false,
                contentType: false,
                cache: false,
                success: function() {
                    setTimeout(function(){
                        location.reload();
                    },1000);
                }
            });
        });

        $(document).on('click','.edit_com',function(){                        
            var _id = $(this).attr('id');
            $.ajax({
                url:'{{ route('companies_edit') }}',
                method: 'POST',
                data : {id:_id},
                dataType:'json',
                cache: false,
                success: function(data){
                    $('#CompModel').modal('show');
                    $('.modal-title').html('Edit Details');
                    $('#com_submit').val('Edit');
                    $('#id').val(data.id);
                    $('#old_image').val(data.logo);
                    $('#com_name').val(data.name);
                    $('#com_email').val(data.email);
                    $('#com_web').val(data.website);                                        
                }
            });
        });

        $(document).on('click','.delete_com',function(){            
            if(confirm("Are you sure want to delete!")){
                var _id = $(this).attr('id');
                $.ajax({
                    url:'{{ route('companies_delete') }}',
                    method:'post',
                    data:{id:_id},
                    success:function() {
                        setTimeout(function(){
                            location.reload();
                        });
                    }
                });
            }
        });

        //Employee Script        

        $('#AddEmployee').click(function(){
            $('#emp_id').val('');
            $('#EmpModel').modal('show');
            $('#emp_reg').trigger('reset');
            $('.modal-title').html('Create new Employee');
        });

        $(document).on('submit', '#emp_reg', function(e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: '{{ route('employees_create') }}',
                method: 'POST',
                data: form_data,
                cache: false,
                success: function() {
                    setTimeout(function(){
                        location.reload();
                    },1000);
                }
            });
        });

        $(document).on('click','.edit_emp',function(){                        
            var _id = $(this).attr('id');
            $.ajax({
                url:'{{ route('employees_edit') }}',
                method: 'POST',
                data : {id:_id},
                dataType:'json',
                cache: false,
                success: function(data){
                    $('#EmpModel').modal('show');
                    $('.modal-title').html('Edit Details');
                    $('#emp_submit').val('Edit');
                    $('#emp_id').val(data.id);
                    $('#com_name').val(data.company_id);
                    $('#emp_fname').val(data.first_name);
                    $('#emp_lname').val(data.last_name);
                    $('#emp_email').val(data.email);
                    $('#emp_phone').val(data.phone);                                        
                }
            });
        });

        $(document).on('click','.delete_emp',function(){            
            if(confirm("Are you sure want to delete!")){
                var _id = $(this).attr('id');
                $.ajax({
                    url:'{{ route('employees_delete') }}',
                    method:'post',
                    data:{id:_id},
                    success:function() {
                        setTimeout(function(){
                            location.reload();
                        });
                    }
                });
            }
        });
    });
</script>
</html>
