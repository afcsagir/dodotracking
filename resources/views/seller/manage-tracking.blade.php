
 <!DOCTYPE html>
            <html lang="en">

            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <meta name="csrf-token" content="{{ csrf_token() }}">

              <title>DoDotracking - Manage Tracking</title>

              <!-- Fonts -->
              <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

              <!-- Styles -->
           <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
              <!-- Chart -->

            </head>

            <body class="font-sans antialiased">
              <div class="min-h-screen bg-gray-100">

                @include('layouts.navigation')
               

<main class="grid gap-x-8 gap-y-8 grid-cols-12 py-8 md:py-12 px-8 justify-center md:px-12 ">
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!--   only bootstrap by asif -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<style>

   a:hover{
    text-decoration: none;
  }

  [x-cloak] {
    display: none;
  }

  .duration-300 {
    transition-duration: 300ms;
  }

  .ease-in {
    transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
  }

  .ease-out {
    transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
  }

  .scale-90 {
    transform: scale(.9);
  }

  .scale-100 {
    transform: scale(1);
  }

  .modal-hide {
    display: none !important;
  }
  .tracking_table{
    text-align: center;
  }

  .btns {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 16px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }

  .btns_limit{
    background-color: #10B880;
    border: none;
    color: white;
    padding: 12px 16px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }

  /* Darker background on mouse-over */
  .btns:hover {
    background-color: RoyalBlue;
  }
</style>
<?php 
$max_limits  = '';
$message = '';
$percantage_value = '';
if(!empty(Auth::user()->package_id)){
      $max_limits = $this_users_limit->max_limit;
      //$message =  '(Used - '.count($total_tracking_orders).' , Max Limit-' .$max_limits. ')';
      if($max_limits>0){
        $percantage_value = (count($total_tracking_orders)*100)/$max_limits;
      
      }
    }          
?>



<div
class="bg-white rounded-md w-full overflow-hidden col-span-12 md:col-span-12 shadow">
<div class="pb-2">
  <div class="p-6 rounded-lg bg-white">
    <div class="md:justify-between">
   @if(!empty($users_packages))
        <h2 class="text-xl text-gray-800 font-bold leading-tight">Manage Tracking {{ $message }}<a style="color: #28a745;" class="pull-right">{{count($total_tracking_orders)}}/{{$max_limits}}</a></h2>

@endif
    
    </div>

@if(empty($users_packages))

 <div class="md:justify-between" style="margin-top: 15px;">
   
        <h2 class="text-xl text-gray-800 font-bold leading-tight">Manage Tracking <a style="color: #28a745;" class="pull-right"></a></h2>

    
    </div>
  <div class="alert alert-danger col-lg-12" role="alert">
 You have No packages purchased yet. please choose a package from here.
    <a href="{{route('your_packages')}}" style="text-decoration: underline; font-weight: bold;">All packages</a>
</div>
  @else

<div class="progress" style="height: 20px">
  <div
    class="progress-bar bg-success"
    role="progressbar"
    style="width: {{(int)$percantage_value}}%"
    aria-valuenow="{{(int)$percantage_value}}"
    aria-valuemin="0"
    aria-valuemax="100"
  >
    {{(int)$percantage_value}}%
  </div>
</div>
    <div class="my-8 relative">
      <div class="mt-4">

         @if(session('danger'))
        <x-alert-danger>{{ session('danger') }}</x-alert-danger>
      @endif
      @if(session('success'))
                <x-alert-success>{{ session('success') }}</x-alert-success>
      @endif
      @if ($errors->any())
          <x-alert-danger>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
        </x-alert-danger>
      @endif

        <button style="margin-top: -15px;" class="btns" id="BtnInsert"><i class="fa fa-plus"></i> Add</button>

        <button class="btns" id="BtnImport"><i class="fa fa-upload"></i> Import</button>



       <!--  <button style="float: right;" class="btns_limit" style="background-color: #00c851 !important;">Limit - {{$max_limits}} (Per Day)</button> -->


    
  <div class="my-4">
        <x-input type="date" name="input-date" id="inputDate">
        </x-input>
      </div>

<!-- insert modal -->
<div class="modal-insert modal-hide">
  <div style="background-color: rgba(0,0,0,0.5)"
  class="overflow-auto fixed inset-0 z-10 flex items-center justify-center">
  <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg pt-4 pb-6 text-left px-6"
  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
  x-transition:enter-end="opacity-100 scale-100">

  <div class="flex justify-between items-center pb-3">
    <p class="text-2xl font-bold">Add Tracking</p>

    <div class="cursor-pointer z-50" id="closeModalInsert">
      <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
      height="18" viewBox="0 0 18 18">
      <path
      d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
    </path>
  </svg>
</div>
</div>

 <form method="POST" action="{{ route('insert tracking') }}" id="form-insert">
      @csrf
      <div>
        <x-label>
          Name
        </x-label>
        <x-input type="text" name="name" id="name" :value="old('name')" required>
        </x-input>
      </div>
      {{-- <div class="mt-6">
        <x-label>
          Phone
        </x-label>
        <x-input type="text" name="phone" id="phone" :value="old('phone')"
        required>
      </x-input>
    </div> --}}
      <div class="mt-4">
        <x-label>
          Tracking Id
        </x-label>
        <x-input type="text" name="tracking-id" id="trackingId" :value="old('tracking-id')"
        required>
      </x-input>
    </div>
    <div class="mt-4">
      <x-label>
        Shipper
      </x-label>
      <!-- <x-select name="shipper" id="shipper" required> -->
        <select name="shipper" id="shipper" required="required" style="width: 100%;">
        <option value="">Select Shipper</option>
        @foreach ($shippers as $shipper)
        <option value="{{ $shipper->id }}"> {{ $shipper->name }} </option>
        @endforeach
      </x-select>
    </div>
    <div class="flex justify-end mt-4">
      <x-button color="blue">Save</x-button>
    </div>
  </form>
</div>
</div>
</div>



<!-- Import form -->
<div class="modal-import modal-hide">
  <div style="background-color: rgba(0,0,0,0.5)"
  class="overflow-auto fixed inset-0 z-10 flex items-center justify-center">
  <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg pt-4 pb-6 text-left px-6"
  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
  x-transition:enter-end="opacity-100 scale-100">

  <div class="flex justify-between items-center pb-3">
    <p class="text-2xl font-bold">Import Tracking</p>
    
    <div class="cursor-pointer z-50" id="closeModalImport">
      <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
      height="18" viewBox="0 0 18 18">
      <path
      d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
    </path>
  </svg>
</div>
</div>

<form method="POST" action="{{ route('import_tracking') }}" id="form-import" enctype="multipart/form-data">
  @csrf
  <div>
    <x-label>
      File
    </x-label>
    <x-input type="file" name="file" id="file" required>
    </x-input>
  </div>
  <div class="mt-6">
    <x-label>
      Shipper
    </x-label>
    <select name="shipper" id="shipper" required="required" style="width: 100%;">
      <option value="">Select Shipper</option>
      @foreach ($shippers as $shipper)
      <option value="{{ $shipper->id }}"> {{ $shipper->name }} </option>
      @endforeach
    </select>
  </div>
  <div class="flex justify-end mt-4">
    <x-button color="blue" type="submit" id="BtnImportSubmit">Save</x-button>
  </div>
</form>
</div>
</div>
</div>
<!-- End Import form -->




<div class="modal-update modal-hide">
  <div style="background-color: rgba(0,0,0,0.5)"
  class="overflow-auto fixed inset-0 z-10 flex items-center justify-center">
  <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg pt-4 pb-6 text-left px-6"
  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
  x-transition:enter-end="opacity-100 scale-100">

  <div class="flex justify-between items-center pb-3">
    <p class="text-2xl font-bold">Update Tracking</p>
    
    <div class="cursor-pointer z-50" id="closeModalUpdate">
      <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
      height="18" viewBox="0 0 18 18">
      <path
      d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
    </path>
  </svg>
</div>
</div>

<form method="POST" action="{{ route('update order') }}" id="form-update"></form>
</div>
</div>
</div>


</div>


<form action="#">
  <div class="flex justify-between flex-col">
    <div class="overflow-x-auto">
      <table class="table-auto border-collapse w-full border mt-4" id="datatable" style="text-align: center;">
        <thead class="border bg-green-300" style="text-align: center;">
          <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
            <th class="px-4 py-2 border-2 tracking_table">Date/Time</th>
            <th class="px-4 py-2 border-2 tracking_table">Name</th>
            {{-- <th class="px-4 py-2 border-2">Phone</th> --}}
            <th class="px-4 py-2 border-2 tracking_table">Tracking Id</th>
            <th class="px-4 py-2 border-2 tracking_table">Shipper</th>
            <th class="px-4 py-2 border-2 tracking_table">Input Method</th>
            <th class="px-4 py-2 border-2 tracking_table">Manage</th>
          </tr>
        </thead>
      </table>

    </div>
  </div>

</form>
</div>
</div>
</div>
</div>
@endif



<script type="text/javascript" src="/js/excel.js"></script>
<script>
  $(document).ready(function() {

                // autofill input date with today
                Date.prototype.toDateInputValue = (function() {
                  var local = new Date(this);
                  return local.toJSON().slice(0, 10);
                });
                document.getElementById('inputDate').value = new Date().toDateInputValue();


                dataTables("{{ route('data tracking') }}?date=" + $(this).val());

                var datatable;

                $('#inputDate').change(function() {
                  datatable.destroy();
                    // console.log($(this).val());
                    dataTables("{{ route('data tracking') }}?date=" + $(this).val());

                  });

                function dataTables(url) {

                    // Datatable
                    datatable = $('#datatable').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax: url,
                      columns: [{
                        name: 'date',
                        data: 'date'
                        // "render": function(data, type, row, meta) {
                        //   return row.time + " " + row.date;
                        // }
                      },
                      {
                        name: 'buyer',
                        data: 'buyer'
                      },
                      // {
                      //   name: 'phone',
                      //   data: 'phone'
                      // },
                      {
                        name: 'tracking_id',
                        data: 'tracking_id'
                      },
                      {
                        name: 'shipper',
                        data: 'shipper'
                      },
                      {
                        name: 'input_method',
                        data: 'input_method'
                      },
                      {
                        name: 'manage',
                        data: 'manage'
                      }
                      ]
                    });
                  }

                  $('#BtnImport').click(function(){
                    $('.modal-import').removeClass('modal-hide');
                  });

                  $('#BtnInsert').click(function() {
                    $('.modal-insert').removeClass('modal-hide');
                  });

                  $(document).on('click', '#BtnUpdate', function() {
                    $('.modal-update').removeClass('modal-hide');
                    $.ajax({
                      url: '{{ route('data tracking') }}?id=' + $(this).data('id'),
                      beforeSend: function() {
                        $('#form-update').html('Loading');
                      }
                    }).done(function(result) {
                      $('#form-update').html(result);
                    });
                  });

                  $('#closeModalUpdate').click(function() {
                    $('.modal-update').addClass('modal-hide');
                  });

                  $('#closeModalInsert').click(function() {
                    $('.modal-insert').addClass('modal-hide');
                  });

                  $('#closeModalImport').click(function() {
                    $('.modal-import').addClass('modal-hide');
                  });


                       $(document).on('click', '#BtnDelete', function() {

                        let drop = confirm('Are you sure?');

                        if (drop) {

                          $.ajax({
                            url: '{{ route('delete tracking') }}',
                            type: 'post',
                            data: {
                              'id': $(this).data('id'),
                              '_token': $('meta[name=csrf-token]').attr('content')
                            },
                            beforeSend: function() {
                                // Pesan yang muncul ketika memproses delete
                              }
                            }).done(function(result) {
                              if (result.status === 1) {
                                // Pesan jika data berhasil di hapus
                                alert('Data deleted successfully');
                                $('#datatable').DataTable().ajax.reload();
                              } else {
                                alert(result.message);
                              }

                            });


                          }
                        });
                     });

                   </script>
            </main>
          </div>
        </body>

        </html>

