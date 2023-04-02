<canvas id="murdersChart-{{$id}}"></canvas>
@section('js_scripts')
<script>
    new Chart
    (document.getElementById("murdersChart-{{$id}}").getContext('2d'),
        {
            type: 'line',
            data: {
                labels: ['1980', '1981', '1982', '1983', '1984', '1985', '1986', '1987', '1988', '1989', '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018'
                ],
                datasets: [{
                    label: 'Quantity of murders 1980-2018 - Uruguay',
                    data: [
                        126, 144, 179, 126, 110, 119, 165, 159, 144, 198, 206, 194, 182, 49, 41, 191, 205, 243, 244, 216, 214, 218, 231, 197, 200, 190, 202, 195, 104, 226, 310, 199, 267, 260, 268, 289, 265, 283, 414
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
                    text: 'Quantity of murders 1980-2018 - Uruguay'
                }
            }

        }
    );
</script>
@endsection


