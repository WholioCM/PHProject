<html>
	<head>
        <title>Welcome!</title>
        <link rel="stylesheet" href="stylinglog.css">
    </head>
    <body>
        <div class="header">
	        <h2>Log In!</h2>
        </div>

    <form method="POST" >

	<div class="input-group">
		<label>Email</label>
		<input type="email" name="emaily" value="">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="passwordy" required>
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn" > Sign in </button>
	</div>

	<p>
		Not a member? <a href="register.php"> Register </a>
	</p>

    </form>
    </body>
</html>

<?php
	include("connectiondb.php");
	session_start();
	
	if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
	}
	$email = isset($_POST['emaily']) ? $_POST['emaily'] : '';
    $passwordtry = isset($_POST['passwordy']) ? $_POST['passwordy'] : '';

	$sql = "SELECT c.CustomerID FROM Customers c, Contact_Details f, Email z WHERE 
	c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$passwordtry' AND z.EmailAddress = '$email'";

	  $result = mysqli_query($conn, $sql);

  	if ($row = mysqli_fetch_assoc($result)) {
		$_SESSION['emailOF'] = $email;
		$_SESSION['passwordOF'] = $passwordtry;
		$idC = $row['CustomerID'];
		
		$sql = "INSERT INTO Orders(OrderID, OrderValue, OrderDate, CustomerID) VALUES(NULL, 0.00, NULL, $idC)";
		mysqli_query($conn, $sql);
		
		header('Location: mainpage.php');
		exit;
  	}else{
    	echo "Your username or password is incorrect!";
	}
	  
?>