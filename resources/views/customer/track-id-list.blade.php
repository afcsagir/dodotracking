<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'DodoTracking') }} - Track Id List</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <style type="text/css">
    a:hover{
      text-decoration: none;
    }

    @media screen and (max-width: 600px) {
  .pricing_title{
    margin-top: 60px;
  }

  
}

.card-header h2{
    font-size: 22px;
    font-weight: bold !important;
  }

  .lead{
    font-size: 18px;
  }
  </style>
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100">


    <!--     // start navigation area -->

    <style type="text/css">
      a:hover{
        text-decoration: none;
      }
    </style>
    

    <div class="container">
      <div class="flex md:w-1/5 justify-center">
        <img class="w-6/12 md:w-4/5" src="@if(isset($userLogo)) {{ asset($userLogo) }} @else {{ asset('img/dodotracking.png') }} @endif " alt="">
      </div>

    </div>


  </div>
</body>

</html>
