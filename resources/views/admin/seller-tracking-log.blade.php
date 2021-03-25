<x-app-layout>
    @section('title', 'Manage Seller')
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <style>
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

        </style>
        <x-card title="{{$user->name}}">
            <div class="mt-6">
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
            </div>
            <div class="flex justify-between flex-col">
                <div class="overflow-x-auto">
                    <table class="table-auto border-collapse w-full border mt-4" id="datatable">
                        <thead class="border bg-green-300">
                            <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                     
                                <th class="px-4 py-2 border-2">Date</th>
                                <th class="px-4 py-2 border-2">Today Searched</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trackingLogs as $trackingLog)
                                <tr>
                                    <td>{{$trackingLog->date}}</td>
                                    <td>{{$trackingLog->total}}</td>
                              
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </x-card>




    </x-app-layout>
