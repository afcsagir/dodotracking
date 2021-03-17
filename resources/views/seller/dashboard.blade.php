<x-app-layout>
    @section('title', 'Dashboard')

        <x-card title="Daily Summary" md="8">
            <div class="overflow-x-auto">
                <canvas class="h-16" id="chart" style=""></canvas>
            </div>
        </x-card>

        <div class="w-full overflow-hidden col-span-12 md:col-span-4">
            <div>
                <div class="flex flex-row w-full bg-white shadow-sm rounded p-4">
                    <div
                        class="flex items-center justify-center flex-shrink-0 h-16 w-16 rounded-xl bg-blue-100 text-blue-500">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#3B82F6">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-center flex-grow ml-4">
                        <div class="text-md text-gray-500">Last 7 Days</div>
                        <div class="font-bold text-xl">
                            {{ $orders }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script>
            var ctx = document.getElementById('chart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: ['{{ $dates[0] }}', '{{ $dates[1] }}', '{{ $dates[2] }}',
                        '{{ $dates[3] }}',
                        '{{ $dates[4] }}', '{{ $dates[5] }}', '{{ $dates[6] }}'
                    ],
                    datasets: [{

                        label: 'Daily Total Order',
                        backgroundColor: 'rgb(59, 130, 246)',
                        borderColor: 'rgb(59, 130, 246)',
                        data: [{{ $data[0] }}, {{ $data[1] }}, {{ $data[2] }},
                            {{ $data[3] }},
                            {{ $data[4] }}, {{ $data[5] }}, {{ $data[6] }}
                        ]
                    }],
                    options: {
                        legend: {
                            display: false,
                        }
                    }
                },

                // Configuration options go here
                options: {
                    //   legend: {
                    //       display: true,
                    //       position: 'top',
                    //       width:'500px',
                    //       labels: {
                    //           boxWidth: 80,
                    //         fontColor: 'black'
                    //     }
                    // }
                }
            });
            // function app() {
            //     return {
            //         chartData: [{{ $data[0] }}, {{ $data[1] }}, {{ $data[2] }}, {{ $data[3] }},
            //             {{ $data[4] }}, {{ $data[5] }}, {{ $data[6] }}
            //         ],

            //         labels: ['{{ $dates[0] }}', '{{ $dates[1] }}', '{{ $dates[2] }}', '{{ $dates[3] }}',
            //             '{{ $dates[4] }}', '{{ $dates[5] }}', '{{ $dates[6] }}'
            //         ],

            //         tooltipContent: '',
            //         tooltipOpen: false,
            //         tooltipX: 0,
            //         tooltipY: 0,
            //         showTooltip(e) {
            //             console.log(e);
            //             this.tooltipContent = e.target.textContent
            //             this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
            //             this.tooltipY = e.target.clientHeight + e.target.clientWidth;
            //         },
            //         hideTooltip(e) {
            //             this.tooltipContent = '';
            //             this.tooltipOpen = false;
            //             this.tooltipX = 0;
            //             this.tooltipY = 0;
            //         }
            //     }
            // }

        </script>

    </x-app-layout>
