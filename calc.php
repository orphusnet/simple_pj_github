 <?php
   require('calcPHP.php');
 ?>
 
 <HTML>
   <HEAD>
      <TITLE>Calculator</TITLE>
	  <SCRIPT SRC='test.js'></SCRIPT>
	  <LINK rel="stylesheet" type="text/css" href="style.css">
   </HEAD>
   <BODY>
    <div id="container">
        <div id="header">
            <p>&nbsp;&nbsp;&nbsp;&nbsp; LOAN CALCULATOR <span id='sp1'>Sprint 1</span><p> 
        </div>
	    <div id="menu">
            
		      <table id="table1" border="0" width="100%">
		        <tr align="center">
				     <td width="27%" class="col" ><a href="#">Reset Calculator</a></td>
					 <td width="0,5%"></td>
					 <td width="23%" class="col" ><a href="#">List Names</a></td>
					 <td width="0,5%"></td>
					 <td width="27%" class="col" ><span  id="span2" onMouseOver="style.textDecoration='underline';style.cursor='pointer'" onclick="window.mesg.style.visibility='visible';window.mesg.style.height='100px'" onMouseOut="style.textDecoration ='none'"  >Erase Data</span></td>
					  <td width="0,5%"></td>
					 <td width="23%" class="col"><a href="help.php">Help</a></td>
				</tr>
		      </table>
            
        </div>
	    <div id="mesg" >
            <p>Are you sure you want to delete all records?&nbsp;&nbsp;<input type="button" value="Yes" name="yes" onclick="" > <input type="button" value="Cancel" name="yes" onclick="window.mesg.style.visibility='hidden';window.mesg.style.height='0px';" >  </p> 
        </div>
	    <div id="content" >
	        <div id="search" >
	           
                   <input type="text" size="15" placeholder="Name" name="fname"><input type="submit" name="search" value="Search">
               
			</div>
	        <div id="list">
		      <?php   
		        if (isset($r)) 
			    {
  				  foreach ($r as $i) 
				  {
                    echo $i  ;
                  }
			    }	
		      ?>
		    </div>
            <div id="form">
		      <form name="input" action="calc.php" method="POST">
			      Name: <input type="hidden" name="id" size="4" value="<?php echo $idi ?>"  ><input type="text" name="name" value="<?php echo $name ?>"  ><br /><br />						
                  Loan amount: <input type="text" name="loan" value="<?php echo $loan ?>" ><br /><br />	
				  Interest rate: <input type="text" name="rate" size="12" value="<?php echo $rate ?>" ><br /><br />	
				  Months<input type="radio" name="group1" value="Month"  <?php echo $grupm ?>  > 
                  Years<input type="radio" name="group1" value="Year" <?php echo $grupy ?> > <br />	
				  Terms: <input type="text" name="term" size="12" value=<?php echo $term ?>   ><br /><br />
				  <input type="submit" value="Calculation" name="subm" > 
				  <input type="submit" value="Save info  " name="submBD" > 
				  <hr width="200px" align="right" noshade>
				  Monthly  loan payment<input type="text" name="valuel" size="15" style="background:#F8FF8E; border: 0px solid;text-align:center; " value="<?php echo $paymentmontly ?>"  ><br /><br />
              </form> 
            </div>
        </div>
    </div>
  </BODY>
</HTML>
