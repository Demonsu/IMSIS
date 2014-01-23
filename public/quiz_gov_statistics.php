<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once '../sys/core/init.inc.php';
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<title>��������ϵͳӦ��Ч�������������������</title>
	
	<link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
	<script style="text/javascript" src="./assets/js/jquery.js"></script>
	<script style="text/javascript" src="./assets/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./assets/css/body.css">
	<script>
	$(document).ready(function(){
		$.ajax({
			type:'POST',
			url:'./handle/system.php',
			data:{
				operation:'FETCHGOVQUIZSTATISTICS',
			},
			success:function(str){
				alert(str);
				var data = jQuery.parseJSON(str);
				for(var i=0;i<data.length;i++){
					for(var j=1;j<=data[i].length;j++){
						$('#r'+(i+1)+'-'+j).text(data[i][j-1]);
					}
				}
			}
		});
		
		$.ajax({
			type:'POST',
			url:'./handle/system.php',
			data:{
				operation:'FETCHGOVQUIZQUESTIONSUGGESTIONLIST',
			},
			success:function(str){
				alert(str);
				var data = jQuery.parseJSON(str);
				for(var i=0;i<data.length;i++){
					$('#t1').append('<p>'+(i+1)+':'+htmlDecode(data[i])+'</p>');
				}
			}
		});
		
		$.ajax({
			type:'POST',
			url:'./handle/system.php',
			data:{
				operation:'FETCHGOVQUIZSUGGESTION',
			},
			success:function(str){
				alert(str);
				var data = jQuery.parseJSON(str);
				for(var i=0;i<data.length;i++){
					$('#t2').append('<p>'+(i+1)+':'+htmlDecode(data[i])+'</p>');
				}
			}
		});
	});
	function htmlDecode(str){
		var s = "";
		if(str.length == 0) return "";
		s = str.replace(/&amp;/g,"&");
		s = s.replace(/&lt;/g, "<");  
		s = s.replace(/&gt;/g, ">");    
		s = s.replace(/&apos;/g, "'");  
		s = s.replace(/&quot;/g, '"');
		return s;
	}
	</script>
	<style>
	.checked{
		background-color:#f0ad4e;
	}
	
	th {
	 font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	 color: #000000;
	 border-right: 1px solid #C1DAD7;
	 border-bottom: 1px solid #C1DAD7;
	 border-top: 1px solid #C1DAD7;
	 letter-spacing: 2px;
	 text-transform: uppercase;
	 text-align: left;
	 padding: 6px 6px 6px 12px;
	 background: #CAE8EA;
	}
	th.nobg {
	 border-top: 0;
	 border-left: 0;
	 border-right: 1px solid #C1DAD7;
	 background: none;
	}
	td {
	 border-right: 1px solid #C1DAD7;
	 border-bottom: 1px solid #C1DAD7;
	 background: #fff;
	 font-size:11px;
	 padding: 6px 6px 6px 12px;
	 color: #000000;
	}
	td.alt {
	 background: #F5FAFA;
	 color: #000000;
	}
	th.spec {
	 border-left: 1px solid #C1DAD7;
	 border-top: 0;
	 background: #fff;
	 font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	}
	th.specalt {
	 border-left: 1px solid #C1DAD7;
	 border-top: 0;
	 background: #f5fafa url(images/bullet2.gif) no-repeat;
	 font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	 color: #000000;
	}
	table{
	 margin-top:25px;
	 margin-bottom:25px;
	}
	</style>
</head>

<body>
<div class="main">
<?php include "include/header.php"; ?>
<h3><b>��������ϵͳ��ʹ�ø���</b></h3>
<p>�������������ճ�ʹ�øõ�������ϵͳ�ĸ��ܻش��������⣬1-5���������ܵ��ĳ̶ȣ�1Ϊ��ͣ�5Ϊ��ߡ���</p>
<table style="width:100%;">
	<tr>
		<th style="width:15%;">
			<b>����</b>
		</th>
		<th style="width:60%;">
			<b>�������</b>
		</th>
		<th><b>1</b></th><th><b>2</b></th><th><b>3</b></th><th><b>4</b></th><th><b>5</b></th>
	</tr>
	
	<tr>
		<td rowspan=4>
			��֪������
		</td>
		<td id="q1">
			��ϵͳ��������ҵ���������Ҫ��ʹ��ֽ�ʰ���
		</td>
		<td id="r1-1"></td>
		<td id="r1-2"></td>
		<td id="r1-3"></td>
		<td id="r1-4"></td>
		<td id="r1-5"></td>
	</tr>
	<tr>
		<td id="q2">
			���ֽ�ʰ칫ϵͳ����ϵͳʹ�ҵĹ����������ס�
		</td>
		<td id="r2-1"></td>
		<td id="r2-2"></td>
		<td id="r2-3"></td>
		<td id="r2-4"></td>
		<td id="r2-5"></td>
	</tr>
	<tr>
		<td id="q3">
			���ֽ�ʰ칫ϵͳ��ʹ�ø�ϵͳ�����ʱ����̡�
		</td>
		<td id="r3-1"></td>
		<td id="r3-2"></td>
		<td id="r3-3"></td>
		<td id="r3-4"></td>
		<td id="r3-5"></td>
	</tr>
	<tr>
		<td id="q4">
			���ֽ�ʰ칫ϵͳ��ʹ�ø�ϵͳ���µ�����ȣ����������ߣ������١�
		</td>
		<td id="r4-1"></td>
		<td id="r4-2"></td>
		<td id="r4-3"></td>
		<td id="r4-4"></td>
		<td id="r4-5"></td>
	</tr>
	
	<tr>
		<td rowspan=4>
			��֪������
		</td>
		<td id="q5">
			���Ҷ��ԣ�ѧϰ��ϵͳ���ѡ�
		</td>
		<td id="r5-1"></td>
		<td id="r5-2"></td>
		<td id="r5-3"></td>
		<td id="r5-4"></td>
		<td id="r5-5"></td>
	</tr>
	<tr>
		<td id="q6">
			ʹ�ø�ϵͳ��չ���������ס�
		</td>
		<td id="r6-1"></td>
		<td id="r6-2"></td>
		<td id="r6-3"></td>
		<td id="r6-4"></td>
		<td id="r6-5"></td>
	</tr>
	<tr>
		<td id="q7">
			����ϵͳ�Ĳ������費�ѡ�
		</td>
		<td id="r7-1"></td>
		<td id="r7-2"></td>
		<td id="r7-3"></td>
		<td id="r7-4"></td>
		<td id="r7-5"></td>
	</tr>
	<tr>
		<td id="q8">
			�Һܿ��������ʹ�ø�ϵͳ��
		</td>
		<td id="r8-1"></td>
		<td id="r8-2"></td>
		<td id="r8-3"></td>
		<td id="r8-4"></td>
		<td id="r8-5"></td>
	</tr>
	
	<tr>
		<td rowspan=4>
			��������
		</td>
		<td id="q9">
			���Ը�ϵͳ����Ŀ�ꡢ�����뷽����ܲ��š��н���λ��ҵ����λ��������󣩵��˽�̶ȡ�
		</td>
		<td id="r9-1"></td>
		<td id="r9-2"></td>
		<td id="r9-3"></td>
		<td id="r9-4"></td>
		<td id="r9-5"></td>
	</tr>
	<tr>
		<td id="q10">
			�������ϵͳ��ơ�������������������۵ĳ̶ȡ�
		</td>
		<td id="r10-1"></td>
		<td id="r10-2"></td>
		<td id="r10-3"></td>
		<td id="r10-4"></td>
		<td id="r10-5"></td>
	</tr>
	<tr>
		<td id="q11">
			�������ϵͳ���蹤���������ĳ̶ȡ�
		</td>
		<td id="r11-1"></td>
		<td id="r11-2"></td>
		<td id="r11-3"></td>
		<td id="r11-4"></td>
		<td id="r11-5"></td>
	</tr>
	<tr>
		<td id="q12">
			��Ϊ��ϵͳ���蹤������Ľ��鱻���ɵ������
		</td>
		<td id="r12-1"></td>
		<td id="r12-2"></td>
		<td id="r12-3"></td>
		<td id="r12-4"></td>
		<td id="r12-5"></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			ְҵ��չ
		</td>
		<td id="q13">
			ʹ�ø�ϵͳ��չ�������׳������ɼ���
		</td>
		<td id="r13-1"></td>
		<td id="r13-2"></td>
		<td id="r13-3"></td>
		<td id="r13-4"></td>
		<td id="r13-5"></td>
	</tr>
	<tr>
		<td id="q14">
			ʹ�ø�ϵͳ��չ�������׵õ���λ���Ͽɡ�
		</td>
		<td id="r14-1"></td>
		<td id="r14-2"></td>
		<td id="r14-3"></td>
		<td id="r14-4"></td>
		<td id="r14-5"></td>
	</tr>
	<tr>
		<td id="q15">
			��ϵͳ�Ĺ����������Ҹ��˵�ְҵ��ֵ��һ�¡�
		</td>
		<td id="r15-1"></td>
		<td id="r15-2"></td>
		<td id="r15-3"></td>
		<td id="r15-4"></td>
		<td id="r15-5"></td>
	</tr>
</table>

<h3><b>��������ϵͳ�ķ���Ч������<b></h3>
<p>������Ӧ�õ�������ϵͳ�ṩ��������ĸ��ܣ�1-5���������ܵ��ĳ̶ȣ�1Ϊ��ͣ�5Ϊ��ߡ���</p>
<table style="width:100%">
	<tr>
		<th style="width:15%;">
			<b>����</b>
		</th>
		<th style="width:60%;">
			<b>�������</b>
		</th>
		<th><b>1</b></th><th><b>2</b></th><th><b>3</b></th><th><b>4</b></th><th><b>5</b></th>
	</tr>
	
	<tr>
		<td rowspan=5>
			��Ϣ��������
		</td>
		<td id="q16">
			ͨ����ϵͳ����������Ϣ��
		</td>
		<td id="r16-1"></td>
		<td id="r16-2"></td>
		<td id="r16-3"></td>
		<td id="r16-4"></td>
		<td id="r16-5"></td>
	</tr>
	<tr>
		<td id="q17">
			�����ߣ�����Ϣ��������Ҫ����������ᷢ����Ϣ��
		</td>
		<td id="r17-1"></td>
		<td id="r17-2"></td>
		<td id="r17-3"></td>
		<td id="r17-4"></td>
		<td id="r17-5"></td>
	</tr>
	<tr>
		<td id="q18">
			��Ϣ������ʱ����������Ϣ������һ���ڼ�����ᷢ����
		</td>
		<td id="r18-1"></td>
		<td id="r18-2"></td>
		<td id="r18-3"></td>
		<td id="r18-4"></td>
		<td id="r18-5"></td>
	</tr>
	<tr>
		<td id="q19">
			��������Ϣ����׼ȷ������һ�����ϻ�������Դ��ȷ�Ĺٷ����ϡ�
		</td>
		<td id="r19-1"></td>
		<td id="r19-2"></td>
		<td id="r19-3"></td>
		<td id="r19-4"></td>
		<td id="r19-5"></td>
	</tr>
	<tr>
		<td id="q20">
			��������Ϣ������Ⱥ�Ĵ�С��
		</td>
		<td id="r20-1"></td>
		<td id="r20-2"></td>
		<td id="r20-3"></td>
		<td id="r20-4"></td>
		<td id="r20-5"></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			�����������
		</td>
		<td id="q21">
			��ϵͳ�ṩ����ָ�ϡ�������ء���ѯ�����ȷ���
		</td>
		<td id="r21-1"></td>
		<td id="r21-2"></td>
		<td id="r21-3"></td>
		<td id="r21-4"></td>
		<td id="r21-5"></td>
	</tr>
	<tr>
		<td id="q22">
			��ͨ����ϵͳΪ���ڡ���ҵ����ҵ��
		</td>
		<td id="r22-1"></td>
		<td id="r22-2"></td>
		<td id="r22-3"></td>
		<td id="r22-4"></td>
		<td id="r22-5"></td>
	</tr>
	<tr>
		<td id="q23">
			��ϵͳ����ҵ�����ȴ��ڰ��¸����ס�
		</td>
		<td id="r23-1"></td>
		<td id="r23-2"></td>
		<td id="r23-3"></td>
		<td id="r23-4"></td>
		<td id="r23-5"></td>
	</tr>
	<tr>
		<td id="q24">
			����ڴ�ͳ��ʽ����ϵͳ����ҵ���ʱ����̡�
		</td>
		<td id="r24-1"></td>
		<td id="r24-2"></td>
		<td id="r24-3"></td>
		<td id="r24-4"></td>
		<td id="r24-5"></td>
	</tr>
	<tr>
		<td id="q25">
			����ڴ�ͳ��ʽ����ϵͳ����ҵ��Ĳ����١�
		</td>
		<td id="r25-1"></td>
		<td id="r25-2"></td>
		<td id="r25-3"></td>
		<td id="r25-4"></td>
		<td id="r25-5"></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			�����������
		</td>
		<td id="q26">
			�ѿ�ͨ�������ŷá��쵼���䡢���߷�̸�ȷ���
		</td>
		<td id="r26-1"></td>
		<td id="r26-2"></td>
		<td id="r26-3"></td>
		<td id="r26-4"></td>
		<td id="r26-5"></td>
	</tr>
	<tr>
		<td id="q27">
			��ͨ����ϵͳ��������������⡣
		</td>
		<td id="r27-1"></td>
		<td id="r27-2"></td>
		<td id="r27-3"></td>
		<td id="r27-4"></td>
		<td id="r27-5"></td>
	</tr>
	<tr>
		<td id="q28">
			ͨ����ϵͳ�������������������ס�
		</td>
		<td id="r28-1"></td>
		<td id="r28-2"></td>
		<td id="r28-3"></td>
		<td id="r28-4"></td>
		<td id="r28-5"></td>
	</tr>
	<tr>
		<td id="q29">
			ͨ����ϵͳ��������������������;�����졣
		</td>
		<td id="r29-1"></td>
		<td id="r29-2"></td>
		<td id="r29-3"></td>
		<td id="r29-4"></td>
		<td id="r29-5"></td>
	</tr>
	<tr>
		<td id="q30">
			ͨ����ϵͳ�����������������Ĵ�������
		</td>
		<td id="r30-1"></td>
		<td id="r30-2"></td>
		<td id="r30-3"></td>
		<td id="r30-4"></td>
		<td id="r30-5"></td>
	</tr>
	
	<tr>
		<td rowspan=6>
			���񴫵�����
		</td>
		<td id="q31">
			��ϵͳ�ķ������ݿɱ�IE��Firefox�ȳ�����������ʡ�
		</td>
		<td id="r31-1"></td>
		<td id="r31-2"></td>
		<td id="r31-3"></td>
		<td id="r31-4"></td>
		<td id="r31-5"></td>
	</tr>
	<tr>
		<td id="q32">
			��ϵͳ�ķ�����������������ĵ����ṹ�������û�����Ľ�����ơ�
		</td>
		<td id="r32-1"></td>
		<td id="r32-2"></td>
		<td id="r32-3"></td>
		<td id="r32-4"></td>
		<td id="r32-5"></td>
	</tr>
	<tr>
		<td id="q33">
			ͨ����ϵͳ�ṩ�������ݱȴ�ͳ��ʽ���졣
		</td>
		<td id="r33-1"></td>
		<td id="r33-2"></td>
		<td id="r33-3"></td>
		<td id="r33-4"></td>
		<td id="r33-5"></td>
	</tr>
	<tr>
		<td id="q34">
			ͨ����ϵͳ�ṩ�ķ���������һվʽ�ġ�
		</td>
		<td id="r34-1"></td>
		<td id="r34-2"></td>
		<td id="r34-3"></td>
		<td id="r34-4"></td>
		<td id="r34-5"></td>
	</tr>
	<tr>
		<td id="q35">
			��ϵͳ�ṩ��������в����ߡ���崻���������ȡ�
		</td>
		<td id="r35-1"></td>
		<td id="r35-2"></td>
		<td id="r35-3"></td>
		<td id="r35-4"></td>
		<td id="r35-5"></td>
	</tr>
	<tr>
		<td id="q36">
			��ϵͳδ������Ȩ�û����ֹ���
		</td>
		<td id="r36-1"></td>
		<td id="r36-2"></td>
		<td id="r36-3"></td>
		<td id="r36-4"></td>
		<td id="r36-5"></td>
	</tr>
	
	<tr>
		<td rowspan=5>
			����Ӧ������
		</td>
		<td id="q37">
			��ϵͳע�ز����µ���Ϣ�����ṩ���£����蹦����
		</td>
		<td id="r37-1"></td>
		<td id="r37-2"></td>
		<td id="r37-3"></td>
		<td id="r37-4"></td>
		<td id="r37-5"></td>
	</tr>
	<tr>
		<td id="q38">
			��λ�ǳ�ע�س���������Ϣ��Դ����ת��Ϊ�µ�ϵͳ��Ŀ��
		</td>
		<td id="r38-1"></td>
		<td id="r38-2"></td>
		<td id="r38-3"></td>
		<td id="r38-4"></td>
		<td id="r38-5"></td>
	</tr>
	<tr>
		<td id="q39">
			��λ�ܿ��ٽ���ϵͳ�����еĳɹ���������������λ���ⵥλ�ģ����ƹ㵽����λ����������Ŀ����
		</td>
		<td id="r39-1"></td>
		<td id="r39-2"></td>
		<td id="r39-3"></td>
		<td id="r39-4"></td>
		<td id="r39-5"></td>
	</tr>
	<tr>
		<td id="q40">
			��λ�ܸ��ݿͻ�����ı仯���ϵ����ڲ���Դ�����ã����ṩ�µ�ҵ������
		</td>
		<td id="r40-1"></td>
		<td id="r40-2"></td>
		<td id="r40-3"></td>
		<td id="r40-4"></td>
		<td id="r40-5"></td>
	</tr>
	<tr>
		<td id="q41">
			Ϊ��ЧԤ����ϵͳӦ�ù����г��ֵ�ͻ���¼�����λ��������Ӧ��Ӧ����ʩ������˫���ݴ���ơ�UPS���ȱ���ϵͳ�ȣ���
		</td>
		<td id="r41-1"></td>
		<td id="r41-2"></td>
		<td id="r41-3"></td>
		<td id="r41-4"></td>
		<td id="r41-5"></td>
	</tr>
	
	<tr>
		<td rowspan=3>
			����������
		</td>
		<td id="q42">
			��ϵͳ��������Ƶ�ʹ�ð���ƽ̨��
		</td>
		<td id="r42-1"></td>
		<td id="r42-2"></td>
		<td id="r42-3"></td>
		<td id="r42-4"></td>
		<td id="r42-5"></td>
	</tr>
	<tr>
		<td id="q43">
			��ϵͳ��������Ƶ�ͻ������Ӧ����Ӧ���ơ�
		</td>
		<td id="r43-1"></td>
		<td id="r43-2"></td>
		<td id="r43-3"></td>
		<td id="r43-4"></td>
		<td id="r43-5"></td>
	</tr>
	<tr>
		<td id="q44">
			��ϵͳ�ɸ����û��ķ��������û�����ǿ�ȣ��ĸߵͶ�̬��������ˮƽ��
		</td>
		<td id="r44-1"></td>
		<td id="r44-2"></td>
		<td id="r44-3"></td>
		<td id="r44-4"></td>
		<td id="r44-5"></td>
	</tr>
</table>
<p>�����������ᷨ�Ľ��飺</p>
<div style="width:100%;overflow:auto;height:200px;" id="t1">

</div>

<p>�Ա�����Ľ��飺</p>
<div style="width:100%;overflow:auto;height:200px;" id="t2">

</div>

<?php include "include/footer.php"; ?>
</div>
</body>
</html>