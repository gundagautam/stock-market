var current_value=[];
var current_comp=[];
$(document).ready(function(){
	var chartData = [];
	
	var companyCode=[];
	var companyName=[];
	var searchString=[];
	$.ajax({
        type: "GET",
        url: "https://raw.githubusercontent.com/datasets/s-and-p-500-companies/master/data/constituents.csv",
        dataType: "text",
        success: function(data) {
			var record_num = 3;
			var allTextLines = data.split(/\r\n|\n/);
			var entries = allTextLines[0].split(',');
			var len=1;			
			while (len<allTextLines.length-1) {
				
				var row=allTextLines[len].split(',');
				
				companyCode.push(row[0]);
				companyName.push(row[1]);
				searchString.push(row[1]+" ("+row[0]+")");
				len=len+1;
			}
			//console.log(searchString);
		},
		
     });
    $( "#search" ).autocomplete({
      source: searchString
    });
	
	$('#search').on('autocompleteselect', function (e, ui) {
		renderGraph(ui.item.value);
		
		$.post('./search.php', 'item='+ui.item.value,function(data) {
			console.log(data);
		});
	});
	
	$('#leftSearch').autocomplete({
		source: searchString
	});
	
	$('#leftSearch').on('autocompleteselect', function (e, ui) {
		renderLeftSearch(ui.item.value);
		$.post('./search.php', 'item='+ui.item.value,function(data) {
			console.log(data);
		});
	});
	
});

function renderLeftSearch(item){
	
	var str="<tr>"
	str=str+"<td>"+item+"</td>";
	str=str+"<td><a href='' id='buy"+item+"' onclick='buy(this.id);' >BUY</a></td>";
	str=str+"<td><a href='' id='sell"+item+"' onclick='sell(this.id);' >BUY</a></td>";
	str = str+"</tr>";
	console.log(str);
	$('#fillTable').append(str);
}

function renderGraph(ui){
		var chartData=[];
		current_comp.push(ui);
		var comp = ui.split("(")[1];
		var code = comp.substring(0,comp.length-1);
        //console.log("Selected value : "+code);
		var url="https://www.quandl.com/api/v3/datasets/WIKI/"+code+".json?start_date=1990-05-01&order=asc&column_index=4&transformation=rdiff";
		//console.log(url);
		$add='<div id = "stockdiv'+code+'"><h4>'+ui+'<img class="divclose" src="img/close.png" onclick = "testImgDiv(\'stockdiv'+code+'\');"/></h4><div class="searchChart" id='+code+' style="height:500px; width:100%;"></div></div>';
		$('#charts').append($add);
		var current;
		
		$.ajax({
			type: 'GET',
            url:"https://www.quandl.com/api/v3/datasets/WIKI/"+code+".json", 
            data: {api_key: '4MiXUnxNk2wT9nc6CPsb',
                start_date:'2016-05-01',
                order:'asc',
                column_index:'4',
				transformation:'rdiff'
				},
            dataType: 'json',
            async: false,
			success: function(data1) {
				$.each(data1, function (index, value) {
					value=value.data;
					$.each(value, function (index, value) {
						//console.log(value[0].includes("2005"));
						//console.log(value);
						if(value[0].includes("201")){
							testVal={
							"date": value[0],
							"value": value[1]
							};
							chartData.push(testVal);
							current=value[1];
						}
					});
						
				});
			//console.log("Current Value "+current);
			current_value.push(current);
			console.log("Current Value "+current_value);
			console.log("Company Value "+current_comp);
			var chart = AmCharts.makeChart(code, {
					"type": "serial",
					"theme": "light",
					"marginRight": 40,
					"marginLeft": 40,
					"autoMarginOffset": 20,
					"mouseWheelZoomEnabled":true,
					"dataDateFormat": "YYYY-MM-DD",
					"valueAxes": [{
						"id": "v1",
						"axisAlpha": 0,
						"position": "left",
						"ignoreAxisWidth":true
					}],
					"balloon": {
						"borderThickness": 1,
						"shadowAlpha": 0
					},
					"graphs": [{
						"id": "g1",
						"balloon":{
						"drop":true,
						"adjustBorderColor":false,
						"color":"#ffffff"
					},
						"bullet": "round",
						"bulletBorderAlpha": 1,
						"bulletColor": "#FFFFFF",
						"bulletSize": 5,
						"hideBulletsCount": 50,
						"lineThickness": 2,
						"title": "red line",
						"useLineColorForBulletBorder": true,
						"valueField": "value",
						"balloonText": "<span style='font-size:18px;'>[[value]]</span>"
					}],
					"chartScrollbar": {
						"graph": "g1",
						"oppositeAxis":false,
						"offset":30,
						"scrollbarHeight": 80,
						"backgroundAlpha": 0,
						"selectedBackgroundAlpha": 0.1,
						"selectedBackgroundColor": "#888888",
						"graphFillAlpha": 0,
						"graphLineAlpha": 0.5,
						"selectedGraphFillAlpha": 0,
						"selectedGraphLineAlpha": 1,
						"autoGridCount":true,
						"color":"#AAAAAA"
					},
					"chartCursor": {
						"pan": true,
						"valueLineEnabled": true,
						"valueLineBalloonEnabled": true,
						"cursorAlpha":1,
						"cursorColor":"#258cbb",
						"limitToGraph":"g1",
						"valueLineAlpha":0.2,
						"valueZoomable":true
					},
					"valueScrollbar":{
					  "oppositeAxis":false,
					  "offset":50,
					  "scrollbarHeight":10
					},
					"categoryField": "date",
					"categoryAxis": {
						"parseDates": true,
						"dashLength": 1,
						"minorGridEnabled": true
					},
					"export": {
						"enabled": true
					},
					"dataProvider" : chartData
						
					
			});

			chart.addListener("rendered", zoomChart);

			zoomChart();

			function zoomChart() {
				chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
			}
				//console.log(searchString);
			},
			error: function (error) {
				console.log("error :: "+JSON.stringify(error));
			}
		});
		
		
		
		/*$.getJSON( url, function( data1 ) {
				//console.log("hello ");
				
		});*/
//console.log(chartData);

	}

function testImgDiv(divID){
		$.post('./remove.php', 'code='+divID.substring(8,divID.length),function(data) {
			console.log(data);
		});
		$('#'+divID).remove();
		
		
}
	
function myFunction() {
	
    document.getElementById("myDropdown").classList.toggle("show");
}
function destroyVar(){
	$.get('./logout.php', function(data) {
		alert("You have been logged out");
		location.reload();
	});
}
// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function renderOrderSearch(code1){
	var comp = code1.split("(")[1];
		var code = comp.substring(0,comp.length-1);
	var url="http://finance.google.com/finance/info?client=ig&q=NASDAQ%3A"+code;
		console.log(url);
		//$add='<div id = "stockdiv'+code+'"><h4>'+ui+'<img class="divclose" src="img/close.png" onclick = "testImgDiv(\'stockdiv'+code+'\');"/></h4><div class="searchChart" id='+code+' style="height:500px; width:100%;"></div></div>';
		//$('#charts').append($add);
		$.ajax({
			url: url,
			cache: false,
			dataType: "json",
			complete: function(data) {
				console.log(JSON.stringify(data));
				var jsonResult = JSON.stringify(data).replace(/\\n/g, "")
               .replace(/\\'/g, "\'")
               .replace(/\\"/g, '\"')
               .replace(/\\&/g, "")
               .replace(/\\r/g, "")
               .replace(/\\t/g, "")
               .replace(/\\b/g, "")
               .replace(/\\f/g, "").replace(/\//g, "").replace(/\ /g, "");
				//console.log(data);
				console.log(jsonResult.substring(jsonResult.indexOf('[')+1,jsonResult.indexOf(']')));
				console.log(JSON.parse(jsonResult.substring(jsonResult.indexOf('[')+1,jsonResult.indexOf(']'))));
			},
			error: function(e, xhr){
				//console.log(e);
			}
		});
					
}


function company(value){
	var item=value.substring(3,value.length);
//	if()
				var comp = item.split("(")[1];
		var code = comp.substring(0,comp.length-1);
        //console.log("Selected value : "+code);
		var current;
		
		console.log("test");
			$.ajax({
				 type: 'GET',
            url:"https://www.quandl.com/api/v3/datasets/WIKI/"+code+".json", 
            data: {api_key: '4MiXUnxNk2wT9nc6CPsb',
                start_date:'2017-04-01',
                order:'asc',
                column_index:'4',
				transformation:'rdiff'
				},
            dataType: 'json',
            async: false,
			success: function(data1) {
				  event.preventDefault();
				$.each(data1, function (index, value) {
					value=value.data;
					$.each(value, function (index, value) {
						//console.log(value[0].includes("2005"));
						//console.log(value);
						current=value[1];
					});
						
				});
				//console.log(searchString);
			},
		error: function (error) {
			console.log("error :: "+JSON.stringify(error));
		}
		
     });

	console.log("Current Value "+current);
	
	$.ajax({
			type: 'post',
            url:"./companyList.php", 
            data: {
				item: item,
				current: current
				},
            async: false,
			success: function(data) {
				  event.preventDefault();
				console.log(data);
				//console.log("Got nothin");
				$("#rightDivComp").append(data);
			}
	});
	
}

function buy(value){
	console.log("buy value : "+value.substring(3,value.length));
	event.preventDefault();
	//document.getElementById("rightDiv").innerHTML='<object type="text/html" data="buy.php"></object>';
	
	
	var item=value.substring(3,value.length);
	var comp = item.split("(")[1];
	var code = comp.substring(0,comp.length-1);
        //console.log("Selected value : "+code);
		var current;
		
		console.log("test");
			$.ajax({
				 type: 'GET',
            url:"https://www.quandl.com/api/v3/datasets/WIKI/"+code+".json", 
            data: {api_key: '4MiXUnxNk2wT9nc6CPsb',
                start_date:'2017-04-01',
                order:'asc',
                column_index:'4',
				transformation:'rdiff'
				},
            dataType: 'json',
            async: false,
			success: function(data1) {
				  event.preventDefault();
				$.each(data1, function (index, value) {
					value=value.data;
					$.each(value, function (index, value) {
						//console.log(value[0].includes("2005"));
						//console.log(value);
						current=value[1];
					});
						
				});
				//console.log(searchString);
			},
		error: function (error) {
			console.log("error :: "+JSON.stringify(error));
		}
		
     });
	
	console.log("Current Value "+current);
	var str= '<h2>Buy Stocks</h2><form  action="./purchase.php" method="post" id="login"><table><tr><td><b>Company:</b></td><td><input type=\'text\' name=\'company_name\' value="'+item+'" readonly></input></td></tr><tr><td><b>Stock Value:</b></td><td><input type=\'text\' name=\'company_curr\' value="'+current+'" readonly></input></td></tr><tr><td><b>Quantity:</b></td><td><input type=\'text\' name=\'quantity\' id = \'stockQty\'></input></td></tr><tr><td id = \'totalCost\'><b>Total Cost:</b></td><td id=\'cost\'><i ></i></td></tr><tr><td></td><td><input type="submit" class="loginbtn" value = "Buy" /></td></tr></table> </form>';
	console.log(str);
	$("#rightDiv").html(str);
	var stkQty =0;
	$("#stockQty").blur(function(){
		stkQty = $("#stockQty").val();
		console.log(stkQty);
		console.log(current*stkQty);		
		$("#cost").html(current*stkQty);
	});
}

function sell(value){
	//console.log("sell value : "+);
	event.preventDefault();
	//document.getElementById("rightDiv").innerHTML='<object type="text/html" data="buy.php"></object>';
	
	
	var item=value.substring(4,value.length);
	var comp = item.split("(")[1];
	var code = comp.substring(0,comp.length-1);
        //console.log("Selected value : "+code);
		var current;
		
		console.log("test");
			$.ajax({
				 type: 'GET',
            url:"https://www.quandl.com/api/v3/datasets/WIKI/"+code+".json", 
            data: {api_key: '4MiXUnxNk2wT9nc6CPsb',
                start_date:'2017-04-01',
                order:'asc',
                column_index:'4',
				transformation:'rdiff'
				},
            dataType: 'json',
            async: false,
			success: function(data1) {
				  event.preventDefault();
				$.each(data1, function (index, value) {
					value=value.data;
					$.each(value, function (index, value) {
						//console.log(value[0].includes("2005"));
						//console.log(value);
						current=value[1];
					});
						
				});
				//console.log(searchString);
			},
		error: function (error) {
			console.log("error :: "+JSON.stringify(error));
		}
		
     });
	
	console.log("Current Value "+current);
	var str= '<h2>Sell Stocks</h2><form action="./sell.php" method="post" id="login" ><table><tr><td><b>Company:</b></td><td><input type=\'text\' name=\'company_name\' value="'+item+'" readonly></input></td></tr><tr><td><b>Stock Value:</b></td><td><input type=\'text\' name=\'company_curr\' value="'+current+'" readonly></input></td></tr><tr><td><b>Quantity:</b></td><td><input type=\'text\' name=\'quantity\' id = \'stockQty\'></input></td></tr><tr><td id = \'totalCost\'><b>Total Cost:</b></td><td id=\'cost\'><i ></i></td></tr><tr><td></td><td><input type="submit" class="loginbtn" value = "Sell" /></td></tr></table> </form>';
	document.getElementById("rightDiv").innerHTML=str;
	var stkQty =0;
	$("#stockQty").blur(function(){
		stkQty = $("#stockQty").val();
		console.log(stkQty);
		console.log(current*stkQty);		
		$("#cost").html(current*stkQty);
	});
}
