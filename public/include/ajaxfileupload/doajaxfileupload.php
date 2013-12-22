<?php
	$path = '../../assets/upload/pics/';
	// GraphUtil::uploadfile($path);
	$result = array ();
	
	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload';
	
	$allowType = array (
			'.jpg',
			'.png',
			'.gif',
			'.bmp'
	); // allow file type
	$num = strrpos ( $_FILES [$fileElementName] ['name'], '.' );
	$fileName = substr ( $_FILES [$fileElementName] ['name'], 0, $num ); // file name
	$fileType = substr ( $_FILES [$fileElementName] ['name'], $num, 8 ); // file type
	
	if (! empty ( $_FILES [$fileElementName] ['error'] )) {
		switch ($_FILES [$fileElementName] ['error']) {
			case '1' :
				$error = '�ϴ����ļ���С������php.ini ������';
				break;
			case '2' :
				$error = '�ϴ����ļ���С������html �еı�����';
				break;
			case '3' :
				$error = '�ļ��ϴ��ж�';
				break;
			case '4' :
				$error = 'û���ϴ��ļ�';
				break;
			case '6' :
				$error = '�Ҳ�����ʱ�ļ���';
				break;
			case '7' :
				$error = '�ļ�д����̴���';
				break;
			case '8' :
				$error = '�ϴ��ļ���չ������';
				break;
			case '999' :
			default :
				$error = 'δ֪�ϴ�����';
		}
	} elseif (empty ( $_FILES ['fileToUpload'] ['tmp_name'] ) || $_FILES ['fileToUpload'] ['tmp_name'] == 'none') {
		$error = 'No file was uploaded..';
	} elseif (! in_array ( $fileType, $allowType )) {
		$error = 'Unsupported upload file type';
	} else {
		$msg .= " File Name: " . $_FILES ['fileToUpload'] ['name'] . ", ";
		$msg .= " File Size: " . @filesize ( $_FILES ['fileToUpload'] ['tmp_name'] );
		
		// save file
		if (! file_exists ( $path )) {
			mkdir ( $path, 0777 );
		}
		$count = 0;
		$name = $fileName;
		while ( file_exists ( $path . $name . $fileType ) ) { // change file name
			$count ++;
			$name = $fileName . ' (' . $count . ')';
		}
		if (! move_uploaded_file ( $_FILES [$fileElementName] ['tmp_name'], $path . $name . $fileType )) {
			$error = '�����ļ�ʧ��';
		} else {
			
			$result ['fullname'] = $path . $name . $fileType;
			$result ['dir'] = $path;
			$result ['name'] = $name;
			$result ['type'] = $fileType;
			
			//if (isset ( $_POST ['graph_name'] )) {
			//	$name = $_POST ['graph_name'];
			//}
			// $filename="1/smallgraph.dot"
			//$pathinfo = pathinfo ( $result ['fullname'] );
			//$user_graph = new Graph ( $result ['fullname'], $pathinfo ['extension'] );
			//$json = json_encode ( $user_graph->tojsonarray () );
			//$jsonfile = GraphUtil::savejson ( $path, 'target-' . $name, $json );
			//GraphUtil::insertRecord ( $uid, $name, $result ['fullname'], $jsonfile );
			// echo $result;
		}
	}
	$result ['error'] = $error;
	$result ['msg'] = $msg;
	
	echo "{";
	echo "error: '" . $error . "',\n";
	echo "msg: '" . $name.$fileType . "'\n";
	echo "}";
?>