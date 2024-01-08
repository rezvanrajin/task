<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exchanges Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white shadow sticky-top">
        <div class="container">
        <a class="navbar-brand" href="{{route('user.plan')}}">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
          </ul>
        </div>
    </div>
      </nav>

      <div class="py-5">
        <div class="container">
          @if (Session::has('success'))
          <div class="alert alert-success">{{Session::get('success')}}</div>
          @php
              Session::forget('success')
          @endphp
      @endif
      <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">
                
                <h5 class="card-title">Basic</h5>
                <p class="card-text">$10.00/mon <br/>no hidden fees</p>
                <a href="{{route('basicPay')}}" class="btn btn-primary">Pay Now</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">       
               <h5 class="card-title">Pro Plan</h5>
                <p class="card-text">$40.00/mo<br/>
                    no hidden fees</p>
                <a href="{{route('proPlan')}}" class="btn btn-primary">Pay Now</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
              <div class="card-body">       
                <h5 class="card-title">Business Plan</h5>
                <p class="card-text">$80.00/mo<br/>
                  no hidden fees</p>
                <a href="{{route('businessPay')}}" class="btn btn-primary">Pay Now</a>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>