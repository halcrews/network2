<?php require ('network_data.php');  ?>
<?php error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
?>
<title><?php echo 'Визуализация топологии сетей'; ?></title>
<script src="assets/js/highcharts.src.js"></script>
<script src="assets/js/networkgraph.js"></script>
<script src="assets/js/exporting.js"></script>
<script src="assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="assets/css/style.css">
<div style="width: 70%; float: left">
    <div id="container"></div>
</div>
<div >
    <div id="info"></div>
</div>

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

                let radiusFactor = 3; //radius multiplier to graphically enlarge nodes

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
                enabled: false,
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
                    },
                    point: {
                        events: {
                            click: function() {
                                for (i = 0; i < json.length; i += 1) {
                                    if (json[i].pcid === this.name) {
                                        let info =  ("ID: " + this.name + "\n" + " ОЗУ: " + json[i].ram + "\n" + "Архитектура: " + json[i].net_architect
                                            + "\n" +"ОС: " + json[i].os_version + "\n" + "PC-роль: " + json[i].pc_role + "\n" + "User_Name: " + json[i].user_name
                                            + "\n" + "PC_Name: " + json[i].pc_name + "\n" + "ОЗУ: " + json[i].ram + "\n" + "Процессор: " + json[i].proc
                                            + "\n" + "Язык ОС: " + json[i].os_language + "\n" + "Запущенные процессы: " + json[i].proccesses_list
                                            + "\n" + "Запущенные службы: " + json[i].servicies_list + "\n" + "Диски: " + json[i].disks + "\n" + "Топология сети: "
                                            + json[i].net_topology + "\n" + "Список бинарных файлов: " + json[i].bin_list);
                                        let log = document.getElementById('info');
                                        if (typeof log.innerText !== 'undefined') {
                                            log.innerText = info;
                                        } else {
                                            log.textContent = info;
                                        }
                                    }
                                }
                            }
                        }
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
                node: {
                    events: {
                        click: function () {
                            alert('Category: ' + this.category + ', value: ' + this.point.name);
                        }
                    }
                },

                data: data
            }]

        });
    });
</script>

<script>
    $(function() {
        $("div.errorMsg:empty").hide();
    });
</script>
