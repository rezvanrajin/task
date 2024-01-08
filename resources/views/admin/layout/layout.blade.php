<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="uploads/favicon.png">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    @routes
   @include('admin.layout.css')

   @include('admin.layout.scripts')

</head>

<body>
<div id="app">
    <div class="main-wrapper">

        <div class="navbar-bg"></div>
        @include('admin.layout.nav')



        <div class="main-sidebar">
        @include('admin.layout.sidebar')
        </div>

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('heading')</h1>
                                                          <div class="ml-auto">
                                     @yield('button')                           
                    </div>
                </div>
@yield('content')
            </section>
        </div>

    </div>
</div>
  

    
       
    
</body>
</html>