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