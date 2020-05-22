<html>
	<head>
        <title>Books Worldwide</title>
        <link rel="stylesheet" href="mainstyle.css">
    </head>
    <body>
        <table class="TopTable">
            <tr>
            <th><h1>Shopping Cart</h1></th>
            <th>
                <?php 
				//Has header to swithch to different things
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

            <th><p><a href="cPage.php">Your Account</a> </p></th>
			<th><p><a href ="mainpage.php">Home Page</a> </p></th>
			
            </tr>
        </table>
		<table class = "YourOrders">
		<tr>
		<th>In the Shopping cart</th>
		</tr>
		</table>
		<table class ="CartItem">
		<?php
		$lat = mysqli_query($conn, "SELECT OrderID, OrderValue FROM Orders ORDER BY OrderID DESC LIMIT 1");
		$ult = mysqli_fetch_array($lat);
		$ordID = $ult[0];
		$curOrder = "SELECT * FROM orders o, order_items i, Customers c, Email e, books b 
		WHERE c.ContactID = e.ContactID AND e.EmailAddress = '$cN' AND o.CustomerID = c.CustomerID
		AND o.OrderID = i.OrderID AND o.OrderID = '$ordID' AND i.ISBN = b.ISBN";
		$query = $result = mysqli_query($conn, $curOrder);
		$count = mysqli_num_rows($query);
		if($count == 0){
			print("Shopping Cart Empty");
		}else {
			echo "<table>";
			$sum = 0;
			echo "<form method = 'post'>";
			while($row = mysqli_fetch_array($query)){
			echo"<tr><td>{$row['Title']}</td><td>{$row['ItemPrice']}</td> <td> <button type='submit' name='delete' value = '{$row['ItemNumber']}'> Delete </button> </td></tr>";
			$sum = $row['OrderValue'];
			
			}
			if(isset ($_POST['delete'])){
			$sName = $_POST['delete'];
			$attempt = "SELECT * FROM order_items, orders 
			WHERE order_items.ItemNumber = '$sName' AND order_items.OrderID = orders.OrderID";
			$query1 = mysqli_query($conn, $attempt)or die("  Could not select item");
			$newNUM = mysqli_num_rows($query1);
			while($once = mysqli_fetch_array($query1)){
				$newTotal = $once['OrderValue']- $once['ItemPrice'];
				$attempt1 = "UPDATE orders SET OrderValue = '$newTotal'";
				$query8 = mysqli_query($conn, $attempt1)or die("  Could not select item");
			}
			$query4 = mysqli_query($conn, "DELETE FROM order_items WHERE order_items.ItemNumber = '$sName'")or die("  Could not update item");
			echo "Item Removed";
			}
			echo "</form>";
			
			
			echo "<tr><td>Your Total= </td><td>$$sum</td></tr>";
			echo"</table>";
		}
		
		?>
		
		
		</table>
		<form method="POST" >
            <div class="input-group">
		        <button type="submit" class="btn" name="order" > Order Now </button>
	        </div>
    </form>
	<?php
	if(isset($_POST['order'])){
		$date = date('Y-m-d');
		
		$query = mysqli_query($conn, "SELECT OrderID, OrderValue FROM Orders ORDER BY OrderID DESC LIMIT 1");
		$result = mysqli_fetch_array($query);
		$oID = $result[0];
		
		$query3 = mysqli_query($conn, "UPDATE Orders SET OrderDate ='$date' WHERE OrderID = '$oID'");
		
		$sql = "SELECT * FROM Customers c, Contact_Details f, Email z WHERE 
	                c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'";

	    $result = mysqli_query($conn, $sql);

		if ($row = mysqli_fetch_assoc($result)) {
            $idC = $row['CustomerID'];
  	     }
		$sql = "INSERT INTO Orders(OrderID, OrderValue, OrderDate, CustomerID) VALUES(NULL, 0.00, NULL, $idC)";
		mysqli_query($conn, $sql);
		echo "Your Items Are on your way!";	
	}
	?>
    </body>
</html>