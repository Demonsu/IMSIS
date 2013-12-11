var tab_id = 0;
$(document).ready(function(){
	//第一张表
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table1.json',
		success:function(data){
			//alert(data);
			var index = 1;
			//alert(data);
			var table = '';
			var i;
			for(i=0;i<data.content.length;i++){
				if(i%2 == 0)
					table += '<div class="row">';
				table += '<div class="col-md-6"><table class="col-md-12">';
				table += '<tr>';
				table += '<th></th>';
				table += '<th colspan="2">'+ data.content[i].title_effect + '</th>';
				table += '<th>得分</th>';
				table += '<th>加权得分</th>';
				table += '</tr>';

				var j;
				var item = data.content[i].effect_content;
				for(j=0;j<item.length;j++){
					table += '<tr>';
					table += '<td>' + item[j].id + '</td>';
					table += '<td>' + item[j].title_field + '</td>';
					table += '<td></td>';
					table += '<td></td>';
					table += '<td></td>';
					table += '</tr>';
					var k;
					var variable = item[j].field_content;
					for(k=0;k<variable.length;k++){
						table += '<tr>';
						table += '<td></td>';
						table += '<td style="text-align:right">' + index + '</td>';
						index++;
						table += '<td>' + variable[k].title_variable + '</td>';
						table += '<td>' + variable[k].score + '</td>';
						if(k==0)
							table += '<td rowspan="' + variable.length + '" style="text-align:right;">' + item[j].field_score + '</td>';
						table += '</tr>';
					}
				}
				table += '<tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>';
				table += '<tr style="color:red">';
				table += '<td></td><td colspan="2">' + data.content[i].title_effect + '总均分</td><td></td><td style="text-align:right">' + data.content[i].effect_field_score + '</td>';
				table += '</tr>';
				table += '</table></div>';
				if(i%2 == 1)
					table += '</div>';
				
			}
			$('#t1').html(table);
			
		}
	});
	//第二张表
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table2.json',

		success:function(data){
			
			var table = '';
			var i;
			table += '<tr>';
			for(i=0;i<data.content.length;i++){
				table += '<th>' + data.content[i].title + '</th>';
			}
			table += '</tr>';
			for(i=0;i<data.content[0].content.length;i++){
				table += '<tr>';
				var j;
				for(j=0;j<data.content.length;j++){
					//alert(data.content[j].content[i]);
					if(j == 2)
						table += '<td>' + data.content[j].content[i] + '%</td>';
					else
						table += '<td>' + data.content[j].content[i] + '</td>';
				}
				table += '</tr>';
			}
			
			$('#t2').html(table);
			
			var array1 = new Array();
			for(i=0;i<data.content[0].content.length;i++){
				array1.push(data.content[0].content[i]);
			}
			
			var options = {
				chart: {
					renderTo:'p2',
					type: 'bar'
				},
				title: {
					text: '2.关键变量统计分布'
				},
				subtitle: {
					text: '百分比率'
				},
				xAxis: {
					categories: [0,1,2,3,4,5],
					title: {
						text: '成熟度特征'
					}
				},
				yAxis: {
					
					min: 0,
					max: 100,
					title: {
						text: '百分比率',
						align: 'high'
					},
					labels: {
						formatter:function(){                   
							return this.value + '%';
						},
						overflow: 'justify'
					}
					
				},
				tooltip: {
					valueSuffix: '%',
				},
				plotOptions: {
					bar: {
						dataLabels: {
							enabled: true
						}	
					}
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'top',
					x: -40,
					y: 100,
					floating: true,
					borderWidth: 1,
					backgroundColor: '#FFFFFF',
					shadow: true
				},
				credits: {
					enabled: false
				},
				series: []
				
			};
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].name = '关键变量';
			options.series[0].data = new Array();
			for(i=0;i<data.content[0].content.length;i++){
				options.series[0].data.push(parseFloat(data.content[2].content[i]));
			}
			//alert(options.series[0].data);
			var chart = new Highcharts.Chart(options);
			//$('#container').highcharts(options);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table3.json',
		success:function(data){
			var table = '';
			var i;
			table += '<tr>';
			table += '<th>作用域（一级指标）</th><th>关键域（二级指标）</th><th>得分（半分制）</th>';
			table += '</tr>';
			for(i=0;i<data.content.length;i++){
				var j;
				for(j=0;j<data.content[i].content.length;j++){
					table += '<tr>';
					if(j==0)
						table += '<td>' + data.content[i].title + '</td>';
					else
						table += '<td></td>';
					table += '<td>' + data.content[i].content[j].title + '</td>';
					table += '<td style="text-align:center">' + data.content[i].content[j].content + '</td>';
					table += '</tr>';
				}
			}
			$('#t3').html(table);
			
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table4.json',
		success:function(data){
			var table = '';
			var i;
			table += '<tr>';
			table += '<th>'+data.content[0].title+'</th><th>'+data.content[1].title+'</th><th>'+data.content[2].title+'</th>';
			table += '</tr>';
			for(i=0;i<data.content[0].content.length;i++){
				var j;
				table += '<tr>';
				for(j=0;j<3;j++){
					if(j == 2)
						table += '<td>'+data.content[j].content[i]+'%</td>';
					else
						table += '<td>'+data.content[j].content[i]+'</td>';
				}
				table += '</tr>';
			}
			table += '<tr>';
			table += '<td>Total</td><td>' + data.total[0] + '</td><td>'+ data.total[1] +'%</td>';
			table += '</tr>';
			$('#t4').html(table);
			
			var options = {
				chart: {
					renderTo:'p4',
					type: 'line'
				},
				title: {
					text: '关键域(KDs)能力统计表'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: []
				},
				yAxis: {
					title: {
						text: '发生项数'
					}
				},
				tooltip: {
					valueSuffix: '%'
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: false
					}
				},
				series: []
			};
			
			var i;
			options.xAxis.categories = new Array();
			for(i=0;i<data.content[0].content.length;i++)
				options.xAxis.categories.push(data.content[0].content[i]);
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].name = '发生项数';
			options.series[0].data = new Array();
			for(i=0;i<data.content[1].content.length;i++)
				options.series[0].data.push(parseInt(data.content[1].content[i]));
			var chart = new Highcharts.Chart(options);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table5.json',
		success:function(data){
			var table = '';
			table += '<tr style="text-align:center">';
			table += '<th></th><th>加权分数</th><th>能力比例</th>'
			table += '</tr>';
			var i;
			for(i=0;i<data.content.length;i++){
				table += '<tr>';
				table += '<td>'+data.content[i].title+'</td>';
				table += '<td style="text-align:right">'+data.content[i].score+'</td>';
				table += '<td style="text-align:right">'+data.content[i].proportion+'%</td>';
				table += '</tr>';
			}
			
			$('#t5').html(table);
			
			var options = {
				chart: {
					renderTo:'p5'
				},
				title: {
					text: '作用域（LDs）的得分表'
				},
				xAxis: {
					categories: []
				},
				yAxis: {
					max:10
				},
				tooltip: {
					formatter: function() {
						var s;
						if (this.point.name) { // the pie chart
							s = ''+
								this.point.name +': '+ this.y +'%';
						} else {
							s = ''+
								this.x  +': '+ this.y;
						}
						return s;
					}
				},
				labels: {
					items: [{
						html: '',
						style: {
							left: '40px',
							top: '8px',
							color: 'black'
						}
					}]
				},
				series: []
			};
			
			var j;
			options.xAxis.categories = new Array();
			for(j=0;j<data.content.length;j++)
				options.xAxis.categories.push(data.content[j].title);

			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].type = 'column';
			options.series[0].name = '加权分数';
			options.series[0].data = new Array();
			for(j=0;j<data.content.length;j++)
				options.series[0].data.push(parseFloat(data.content[j].score));
			
			options.series[1] = new Object();
			options.series[1].type = 'pie';
			options.series[1].name = '能力比率';
			options.series[1].data = new Array();
			for(j=0;j<data.content.length;j++){
				options.series[1].data[j] = new Object();
				options.series[1].data[j].name = data.content[j].title;
				options.series[1].data[j].y = parseFloat(data.content[j].proportion);
			}
			options.series[1].center = new Array();
			options.series[1].center[0] = 80;
			options.series[1].center[1] = 60;
			options.series[1].size = 100;
			options.series[1].showInLegend = false;
			options.series[1].dataLabels = new Object();
			options.series[1].dataLabels.enabled = false;
			var chart = new Highcharts.Chart(options);
		}
	});	
	/*
	$.ajax({
		type:'POST',
		url:'json/demo7.json',
		success:function(data){
			table = '';
			table += '<tr style="text-align:center"> <th></th> <th></th> <th>实际得分</th> <th>成熟度2级</th> <th>完成比例</th> <th>成熟度3级</th> <th>完成比例</th> </tr>';
			var i;
			for(i=0;i<data.content.length;i++){
				var j;
				for(j=0;j<data.content[i].content.length;j++){
					table += '<tr>';
					if(j == 0)
						table += '<td>'+data.content[i].title+'</td>';
					else
						table += '<td></td>';
					table += '<td>'+data.content[i].content[j].title+'</td>';
					var k;
					for(k=0;k<data.content[i].content[j].content.length;k++){
						if((k == 2 || k == 4) && data.content[i].content[j].content[k] != '')
							table += '<td style="text-align:right">'+data.content[i].content[j].content[k]+'%</td>';
						else
							table += '<td style="text-align:right">'+data.content[i].content[j].content[k]+'</td>';
					}
					table += '</tr>';
				}
			}
			$('#t7').html(table);
			
			var options = {
				chart: {
					renderTo:'container7',
					type: 'bar'
				},
				title: {
					text: '能力对比图'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: [],
					title: {
						text: null
					}
				},
				yAxis: {
					min: 0,
					max: 5,
					title: {
						text: '得分',
						align: 'high'
					},
					labels: {
						overflow: 'justify'
					}
				},
				tooltip: {
					valueSuffix: ''
				},
				plotOptions: {
					bar: {
						dataLabels: {
							enabled: false
						}
					}
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'top',
					x: -40,
					y: 100,
					floating: true,
					borderWidth: 1,
					backgroundColor: '#FFFFFF',
					shadow: true
				},
				credits: {
					enabled: false
				},
				series: []
			};
			
			var i,j;
			options.xAxis.categories = new Array();
			for(i=0;i<data.content.length;i++){
				for(j=0;j<data.content[i].content.length;j++){
					options.xAxis.categories.push(data.content[i].content[j].title);
				}
			}
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].name = '实际得分';
			options.series[0].data = new Array();
			options.series[0].color = Highcharts.getOptions().colors[0];
			for(i=0;i<data.content.length;i++){
				for(j=0;j<data.content[i].content.length;j++){
					options.series[0].data.push(parseFloat(data.content[i].content[j].content[0]));
				}
			}
			options.series[1] = new Object();
			options.series[1].name = '成熟度3级';
			options.series[1].data = new Array();
			options.series[1].color = Highcharts.getOptions().colors[3];
			for(i=0;i<data.content.length;i++){
				for(j=0;j<data.content[i].content.length;j++){
					options.series[1].data.push(parseFloat(data.content[i].content[j].content[3]));
				}
			}
			var chart = new Highcharts.Chart(options);
		}
	});*/
	hide();
	$('#tab-show-t0').show();
	var i;
	for(i=1;i<=15;i++){
		$('#show-t' + i).click(function(){
			//alert(this.id);
			hide();
			$('#tab-' + this.id).show();
		});
	}
	
	
});

function hide(){
	$('.tab-pane').hide();
}