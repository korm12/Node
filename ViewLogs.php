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
    
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script>             
            var sensval = 0;
			$(document).ready(function() {
                
                var gauge = $("#sensorgauge").dxCircularGauge({
                    scale: {
                        
                        startValue: 0, 
                        endValue: 1024,
                        tickInterval: 100,
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
                            { startValue: 0, endValue: 334, color: "#d01f41" },
                            { startValue: 334, endValue: 667, color: "#E6E200" },
                            { startValue: 667, endValue: 1024, color: "#77DD77" }
                        ]
                    },
                                size: {
                        height:400,
                        width:"100%"
                        },

                    value: 500,
                    
                }).dxCircularGauge("instance");
                
                
                var lgvalue = $("#linear-gauge-water-level").dxLinearGauge({
                    scale: {
                        startValue: 0,
                        endValue: 5,
                        customTicks: [0, 1, 2, 3, 4, 5],
                    },
                    
                    geometry: {
                    orientation:"vertical"
                    },
                    size: {
                    height:400,
                    width:undefined
                    },
              
                    
                    title: {
                        text: "Water Level",
                        font: { size: 28 }
                    },
                    value: 4
                }).dxLinearGauge("instance");

				setInterval(function(){get_data()},1000);
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
                           
                            gauge.value(raw[0]["Soil_Moisture_Val"]);
                            lgvalue.value(raw[0]["waterlevel"]);
                            $("#raw-soilmoisture-text").html(raw[0]["Soil_Moisture_Val"]);
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
                        <a class="nav-link" href="#"  style=" color:#8CC63F;">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"  style=" color:#8CC63F;">Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"  style=" color:#8CC63F;">Logout</a>
                    </li>
                </ul>>
            </div>
        </nav>
        <div class=" ">
            <h1 class="text-center page-title" >MULTISYS IRRIGATION SYSTEM</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 cols text-center">
                    <div id="linear-gauge-water-level" class="sm-gauge shad" style="height:100%;min-height: 470px;"></div>
                    
                </div>
                
                <div class="col-md-6 cols" >
                    <div class=" sm-gauge shad" style="height:100%;min-height: 470px">
                        <div id="sensorgauge">
                        </div>
                        <div id="raw-soilmoisture-container">
                            <h1 id="raw-soilmoisture-text" class="text-center" style="margin-top:-100px"></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 cols">
                    <table class=" table table-dark shad">
                        <thead>
                            <tr>
                                <th>id</th> 
                                <th>Soil Moisture Value</th> 
                                <th>Water Level</th> 
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
	</body>
</html>