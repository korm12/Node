<!DOCTYPE html>
<html>
	<head>
		<title>Multisys Irrigation System</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="jquery.min.js"></script>
        <link rel="stylesheet" href="main1.css">

        
        <script type="text/javascript" src="lib/jquery-2.0.3.js"></script>

        <script type="text/javascript" src="lib/globalize.min.js"></script>
        <script type="text/javascript" src="lib/dx.chartjs.js"></script>
        <script src="https://cdn3.devexpress.com/jslib/20.2.4/js/dx.all.js"></script>
    
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
        <script>             
            var sensval = 0;
            
            $(document).ready(function() {
                jQuery.ajax({
						type:"GET",
						url: "getDates.php",
						data:"",
						success:function(data) {
							$("#cmb").html(data);
						}
					});
                var seriesVal = [
                                {  argumentField: "time", valueField: "pump", name: "Value",color: " #0d6104" },
                                ];
                var rangebarData = [];
                function loadGraph(dateVal){
                 jQuery.ajax({
                    type:"GET",
                    url: "getPumpActivity.php?dateVal="+dateVal,
                    data:"",
                    success:function(data) {
                      var dataSM = JSON.parse(data);
                        console.log(dataSM);
                        rangebarData = dataSM;
                        loadRangeBar(rangebarData);
                         var smGraph = 
                            $("#graph").dxChart({
                                dataSource: dataSM,
                                commonSeriesSettings: {
                                    type: "stepline"
                                },
                                margin: {
                                    bottom: 20
                                },
                                argumentAxis: {
                                    valueMarginsEnabled: false,
                                    discreteAxisDivisionMode: "crossLabels",
                                    grid: {
                                        visible: true
                                    }
                                },
                                series: seriesVal,
                                legend: {
                                    verticalAlignment: "bottom",
                                    horizontalAlignment: "center",
                                    itemTextPosition: "bottom"
                                },
                                title: { 
                                    text: "Pump Activity",

                                },
                                "export": {
                                    enabled: true
                                },
                                tooltip: {
                                    enabled: true
                                }
                            }).dxChart("instance");
                    }

                });
                
				}
                jQuery.ajax({
                    type:"GET",
                    url: "getLatestDate.php",
                    data:"",
                    success:function(data) {
                        console.log(JSON.parse(data)[0]);
                        loadGraph(JSON.parse(data)[0]);
                    }
                });
                 function loadRangeBar(rangebarData){
                    $("#rangeSelector").dxRangeSelector({
                        size: {
                            height: 120
                        },
                        margin: {
                            left: 10
                        },
                        scale: {
                            minorTickCount:1
                        },
                        dataSource: rangebarData,
                        chart: {
                            series: seriesVal,
                            palette: "Harmony Light"
                        },
                        behavior: {
                            callValueChanged: "onMoving"
                        },
                        onValueChanged: function (e) {
                            var zoomedChart = $("#graph").dxChart("instance");
                            zoomedChart.getArgumentAxis().visualRange(e.value);
                        }
                    });
                }
                var getDateBtn = document.getElementsByClassName('go-button')[0];
                getDateBtn.addEventListener('click', function(event){
                    var buttonParent = event.target.parentElement;
                    var dateCMB = buttonParent.getElementsByClassName('date')[0];
                   var str = dateCMB.options[dateCMB.selectedIndex].text;
                    loadGraph(str);
                })
			});
            
            
            
		</script>
	</head>
	<body >
         <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark default-color">
            <a class="navbar-brand" href="#"><img src="pictures/logo2.png" width="40px" alt="logo" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ViewLogs.php"  style=" color:#8CC63F;">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="informationVIEW.php"  style=" color:#8CC63F;">Information</a>
                    </li>
                </ul>>
            </div>
        </nav>
        
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-2 sidebar text-center">
                    <div class="row mx-auto">
                        <a href="informationVIEW.php" class="sidebar-link" >Daily Graph</a>
                    </div> 
                    <div class="row mx-auto">
                        <a href="dailyLogsView.php" class="sidebar-link">Daily Logs</a>
                    </div> 
                    <div class="row mx-auto ">
                        <a href="pumpActivityVIEW.php" class="sidebar-link">Pump Activity</a>
                    </div> 
                    <br/><br/>
                </div>
                <div class="col-lg-10">
                    <br/>
                    <h1 class="text-center page-title2" >Pump Activity</h1>
                    <div class="margin-container bg-white cmb-cont" >
                        <div class="row">
                            <div id="cmb" class="cmb" ></div>
                            <button class="go-button btn btn-sm btn-primary ml-2" > GO </button>
                        </div>
                    </div> 
                    <div class="graph margin-container">
                        <div id="graph" class="" style="padding-left:5%;padding-right:5%;height:70%">
                        </div>
                        <div id="rangeSelector" class="" style="padding-left:5%;padding-right:5%;height:24%">
                        </div>
                    </div>
                </div>
            </div>    
        </div>
 
	</body>
</html>s