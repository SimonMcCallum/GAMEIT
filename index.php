<?php	
	echo '<!DOCTYPE HTML>';

	if (!isset($dataBase)){
		include 'connect.php';
	}
	echo file_get_contents('html/headerGameIT.html');	
	echo '<body>';
	
	echo file_get_contents('html/containerGameIT.html');
	echo file_get_contents('html/scriptsGameIT.html');
	
	

	/*$result = $dataBase->query("SELECT * FROM EventData42 WHERE Cheat = 0 AND GameID = '42' ORDER BY Time DESC LIMIT");
	while($row = $result->fetch_assoc())
	  {	 
	    echo json_encode($row); 
	    }*/
	    
	 echo file_get_contents('html/footerGameIT.html');
	  ?>  
	





