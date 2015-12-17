<?php
        $arreglo = $_SESSION['basket'];
	    $name = "Raleigh Theatre";
        $date = date("d-m-Y");
        $time = date("H:i:s");      
        $topic = 'Summary of your purchase';
        $from = "www.RaleighTheatre.com";
        $email = $_SESSION['email'];
        $reference =  $_SESSION['reference'];
 
       $comment = '
			<div style="font-family: "Helvetica";">
			<center>
			<img src="http://s30.postimg.org/ml03269ox/logo.png" width="700px">
			<h1><em>Raleigh Theatre</em></h1></center><br>
			<h1><em>Thanks for your purchase</em></h1></center>
			<hr width="90%">
			<p></p> ';

	for($i=0; $i<count($arreglo);$i++){
		$image = $arreglo[$i]['Productionimage'];
		$comment .= "
		<div><img src = '".$image."' width='140px'></div> 
		<div>Production name: ".$arreglo[$i]['Productionname']."</div>  
		<div>Performance date: ".$arreglo[$i]['Performancedate']."</div>
		<div>18:00pm</div>
		<div>Seat: ".$arreglo[$i]['Performanceseat']."</div>
		<div>Price: ".$arreglo[$i]['Productionprice']."</div>
		<div>Ticked ID: ".$reference."</div><br><br><br>";
	} 
       
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf8\r\n"; 

       
        $headers .= "From: RaleighTheatre@kingston.ac.uk\r\n"; 
        
		try{
			mail($email,$topic,$comment,$headers);
		}catch(Exception $e){}
?>