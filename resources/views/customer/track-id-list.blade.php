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
    /*.footer_asif{
      position: fixed;
      width: 100%;
      bottom: 0;
      font-size: 16px;
    }*/
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


      <div class="row" style="padding-top: 4%;">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
          <div class="flex justify-center" style="width: 70%; margin: 0 auto; padding-bottom: 4%;">
            @if (session()->has('userLogo'))
            <img src="{{ asset(session()->get('userLogo')) }}  " alt="">
            @else
            <img src="@if(isset($userLogo)) {{ asset($userLogo) }} @else {{ asset('img/dodotracking.png') }} @endif " alt="">
            @endif

          </div>

          <div class="form-group text-center" style="padding-top: 2%; padding-bottom: 2%; font-size: 18px;">
            You can check your tracking No by enterning order date and  name from here.
          </div>

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
                  <label for="exampleInputPassword1"><strong>Order Date</strong></label>
                  <input type="date" name='date' class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1" id="exampleInputPassword1" placeholder="Date" required value="{{old('date')}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><strong>Full Name</strong></label>
                  <input type="text" name='name' class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required value="{{old('name')}}">
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> 
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4"></div>

      </div>


      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
         <div class="pb-5">
          @if (session()->has('data'))    
         <!--  <div class="card mt-5 ">
            <div class="card-header">
              <h4><strong>Your Tracking  List</strong></h4>
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
        </div> -->

         <h4 style="padding-top: 5%; padding-bottom: 2%;"><strong>Your Tracking  List</strong></h4>

        <table class="table">
              <thead class="thead-light">
                <tr style="background-color: #F7941E; color: #FFFFFF;">
                  <th>Date</th>
                  <th>Name</th>
                  <th>Tracking Number</th>
                  <th>Shipper</th>
                </tr>
              </thead>
              <tbody>
                @if(count(session()->get('data')) > 0)
                  @foreach (session()->get('data') as $item)    
                    <tr>
                        <td>{{date('d-M-Y', strtotime($item->date))}}</td>
                        <td>{{$item->buyer}}</td>
                        <td>{{$item->tracking_id}}</td>
                        <td>@if (isset($item->shipper)) {{$item->shipper->name}} @endif</td>
                    </tr>
                  @endforeach    
                  @else
                  <tr>
                    <td style="text-align: center;" colspan="4">No data Found</td>
                  </tr>
                  @endif      
              </tbody>
            </table>
        @endif
      </div>
    </div>
    <div class="col-lg-2"></div>

  </div>




</div>

<div class="text-center p-3 footer_asif" style="background-color: rgba(0, 0, 0, 0.2);">
    Powered By
    <a class="text-dark" href="https://dodotracking.com/">Dodotracking.com</a>
  </div>
<script>
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
</script>
</body>

</html>
