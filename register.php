<html>
	<head>
        <title>Welcome!</title>
        <link rel="stylesheet" href="stylinglog.css">
    </head>
    <body>
        <div class="header">
	        <h2>Register</h2>
        </div>
    
        <form action="" method="POST">
            <table>
                <tr>
                    <td>First Name</td>
                    <td><input type ="text" name ="firstname" required></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type ="text" name ="lastname" required></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type ="text" name ="address" required></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><input type ="text" name ="phone" required></td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td><input type ="text" name ="email" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type ="text" name ="password" required></td>
                </tr>
                <tr>
                    <td>Admin?</td>
                    <td><input type ="checkbox" name ="ifadmin" value ="true"> Check this box if you are an Admin.</td>
                </tr>
                <tr>
                <td><input type="submit" value="Submit"></td>
                </tr>
            </table>
            <p>
                Already a member? <a href="login.php"> Sign in </a>
            </p>

        </form>
    </body>
    <?php
session_start();

if(isset($_POST['firstname'])){
    $fname = $_POST['firstname'];
}
if(isset($_POST['lastname'])){
    $lname = $_POST['lastname'];
}
if(isset($_POST['address'])){
    $caddress = $_POST['address'];
}
if(isset($_POST['phone'])){
    $phone = $_POST['phone'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
if(isset($_POST['password'])){
    $password = $_POST['password'];
}
if(isset($_POST['ifadmin'])){
    $admin = 1;
}else{
    $admin = 0;
}

if (!empty($fname) || !empty($lname) || !empty($caddress) || !empty($phone) || !empty($email) || !empty($password) || !empty($admin)){
    $_SESSION['emailOF'] = $email;
    $_SESSION['passwordOF'] = $password;
    
    include("connectiondb.php");

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    }

    $sql = "INSERT INTO Contact_Details(ContactID) VALUES(NULL);";
    mysqli_query($conn, $sql);

    $SELECT = "SELECT ContactID FROM Contact_Details ORDER BY ContactID DESC LIMIT 1";
    $query = mysqli_query($conn, $SELECT);
    $result = mysqli_fetch_array($query);
    $ContactID = $result[0];

    $null = NULL;
    $INSERT = "INSERT INTO Customers(CustomerID, FirstName, LastName, ContactID, CPassword, IfAdmin) VALUES(?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("bssisi", $null, $fname, $lname, $ContactID, $password, $admin);
    $stmt->execute();

    $INSERT = "INSERT INTO Email(EmailAddress, ContactID) VALUES(?, ?)";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("si", $email, $ContactID);
    $stmt->execute();

    $INSERT = "INSERT INTO CAddress(PhysicalAddress, ContactID) VALUES(?, ?)";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("si", $caddress, $ContactID);
    $stmt->execute();

    $INSERT = "INSERT INTO Phone(PhoneNumber, ContactID) VALUES(?, ?)";
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("ii", $phone, $ContactID);
    $stmt->execute();


	$sql = "SELECT c.CustomerID FROM Customers c, Contact_Details f, Email z WHERE 
	c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$password' AND z.EmailAddress = '$email'";

	  $result = mysqli_query($conn, $sql);

  	if ($row = mysqli_fetch_assoc($result)) {
		$_SESSION['emailOF'] = $email;
		$_SESSION['passwordOF'] = $password;
		$idC = $row['CustomerID'];
		
		$sql = "INSERT INTO Orders(OrderID, OrderValue, OrderDate, CustomerID) VALUES(NULL, 0.00, NULL, $idC)";
		mysqli_query($conn, $sql);
		
		header('Location: mainpage.php');
		exit;
  	}

    header("location: mainpage.php");
}
?>
</html>

