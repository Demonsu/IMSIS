<?php
	include_once '../sys/core/init.inc.php';

	//echo $result;
	$quiz_id = $_GET['quiz_id'];

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>问卷</title>
	

	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<script style="text/javascript" src="./assets/js/statistics.js"></script>
    <script style="text/javascript" src="./assets/js/paste_to_excel.js"></script>
	<script style="text/javascript" src="assets/plugin/highcharts/js/highcharts.js"></script>
	<script style="text/javascript" src="assets/plugin/highcharts/js/modules/exporting.js"></script>
	<script style="text/javascript" src="assets/js/export_excel.js"></script>
	<link rel="stylesheet" href="./assets/css/statistics.css">
	<link rel="stylesheet" href="./assets/css/body.css">
</head>
<body>
<div class="main">
<input type="text" style="display:none" id="quiz_id" value="<?php echo $quiz_id; ?>" />
<?php include 'include/header.php'; ?>

<div class="group">
	<!-- Nav tabs -->
	<div class="group">
		<nav id="navbar-example" class="navbar navbar-default navbar-static" role="navigation">
        <div class="navbar-header">
          <a class="navbar-brand" id="index-show">请选择统计结果</a>
        </div>
        <div class="collapse navbar-collapse bs-js-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">基本数据描述<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation"><a role="menuitem" tabindex="1" href="#" id="show-t1">关键变量（CVs）得分表</a></li>
                <li role="presentation"><a role="menuitem" tabindex="2" href="#" id="show-t2">关键变量统计分布</a></li>
                <li role="presentation"><a role="menuitem" tabindex="3" href="#" id="show-t3">关键域（KDs）得分表</a></li>
                <li role="presentation"><a role="menuitem" tabindex="4" href="#" id="show-t4">关键域统计分布</a></li>
				<li role="presentation"><a role="menuitem" tabindex="5" href="#" id="show-t5">作用域（LDs）得分表</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">能力描述摘要 <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                <li role="presentation"><a role="menuitem" tabindex="6" href="#" id="show-t6">目标能力摘要表</a></li>
                <li role="presentation"><a role="menuitem" tabindex="7" href="#" id="show-t7">能力对比分析（能力对比图）</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">短缺能描述<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a role="menuitem" tabindex="8" href="#" id="show-t8">短缺能力的详细信息</a></li>
                <li role="presentation"><a role="menuitem" tabindex="9" href="#" id="show-t9">短缺能力的作用域分析</a></li>
                <li role="presentation"><a role="menuitem" tabindex="10" href="#" id="show-t10">能力提升分析</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" id="drop4" role="button" class="dropdown-toggle" data-toggle="dropdown">优势能力描述<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop4">
                <li role="presentation"><a role="menuitem" tabindex="11" href="#" id="show-t11">优势能力详细信息</a></li>
                <li role="presentation"><a role="menuitem" tabindex="12" href="#" id="show-t12">优势能力的作用域分析</a></li>
                <li role="presentation"><a role="menuitem" tabindex="13" href="#" id="show-t13">优势能力数量分析</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" id="drop5" role="button" class="dropdown-toggle" data-toggle="dropdown">评估结果摘要<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop5">
                <li role="presentation"><a role="menuitem" tabindex="14" href="#" id="show-t14">能力情况汇总表</a></li>
                <!--<li role="presentation"><a role="menuitem" tabindex="15" href="#"  id="show-t15">评估报告描述</a></li>-->
              </ul>
            </li>
          </ul>
          
        </div><!-- /.nav-collapse -->
      </nav>
		
		<!--
		<div style="float:left;width:60px">
			<button id="nav-left" class="btn btn-default glyphicon glyphicon-chevron-left" style="width:35px;margin:5px 10px 0 15px"></button>
		</div>
		<div style="float:left;width:900px;overflow:hidden;">
		<div style="width:10000px;float:left;" id="side-left">
		<ul class="nav nav-tabs">
		  <li><a href="#tab-div1" id="tab1" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键变量（CVs）得分表">#1关键变量（CVs）得分表</a></li>
		  <li><a href="#tab-div2" id="tab2" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键变量统计分布">#2关键变量统计分布</a></li>
		  <li><a href="#tab-div3" id="tab3" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键域（KDs）得分表">#3关键域（KDs）得分表</a></li>
		  <li><a href="#tab-div4" id="tab4" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="关键域（KDs）能力统计表">#4关键域（KDs）能力统计表</a></li>
		  <li><a href="#tab-div5" id="tab5" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="作用域（LDs）的得分表">#5作用域（LDs）的得分表</a></li>
		  <li><a href="#tab-div6" id="tab6" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="目标能力摘要表（用户填写）">#6目标能力摘要表（用户填写）</a></li>
		  <li><a href="#tab-div7" id="tab7" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="能力对比图">#7能力对比图</a></li>
		  <li><a href="#tab-div8" id="tab8" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="短缺能力详细信息">#8短缺能力详细信息</a></li>
		  <li><a href="#tab-div9" id="tab9" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="短缺能力的作用域分析">#9短缺能力的作用域分析</a></li>
		  <li><a href="#tab-div10" id="tab10" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="能力提升分析">#10能力提升分析</a></li>
		  <li><a href="#tab-div11" id="tab11" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="优势能力详细信息">#11优势能力详细信息</a></li>
		  <li><a href="#tab-div12" id="tab12" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="优势能力的作用域分析">#12优势能力的作用域分析</a></li>
		  <li><a href="#tab-div13" id="tab13" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="优势能力的数量分析">#13优势能力的数量分析</a></li>
		  <li><a href="#tab-div14" id="tab14" data-toggle="tab" class="tab-tip" data-toggle="tooltip" data-placement="bottom" data-original-title="能力情况总汇表">#14能力情况总汇表</a></li>
		</ul>
		</div>
		</div>
	<div style="width:60px;float:left">
		<button id="nav-right" class="btn btn-default glyphicon glyphicon-chevron-right" style="width:35px;margin:5px 15px 0 10px"></button>
	</div>-->
	</div>
	<!-- Tab panes -->
	<div class="row">
	  <div class="tab-pane col-md-12" id="tab-show-t0">
		<div class="jumbotron" style="border-radius:6px">
		  <h1>统计结果查看</h1>
		  <p>
			在这个页面你可以根据你所填写的问卷生成相应的评测指标<br>
			同样你也可以将测评结果生产的表格以及图标下载到您的PC上<br>
			<br>
		  </p>
		  <p><a class="btn btn-primary btn-lg" role="button" onclick="download_result()"><span class="glyphicon glyphicon-tasks"></span> 导出报表</a></p>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t1">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>1.关键变量（CVs）得分表</h1>
			  <p>该表展示所选被评估项的得分，并计算了关键域（KDs）和作用域（LDs）的计算结果。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t1">
			
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t2">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>2.关键变量统计分布</h1>
			  <p>此表可帮助发现，关键变量集中的趋势，成熟度高的关键变量越多，总体能力越好</p>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<table class="col-md-12" id="t2">
	
			</table>
		</div>
		<div class="col-md-12 text-center">
			<div id="p2" style="width:960px;height: 400px;">
				
			</div>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t3">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>3.关键域（KDs）得分表</h1>
			  <p>此表是关键域（二级指标）得分的摘要表，数据经过化尾处理，转化为正分和半分数。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t3">
	
			</table>
		</div>
		<div class="col-md-12 text-center">
			<div id="p3" style="width:960px;height: 400px;">
				
			</div>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t4">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>4. 关键域（KDs）能力统计表</h1>
			  <p>此表可帮助发现，关键域集中的趋势，成熟度高的关键变量越多，总体能力越好</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t4">
	
			</table>
		</div>
		<div class="col-md-12" id="p4" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t5">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>5.作用域（LDs）的得分表</h1>
			  <p>业务管理、信息技术、组织和运营、电子政务规划是组织能力的四个方面，该表直观表现组织能力的大致分布，看出哪个领域能力强，哪个领域稍弱。实际中，不同领域分管领导不同，该表提供了一个能力对比的展现，组织要均衡发展，四个方面的能力越平均，组织的整体能力越优良。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t5">
	
			</table>
		</div>
		<div class="col-md-12" id="p5" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t6">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>6.目标能力摘要表</h1>
			  <p>成熟度等级不是一个均数，而是多个关键域的表现集合。该表呈现为了达到一定成熟度，需要在关键域中有何种表现。有些目标能力为空，表示该成熟度下并不对该关键域有能力上的要求，相对应，能力上的数字表示应该达到的成熟度水平。当所有关键域都达到了目标值，才能说组织达到了该成熟度水平。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t6">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t7">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>7.能力对比图</h1>
			  <p>此表是目标能力与实际能力之间的比较，“完成比例”指标告诉我们，未达到较高一级成熟度的原因，是某些关键域未完成，即完成度小于100。也可以得到哪些关键域表现优异，即完成度超过了较高一级成熟度的目标。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t7">
	
			</table>
		</div>
		<div class="col-md-12" id="p7" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t8">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>8.短缺能力详细信息</h1>
			  <p>此表是在能力对比的基础上对短缺能力的详细描述，贡献率是指每个关键变量对整体得分贡献了多少，贡献的越少，能力越不足。因而从贡献率可以发现短缺的关键变量。同时，与较高一级成熟度比较，完成比例告诉我们，现在能力完成了目标能力的比例，提升空间有多大。在这样一个提升空间内，细分下来，可看到每个关键节点（关键变量）的提升空间，从而指导在不同关键变量下应该付出多大的努力。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t8">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t9">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>9.短缺能力的作用域分析</h1>
			  <p>该表是对整个能力提升工作量的描述。很明显，百分比越大，说明需要提升的方面越多，工作量越大，在提升能力的过程中，应该多分配资源。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t9">
	
			</table>
		</div>
		<div class="col-md-12" id="p9-1" style="width:960px; height: 400px;">
			
		</div>
		<div class="col-md-12" id="p9-2" style="width:960px; height: 400px;">
			
		</div>
		<div class="col-md-12" id="p9-3" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t10">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>10.能力提升分析</h1>
			  <p></p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t10">
	
			</table>
		</div>
		<div class="col-md-12" id="p10" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t11">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>11.优势能力详细信息</h1>
			  <p>通过贡献率大小可以获知优势能力中具体哪个流程表现最佳，贡献率大于0，表示该流程（关键变量）已经超越比现有能力高一级的能力等级的要求，表现极佳。就关键域而言，与现有等级要求对比，超越比例是超出要求的部分。优秀指数则用于指出，优秀关键域中关键变量之间的优秀程度。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t11">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t12">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>12.优势能力的作用域分析</h1>
			  <p>该图标用于站在作用域的角度，描述优势作用域的优秀比例。用于帮助四个领域的负责人员从部门的角度，获得部门优秀关键域的比例，比例越大，部分的流程工作越好，规范化程度越高。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t12">
	
			</table>
		</div>
		<div class="col-md-12" id="p12-1" style="width:960px; height: 400px;">
			
		</div>
		<div class="col-md-12" id="p12-2" style="width:960px; height: 400px;">
			
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t13">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>13.优势能力的数量分析</h1>
			  <p>按照优秀指数的大小，获知优秀的关键变量有哪些。</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t13">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t14">
		<div class="col-md-12">
			<div class="jumbotron" style="border-radius:6px">
			  <h1>14.能力情况总汇表</h1>
			  <p>该次共有17个关键域参加参评，统计分析显示，战略规划、组织机构、创新管理、规章遵循、IT资源利用方面还存在不足。改进的方法，请参见《能力提升分析》表</p>
			</div>
		</div>
		<div class="col-md-12">
			<table class="col-md-12" id="t14">
	
			</table>
		</div>
	  </div>
	  <div class="tab-pane" id="tab-show-t15">
		<div class="col-md-12">
			<table class="col-md-12" id="t15">
	
			</table>
		</div>
	  </div>
	</div>
</div>

<?php include 'include/footer.php'; ?>

</div>

</div>
</body>
</html>