$(function () {

    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: 'resources/assets/js/plugins/visualization/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/pie',
            'echarts/chart/funnel'
        ],


        // Charts setup
        function (ec, limitless) {

            var basic_donut = ec.init(document.getElementById('basic_donut'), limitless);

            //
            // Basic donut options
            //

            basic_donut_options = {
                // Add title
                title: {
                    text: 'ประเภทงานประจำเดือน',
                    subtext: 'รายการประเภทของการส่งงาน',
                    x: 'center',
                    textStyle: {
                        fontFamily: 'Noto Sans Thai, sans-serif'
                    }
                },
                // Add legend
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: ['รับเช็ค','วางบิล','ส่งพัสดุ','ส่งเอกสาร','อื่นๆ'],
                    textStyle: {
                        fontFamily: 'Noto Sans Thai, sans-serif'
                    }
                },
                // Enable drag recalculate
                calculable: true,
                // Set chart height
                height: 400,
                // Add series
                backgroundColor: '#fff',
                series: [
                    {
                        name: 'Browsers',
                        type: 'pie',
                        radius: ['50%', '70%'],
                        center: ['50%', '57.5%'],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontFamily: 'Noto Sans Thai, sans-serif'
                                    }
                                },
                                labelLine: {
                                    show: true
                                }
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                                    position: 'center',
                                    textStyle: {
                                        fontSize: '17',
                                        fontWeight: '500',
                                        fontFamily: 'Noto Sans Thai, sans-serif'
                                    }
                                }
                            }
                        },
                        data: [
                            {value: 335, name: 'รับเช็ค'},
                            {value: 310, name: 'วางบิล'},
                            {value: 234, name: 'ส่งพัสดุ'},
                            {value: 135, name: 'ส่งเอกสาร'},
                            {value: 1548, name: 'อื่นๆ'}
                        ]
                    }
                ]
            };
            


 

            // Apply options
            // ------------------------------

            basic_donut.setOption(basic_donut_options);



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function (){
                    basic_donut.resize();
                }, 200);
            }
        }
    );
});
