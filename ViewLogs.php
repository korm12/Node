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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script>             
            var sensval = 0;

                        
            $(document).ready(function() {
               
    
                var gauge = $("#sensorgauge").dxCircularGauge({
                    scale: {
                        
                        startValue: 0, 
                        endValue: 100,
                        tickInterval: 10,
                        label: {
                            customizeText: function (arg) {
                                return arg.valueText;
                            }
                        }
                    },
                    title: {
                        text: "Soil Moisture Measurement",
                        font: { size: 20 }
                    },
                    rangeContainer: {
                        offset: 10,
                        ranges: [
                            { startValue: 0, endValue: 33, color: "#d01f41" },
                            { startValue: 34, endValue: 66, color: "#E6E200" },
                            { startValue: 67, endValue: 100, color: "#77DD77" }
                        ]
                    },
                    size: {
                        height:270,
                        width:"100%"
                        },

                    value: 500,
                    
                }).dxCircularGauge("instance");
                
                var gauge2 = $("#gauge-intensity").dxCircularGauge({
                    scale: {
                        
                        startValue: 0, 
                        endValue: 100,
                        tickInterval: 10,
                        label: {
                            customizeText: function (arg) {
                                return arg.valueText;
                            }
                        }
                    },
                    title: {
                        text: "Intensity Level Gauge",
                        font: { size: 20 }
                    },
                    rangeContainer: {
                        offset: 10,
                        ranges: [
                            { startValue: 0, endValue: 33, color: "#d01f41" },
                            { startValue: 34, endValue: 66, color: "#E6E200" },
                            { startValue: 67, endValue: 100, color: "#77DD77" }
                        ]
                    },
                                size: {
                        height:270,
                        width:"100%"
                        },

                    value: 500,
                    
                }).dxCircularGauge("instance");
                
   

				setInterval(function(){get_data()},4000);
				function get_data()
				{
					jQuery.ajax({
						type:"GET",
						url: "read_db1.php",
						data:"",
						success:function(data) {
							$("table").html(data);
						}
					});
                    
                    jQuery.ajax({
						type:"GET",
						url: "getSMgaugevalue.php",
						data:"",
						success:function(data) {
                            var raw = JSON.parse(data);
                            
                            //console.log(data);
                            gauge.value(raw[0]["Soil_Moisture_Val"]);
                            gauge2.value(raw[0]["intensity"]);
    
                            $("#raw-soilmoisture-text").html(raw[0]["Soil_Moisture_Val"]);
                             $("#raw-intensity-text").html(raw[0]["intensity"]);
						}
                    
					});
                     jQuery.ajax({
						type:"GET",
						url: "getSMValue.php",
						data:"",
						success:function(data) {
                          var dataSM = JSON.parse(data);

                            var convDataSMl = [];
                            for(var i  = 0; i < dataSM.length ; i++){
                                var element = {};
                                convDataSMl.push({"id": parseInt(dataSM[i]["id"]), "Soil_Moisture_Val": parseInt(dataSM[i]["Soil_Moisture_Val"])});
                            }
//                            console.log(convDataSMl);
                             var smGraph = 
                                $("#sm-line-gauge").dxChart({
                                    palette: "Violet",
                                    dataSource: convDataSMl,
                                    commonSeriesSettings: {
                                        argumentField: "id",
                                        type: "line"
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
                                    series: [
                                        { valueField: "Soil_Moisture_Val", name: "Value",color: " #0d6104" },

                                    ],
                                    legend: {
                                        verticalAlignment: "bottom",
                                        horizontalAlignment: "center",
                                        itemTextPosition: "bottom"
                                    },
                                    title: { 
                                        text: "Soil Moisture Value",
            
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
			});
            
		</script>
        
        
	</head>
	<body>
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
        <div class=" ">
            <h1 class="text-center page-title" >MULTISYS IRRIGATION SYSTEM</h1>
        </div>
        <div class="container-fluid"  >
            <div class="container-wrap">
            <div class="row" style="max-height:75vh">
                <div class="col-lg-4 text-center mx-auto" >
                    <div class="row">
                        <div class=" shad circ-gauge">
                            <div id="gauge-intensity">

                            </div>
                            <div id="raw-intensity-container">
                                <h1 id="raw-intensity-text" class="text-center" style="margin-top:-75px"></h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="shad circ-gauge">
                            <div id="sensorgauge">
                            </div>
                            <div id="raw-soilmoisture-container">
                                <h1 id="raw-soilmoisture-text" class="text-center" style="margin-top:-75px"></h1>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 " >
                    <table class=" table table-dark table-st shad" style="margin-bottom:1vh">
                        <thead>
                            <tr>
                                <th>Operation</th> 
                                <th>Pump</th> 
                            </tr>
                        </thead>
                    </table>
                    <div id="sm-line-gauge" class="sm-gauge shad" style="padding-left:5%;padding-right:5%;">
                    </div>
                </div>
            </div>

            </div>
        </div>
	</body>
</html>