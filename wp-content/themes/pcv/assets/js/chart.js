jQuery(document).ready(function ($) {
    if ($('#myChart').length > 0) {
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    borderRadius: 20,
                    data: data,
                    backgroundColor: [
                        'rgba(0, 0, 0, 0.15)'
                    ],
                    hoverBackgroundColor: [
                        'rgba(0, 0, 0, 0.35)'
                    ],
                    borderColor: [
                        'rgba(255,255,255,100)'
                    ],
                    borderWidth: 1

                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            callback: function (val, index, bonjour) {
                                return index === 0 || index === (bonjour.length - 1) ? this.getLabelForValue(val) : '';
                            },
                            color: 'black',
                            maxRotation: 0,
                            minRotation: 0,
                            major: {
                                enabled:false
                            }
                        },
                        //display: false,
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display: false,
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
})