<canvas id="politicsChart-{{$id}}"></canvas>

@section('js_scripts')
<script>
   $(document).ready(function(){
     new Chart
    (document.getElementById("politicsChart-{{$id}}").getContext('2d'),
        {
            type: 'line',
            data: {
                labels: ['2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017'
                ],
                datasets: [{
                    label: 'Percentage of persons in Poverty - Uruguay',
                    data: [
                        32.5, 29.6, 24.2, 21, 18.5, 13.7, 12.4, 11.5, 9.7, 9.7, 9.4, 7.9
                    ],
                    backgroundColor: [
                        'rgba(255,255,255, 0.0)'],
                    borderColor: [
                        'rgba(255,99,132,1)'],

                }],
            },

            options: {
                title: {
                    display: true,
                    text: 'Porcentaje de personas en situacion de pobreza 2006-2017'
                }
            }

        }
    );
   });
</script>
@endsection
