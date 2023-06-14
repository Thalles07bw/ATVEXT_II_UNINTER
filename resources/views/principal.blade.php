<html>
    @include('partials.header')
    <body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Conteudo do site -->
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Orçamento Médio por departamento</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{number_format($om_depto,2,',','.')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-4 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Orçamento médio por colaborador</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{number_format($om_colab,2,',','.')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-md-4 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Quantidade de Colaboradores Efetivados</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$qtd_colab}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header-->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Colaboradores Por Gênero</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="grafico-sexo" width="672" height="245" style="display: block; width: 672px; height: 245px;" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: pink;"></i> Feminino
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: blue;"></i> Masculino
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: magenta;"></i> LGBTQIA+
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Colaboradores Por Escolaridade</h6>
                        </div>
                    
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="grafico-ensino" width="672" height="245" style="display: block; width: 672px; height: 245px;" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: orange;"></i> Superior
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: green;"></i> Técnico
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: blue;"></i> Médio
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: red;"></i> Fundamental
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header-->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Possuem Necessidade Especial</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="grafico-pcd" width="672" height="245" style="display: block; width: 672px; height: 245px;" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: orange;"></i> Sim
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: blue;"></i> Não
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Colaboradores Por Senioridade</h6>
                        </div>       
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="grafico-senioridade" width="672" height="245" style="display: block; width: 672px; height: 245px;" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: orange;"></i> Júnior
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: green;"></i> Pleno
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: blue;"></i> Sênior
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: red;"></i> Estagiário
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: purple;"></i> Trainee
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle" style="color: yellow;"></i> Jovem Aprendiz
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    @include('partials.footer')
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        let maximo = parseInt('{{$qtd_colab}}')
  
        // Pie Chart Example
        var ctx = document.getElementById("grafico-sexo");
        var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Feminino", "Masculino", "LGBTQIA+"],
            datasets: [{
            data: ['{{$fem}}', '{{$masc}}', '{{$lgbt}}'],
            backgroundColor: ['pink', 'blue', 'magenta'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(0,0,0)",
            bodyFontColor: "#ffffff",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            },
            legend: {
            display: false
            },
            cutoutPercentage: 80,
        },
        });

        // Pie Chart Example 2
        var ctx = document.getElementById("grafico-ensino");
        var myPieChart2 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Superior", "Médio", "Técnico" ,"Fundamental" ],
            datasets: [{
            data: ['{{$superior}}', '{{$medio}}', '{{$tecnico}}', '{{$fundamental}}'],
            backgroundColor: ['orange', 'blue', 'green', 'red'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', 'magenta'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(0,0,0)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        
            },
            scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    max: maximo
                }
            }]
            },

            legend: {
            display: false
            },
            cutoutPercentage: 80,
        },
        });
        //Grau Hierárquico
        var ctx = document.getElementById("grafico-senioridade");
        var myPieChart2 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Júnior", "Pleno", "Senior" ,"Estágiario", "Trainee" , "Jovem Aprendiz" ],
            datasets: [{
            data: ['{{$junior}}', '{{$pleno}}', '{{$senior}}', '{{$estagiario}}', '{{$trainee}}', '{{$ma}}'],
            backgroundColor: ['orange', 'blue', 'green', 'red', 'purple', 'yellow'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', 'magenta', 'pink'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(0,0,0)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        
            },
            scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    max: maximo
                }
            }]
            },

            legend: {
            display: false
            },
            cutoutPercentage: 80,
        },
        });

        //Grau Hierárquico
        var ctx = document.getElementById("grafico-pcd");
        var myPieChart2 = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Sim", "Não"],
            datasets: [{
            data: ['{{$pcd}}', '{{$npcd}}'],
            backgroundColor: ['orange', 'blue'],
            hoverBackgroundColor: ['#2e59d9', '#17a673'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(0,0,0)",
            bodyFontColor: "#ffffff",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            },
            legend: {
            display: false
            },
            cutoutPercentage: 80,
            },
        });



        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
            label: "Earnings",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [5000, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, null, null, null],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                beginAtZero: true,
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return 'R$ ' + number_format(value);
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': R$ ' + number_format(tooltipItem.yLabel);
                }
            }
            }
        }
        });
    </script>
</html>