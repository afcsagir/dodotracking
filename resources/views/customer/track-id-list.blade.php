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
  {{-- datatable --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  

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

      <div style="padding-top: 20%">
        <div class="row ">
          <div class="col-4"></div>
              <div class="flex md:w-1/5 justify-center ">
                @if (session()->has('userLogo'))
                <img class="w-6/12 md:w-4/5" src="{{ asset(session()->get('userLogo')) }}  " alt="">
               @else
               <img class="w-6/12 md:w-4/5" src="@if(isset($userLogo)) {{ asset($userLogo) }} @else {{ asset('img/dodotracking.png') }} @endif " alt="">
                @endif
     
              </div>
        </div>

        <div class="row pt-5">
          <div class="col-4"></div>
          <div class="card">
            <div class="card-body">
              @if(session()->has('error'))
              <div class="alert alert-danger mb-3 background-danger" role="alert">
                  {{ session()->get('error') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
              <form method="POST" action="{{route('track id req')}}" id="form-import" enctype="multipart/form-data">
                @csrf
                    @if (isset($seller))
                      <input type="hidden" name="seller_id" value={{$seller->id}}>
                    @endif
                  <div class="form-group">
                    <label for="exampleInputPassword1">Date</label>
                    <input type="date" name='date' class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1" id="exampleInputPassword1" placeholder="Date" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name='name' class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>
                  </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> 
              </form>
          </div>
        </div>
      </div>

      <div class="pb-5">
        @if (session()->has('data'))    
        <div class="card mt-5 ">
          <div class="card-header">
            <h4>Tracking Id List</h4>
          </div>
          <div class="card-body">
            <table id="table_id" class="display">
              <thead>
                  <tr>
                      <th>Date</th>
                      <th>Name</th>
                      <th>Tracking Number</th>
                      <th>Shipper</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach (session()->get('data') as $item)    
                    <tr>
                        <td>{{$item->date}}</td>
                        <td>{{$item->buyer}}</td>
                        <td>{{$item->tracking_id}}</td>
                        <td>@if (isset($item->shipper)) {{$item->shipper->name}} @endif</td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif
      </div>
    </div>


  </div>
  <script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
  </script>
</body>

</html>
