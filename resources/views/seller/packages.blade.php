<x-app-layout>
  @section('title', 'Dashboard')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      


    @foreach ($packages as $package)
      <x-card md="4">
        <div class="card text-center">
          <div class="card-header">
            {{$package->package_name}}
          </div>
          <div class="card-body">
            <h5 class="card-title">$ {{$package->price}}</h5>
            <p class="card-text">{{$package->details}}</p>
            <p class="card-text">{{$package->max_limit}}</p>
            <p class="card-text">@if ($package->package_type == 1)
                Daily
            @else
                Monthly
            @endif</p>
            <a href="#" class="btn btn-primary">Buy Now</a>
          </div>
          <div class="card-footer text-muted">
            2 days ago
          </div>
        </div>
      </x-card>
    @endforeach
        

</x-app-layout>


