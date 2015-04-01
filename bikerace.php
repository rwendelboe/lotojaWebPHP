<!DOCTYPE html> 
<!--http://cs2610.cs.usu.edu/~romankuzmin/hw8/bikerace.php -->
<html lang="en">
	<head>
		<meta charset="utf-8">
        <title>LOTOJA</title>	
		<link href="style.css" rel="stylesheet" type="text/css" />		
    </head>
    <body>
			
		<?php 
		define ("MINUTESPERHOUR", 60);
		$racerTime0 = "";
		$racerTime1 = "";
		$racerTime2 = "";
		$racerTime3 = "";
		$racerTime4 = "";
		$CheckpointDis1 = 44;
		$CheckpointDis2 = 87;
		$CheckpointDis3 = 128;
		$CheckpointDis4 = 165;
		$CheckpointDis5 = 207;
		$name = "";
		$nameError = "";
		$errorMsg = ""; 
		$error0 = "";
		$error1 = "";
		$error2 = "";
		$error3 = "";
		$error4 = "";
		$overallTotal = "";
		$speed1 = "";
		$speed2 = "";
		$speed3 = "";
		$speed4 = "";
		$speed5 = "";
		$numError = "";
		$temp = 0;
		$error = false;
		$checkName = false;
		$sizeError = false;


		if(isset($_POST['submit'])){
			if(empty($_POST['name'])){
				$checkName = true;
				$nameError = "Please Enter a Name";
				
			}else{
				if(!ctype_alpha($_POST['name'])){
					$checkName = true;
					$nameError = "Please Letters only for the name";
				}
				else{
					$name = htmlentities($_POST['name']);
				}
			}

			for($i=0; $i<count($_POST['racerTime']); $i++) {
			
				if(ctype_digit($_POST['racerTime'][$i])){

					$qtyName = "racerTime$i";
					$$qtyName = htmlentities($_POST['racerTime'][$i]);

					if(htmlentities($_POST['racerTime'][$i]) <= $temp ){
						$errorMsg = "error$i";
						$$errorMsg = "Please enter a number greater than previous";
						$sizeError = true;
					}
					else{
						$temp = htmlentities($_POST['racerTime'][$i]);
					}

				}
				else{
					$error = true;
					$errorMsg = "error$i";
					$$errorMsg = "Please enter a number.";

					if(is_numeric($_POST['racerTime'][$i]) == false && !empty($_POST['racerTime'][$i])){
						$$errorMsg = "Letters are not allowed for time input";
					}
				}
			}
			
			if(!empty($racerTime0) && !empty($racerTime1) && !empty($racerTime2) && !empty($racerTime3) && !empty($racerTime4) && $error == false && $nameError == false && $sizeError == false ){

				$overallTotal = overallSpeed($racerTime4);
				
				$speed1 = 44 / (($racerTime0 - 0)/MINUTESPERHOUR);
				$speed2 = 43 / (($racerTime1 - $racerTime0)/MINUTESPERHOUR);
				$speed3 = 41 / (($racerTime2 - $racerTime1)/MINUTESPERHOUR);
				$speed4 = 37 / (($racerTime3 - $racerTime2)/MINUTESPERHOUR);
				$speed5 = 42 / (($racerTime4 - $racerTime3)/MINUTESPERHOUR);
			}
		}
		if(isset($_POST['clear'])){
			
			$name = "";
			$error = false;
			$sizeError = false;
			$checkName = false;
			for($i=0; $i<count($_POST['racerTime']); $i++) {
			
				if(ctype_digit($_POST['racerTime'][$i])){
					$qtyName = "racerTime$i";
					$$qtyName = "";
				}
			}
	
				$speed1 = 0;
				$speed2 = 0;
				$speed3 = 0;
				$speed4 = 0;
				$speed5 = 0;
			
		}
		?>
		
		<h1>Welcome to LOTOJA Race!!!</h1>		
		<form action="bikerace.php" method="post">
			<fieldset><legend>Data Input </legend>

				<div><label for="name">Enter Your Name:</label><input type="text" id="name" value="<?php echo $name ?>" name="name" /><span><?php echo $nameError ?></span></div>

				<p>Checkpoint #1 - 44 miles</p>
				<div class = "timeInterval"><label for="racerTime1">Enter your time in minutes: </label><input type="text" id="racerTime1" name="racerTime[]" value="<?php echo $racerTime0 ?>" /><span><?php echo $error0 ?></span></div>

				<p>Checkpoint #2 - 87 miles</p>
				<div class = "timeInterval"><label for="racerTime2">Enter your time in minutes: </label><input type="text" id="racerTime2" name="racerTime[]" value="<?php echo $racerTime1 ?>" /><span><?php echo $error1?></span></div>

				<p>Checkpoint #3 - 128 miles</p>
				<div class = "timeInterval"><label for="racerTime3">Enter your time in minutes: </label><input type="text" id="racerTime3" name="racerTime[]" value="<?php echo $racerTime2 ?>" /><span><?php echo $error2 ?></span></div>

				<p>Checkpoint #4 - 165 miles</p>
				<div class = "timeInterval"><label for="racerTime4">Enter your time in minutes: </label><input type="text" id="racerTime4" name="racerTime[]" value="<?php echo $racerTime3 ?>" /><span><?php echo $error3 ?></span></div>

				<p>Checkpoint #5 - 207 miles</p>
				<div class = "timeInterval"><label for="racerTime5">Enter your time in minutes: </label><input type="text" id="racerTime5" name="racerTime[]" value="<?php echo $racerTime4 ?>" /><span><?php echo $error4 ?></span></div>
				
				<div><input type="submit" value="Submit" name="submit" /></div>
				<div class = "clear"><input type="submit" value="Clear" name="clear" /></div>
			</fieldset>


			
			<fieldset class = "output"><legend>Data Output</legend>
				<h2><?php printf( "Your over all speed is: %.2f mph" , $overallTotal) ?></h2>
				
				<table >

					<tr>
   						<th> <?php if ($error == false && $checkName == false && $sizeError == false) echo $name ?>'s Checkpoints</th>
    					<th>Interval Distance</th>		
    					<th>Interval Time</th>
    					<th>Interval Speed</th>
  					</tr>
					
  					<tr>
    					<td>Checkpoint #1</td>
    					<td>44</td>		
   						<td><?php if ($error == false && $checkName == false && $sizeError == false) echo $racerTime0 - 0 ?></td>
   						<td><?php printf( " %.2f mph" , $speed1) ?></td>
  					</tr>
  					<tr>
   						<td>Checkpoint #2</td>
    					<td>43</td>		
    					<td><?php if ($error == false && $checkName == false && $sizeError == false) echo $racerTime1 - $racerTime0 ?></td>
    					<td><?php printf( " %.2f mph" , $speed2) ?></td>
  					</tr>
  					<tr>
   						<td>Checkpoint #3</td>
    					<td>41</td>		
    					<td><?php if ($error == false && $checkName == false && $sizeError == false) echo $racerTime2 - $racerTime1 ?></td>
    					<td><?php printf( " %.2f mph" , $speed3) ?></td>
  					</tr>
  					<tr>
   						<td>Checkpoint #4</td>
    					<td>37</td>		
    					<td><?php if ($error == false && $checkName == false && $sizeError == false) echo $racerTime3 - $racerTime2 ?></td>
    					<td><?php printf( " %.2f mph" , $speed4) ?></td>
  					</tr>
  					<tr>
   						<td>Checkpoint #5</td>
    					<td>42</td>		
    					<td><?php if ($error == false && $checkName == false && $sizeError == false) echo $racerTime4 - $racerTime3 ?></td>
    					<td><?php printf( " %.2f mph" , $speed5) ?></td>
  					</tr>
				</table>

			</fieldset>
			
        </form>

		<?php		
		function convertToCelsius($fahrenheit){
			return ($fahrenheit-32)/1.8;
		}
		function overallSpeed($racerTime4){
			
			return 207 / ($racerTime4 / MINUTESPERHOUR) ;

		}

		?>

    </body>
</html>  