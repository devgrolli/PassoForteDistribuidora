<script src="{{ asset('assets/chart.js') }}"></script>
@section('js')
    <script>
        $.ajax({
            type: "GET",
            url: "{{ URL('/graficoEntrada') }}",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                var ctx = document.getElementById('chartEntrada').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data[1],
                        datasets: [{
                            label: 'Quantidade de entradas nos últimos 6 meses',
                            data: data[0],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgb(74,225,243,0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgb(74,225,243, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(response) {
                console.log(response);
            }
        });

        $.ajax({
            type: "GET",
            url: "{{ URL('/graficoSaida') }}",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                var ctx = document.getElementById('chartSaida').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data[1],
                        datasets: [{
                            label: 'Quantidade de saídas nos últimos 6 meses',
                            data: data[0],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgb(74,225,243,0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgb(74,225,243, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(response) {
                console.log(response);
            }
        });

        $.ajax({
            type: "GET",
            url: "{{ URL('/graficoSaida') }}",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                new Chart(document.getElementById("pie-chart"), {
                    type: 'doughnut',
                    data: {
                        labels: data[1],
                        datasets: [{
                            label: "Population (millions)",
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9",
                                "#c45850"
                            ],
                            data: data[0],
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Predicted world population (millions) in 2050'
                        }
                    }
                });
            },
            error: function(response) {
                console.log(response);
            }
        });
    </script>
@stop
