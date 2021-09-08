<?php require ('network_data.php');  ?>
<script src="assets/js/highcharts.src.js"></script>
<script src="assets/js/networkgraph.js"></script>
<script src="assets/js/exporting.js"></script>

<div id="container"></div>
<script>


    var json = <?php echo $json_response; ?>,
        data = [];
    console.log(data)

    json.forEach(function(point) {
        //console.log(point.net_architect)
        data.push([point.domain_name, point.pcid, point.net_architect, point.os_version, point.pc_role, point.bin_list,
            point.user_name, point.pc_name, point.ram, point.proc, point.os_language, point.proccesses_list, point.servicies_list, point.disks,
            point.net_topology, point.bin_list])

        /*Nodes sizes*/
        Highcharts.addEvent(
            Highcharts.Series,
            'afterSetOptions',
            function (e) {
                nodes = {};
                let nodeCounts = {};

                //count connections for each From or To node
                e.options.data.forEach(function (link) {
                    nodeCounts[link[0]] = (nodeCounts[link[0]] || 0) + 1;
                    nodeCounts[link[1]] = (nodeCounts[link[1]] || 0) + 1;
                });

                let radiusFactor = 2; //radius multiplier to graphically enlarge nodes

                //map each nodeCount to a node object setting the radius
                e.options.nodes = Object.keys(nodeCounts).map(function (id) {
                    return {
                        id: id,
                        marker: {   radius: nodeCounts[id] * radiusFactor }
                    };
                });
            }
        );
        /*End of Nodes sizes*/

        Highcharts.chart('container', {
            chart: {
                type: 'networkgraph',
                height: '50%'
            },
            title: {
                text: 'Визуализация топологии сетей'
            },
            tooltip: {
                formatter: function () {
                    if ((pcid_count = data.length) > 0) {
                        for (i = 0; i < pcid_count; i++) {
                            return '<br/><b>ID: </b>' + this.point.name + '<br/><b>Архитектура: </b>' + data[0].net_architect + '<br/><b>ОС: </b>' + point.os_version +
                                '<br/><b>PC-роль: </b>' + this.point.pc_role + '<br/><b>User_Name: </b>' + point.user_name + '<br/><b>PC_Name: </b>' + point.pc_name +
                                '<br/><b>ОЗУ: </b>' + data[0].ram + '<br/><b>Процессор: </b>' + point.proc + '<br/><b>Язык ОС: </b>' + point.os_language +
                                '<br/><b>Запущенные процессы: </b>' + point.proccesses_list + '<br/><b>Запущенные службы: </b>' + point.servicies_list +
                                '<br/><b>Диски: </b>' + point.disks + '<br/><b>Топология сети: </b>' + point.net_topology + '<br/><b>Список бинарных файлов: </b>' + point.bin_list;
                        }
                    }
                }
            },
            plotOptions: {
                networkgraph: {
                    keys: ['from', 'to'],
                    layoutAlgorithm: {
                        enableSimulation: true,
                        friction: -0.9
                    }
                }
            },

            series: [{
                dataLabels: {
                    enabled: true,
                    linkFormat: ''
                },
                type: 'networkgraph',
                layoutAlgorithm: {
                    enableSimulation: true
                },
                dataGrouping: {
                    enabled: false
                },
                data: data
            }]

        });
    });
</script>
