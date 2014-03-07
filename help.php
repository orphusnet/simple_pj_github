 <?php

Require_once 'login.php'  ;
$resul=0 ;
$resu=0 ;
$vis = "hidden" ;
$name = "" ;
$loan = "" ;
$rate = "" ;
$term = "" ;
$value = "" ;
$valuel = "" ;
$idi = "" ;		
$list_name = '0' ;		

$mysqli = new mysqli($db_hostanme, $db_username, $db_password, $db_database);

if ($mysqli->connect_errno) 
{
    exit( "Failed to connect to MySQL: " . $mysqli->connect_error) ;
}

 if (isset($_POST['submBD']))
	  {
	    $id2 = $_POST['id'] ;
	    $name = $_POST['name'] ;
		$loan = $_POST['loan'] ;
	    $rate = $_POST['rate']  ;
		$term = $_POST['term'] ;
		$valuel = $_POST['valuel'] ;		
	  
        if ($id2=="")  
           {		  
		         $sql = "INSERT INTO loan (name, loan, rate, term, value, date ) VALUES ('$name', $loan, $rate, $term, $valuel,'" . date("F j, Y, g:i a") . "') "; 
           }
		   else
           {		  
		        $sql = "update  loan set name = '$name', loan = $loan, rate = $rate, term = $term, value = $valuel where id = $id2" ; 
           }
		  //die() ;
          // Performs the $sql query on the server to insert the values
          if ($mysqli->query($sql) === TRUE) {  }
          else {
                 echo 'Error: '. $mysqli->error;
          }

	  }


	
	 
	   if (isset($_POST['subm']))
	  {
	    $name = $_POST['name'] ;
		if ( $_POST['group1'] == "Year" )
		{
		    $term = $_POST['term']  ;
			$term = $term * 12 ;
		}
		else
		{
		    $term = $_POST['term'] ;
		}
		$loan = $_POST['loan'] ;
	    $rate = $_POST['rate'] ;
		$rate1 = $_POST['rate'] / 1200 ;
		
		//echo $loan . "<br>" ;
		//echo $rate . "<br>" ;
		//echo $term . "<br>" ;	\	
       // $valuel = round(($loan * $rate1 *((1+$rate1)^$term))/(((1+$rate1)^$term) - 1),2) ; 
         $valuel = round(( $rate1 + (rate1/((1+$rate1)^$term)-1))*loan  ,2) ; 	   
        //echo  $valuel  ;		
	    $resul =  "The operation on  " . date('l jS \of F Y h:i:s A') .  " has a result of : " . round($value,2)  ;
	  }
	  
	  
	   if (isset($_GET['delete']))
	   {
	   
	       $res = $mysqli->query("delete  FROM loan where id = " . $_GET['delete'] );
         
           
	   } 
	
	    if (isset($_GET['edit']))
	   {
	   
	        $res = $mysqli->query("select *   FROM loan where id = " . $_GET['edit'] );
		    $row = $res->fetch_assoc() ;
			$idi = $row['id'] ;
	        $name = $row['name'] ;
	        $loan = $row['loan'] ;
	        $rate = $row['rate'] ;
	        $term = $row['term'] ;
	        $date1 = $row['date'] ;	 
	        $valuel = $row['value'] ;	
         
           
	   } 
	  
	  
	   if (isset($_GET['loan']))
	   {
	   
	       $res = $mysqli->query("SELECT  * FROM loan where id = " . $_GET['loan'] );
         
           if ($res->num_rows > 0) 
           {
		       $row = $res->fetch_assoc() ;
               $r1 = "Loan No. " . $row['id'] . " on  date " .  $row['date'] ;
	           $r2  =  $row['id']  ;
			   $resul =  "The operation on date " .$row['date']  .  " has a result of : " .  $row['value']  ;
	       }
	   }   
	   
	  // show formula
	  if (isset($_GET['opc']))
	   {
	   
	   
	   switch ($_GET['opc']) 
	     {
            case 1:
               header( 'Location: http://localhost/calc/calc.php' ) ;
              break;
            case 2:
              $list_name = '1' ;
              break;	
            case 3:
               $sql = "delete from loan"; 
		 
               // Performs the $sql query on the server to insert the values
               if ($mysqli->query($sql) === TRUE) {  }
               else {
                     echo 'Error: '. $mysqli->error;
               }
              break;
            case 4:
             
              break;				  
         }
	   
	   
	   }   
	  
$res = $mysqli->query("SELECT  * FROM loan");

if ($res->num_rows > 0) 
{
   
   while ($row = $res->fetch_assoc()) {
     $id1 = $row['id'] ;
	 $name1 = $row['name'] ;
	 $loan1 = $row['loan'] ;
	 $rate1 = $row['rate'] ;
	 $term1 = $row['term'] ;
	 $date11 = $row['date'] ;	 
	 $valuel1 = $row['value'] ;	
     $space	 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ;
     if ($list_name == '0' )
	 {
     $r[$row['id']]['0'] = "<div style='text-align:left;width:100%'>&nbsp;&nbsp;&nbsp;Name: $name1<br>&nbsp;&nbsp;&nbsp;$date11 </div>  <br>Loan Amount: $loan1<br>Integer Rate: $rate1&nbsp;%<br>Term in Months: $term1<br>Montly Payment: <b><i> $valuel1</i></b><br><br><a href='calc.php?edit= $id1' >Edit</a>&nbsp;&nbsp;&nbsp;<a href='calc.php?delete= $id1' >Delete</a>$space<hr width='100%' align='right'>  " ;
	 }
	 else
	 {
	    $r[$row['id']]['0'] = "<div style='text-align:left;width:100%'>&nbsp;&nbsp;&nbsp;Name: $name1<br>&nbsp;&nbsp;&nbsp;$date11 </div><br><a href='calc.php?edit= $id1' >Edit</a>&nbsp;&nbsp;&nbsp;<a href='calc.php?delete= $id1' >Delete</a>$space<hr width='100%' align='right'>  " ;
	 }
	$r[$row['id']]['1']  =  $row['id']  ; 
   
	}
	
}	  
	  
 ?>
 
 <!doctype html>
 <HTML>
   <HEAD>
      <TITLE>Calculator</TITLE>
	  <LINK rel="stylesheet" type="text/css" href="style.css">
	  <script>
	  function calmonth(event,counter)
	  {
	    var mon = document.getElementById ("term1") ;
		temp = String.fromCharCode(event.charCode) ;
		if (temp.value == '') { mon.value  = ''}
		else
		{
		    mon.value = (counter.value.concat(temp) ) * 12    ;
		}
		
	  } 
	  
	  </script>
   </HEAD>
   <BODY>
   <div id="container">
   
      <div id="first">
            <p>&nbsp;&nbsp;&nbsp;&nbsp; LOAN CALCULATOR <span id='sp1'>Sprint 0</span><p> 
      </div>
	  <div id="second">
           
      </div>
	  
	   <div id="help" >
	       <h1>Help Instrucctions </h1>
         <p>
		 "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
		 </p>
		 <p3><a href="calc.php">Back...</a></p3>
      </div>
      <div id="botom">
        
		
		
   
   </div>
   </div>
    
	  
   

  
   <div id="formula" style="visibility:<?php echo $vis ?>;">
         <img src="formula.png" alt="formula" style="float:left" width="810" height="280">
   
   </div>
   
   </BODY>
</HTML>
