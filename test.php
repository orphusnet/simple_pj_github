<?php
/*
//	DOCUMENT DEFINING PHP CLASSES TO BE INSTANIATED IN THE REST OF CODE
//  
//	class:   db_operations{}
//	
//  methods:   
//  	db_connect()  -- Just connect to your database server using the credentials you set handle an error if something goes wrong
//	
//		db_query($query) -- Execute the query sended from the caller : return the result of the query 
//
*/

modifying all things
class db_operations{
	function db_connect(){
	//Initializing variables with the necesary data to connect to your database
	$user = "root";
 	$passwd = "";
	$host="localhost";
 	$database= "colors_votes";
	$this->conn=mysqli_connect($host,$user,$passwd,$database);

	// Debugging the database connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  } 
}
	
	// Executing a query to the database
	function db_query($query){
		 $result = mysqli_query($this->conn,$query);
		
		return $result;
		
		}
	
}
