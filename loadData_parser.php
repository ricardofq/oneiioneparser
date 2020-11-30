<?php 
session_start();


		
	if(isset($_POST['formSubmit']))
	{ 	
		include('include.php');

		$newEntries=0;
		$peso_cnt=0;
		$mm_cnt=0;
		$h2o_cnt=0;
		$mg_cnt=0;
		$gv_cnt=0;
	
		//$newString = str_replace(' ', '<br>', $_POST['info_text']);
	
		//print $newString;

		

		$pieces = explode(" ", $_POST['info_text']);

		$id = $_POST['id'];

//		$pieces[count($pieces)] = "";

		for ($i = 0; $i <= count($pieces); $i++)
		{
			$line = $pieces[$i];
			print $pieces[$i];
			
			if( (strlen($line) > 0) &&  ( substr($line, 1, 1) == '-') || (substr($line, 2, 1) == '-') )
            {
                list($day, $month, $year) = sscanf($line, "%u-%u-%u");
				$date = $year . '-' . $month . '-' . $day;
				print ' ' . $date;
				$mg=0;
				$h2o=0;
				$mm=0;
				$gv=0;
			}

			//-- Identify "Peso" line --

            $res=strcmp(substr($line, 0, 4), "Peso");
            if( $res == 0 )
            {
				$peso_original = $pieces[$i+1];
				$peso = str_replace(',', '.', $peso_original);
				$i=$i+1; 
				print ' ' . $peso;
			}

			//-- Identify "MG" line --
            $res=strcmp(substr($line, 0, 2), "MG");
            if( $res == 0 )
	        {
				$mg_original = $pieces[$i+1];
				$mg = str_replace(',', '.', $mg_original);
				$i=$i+1; 
				print ' ' . $mg;
            }
			
			//-- Identify "H2O" line --
            $res=strcmp(substr($line, 0, 3), "H2O");
            if( $res == 0 )
            {
				$h2o_original = $pieces[$i+1];
				$h2o = str_replace(',', '.', $h2o_original);
				$i=$i+1; 
				print ' ' . $h2o;
            }
		
			//-- Identify "MM" line --
            $res=strcmp(substr($line, 0, 2), "MM");
            if( $res == 0 )
            {
				$mm_original = $pieces[$i+1];
				$mm = str_replace(',', '.', $mm_original);
				$i=$i+1; 
				print ' ' . $mm;
            }	

			//-- Identify "GV" line --
            $res=strcmp(substr($line, 0, 2), "GV");
            if( $res == 0 )
            {
				$gv_original = $pieces[$i+1];
				$gv = str_replace(',', '.', $gv_original);
				$i=$i+1; 
				print ' ' . $gv;
            }


			//-- Identify empty line --
            $res=strcmp($line, "");
			$nextLineIsDate=0;

			if( $i < count($pieces) )
			{

				$nextLine = $pieces[$i+1];
				if( (strlen($nextLine) > 0) && ( substr($nextLine, 1, 1) == '-') || (substr($nextLine, 2, 1) == '-') )
				{
					$nextLineIsDate=1;
					//print '<br> NextLine is date<br>';
				}
			}

            if( ($res == 0 && $nextLineIsDate == 1) || $i == count($pieces) )
            {
            	//print '<br>Next Line is empty Line!<br>';

				$doc = [ 	'addedOn' => $date,
							'weight' => $peso,
							'mm' => $mm,
							'h2O' => $h2o,
							'mg' => $mg,
							'gv' => $gv,
							'addedBy' => 'quim esteroides',
				];


				// -- Update DB --------------------------------------------------------
				$bulk = new MongoDB\Driver\BulkWrite;
				$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');

				$bulk->insert($doc);

				$result = $manager->executeBulkWrite('one2one.users', $bulk);



    //             if($peso > 0) 
				// {
				// 	$query_weight=sprintf("INSERT INTO `one2one`.`weight` (`id`, `weight`, `date`) VALUES ('%d', '%f', '%s');",$id,$peso, $date);
				// 	print $query_weight;
				// 	print '<br>';
				// 	if($result_weight       = mysqli_query($link, $query_weight))
				// 		$peso_cnt +=1;
				// }


				// if($mg > 0)
    //             {
			 //        $query_mg=sprintf("INSERT INTO `one2one`.`fm` (`id`, `fm`, `date`) VALUES ('%d', '%f', '%s');",$id,$mg, $date);
				// 	print $query_mg;
				// 	print '<br>';
				// 	if($result_mg       = mysqli_query($link, $query_mg))
				// 	$mg_cnt +=1;
    //             }
				
				// if($h2o > 0)
    //             {
    // 		        $query_h2o=sprintf("INSERT INTO `one2one`.`h2o` (`id`, `h2o`, `date`) VALUES ('%d', '%f', '%s');",$id,$h2o, $date);
				// 	print $query_h2o;
				// 	print '<br>';
				// 	if($result_h2o       = mysqli_query($link, $query_h2o))
				// 		$h2o_cnt +=1;
    //             }
				
				// if($mm > 0)
    //             {
    // 		        $query_mm=sprintf("INSERT INTO `one2one`.`mm` (`id`, `mm`, `date`) VALUES ('%d', '%f', '%s');",$id,$mm, $date);
				// 	print $query_mm;
				// 	print '<br>';
				// 	if($result_mm       = mysqli_query($link, $query_mm))
				// 		$mm_cnt +=1;
    //             }

				
				// if($gv > 0)
    //             {
    // 		        $query_gv=sprintf("INSERT INTO `one2one`.`vf` (`id`, `vf`, `date`) VALUES ('%d', '%f', '%s');",$id,$gv, $date);
				// 	print $query_gv;
				// 	print '<br>';
				// 	if($result_gv       = mysqli_query($link, $query_gv))
				// 		$gv_cnt +=1;
    //             }
				
				$newEntries +=1; 

			}


			print '<br>';

		}
	

		print '<br>';	
		print 'New Entries= ' . ($newEntries) . '<br>';


		//$location=sprintf("location: main.php?page=users&action=view&ID=%d", $id);
		//header($location);

/*		print '<br>';	
		print '<br>';	
		print 'New Entries= ' . ($newEntries+1) . '<br>';
		print 'Peso_cnt = ' . ($peso_cnt) . '<br>';
		print 'MG_cnt = ' . ($mg_cnt) . '<br>';
		print 'h2o_cnt = ' . ($h2o_cnt) . '<br>';
		print 'MM_cnt = ' . ($mm_cnt) . '<br>';
		print 'gv_cnt = ' . ($gv_cnt) . '<br>';
*/
	}
?>
