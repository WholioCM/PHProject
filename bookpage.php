<html>
	<head>
        <title>Books Worldwide</title>
        <link rel="stylesheet" href="mainstyle.css">
    </head>
    <body>
    <table class="thetable">
            <tr>
            <th><h1>Welcome to Books Worldwide</h1></th>
            <th>
                <?php 
                session_start();	
                include("connectiondb.php");
                $cN = $_SESSION['emailOF'];
                $cNP = $_SESSION['passwordOF'];

                $sql = "SELECT * FROM Customers c, Contact_Details f, Email z WHERE 
	                c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'";

	            $result = mysqli_query($conn, $sql);

  	            if ($row = mysqli_fetch_assoc($result)) {
                    echo "Welcome, {$row['FirstName']}";
  	            }
                ?>
            </th>
            <th><p><a href="mainpage.php">Home Page</a> </p></th>
            <th><p><a href="cPage.php">Your Account</a> </p></th>
            <th><p><a href="shoppingCart.php">Shopping Cart</a> </p></th>
            </tr>
        </table>

    <?php
    include("connectiondb.php");

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    }else{
        echo "<table>";
        echo "<tr>";
            echo "<th> ISBN </th>";
            echo "<th> Title </th>";
            echo "<th> Publication Date </th>";
            echo "<th> User Reviews </th>";
            echo "<th> Price </th>";
            echo "<th> Supplier ID </th>";
        echo "</tr>";

        if(isset($_GET['title']))
        {
        $itemName = $_GET['title'];
        
        $query = mysqli_query($conn, "SELECT * FROM books WHERE Title='$itemName'");
        
        if(mysqli_num_rows($query) != 0)
        {
            
        while($row = mysqli_fetch_array($query))
        {
			$oISBN = $row['ISBN'];
			$oPrice = $row['Price'];
            echo "<tr>";
            echo "<th>";
            echo $row['ISBN'];
            echo "</th>";
            echo "<th>"; 
            echo $row['Title']; 
            echo "</th>";
            echo "<th>"; 
            echo $row['PublicationDate'];
            echo "</th>";
            echo "<th>"; 
            echo $row['UserReviews']; 
            echo "</th>";
            echo "<th>"; 
            echo $row['Price']; 
            echo "</th>";
            echo "<th>"; 
            echo $row['SupplierID']; 
            echo "</th>";
        echo "</tr> </table>";
        }  
        } 
    }
}
    ?>
    <form method="POST" >
            <div class="input-group">
		        <button type="submit" class="btn" name="cart" > Add to Shopping Cart </button>
	        </div>
    </form>
	<?php
	if(isset($_POST['cart'])){
		
		$query = mysqli_query($conn, "SELECT OrderID, OrderValue FROM Orders ORDER BY OrderID DESC LIMIT 1");
		$result = mysqli_fetch_array($query);
		$oID = $result[0];
		$oValue = $result[1];
		
		$total = $oValue + $oPrice;
		
		$query2 = mysqli_query($conn, "INSERT INTO Order_Items(ItemNumber, ItemPrice, ISBN, OrderID) VALUES(NULL, '$oPrice', '$oISBN', '$oID')");
		$query3 = mysqli_query($conn, "UPDATE Orders SET OrderValue ='$total' WHERE OrderID = '$oID'");
		echo "You Item has been Succesfully Added to Cart";
		
	}
	?>
</html>