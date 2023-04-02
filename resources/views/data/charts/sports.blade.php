<canvas id="sportsChart-{{$id}}"></canvas>

@section('js_scripts')
<script>
    new Chart(document.getElementById("sportsChart-{{$id}}"), {
        type: 'line',
        data: {
            labels: ["2014", "2015", "2016", "2017"],
            datasets: [{
                label: 'Sin NBI',
                data: [77.7, 78.4, 79.4, 79.8],
                backgroundColor: [
                    'rgba(255,255,255, 0.0)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',

                ],
                borderWidth: 1
            },
                {
                    label: 'Con 1 NBI',
                    data: [15.6, 15.6, 15.2, 15.5],
                    backgroundColor: [
                        'rgba(255,255,255, 0.0)'
                    ],
                    borderColor: [
                        'rgba(128,0,0,1)',

                    ],
                    borderWidth: 1
                },

                {
                    label: 'Con 2 NBI',
                    data: [3.7, 3.5, 3.2, 2.8],
                    backgroundColor: [
                        'rgba(255,255,255, 0.0)'
                    ],
                    borderColor: [
                        'rgba(0,0,128,1.0)',

                    ],
                    borderWidth: 1
                },

                {
                    label: 'Con 3 o mas NBI',
                    data: [3, 2.5, 2.3, 1.9],
                    backgroundColor: [
                        'rgba(255,255,255, 0.0)'
                    ],
                    borderColor: [
                        'rgba(0,255,0,1.0)',

                    ],
                    borderWidth: 1
                },

            ]
        },
        options: {
            title: {
                display: true,
                text: 'Distribución porcentual de hogares según cantidad de NBI que presenta 2014-2017. Total país'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection