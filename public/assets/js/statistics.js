var tab_id = 0;
var t1_num;
$(document).ready(function(){
	$('#loading-cover').show();
	//第一张表
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table1.json',
		success:function(data){
			//alert(data);
			var index = 1;
			//alert(data);
			var table = '<tr><th class="table-title" colspan=5><span title="该表展示所选被评估项的得分，并计算了关键域（KDs）和作用域（LDs）的计算结果。">关键变量（CVs）得分表</span></th></tr>';
			var i;
			t1_num = data.content.length;
			for(i=0;i<data.content.length;i++){
				table += '<tr>';
				table += '<th></th>';
				table += '<th colspan="2">'+ data.content[i].title_effect + '</th>';
				table += '<th style="text-align:center">得分</th>';
				table += '<th style="text-align:center">加权得分</th>';
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
						table += '<td style="text-align:center">' + index + '</td>';
						index++;
						table += '<td>' + variable[k].title_variable + '</td>';
						table += '<td style="text-align:center">' + variable[k].score + '</td>';
						if(k==0)
							table += '<td rowspan="' + variable.length + '" style="text-align:center">' + item[j].field_score + '</td>';
						table += '</tr>';
					}
				}
				table += '<tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>';
				table += '<tr style="color:red">';
				table += '<td></td><td colspan="2"  style="text-align:center">' + data.content[i].title_effect + '总均分</td><td></td><td style="text-align:center">' + data.content[i].effect_field_score + '</td>';
				table += '</tr>';
				
			}
			$('#t1').html(table);
			
		}
	});
	//第二张表
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table2.json',

		success:function(data){
			
			var table = '<tr><th class="table-title" colspan=3><span title="此表可帮助发现，关键变量集中的趋势，成熟度高的关键变量越多，总体能力越好">关键变量统计表</span></th></tr>';
			var i;
			table += '<tr>';
			for(i=0;i<data.content.length;i++){
				table += '<th  style="text-align:center">' + data.content[i].title + '</th>';
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
			
			
			
			var options = {
				chart: {
					renderTo:'p2',
					type: 'bar'
				},
				title: {
					text: '关键变量统计分布'
				},
				subtitle: {
					text: '百分比率'
				},
				xAxis: {
					categories: [5,4,3,2,1,0],
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
			for(i=data.content[0].content.length;i>0;i--){
				options.series[0].data.push(parseFloat(data.content[2].content[i-1]));
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
			var table = '<tr><th class="table-title" colspan=3><span title="此表是关键域（二级指标）得分的摘要表，数据经过化尾处理，转化为正分和半分数。">关键域（KDs）得分表</span></th></tr>';
			var i;
			table += '<tr>';
			table += '<th>作用域（一级指标）</th><th>关键域（二级指标）</th><th style="text-align:center">得分（半分制）</th>';
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
			var options = {
				chart: {
					renderTo:'p3',
					type: 'bar'
				},
				title: {
					text: '关键域（KDs）得分图'
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
			
			options.xAxis.categories = new Array();
			var i,j;
			for(i=0;i<data.content.length;i++){
				for(j=0;j<data.content[i].content.length;j++){
					options.xAxis.categories.push(data.content[i].content[j].title);
				}
			}
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].name = "得分";
			options.series[0].data = new Array();
			for(i=0;i<data.content.length;i++){
				for(j=0;j<data.content[i].content.length;j++){
					options.series[0].data.push(parseFloat(data.content[i].content[j].content));
				}
			}
			var chart = new Highcharts.Chart(options);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table4.json',
		success:function(data){
			var table = '<tr><th class="table-title" colspan=3><span title="此表可帮助发现，关键域集中的趋势，成熟度高的关键变量越多，总体能力越好">关键域（KDs）能力统计表</span></th></tr>';
			var i;
			table += '<tr>';
			table += '<th style="text-align:center">'+data.content[0].title+'</th><th style="text-align:center">'+data.content[1].title+'</th><th style="text-align:center">'+data.content[2].title+'</th>';
			table += '</tr>';
			for(i=0;i<data.content[0].content.length;i++){
				var j;
				table += '<tr>';
				for(j=0;j<3;j++){
					if(j == 2)
						table += '<td  style="text-align:center">'+data.content[j].content[i]+'%</td>';
					else
						table += '<td  style="text-align:center">'+data.content[j].content[i]+'</td>';
				}
				table += '</tr>';
			}
			table += '<tr>';
			table += '<td  style="text-align:center">Total</td><td  style="text-align:center">' + data.total[0] + '</td><td  style="text-align:center">'+ data.total[1] +'%</td>';
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
					categories: [],
					title:{
						text:'成熟度特征'
					}
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
			var table = '<tr><th class="table-title" colspan=3><span title="业务管理、信息技术、组织和运营、电子政务规划是组织能力的四个方面，该表直观表现组织能力的大致分布，看出哪个领域能力强，哪个领域稍弱。实际中，不同领域分管领导不同，该表提供了一个能力对比的展现，组织要均衡发展，四个方面的能力越平均，组织的整体能力越优良。">作用域（LDs）的得分表</span></th></tr>';
			table += '<tr style="text-align:center">';
			table += '<th></th><th style="text-align:center">加权分数</th><th style="text-align:center">能力比例</th>'
			table += '</tr>';
			var i;
			var ave = 0;
			for(i=0;i<data.content.length;i++){
				table += '<tr>';
				table += '<td>'+data.content[i].title+'</td>';
				table += '<td style="text-align:center">'+data.content[i].score+'</td>';
				ave += data.content[i].score / 4.0;
				table += '<td style="text-align:center">'+data.content[i].proportion+'%</td>';
				table += '</tr>';
			}
			table += '<tr>';
			table += '<td style="text-align:right">均值</td>';
			
			table += '<td style="text-align:right">'+ave+'</td>';
			table += '<td></td>';
			table += '</tr>';
			
			$('#t5').html(table);
			
			var options = {
				chart: {
					renderTo:'p5-1',
					type: 'column'
				},
				title: {
					text: '作用域（LDs）的得分表'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: []
				},
				yAxis: {
					min: 0,
					title: {
						text: '加权分数'
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						dataLabels: {
							enabled: true
						}
					}
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
			var chart = new Highcharts.Chart(options);
			
			options = {
				chart: {
					renderTo:'p5-2',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: '作用域（LDs）的得分表'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							color: '#000000',
							connectorColor: '#000000',
							format: '<b>{point.name}</b>: {point.percentage:.1f} %'
						}
					}
				},
				series: []
			}
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].type = 'pie';
			options.series[0].name = '能力比率';
			options.series[0].data = new Array();
			for(j=0;j<data.content.length;j++){
				options.series[0].data[j] = new Array();
				options.series[0].data[j][0] = data.content[j].title;
				options.series[0].data[j][1] = parseFloat(data.content[j].proportion);
			}
			var chart = new Highcharts.Chart(options);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table6.json',
		success:function(data){
			var table = '<tr><th class="table-title" colspan=7><span title="成熟度等级不是一个均数，而是多个关键域的表现集合。该表呈现为了达到一定成熟度，需要在关键域中有何种表现。有些目标能力为空，表示该成熟度下并不对该关键域有能力上的要求，相对应，能力上的数字表示应该达到的成熟度水平。当所有关键域都达到了目标值，才能说组织达到了该成熟度水平。">目标能力摘要表</span></th></tr>';
			table += '<tr style="text-align:center">';
			table += '<th>作用域(一级指标)</th><th>关键域(二级指标)</th><th colspan=5 style="text-align:center">组织的成熟度水平</th>';
			table += '</tr>';
			table += '<tr>';
			table += '<td></td><td></td>';
			table += '<td>成熟度1级</td><td>成熟度2级</td><td>成熟度3级</td><td>成熟度4级</td><td>成熟度5级</td>';
			table += '</tr>';
			
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
					table += '<td>'+data.content[i].content[j].content[0]+'</td>';
					table += '<td style="background:rgb(253,253,217);text-align:center">'+data.content[i].content[j].content[1]+'</td>';
					table += '<td style="background:rgb(235,241,222);text-align:center">'+data.content[i].content[j].content[2]+'</td>';
					table += '<td style="background:rgb(242,220,219);text-align:center">'+data.content[i].content[j].content[3]+'</td>';
					table += '<td style="background:rgb(220,230,241);text-align:center">'+data.content[i].content[j].content[4]+'</td>';
					table += '</tr>';
				}
			}
			$('#t6').html(table);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table7.json',
		success:function(data){
			var level = new Array('1','2','3','4','5');
			table = '<tr><th class="table-title" colspan=7><span title="此表是目标能力与实际能力之间的比较，“完成比例”指标告诉我们，未达到较高一级成熟度的原因，是某些关键域未完成，即完成度小于100。也可以得到哪些关键域表现优异，即完成度超过了较高一级成熟度的目标。">能力对比表</span></th></tr>';
			table += '<tr style="text-align:center"> <th></th> <th></th> <th style="text-align:center">实际得分</th> <th style="text-align:center">成熟度'+level[data.first-1]+'级</th> <th style="text-align:center">完成比例</th> <th style="text-align:center">成熟度'+level[data.second-1]+'级</th> <th style="text-align:center">完成比例</th> </tr>';
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
						if((k == 2) && data.content[i].content[j].content[k] != '')
							table += '<td style="text-align:center">'+data.content[i].content[j].content[k]+'%</td>';
						else if(k == 4 && data.content[i].content[j].content[k] != ''){
							if(parseFloat(data.content[i].content[j].content[k]) < 100)
								table += '<td style="text-align:center;background:rgb(230,184,183)">'+data.content[i].content[j].content[k]+'%</td>';
							else if(parseFloat(data.content[i].content[j].content[k]) > 100)
								table += '<td style="text-align:center;background:rgb(183,222,232)">'+data.content[i].content[j].content[k]+'%</td>';
							else
								table += '<td style="text-align:center">'+data.content[i].content[j].content[k]+'%</td>';
						}
						else
							table += '<td style="text-align:center">'+data.content[i].content[j].content[k]+'</td>';
					}
					table += '</tr>';
				}
			}
			$('#t7').html(table);
			
			var options = {
				chart: {
					renderTo:'p7',
					type: 'bar'
				},
				title: {
					text: '能力成熟度对比图'
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
			options.series[1].name = '成熟度'+level[data.second-1]+'级';
			options.series[1].data = new Array();
			options.series[1].color = Highcharts.getOptions().colors[3];
			for(i=0;i<data.content.length;i++){
				for(j=0;j<data.content[i].content.length;j++){
					options.series[1].data.push(parseFloat(data.content[i].content[j].content[3]));
				}
			}
			var chart = new Highcharts.Chart(options);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table8.json',
		success:function(data){
			var ar = new Array('一','二','三','四','五');
			var table = '<tr><th class="table-title" colspan=11><span title="此表是在能力对比的基础上对短缺能力的详细描述，贡献率是指每个关键变量对整体得分贡献了多少，贡献的越少，能力越不足。因而从贡献率可以发现短缺的关键变量。同时，与较高一级成熟度比较，完成比例告诉我们，现在能力完成了目标能力的比例，提升空间有多大。在这样一个提升空间内，细分下来，可看到每个关键节点（关键变量）的提升空间，从而指导在不同关键变量下应该付出多大的努力。">短缺能力详细信息表</span></th></tr>';
			table += '<tr style="text-align:center">';
			table += '<th style="text-align:center">领域</th>';
			table += '<th style="text-align:center">残缺的关键域</th>';
			table += '<th colspan="2" style="text-align:center">关键变量得分</th>';
			table += '<th style="text-align:center">综合得分</th>';
			table += '<th style="text-align:center">贡献率</th>';
			table += '<th style="text-align:center">第'+ar[parseInt(data.level)-1]+'级</th>';
			table += '<th style="text-align:center">完成比例</th>';
			table += '<th style="text-align:center">提升空间</th>';
			table += '<th style="text-align:center">提升结点空间</th>';
			table += '<th style="text-align:center">需要努力提高</th>';
			table += '</tr>';
			var i;
			for(i=0;i<data.content.length;i++){
				
				var k;
				for(k=0;k<data.content[i].content.length;k++){
					table += '<tr>';
					if(k == 0)
						table += '<td>'+data.content[i].title+'</td>';
					else
						table += '<td></td>';
					table += '<td>'+data.content[i].content[k].title+'</td>';
					table += '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
					table += '</tr>';
					var j;
					for(j=0;j<data.content[i].content[k].content.length;j++){
						table += '<tr>';
						table += '<td></td><td></td>';
						table += '<td>'+data.content[i].content[k].content[j].title+'</td>';
						table += '<td  style="text-align:center">'+data.content[i].content[k].content[j].vari_score+'</td>';
						if(j == 0){
							table += '<td rowspan=' + data.content[i].content[k].content.length + ' style="text-align:center">'+ data.content[i].content[k].compre +'</td>';
						}
						if(parseFloat(data.content[i].content[k].content[j].contribution) < 0)
							table += '<td style="background:rgb(183,222,232)" >'+data.content[i].content[k].content[j].contribution+'%</td>';
						else
							table += '<td  style="text-align:center">'+data.content[i].content[k].content[j].contribution+'%</td>';
						if(j == 0){
							table += '<td rowspan=' + data.content[i].content[k].content.length + ' style="text-align:center">'+ data.content[i].content[k].third +'</td>';
							table += '<td rowspan=' + data.content[i].content[k].content.length + ' style="text-align:center">'+ data.content[i].content[k].com_rate +'%</td>';
							table += '<td rowspan=' + data.content[i].content[k].content.length + ' style="text-align:center">'+ data.content[i].content[k].promote_rate +'%</td>';
						}
						if(parseFloat(data.content[i].content[k].content[j].space) > 0)
							table += '<td style="background:rgb(252,213,180);text-align:center">'+data.content[i].content[k].content[j].space+'%</td>';
						else
							table += '<td style="text-align:center">'+data.content[i].content[k].content[j].space+'%</td>';
						if(data.content[i].content[k].content[j].need_promote == 'true')
							table += '<td style="text-align:center"><span class="glyphicon glyphicon-ok-sign"></span></td>';
						else
							table += '<td style="text-align:center"></td>';
						table += '</tr>';
					}
				}
			}
			
			$('#t8').html(table);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table9.json',
		success:function(data){
			var table = '<tr><th class="table-title" colspan=8><span title="该表是对整个能力提升工作量的描述。很明显，百分比越大，说明需要提升的方面越多，工作量越大，在提升能力的过程中，应该多分配资源。">短缺能力的作用域分析表</span></th></tr>';
			table += '<tr>';
			table += '<th colspan=5 style="text-align:center">短缺能力的领域分析表</th>';
			table += '</tr>';
			table += '<tr>';
			table += '<th></th><th style="text-align:center">短缺能力项数</th><th style="text-align:center">被测项数</th><th style="text-align:center">所占比例</th><th style="text-align:center">占短缺能力的百分比</th>';
			table += '</tr>';
			var i;
			for(i=0;i<data.content.length;i++){
				table += '<tr>';
				table += '<td>'+data.content[i].title+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[0]+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[1]+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[2]+'%</td>';
				table += '<td style="text-align:center">'+data.content[i].content[3]+'%</td>';
				table += '</tr>';
			}
			table += '<tr>';
			table += '<td style="text-align:right">总数</td>';
			table += '<td style="text-align:center">'+data.total[0]+'</td>';
			table += '<td style="text-align:center">'+data.total[1]+'</td>';
			table += '<td style="text-align:center">'+data.total[2]+'%</td>';
			table += '<td></td>'
			table += '</tr>';
			
			$('#t9').html(table);
			
			var options = {
				chart: {
					renderTo:'p9-1',
					type: 'column'
				},
				title: {
					text: '短缺能力与被测能力项数'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: []
				},
				yAxis: {
					min: 0,
					title: {
						text: '项数'
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							format:'<b>{point.y}</b>'
						}
					}
				},
				series: []
			};
			options.xAxis.categories = new Array();
			for(i=0;i<data.content.length;i++){
				options.xAxis.categories.push(data.content[i].title);
			}
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].name = '短缺能力项数';
			options.series[0].data = new Array();
			for(i=0;i<data.content.length;i++){
				options.series[0].data.push(parseInt(data.content[i].content[0]));
			}
			options.series[1] = new Object();
			options.series[1].name = '被测项数';
			options.series[1].data = new Array();
			for(i=0;i<data.content.length;i++){
				options.series[1].data.push(parseInt(data.content[i].content[1]));
			}
			var chart = new Highcharts.Chart(options);
			
			options = {
				chart: {
					renderTo:'p9-2',
					type: 'column'
				},
				title: {
					text: '短缺能力项数占测评项数的百分比'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: []
				},
				yAxis: {
					min: 0,
					title: {
						text: ''
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y}%</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							format:'<b>{point.y}%</b>'
						}
						
					}
				},
				series: []
			};
			options.xAxis.categories = new Array();
			for(i=0;i<data.content.length;i++){
				options.xAxis.categories.push(data.content[i].title);
			}
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].name = '所占比例';
			options.series[0].data = new Array();
			for(i=0;i<data.content.length;i++){
				options.series[0].data.push(parseFloat(data.content[i].content[2]));
			}
			var chart = new Highcharts.Chart(options);
			
			options = {
				chart: {
					renderTo:'p9-3',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: '占短缺能力的百分比'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							color: '#000000',
							connectorColor: '#000000',
							format: '<b>{point.name}</b>: {point.percentage:.1f} %'
						}
					}
				},
				series: []
			};
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].type = 'pie';
			options.series[0].name = '占短缺能力的百分比';
			options.series[0].data = new Array();
			for(i=0;i<data.content.length;i++){
				options.series[0].data[i] = new Array();
				options.series[0].data[i].push(data.content[i].title);
				options.series[0].data[i].push(parseFloat(data.content[i].content[3]));
			}
			var chart = new Highcharts.Chart(options);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/' + $('#quiz_id').val() + '/table10.json',
		success:function(data){
			//alert(data);
			var table = '<tr><th class="table-title" colspan=8><span title="">能力提升分析表</span></th></tr>';
			table += '<tr style="text-align:center">';
			table += '<th style="text-align:center">类型</th>';
			table += '<th style="text-align:center">关键变量提升的项数(T=56)</th>';
			table += '<th style="text-align:center">占该领域的百分比</th>';
			table += '<th style="text-align:center">需要提升的流程(关键变量)</th>';
			table += '<th style="text-align:center">得分</th>';
			table += '<th style="text-align:center">提升空间</th>';
			table += '<th style="text-align:center">用功比例</th>';
			table += '<th style="text-align:center">特别弱项</th>';
			table += '</tr>';
			
			var i;
			for(i=0;i<data.table1.length;i++){
				var j;
				if(parseInt(data.table1[i].T56) == 0){
					table += '<tr>';
					table += '<td>'+data.table1[i].title+'</td>';
					table += '<td rowspan='+data.table1[i].content.length+' style="text-align:center">'+data.table1[i].T56+'</td>';
					table += '<td rowspan='+data.table1[i].content.length+' style="text-align:center">'+data.table1[i].rate+'%</td>';
					table += '<td></td><td></td><td></td><td></td>';
					table += '</tr>';
				}
				else{
					for(j=0;j<data.table1[i].content.length;j++){
						table += '<tr>';
						if(j == 0){
							table += '<td>'+data.table1[i].title+'</td>';
							table += '<td rowspan='+data.table1[i].content.length+' style="text-align:center">'+data.table1[i].T56+'</td>';
							table += '<td rowspan='+data.table1[i].content.length+' style="text-align:center">'+data.table1[i].rate+'%</td>';
						}
						else
							table += '<td></td>';
						table += '<td>'+data.table1[i].content[j].title+'</td>';
						table += '<td style="text-align:center">'+data.table1[i].content[j].content[0]+'</td>';
						table += '<td style="text-align:center">'+data.table1[i].content[j].content[1]+'%</td>';
						table += '<td style="text-align:center">'+data.table1[i].content[j].content[2]+'</td>';
						if(data.table1[i].content[j].content[3] == 'true')
								table += '<td style="text-align:center"><span class="glyphicon glyphicon-star"></span></td>';
							else
								table += '<td style="text-align:center"></td>';
						table += '</tr>';
					}
				}
			}
			table += '<tr>';
			table += '<td style="text-align:center">总数</td>';
			table += '<td style="text-align:center">'+data.table1_total[0]+'</td><td></td><td></td><td></td><td></td><td></td><td></td>';
			table += '</tr>';
			table += '<tr>';
			table += '<td style="text-align:center">占总关键变量百分比</td>';
			table += '<td style="text-align:center">'+data.table1_total[1]+'%</td><td></td><td></td><td></td><td></td><td></td><td></td>';
			table += '</tr>';
			table += '<tr style="text-align:center">';
			table += '<th style="text-align:center">需要提升的流程</th>';
			table += '<th style="text-align:center">得分</th>';
			table += '<th style="text-align:center">提升空间(降序排序)</th>';
			table += '</tr>';
			var ii,jj;
			for(ii=0;ii<data.table2.length;ii++){
				for(jj=0;jj<data.table2.length;jj++){
					if(parseFloat(data.table2[ii].content[1])>parseFloat(data.table2[jj].content[1])){
						var temp = data.table2[ii];
						data.table2[ii] = data.table2[jj];
						data.table2[jj] = temp;
					}
				}
			}
			for(i=0;i<data.table2.length;i++){
				table += '<tr>';
				table += '<td>'+data.table2[i].title+'</td>';
				table += '<td style="text-align:center">'+data.table2[i].content[0]+'</td>';
				table += '<td style="text-align:center">'+data.table2[i].content[1]+'%</td>';
				table += '</tr>';
			}
			$('#t10').html(table);
			
			var options = {
				chart:{
					renderTo:'p10'
				},
				title: {
					text: '能力提升图',
					x: -20 //center
				},
				subtitle: {
					text: '',
					x: -20
				},
				xAxis: {
					categories: []
				},
				yAxis: {
					title: {
						text: '成熟度特征'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				tooltip: {
					valueSuffix: ''
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 0
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
			options.xAxis.categories = new Array();
			for(i=0;i<data.table2.length;i++){
				options.xAxis.categories.push(data.table2[i].title);
			}
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].name = '得分';
			options.series[0].data = new Array();
			for(i=0;i<data.table2.length;i++){
				options.series[0].data.push(parseInt(data.table2[i].content[0]));
			}
			options.series[1] = new Object();
			options.series[1].name = '提升空间';
			options.series[1].data = new Array();
			for(i=0;i<data.table2.length;i++){
				options.series[1].data.push(parseFloat(data.table2[i].content[0])*(1.0+parseFloat(data.table2[i].content[1])/100));
			}
			var chart = new Highcharts.Chart(options);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/'+ $('#quiz_id').val() +'/table11.json',
		success:function(data){
			var ar = new Array('一','二','三','四','五');
			var table = '<tr><th class="table-title" colspan=10><span title="通过贡献率大小可以获知优势能力中具体哪个流程表现最佳，贡献率大于0，表示该流程（关键变量）已经超越比现有能力高一级的能力等级的要求，表现极佳。就关键域而言，与现有等级要求对比，超越比例是超出要求的部分。优秀指数则用于指出，优秀关键域中关键变量之间的优秀程度。">优势能力详细信息表</span></th></tr>';
			table += '<tr style="text-align:center">';
			table += '<th style="text-align:center">领域</th>';
			table += '<th style="text-align:center">优势能力</th>';
			table += '<th colspan="2" style="text-align:center">关键变量得分</th>';
			table += '<th style="text-align:center">综合得分</th>';
			table += '<th style="text-align:center">贡献率</th>';
			table += '<th style="text-align:center">第'+ar[parseInt(data.level)-1]+'级</th>';
			table += '<th style="text-align:center">完成比例</th>';
			table += '<th style="text-align:center">超越比例</th>';
			table += '<th style="text-align:center">优秀指数</th>';
			table += '</tr>';
			var i;
			for(i=0;i<data.content.length;i++){
				var k;
				for(k=0;k<data.content[i].content.length;k++){
					table += '<tr>';
					if(k == 0)
						table += '<td>'+data.content[i].title+'</td>';
					else
						table += '<td></td>';
					table += '<td>'+data.content[i].content[k].title+'</td>';
					table += '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
					table += '</tr>';
					var j;
					for(j=0;j<data.content[i].content[k].content.length;j++){
						table += '<tr>';
						table += '<td></td><td></td>';
						table += '<td>'+data.content[i].content[k].content[j].title+'</td>';
						table += '<td  style="text-align:center">'+data.content[i].content[k].content[j].vari_score+'</td>';
						if(j == 0)
							table += '<td rowspan=' + data.content[i].content[k].content.length + ' style="text-align:center">'+ data.content[i].content[k].compre +'</td>';
						
						if(parseFloat(data.content[i].content[k].content[j].contribution) > 0)
							table += '<td style="background:rgb(196,215,155);text-align:center" >'+data.content[i].content[k].content[j].contribution+'%</td>';
						else
							table += '<td  style="text-align:center">'+data.content[i].content[k].content[j].contribution+'%</td>';
						if(j == 0){
							table += '<td rowspan=' + data.content[i].content[k].content.length + ' style="text-align:center">'+ data.content[i].content[k].third +'</td>';
							table += '<td rowspan=' + data.content[i].content[k].content.length + ' style="text-align:center">'+ data.content[i].content[k].com_rate +'%</td>';
							table += '<td rowspan=' + data.content[i].content[k].content.length + ' style="text-align:center">'+ data.content[i].content[k].promote_rate +'%</td>';
						}
						if(parseFloat(data.content[i].content[k].content[j].space) > 0)
							table += '<td style="background:rgb(252,213,180);text-align:center">'+data.content[i].content[k].content[j].space+'</td>';
						else
							table += '<td style="text-align:center">'+data.content[i].content[k].content[j].space+'</td>';
						table += '</tr>';
					}
				}
			}
			
			$('#t11').html(table);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/'+$('#quiz_id').val()+'/table12.json',
		success:function(data){
			var table = '<tr><th class="table-title" colspan=5><span title="该图标用于站在作用域的角度，描述优势作用域的优秀比例。用于帮助四个领域的负责人员从部门的角度，获得部门优秀关键域的比例，比例越大，部分的流程工作越好，规范化程度越高。">优势能力的作用域分析表</span></th></tr>';

			table += '<tr style="text-align:center">';
			table += '<th></th><th style="text-align:center">优势能力项数</th><th style="text-align:center">总项数</th><th style="text-align:center">所占比例</th><th style="text-align:center">占优势能力的百分比</th>';
			table += '</tr>';
			var i;
			for(i=0;i<data.content.length;i++){
				table += '<tr>';
				table += '<td>'+data.content[i].title+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[0]+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[1]+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[2]+'%</td>';
				table += '<td style="text-align:center">'+data.content[i].content[3]+'%</td>';
				table += '</tr>';
			}
			table += '<tr>';
			table += '<td style="text-align:right">总数</td>';
			table += '<td style="text-align:center">'+data.total[0]+'</td>';
			table += '<td style="text-align:center">'+data.total[1]+'</td>';
			table += '<td style="text-align:center">'+data.total[2]+'%</td>';
			table += '<td></td>'
			table += '</tr>';
			
			$('#t12').html(table);
			
			var options = {
				chart: {
					renderTo:'p12-1',
					type: 'column'
				},
				title: {
					text: '优势能力分布图'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: []
				},
				yAxis: {
					min: 0,
					title: {
						text: ''
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							format:'<b>{point.y}</b>'
						}
					}
				},
				series: []
			};
			options.xAxis.categories = new Array();
			for(i=0;i<data.content.length;i++){
				options.xAxis.categories.push(data.content[i].title);
			}
			
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].name = '优势能力项数';
			options.series[0].data = new Array();
			for(i=0;i<data.content.length;i++){
				options.series[0].data.push(parseInt(data.content[i].content[0]));
			}
			options.series[1] = new Object();
			options.series[1].name = '总项数';
			options.series[1].data = new Array();
			for(i=0;i<data.content.length;i++){
				options.series[1].data.push(parseInt(data.content[i].content[1]));
			}
			var chart = new Highcharts.Chart(options);
			
			options = {
				chart: {
					renderTo:'p12-2',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: '占短缺能力的百分比'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							color: '#000000',
							connectorColor: '#000000',
							format: '<b>{point.name}</b>: {point.percentage:.1f} %'
						}
					}
				},
				series: []
			};
			options.series = new Array();
			options.series[0] = new Object();
			options.series[0].type = 'pie';
			options.series[0].name = '占短缺能力的百分比';
			options.series[0].data = new Array();
			for(i=0;i<data.content.length;i++){
				options.series[0].data[i] = new Array();
				options.series[0].data[i].push(data.content[i].title);
				options.series[0].data[i].push(parseFloat(data.content[i].content[3]));
			}
			var chart = new Highcharts.Chart(options);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/'+$('#quiz_id').val()+'/table13.json',
		success:function(data){
			var table = '<tr><th class="table-title" colspan=7><span title="按照优秀指数的大小，获知优秀的关键变量有哪些。">优势能力的数量分析表</span></th></tr>';
			table += '<tr style="text-align:center">';
			table += '<th style="text-align:center">领域</th>';
			table += '<th style="text-align:center">优秀关键变量的项数(T=56)</th>';
			table += '<th style="text-align:center">占该领域的百分比</th>';
			table += '<th>优秀关键变量</th>';
			table += '<th style="text-align:center">得分</th>';
			table += '<th style="text-align:center">优秀指数</th>';
			table += '<th style="text-align:center">特别优秀关键变量</th>';
			table += '</tr>';
			
			var i;
			for(i=0;i<data.table1.length;i++){
				var j;
				if(parseInt(data.table1[i].T56) == 0){
					table += '<tr>';
					table += '<td>'+data.table1[i].title+'</td>';
					table += '<td rowspan='+data.table1[i].content.length+' style="text-align:center">'+data.table1[i].T56+'</td>';
					table += '<td rowspan='+data.table1[i].content.length+' style="text-align:center">'+data.table1[i].rate+'%</td>';
					table += '<td></td><td></td><td></td><td></td>';
					table += '</tr>';
				}
				else{
					for(j=0;j<data.table1[i].content.length;j++){
						table += '<tr>';
						if(j == 0){
							table += '<td>'+data.table1[i].title+'</td>';
							table += '<td rowspan='+data.table1[i].content.length+' style="text-align:center">'+data.table1[i].T56+'</td>';
							table += '<td rowspan='+data.table1[i].content.length+' style="text-align:center">'+data.table1[i].rate+'%</td>';
						}
						else
							table += '<td></td>';
						table += '<td>'+data.table1[i].content[j].title+'</td>';
						table += '<td style="text-align:center">'+data.table1[i].content[j].content[0]+'</td>';
						table += '<td style="text-align:center">'+data.table1[i].content[j].content[1]+'</td>';
						if(data.table1[i].content[j].content[2] == 'true')
							table += '<td style="text-align:center"><span class="glyphicon glyphicon-tag"></span></td>';
						else
							table += '<td style="text-align:center"></td>';
						table += '</tr>';
					}
				}
			}
			table += '<tr>';
			table += '<td style="text-align:center">总数</td>';
			table += '<td style="text-align:center">'+data.table1_total[0]+'</td><td></td><td></td><td></td><td></td><td></td>';
			table += '</tr>';
			table += '<tr>';
			table += '<td style="text-align:center">占总关键变量百分比</td>';
			table += '<td style="text-align:center">'+data.table1_total[1]+'</td><td></td><td></td><td></td><td></td><td></td>';
			table += '</tr>';

			table += '<tr style="text-align:center">';
			table += '<th>优秀关键变量</th>';
			table += '<th>得分</th>';
			table += '<th>优秀指数</th>';
			table += '</tr>';
			var ii,jj;
			for(ii=0;ii<data.table2.length;ii++){
				for(jj=0;jj<data.table2.length;jj++){
					if(parseFloat(data.table2[ii].content[1])>parseFloat(data.table2[jj].content[1])){
						var temp = data.table2[ii];
						data.table2[ii] = data.table2[jj];
						data.table2[jj] = temp;
					}
				}
			}
			for(i=0;i<data.table2.length;i++){
				table += '<tr>';
				table += '<td>'+data.table2[i].title+'</td>';
				table += '<td style="text-align:center">'+data.table2[i].content[0]+'</td>';
				table += '<td style="text-align:center">'+data.table2[i].content[1]+'</td>';
				table += '</tr>';
			}
			$('#t13').html(table);
		}
	});
	$.ajax({
		type:'POST',
		url:'statistics/'+$('#quiz_id').val()+'/table14.json',
		success:function(data){
			var table = '<tr><th class="table-title" colspan=4><span title="">能力情况总汇表</span></th></tr>';
			table += '<tr style="text-align:center">';
			table += '<th></th><th style="text-align:center">参加测评</th><th style="text-align:center">短缺能力</th><th style="text-align:center">优势能力</th>';
			table += '</tr>';
			var i;
			for(i=0;i<data.content.length;i++){
				table += '<tr>';
				table += '<td>'+data.content[i].title+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[0]+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[1]+'</td>';
				table += '<td style="text-align:center">'+data.content[i].content[2]+'</td>';
				table += '</tr>';
			}
			table += '<tr>';
			table += '<td>成熟度等级</td>';
			table += '<td colspan=3 style="text-align:center">'+data.level+'级</td>';
			table += '</tr>';
			$('#t14').html(table);
			
			$('#test-level').html(data.level);
			$('#test-total').html(data.content[1].content[0]);
			$('#test-bad').html(data.content[1].content[1]);
		}
	});
	$('#index-show').click(function(){
		$('.tab-pane').show();
	});
	//$('#index-show').click();
	var i;
	for(i=1;i<=15;i++){
		$('#show-t' + i).click(function(){
			//alert(this.id);
			hide();
			$('#tab-' + this.id).show();
		});
	}
	$('#loading-cover').hide();
	
});
function download_result(){
	var test=new PageToExcel("t1-1",0,255,"测试.xls");//table id , 第几行开始，最后一行颜色 ，保存的文件名
	test.CreateExcel(false);
	test.Exec();
	test.SaveAs();
	test.CloseExcel();
}
function hide(){
	$('.tab-pane').hide();
}

function export1(){
	try{
		method1();
	}
	catch(e){
		alert("导出Excel失败，改为导出pdf");
		window.print();
	}

}