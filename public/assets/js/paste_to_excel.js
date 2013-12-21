// JavaScript Document
		
        function method1() { 

            var oXL = new ActiveXObject("Excel.Application");
            //创建AX对象excel    
            var oWB = oXL.Workbooks.Add();
            //获取workbook对象    
			oWB.Worksheets(1).Delete();
			oWB.Worksheets(1).Delete();
			 
			var curTbl = document.getElementById("t1");
			//alert(curTbl.id);
			var oSheet = oWB.ActiveSheet;
			oSheet.Name="关键变量（CVs）得分表";
			//激活当前sheet    
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTbl);
			//把表格中的内容移到TextRange中    
			sel.select();
			//全选TextRange中内容    
			sel.execCommand("Copy");
			//复制TextRange中内容     
			oSheet.Paste();
			//粘贴到活动的EXCEL中          
			oXL.Visible = true;
			//设置excel可见属性 
			   
			var curTb2 = document.getElementById("t2");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="关键变量统计分布表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb2);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;
						
			var curTb3 = document.getElementById("t3");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="关键域（KDs）得分表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb3);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;		
			
			var curTb4 = document.getElementById("t4");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="关键域（KDs）能力统计表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb4);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			var curTb5 = document.getElementById("t5");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="作用域（LDs）的得分表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb5);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			var curTb6 = document.getElementById("t6");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="目标能力摘要表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb6);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;			
			
			var curTb7 = document.getElementById("t7");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="能力对比图";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb7);
			try
			{
			   sel.select();
			}
			catch(err)
			{
			   //alert(err);
			}  
			    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;		
			
			var curTb8 = document.getElementById("t8");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="短缺能力详细信息";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb8);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;		
			
			var curTb9 = document.getElementById("t9");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="短缺能力的作用域分析";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb9);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			var curTb10 = document.getElementById("t10");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="能力提升分析";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb10);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			
			var curTb11 = document.getElementById("t11");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="优势能力详细信息";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb11);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			var curTb12 = document.getElementById("t12");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="优势能力的作用域分析";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb12);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;			
			
			var curTb13 = document.getElementById("t13");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="优势能力的数量分析";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb13);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;		
			
			var curTb14 = document.getElementById("t14");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="能力情况总汇表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb14);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;						
			

			
							
        }
        function method_server() { 

            var oXL = new ActiveXObject("Excel.Application");
            //创建AX对象excel    
            var oWB = oXL.Workbooks.Add();
			//oWB.Name="test";
            //获取workbook对象    
			oWB.Worksheets(1).Delete();
			oWB.Worksheets(1).Delete();
			 
			var curTbl = document.getElementById("t1");
			//alert(curTbl.id);
			var oSheet = oWB.ActiveSheet;
			oSheet.Name="关键变量（CVs）得分表";
			//激活当前sheet    
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTbl);
			//把表格中的内容移到TextRange中    
			sel.select();
			//全选TextRange中内容    
			sel.execCommand("Copy");
			//复制TextRange中内容     
			oSheet.Paste();
			//粘贴到活动的EXCEL中          
			oXL.Visible = true;
			//设置excel可见属性 
			   
			var curTb2 = document.getElementById("t2");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="关键变量统计分布表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb2);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;
						
			var curTb3 = document.getElementById("t3");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="关键域（KDs）得分表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb3);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;		
			
			var curTb4 = document.getElementById("t4");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="关键域（KDs）能力统计表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb4);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			var curTb5 = document.getElementById("t5");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="作用域（LDs）的得分表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb5);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			var curTb6 = document.getElementById("t6");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="目标能力摘要表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb6);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;			
			
			var curTb7 = document.getElementById("t7");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="能力对比图";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb7);
			try
			{
			   sel.select();
			}
			catch(err)
			{
			   //alert(err);
			}  
			    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;		
			
			var curTb8 = document.getElementById("t8");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="短缺能力详细信息";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb8);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;		
			
			var curTb9 = document.getElementById("t9");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="短缺能力的作用域分析";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb9);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			var curTb10 = document.getElementById("t10");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="能力提升分析";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb10);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			
			var curTb11 = document.getElementById("t11");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="优势能力详细信息";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb11);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;	
			
			var curTb12 = document.getElementById("t12");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="优势能力的作用域分析";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb12);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;			
			
			var curTb13 = document.getElementById("t13");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="优势能力的数量分析";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb13);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;		
			
			var curTb14 = document.getElementById("t14");
			var oSheet = oWB.Sheets.Add();
			oSheet.Name="能力情况总汇表";   
			var sel = document.body.createTextRange();
			sel.moveToElementText(curTb14);    
			sel.select();    
			sel.execCommand("Copy");     
			oSheet.Paste();        
			oXL.Visible = true;						
								
        }
        function method2(tableid) //读取表格中每个单元到EXCEL中    
        {
            var curTbl = document.getElementById(tableid);
            var oXL = new ActiveXObject("Excel.Application");
            //创建AX对象excel    
            var oWB = oXL.Workbooks.Add();
            //获取workbook对象    
            var oSheet = oWB.ActiveSheet;
            //激活当前sheet    
            var Lenr = curTbl.rows.length;
            //取得表格行数    
            for (i = 0; i < Lenr; i++) {
                var Lenc = curTbl.rows(i).cells.length;
                //取得每行的列数    
                for (j = 0; j < Lenc; j++) {
                    oSheet.Cells(i + 1, j + 1).value = curTbl.rows(i).cells(j).innerText;
                    //赋值    
                }
            }
            oXL.Visible = true;
            //设置excel可见属性    
        }
        function getXlsFromTbl(inTblId, inWindow) {
            try {
                var allStr = "";
                var curStr = "";
                //alert("getXlsFromTbl");    
                if (inTblId != null && inTblId != "" && inTblId != "null") {
                    curStr = getTblData(inTblId, inWindow);
                }
                if (curStr != null) {
                    allStr += curStr;
                }
                else {
                    alert("你要导出的表不存在！");
                    return;
                }
                var fileName = getExcelFileName();
                doFileExport(fileName, allStr);
            }
            catch (e) {
                alert("导出发生异常:" + e.name + "->" + e.description + "!");
            }
        }
        function getTblData(inTbl, inWindow) {
            var rows = 0;
            //alert("getTblData is " + inWindow);    
            var tblDocument = document;
            if (!!inWindow && inWindow != "") {
                if (!document.all(inWindow)) {
                    return null;
                }
                else {
                    tblDocument = eval(inWindow).document;
                }
            }
            var curTbl = tblDocument.getElementById(inTbl);
            var outStr = "";
            if (curTbl != null) {
                for (var j = 0; j < curTbl.rows.length; j++) {
                    //alert("j is " + j);    
                    for (var i = 0; i < curTbl.rows[j].cells.length; i++) {
                        //alert("i is " + i);    
                        if (i == 0 && rows > 0) {
                            outStr += " \t";
                            rows -= 1;
                        }
                        outStr += curTbl.rows[j].cells[i].innerText + "\t";
                        if (curTbl.rows[j].cells[i].colSpan > 1) {
                            for (var k = 0; k < curTbl.rows[j].cells[i].colSpan - 1; k++) {
                                outStr += " \t";
                            }
                        }
                        if (i == 0) {
                            if (rows == 0 && curTbl.rows[j].cells[i].rowSpan > 1) {
                                rows = curTbl.rows[j].cells[i].rowSpan - 1;
                            }
                        }
                    }
                    outStr += "\r\n";
                }
            }
            else {
                outStr = null;
                alert(inTbl + "不存在!");
            }
            return outStr;
        }
        function getExcelFileName() {
            var d = new Date();
            var curYear = d.getYear();
            var curMonth = "" + (d.getMonth() + 1);
            var curDate = "" + d.getDate();
            var curHour = "" + d.getHours();
            var curMinute = "" + d.getMinutes();
            var curSecond = "" + d.getSeconds();
            if (curMonth.length == 1) {
                curMonth = "0" + curMonth;
            }
            if (curDate.length == 1) {
                curDate = "0" + curDate;
            }
            if (curHour.length == 1) {
                curHour = "0" + curHour;
            }
            if (curMinute.length == 1) {
                curMinute = "0" + curMinute;
            }
            if (curSecond.length == 1) {
                curSecond = "0" + curSecond;
            }
            var fileName = "leo_zhang" + "_" + curYear + curMonth + curDate + "_"
            + curHour + curMinute + curSecond + ".csv";
            //alert(fileName);    
            return fileName;
        }
        function doFileExport(inName, inStr) {
            var xlsWin = null;
            if (!!document.all("glbHideFrm")) {
                xlsWin = glbHideFrm;
            }
            else {
                var width = 6;
                var height = 4;
                var openPara = "left=" + (window.screen.width / 2 - width / 2)
                + ",top=" + (window.screen.height / 2 - height / 2)
                + ",scrollbars=no,width=" + width + ",height=" + height;
                xlsWin = window.open("", "_blank", openPara);
            }
            xlsWin.document.write(inStr);
            xlsWin.document.close();
            xlsWin.document.execCommand('Saveas', true, inName);
            xlsWin.close();
        } 


            function Validate1() {
                if (document.getElementById("txt_MemberName").value == "") {
                    DIV_MemberName.style.display = 'block';
                } else {
                    DIV_MemberName.style.display = 'none';
                }
            }
            function Validate2() {
                if (document.getElementById("txt_MemberPassword").value == "") {
                    DIV_MemberPassword.style.display = 'block';
                } else {
                    DIV_MemberPassword.style.display = 'none';
                }
            } 
