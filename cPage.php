<html>
	<head>
        <title> Your Account </title>
        <link rel="stylesheet" href="mainstyle.css">
    </head>
    <body>
        <?php
            include("connectiondb.php");
            session_start();

            $cN = $_SESSION['emailOF'];
            $cNP = $_SESSION['passwordOF'];

            $sql = "SELECT * FROM Customers c, Contact_Details f, Email z WHERE 
	            c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'";

	        $result = mysqli_query($conn, $sql);

  	        if ($row = mysqli_fetch_assoc($result)) {
                echo "<h1 class = 'CPerson'> Welcome, {$row['FirstName']} {$row['LastName']} </h1>";
            }

            $sql2 = "SELECT a.PhysicalAddress FROM Customers c, Contact_Details f, Email z, caddress a WHERE 
            c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'
            AND f.ContactID = a.ContactID";
            $sql3 = "SELECT s.PhoneNumber FROM Customers c, Contact_Details f, Email z, phone s WHERE 
            c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'
            AND f.ContactID = s.ContactID";
            $sql4 = "SELECT q.EmailAddress FROM Customers c, Contact_Details f, Email z, email q WHERE 
            c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'
            AND f.ContactID = q.ContactID";
            $CusID = "SELECT c.ContactID FROM Customers c, Contact_Details f, Email z WHERE 
            c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'";

            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            $result4 = mysqli_query($conn, $sql4);
            $mainResult = mysqli_query($conn, $CusID);

            
            if ($row2 = mysqli_fetch_assoc($result2)) {
                $_SESSION['AddressOF'] = $row2['PhysicalAddress'];
                $addy = $row2['PhysicalAddress'];
                echo "<form method='POST'>";
                echo "Update Address: <input type = 'text' name = 'newAddress' size = '50' value = '{$row2['PhysicalAddress']}'>";
            }
            echo "<br>";
            if ($row3 = mysqli_fetch_assoc($result3)) {
                $_SESSION['NumberOF'] = $row3['PhoneNumber'];
                $phony = $row3['PhoneNumber'];
                echo "Update Phone Number: <input type = 'text' name = 'newNumber' size = '50' value = '{$row3['PhoneNumber']}'>";
            }
            echo "<br>";
            if ($row4 = mysqli_fetch_assoc($result4)) {
                $_SESSION['EmailOF'] = $row4['EmailAddress'];
                $emal = $row4['EmailAddress'];
                echo "Update Email: <input type = 'text' name = 'newEmail' size = '50' value = '{$row4['EmailAddress']}'>";
                echo "<button type='submit' class='btn' name='updateButton'> Update </button>";
                echo "</form>";
            }
            

        $NewAddress = isset($_POST['newAddress']) ? $_POST['newAddress'] : $addy;
        $NewNumber = isset($_POST['newNumber']) ? $_POST['newNumber'] : $phony;
        $NewEmail = isset($_POST['newEmail']) ? $_POST['newEmail'] : $emal;

        if ($rowID = mysqli_fetch_assoc($mainResult)){
        $sqlUpdate1 = "UPDATE caddress SET PhysicalAddress = '".$NewAddress."' WHERE ContactID = '{$rowID['ContactID']}'";
        $sqlUpdate2 = "UPDATE phone SET PhoneNumber = '".$NewNumber."' WHERE ContactID = '{$rowID['ContactID']}'";
        $sqlUpdate3 = "UPDATE email SET EmailAddress = '".$NewEmail."' WHERE ContactID = '{$rowID['ContactID']}'";
            if(mysqli_query($conn, $sqlUpdate1)){
                echo "Address has been succesfully updated!";
            }
            if(mysqli_query($conn, $sqlUpdate2)){
                echo "Phone haas been succesfully updated!";
            }
            if(mysqli_query($conn, $sqlUpdate3)){
            echo "Email haas been succesfully updated!";
            }
        }


            if(mysqli_connect_error()){
                die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
            }
        
            $sqlgetOrder = "SELECT * FROM Customers c, Contact_Details f, Email z, Orders r WHERE 
            c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'
            AND c.CustomerID = r.CustomerID";
            $sqldata = mysqli_query($conn, $sqlgetOrder) or die('Error');
            
            echo "<h2> Your Orders </h2> ";
            echo "<table class = 'ordertable'>";
        
            while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
        
                echo "<tr><th>{$row['OrderID']}</th><th>{$row['OrderValue']}</th><th>{$row['OrderDate']}</th></tr>";
            }
        ?>
        <p><a href="mainpage.php">Home Page</a> </p>  
    </body>
</html>