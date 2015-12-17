<?php
session_start();
include("./includes/header.html");

if (!empty($_POST)) {
	$firstnameError = null;
    $lastnameError = null;
    $streetError = null;
    $townError = null;
    $postcodeError = null;
    $phonenumberError = null;
    $emailError = null;
         
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $street = $_POST['street'];
    $town = $_POST['town'];
    $postcode = $_POST['postcode'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
         
    $valid = true;

    if (empty($firstname)) {
        $firstnameError = 'Please enter First Name';
        $valid = false;
    }

    if (empty($lastname)) {
        $lastnameError = 'Please enter Last Name';
        $valid = false;
    }

    if (empty($street)) {
        $streetError = 'Please enter street';
        $valid = false;
    }
        
	if (empty($town)) {
        $townError = 'Please enter town';
        $valid = false;
    }

	if (strlen($postcode) < 6) {
		$postcodeError = "Input is too short, minimum is 6 characters.";
		$valid = false;
	}

	else if(strlen($postcode) > 7) {
		$postcodeError = "Input is too long, maximum is 8 characters.";
		$valid = false;
	}

	if (strlen($phonenumber) < 11) {
		$phonenumberError = "Input is too short, minimum is 11 characters.";
		$valid = false;
	}
	
	elseif(strlen($phonenumber) > 11) {
		$phonenumberError = "Input is too long, maximum is 11 characters.";
		$valid = false;
	}
	
    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    }
	
	else if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }
         
    if ($valid) {
		
		$_SESSION['customer'] = array('Firstname' => $firstname,
			'Lastname' => $lastname,
			'Street' => $street,
			'Town' => $town,
			'Postcode' => $postcode,
			'Phonenumber' => $phonenumber,
			'Email' => $email);

			$arrayy = $_SESSION['customer'];

			header("Location: ./booking.php");
    }
}

?>

<!-- Customer form -->

	<div class="col-lg-7" style="padding-left:50px">	<h1 style="color:#d9534f">Customer form</h1>
	<form class="form-horizontal" action="customer.php" method="post">
		<div class="control-group <?php echo !empty($firstnameError)?'error':'';?>">
			<label class="control-label">First Name</label>
			<div class="controls">
				<input name="firstname" type="text"  placeholder="First Name" value="<?php echo !empty($firstname)?$firstname:'';?>">
                <?php if (!empty($firstnameError)): ?>    <span class="help-inline"><?php echo $firstnameError;?></span>    <?php endif; ?>
            </div>
        </div>
                     
		<div class="control-group <?php echo !empty($lastnameError)?'error':'';?>">
            <label class="control-label">Last Name</label>
            <div class="controls">
				<input name="lastname" type="text"  placeholder="Last Name" value="<?php echo !empty($lastname)?$lastname:'';?>">
				<?php if (!empty($lastnameError)): ?>    <span class="help-inline"><?php echo $lastnameError;?></span>     <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php echo !empty($streetError)?'error':'';?>">
            <label class="control-label">Street</label>
             <div class="controls">
				<input name="street" type="text"  placeholder="Street" value="<?php echo !empty($street)?$street:'';?>">
                 <?php if (!empty($streetError)): ?>     <span class="help-inline"><?php echo $streetError;?></span>     <?php endif; ?>
             </div>
        </div>

          <div class="control-group <?php echo !empty($townError)?'error':'';?>">
                <label class="control-label">Town</label>
                <div class="controls">
					<input name="town" type="text"  placeholder="Town" value="<?php echo !empty($town)?$town:'';?>">
                    <?php if (!empty($townError)): ?>      <span class="help-inline"><?php echo $townError;?></span>     <?php endif; ?>
                </div>
          </div>

           <div class="control-group <?php echo !empty($postcodeError)?'error':'';?>">
               <label class="control-label">Post Code</label>
                <div class="controls">
                    <input name="postcode" type="text"  placeholder="Post Code" value="<?php echo !empty($postcode)?$postcode:'';?>">
                    <?php if (!empty($postcodeError)): ?>       <span class="help-inline"><?php echo $postcodeError;?></span>      <?php endif; ?>
                </div>
             </div>

             <div class="control-group <?php echo !empty($phonenumberError)?'error':'';?>">
                 <label class="control-label">Phone Number</label>
                  <div class="controls">
                        <input name="phonenumber" type="text"  placeholder="Phone Number" value="<?php echo !empty($phonenumber)?$phonenumber:'';?>">
                        <?php if (!empty($phonenumberError)): ?>     <span class="help-inline"><?php echo $phonenumberError;?></span>     <?php endif;?>
                   </div>
             </div>

             <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                 <label class="control-label">Email Address</label>
                 <div class="controls">
                    <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                    <?php if (!empty($emailError)): ?>      <span class="help-inline"><?php echo $emailError;?></span>      <?php endif;?>
                 </div>
            </div><br>
                      
            <div class="form-actions">
                <button type="submit" class="btn btn-danger"  style="font-size:18px">BOOK TICKETS</button>
            </div>
     </form>
</div>

<div class="col-lg-5">
	<h1 style="color:#d9534f">Tickets to purchase</h1><br>
<?php
if(isset($_SESSION['basket'])) {
			
	$data = $_SESSION ['basket'];
	$total = 0;
	
	for ($i=0; $i<count($data); $i++){
		?>
		<div class="col-lg-6">
			<center><img src = "<?php echo $data[$i]['Productionimage'];?>" width="120px"> <br>
			<span style="font-size:23px; font-weight:400; color:black"><?php echo $data[$i]['Productionname'];?></span><br>
			<span style="font-size:20px; font-weight:400; color:black;font-style:italic"><?php echo date("l jS \of F Y", strtotime($data[$i]['Performancedate']));?></span><br>
			<span style="font-size:20px; font-weight:400; color: black">18:00pm</span><br>
			<span style="font-size:20px; font-weight:400; color: black">Seat: <?php echo $data[$i]['Performanceseat'] ?></span><br>
			<span style="font-size:20px; font-weight:600; color:#D11111">£<?php echo $data[$i]['Productionprice'];?></span><br><br></center><br>
			
		</div>
		<?php
		$total += $data[$i]['Productionprice'];
		}
}
?>
</div>
                 
</div>
</body>
</html>