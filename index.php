<?php error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
?>
<?php require ('network_data.php');  ?>

<title><?php echo 'Визуализация топологии сетей'; ?></title>
<script src="assets/js/highcharts.src.js"></script>
<script src="assets/js/networkgraph.js"></script>
<script src="assets/js/exporting.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootbox.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<div id="container">
    <div id="domain">Domain-1</div>

</div>
<div id="label"></div>
<div id="info"></div>


<script>
    document.getElementById("domain").innerHTML = localStorage.getItem('todoData')

    //Выбор элементов по имени домена
    function getDomain(array, type, val) {
        return array.filter(function (el) {
            return el[type] === val;
        })
    }
    var domains = <?php echo $domain; ?>,
        domain = [];

</script>
<div id="label">Выбор домена
<script>
    var selectDomain = document.createElement("SELECT");
    //selectDomain.setAttribute("id", "domainSelection");
    document.body.appendChild(selectDomain);
    selectDomain.id = "domainSelection";
    domains.forEach(function (item, index, array) {
        var opt = document.createElement("option")
        opt.text = item.domain_name
        opt.value = item.domain_name
        selectDomain.add(opt)
        document.getElementById("domainSelection").value = "Выберите домен";
    })

</script>
</div>
<script>

    $(function () {
        $('#domainSelection').change(function () {
            localStorage.setItem('todoData', this.value);
            location.reload()//перезагрузка страницы после выбора домена
        });
        if (localStorage.getItem('todoData')) {
            $('#domainSelection').val(localStorage.getItem('todoData'));
        }
    });

    var jsonn = <?php echo $json_response; ?>,
        dataa = [];

    var json = getDomain(jsonn, 'domain_name', document.getElementById("domain").innerHTML),
        data = []

    document.getElementById("domainSelection").onchange = function () {changeFunction()};
    function changeFunction() {
        var select = document.getElementById("domainSelection");
        document.getElementById("domain").innerHTML = select.value;
    }


    var json3 = getDomain(json, 'domain_name', document.getElementById("domain").innerHTML),
        data_filtered = [];

    var filtered = data.filter(
        function (e) {
            return this.indexOf(e) == 'Domain-1';
        }, data)


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
                                        let info =  ("<b>"+"ID: "+"</b>" + this.name + "<br>" + "<b>"+" ОЗУ: "+"</b>" + json[i].ram + "<br>" + "<b>"+"Архитектура: "+"</b>" + json[i].net_architect
                                            + "<br>" + "<b>"+"ОС: "+"</b>" + json[i].os_version + "<br>" + "<b>"+"PC-роль: "+"</b>" + json[i].pc_role + "<br>" + "<b>"+"User_Name: "+"</b>" + json[i].user_name
                                            + "<br>" + "<b>"+"PC_Name: "+"</b>" + json[i].pc_name + "<br>" + "<b>"+"ОЗУ: "+"</b>" + json[i].ram + "<br>" + "<b>"+"Процессор: "+"</b>" + json[i].proc
                                            + "<br>" + "<b>"+"Язык ОС: "+"</b>" + json[i].os_language + "<br>" + "<b>"+"Диски: "+"</b>" + json[i].disks + "<br>" + "<b>"+"Топология сети: "+"</b>" + json[i].net_topology + "\n" + "<br>" + "<b>"+"Список бинарных файлов: "+"</b>" + json[i].bin_list + '<div class="accordion" id="accordionExample">'+ '<div class="card">' + '<div class="card-header" id="headingOne">'
                                            + '<h2 class="mb-0">'+ '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'+"<b>"+ "Запущенные процессы: "+"</b>"+"</button>"+"</h2>" + "</div>"+'<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">'
                                            +'<div class="card-body">' + json[i].proccesses_list + "</div>"+"</div>" + "</div>" + '<div class="card">' + '<div class="card-header" id="headingThree">'+ '<h2 class="mb-0">'
                                            +'<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">'
                                            +"<b>"+"Запущенные службы: " + "</b>" + "</button>"+"</h2>"+"</div>"+'<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">'
                                            +'<div class="card-body">'+ json[i].servicies_list + "</div>"+"</div>"+ "</div>"+"</div>");

                                        console.log(json[i].pcid + " : " + this.name)


                                        bootbox.alert(info, function() {
                                            closeButton: false;
                                        });

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
