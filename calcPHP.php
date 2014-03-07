 <?php
    //read a json file with oldest load and send to array.
    $str_data = file_get_contents("cont.json");
	$json_a = json_decode($str_data, true);
	
	
	
	//create the html to be show in div list
	foreach ($json_a as $valor)	
	{
		$name_r = $valor['name'] ;
		$loan_r = $valor['loan'] ;
		$rate_r = $valor['rate'] ;
		$name_r = $valor['name'] ;
		$date_r = $valor['date'] ;
		$paymentmontly_r = $valor['paymentmontly'] ;		
        $r[] = "<div style='text-align:left;width:100%'>&nbsp;&nbsp;&nbsp;Name: $name_r<br>&nbsp;&nbsp;&nbsp;$date_r </div>  <br>Loan Amount: $loan_r<br>Integer Rate: $rate_r &nbsp;%<br>Term in Months: $rate_r<br>Montly Payment: <b><i> $paymentmontly_r</i></b><br><br><hr width='100%' align='right'>  " ;
	}
	
	
 
class term {

  private $term ;
  public $termMonth ;
  function set_term($termvalue)
  {
      $this->term = $termvalue  ;
  }
    function get_term()
  {
      return $this->term   ;
  }
  function result_term($value)
  {
      if ($value == "Month") 
	  {
	        $this->termMonth = $this->term  ;
	  }	
	  else
	  {
	      if ($value == "Year") 
	      {
	         $this->termMonth =  $this->term * 12 ;
	      }
		  else
		  {
		    $this->termMonth = 0 ;
		  }
	  }
	  
	  
  }
  
}

class rate extends term
{
   private $rate ;
   function get_rate()
   {
       return $this->rate ;
   }
   function set_rate($value)
   {
      $this->rate = $value  ;
   }
   function calcrate()
   {
     return $this->rate  / 1200 ;
   }
}



class calc extends rate
{
   public $name = "" ;
   public $result = 0 ;
   public $loan = 0 ;
   
   
   function calcloan()
   {
    $this->result = round(($this->calcrate() + ($this->calcrate() /(pow(1+$this->calcrate() ,$this->termMonth )-1)))*$this->loan,2)   ; 	
	// $this->result = 0 ;
	 return $this->result ;
   }
   
}



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
$grupy = "checked" ;	
$grupm= "" ;
$paymentmontly = 0 ;	

$objcalc = new calc ;


if ($_POST)
{
    $id2 = $_POST['id'] ;
    $name = $_POST['name'] ;
	$loan = $_POST['loan'] ;
    $rate = $_POST['rate']  ;
	$term = $_POST['term'] ;
	$paymentmontly = $_POST['valuel'] ;
}		
	
 //Making the calculation of loan
if (isset($_POST['subm']))
{
    $objcalc->name = $_POST['name'] ;
	$objcalc->set_term($_POST['term']) ;
	$objcalc->result_term($_POST['group1']) ;
	$idi = $_POST['id'] ;
	$objcalc->loan = $_POST['loan'] ;
    $objcalc->set_rate($_POST['rate']) ;
	$paymentmontly =  $objcalc->calcloan()   ; 	
    //Values sending to fill inputs
    $loan = $objcalc->loan ;	
    $name = $objcalc->name ;	
    $rate = $objcalc->get_rate() ;
    $term = $objcalc->get_term() ;
	if ($_POST['group1'] == "Month") 
	{
		$grupm = "checked" ;
        $grupy = "" ;		
	}
	else
	{
        $grupm = "" ;
        $grupy = "checked" ;			  
	} 	
	    
}

//	Saving information to array   
if (isset($_POST['submBD']))
{   $json =  array
		    (
		       'name' => $name ,
		       'loan' => $loan ,
		       'rate' => $rate ,
		       'term' => $term  ,
               'paymentmontly' => $paymentmontly,
               'date' => date("F j, Y, g:i a")				   
            );
		
	
	$str_data = file_get_contents("cont.json");
	// convert to array
	$json_a = json_decode($str_data, true);
	$json_a[] = $json ;
	
	
	
	
    $nombre_archivo = 'cont.json';
    $archivo = fopen($nombre_archivo, 'a+');
	ftruncate($archivo, 0);
    rewind($archivo);
    fwrite($archivo, json_encode($json_a));
    fclose($archivo);
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
               
			   header( 'Location: http://localhost/calc/calc.php?ask=1' ) ;
			   
              break;
            case 4:
             
              break;				  
         }
	   
	   
	   }   
 ?>
 
 
