$(function () {

    require.config({
        paths: {
            echarts: 'resources/assets/js/plugins/visualization/echarts'
        }
    });

    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],

        function (ec, limitless) {

            var basic_columns = ec.init(document.getElementById('basic_columns'), limitless);

            basic_columns_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['สำเร็จ', 'ไม่สำเร็จ'],
                    textStyle: {
                        fontFamily: 'Noto Sans Thai, sans-serif'
                    }
                },

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'สำเร็จ',
                        type: 'bar',
                        data: [2, 4, 7, 23, 25, 76, 135, 162, 32, 20, 6, 3],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        },
                        markLine: {
                            data: [{type: 'average', name: 'Average'}]
                        }
                    },
                    {
                        name: 'ไม่สำเร็จ',
                        type: 'bar',
                        data: [2, 5, 9, 26, 58, 70, 175, 182, 48, 18, 6, 2],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        },
                        markLine: {
                            data: [{type: 'average', name: 'Average'}]
                        }
                    }
                ]
            };

            basic_columns.setOption(basic_columns_options);

            window.onresize = function () {
                setTimeout(function () {
                    basic_columns.resize();
                }, 200);
            }
        }
    );
});
