<?php

// en klasse som kobler seg til en database

class database
{
private $connectlink;	//Database Connection Link
private $username = "quizUser";
private $password = "Uka8yzq5";
private $database = "MasterQuiz";
private $hostname = "localhost";
private $resultlink;	//Database Result Recordset link
private $rows;		//Stores the rows for the resultset
public $errorM1 = "Kunne ikke koble til host database. Vennligst kontakt systemansvarlig!";
public $errorM2 = "Kunne ikke velge angitt database. Vennligst kontakt systemansvarlig!";
public $errorM3 = "Kunne ikke velge sette angitt spørring. Vennligst kontakt systemansvarlig!";
private $mysql="";
private $nmbr=0;

 
public function __construct() {
	
}

public function connect() {
	$this->connectlink = mysql_connect($this->hostname,$this->username,$this->password);
	if(!($this->connectlink)) {
		print("Error no connect ");
		return mysql_error();
	}
	else {
		if(!mysql_select_db($this->database,$this->connectlink)) {
			return mysql_error();
		}
		else {
			return ""; // fungerte
		}
	}

}
 
public function __destruct() {
	@mysql_close($this->connectlink);
}

public function setQuery($sql) {
	
	$this->mysql = $sql;
	if(!mysql_query($this->mysql)) {
		return mysql_error();
	}
	else {
		return "";
	}
	
	
}
 
public function query($sql) {
	$this->resultlink = mysql_query($sql);
	return $this->resultlink;
}
 
public function fetch_rows($result) {
	$rows = array();
	if($result) {
		while($row = mysql_fetch_array($result)) {
			$rows[] = $row;
		}
	}
	else {
		//throw new RetrieveRecordsException("Error Retrieving Records".mysql_error(),"102");
		$rows = null;
	}
	return $rows;
}

public function number($r) {
	
	$this->nmbr = mysql_num_rows($r);
	$nm = $this->nmbr;
	return $nm;
	
}




}
 
	//Create database object
 
?>