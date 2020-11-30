<?php

	print '<html>';
	print '<head>';
	print '<title>Importar Dados</title>';
	print '<META http-equiv="Content-Style-Type" content="text/css">';
	print '<link rel="stylesheet" type="text/css" href="gui.css">';
	print '</head>';

	print '<body>';
	
	include('include.php');
	
	
	print '<h7>Ferramenta de importação de dados</h7><br>';
	print '<br>';

	// print '<h6><strong>Aluno: </strong> ';
		
	// $query=sprintf("SELECT * FROM `one2one`.`clients` WHERE id='%d'",$_GET['ID']);

 //        if ($result = mysqli_query($link, $query))
	// {
	// 	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	// 	{
	// 		print utf8_encode($row['name']);
	// 		$d1 = $row['birthdate'];
	// 		$years = round((time()-strtotime($d1))/(3600*24*365.25));
	// 		print ' ( ' .$years . ' anos | ' . $row['height'] . ' m )';
	// 	}


			
	// }
	// print '</h6>';
		
	print '<br>';
	print '<form action="loadData_parser.php" method="post">';
        //print '<table style="width=500px">';
        //print '<tr>';
        //print '<td><input type="text" style="font-size: 24pt" name="info_text" size="30"></td>';
	//print '</tr>';
	print '<center>';
        print '<input type="text" style="font-size: 24pt" name="info_text" size="30">';
	print '</center>';
        //print '</table>';
	print '<input type="hidden" name="id" value="';
	print $_GET['ID'];
	print '">';
        print '<p><center><input type="submit" name="formSubmit" style="font-size: 24pt"  value="Submeter"/></center><p>';
        print '</form>';

	print '</body>';

?>



