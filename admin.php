<html>
	<head>
	
		<title>Admin Page</title>
        <link rel="stylesheet" href="mainstyle.css">
		</head>
    <body>
        <h1> Find Information </h1>
		<form action = "admin.php" method = "post">
		 
		<table class = "FindCustomer">
		<tr>
		<h2>Find Customer</h2>
		 <td>First Name: <input type = "text" name = "FirstName" value = ""></td>
		 <td>Last Name: <input type = "text" name = "LastName" value = ""></td>
		 <td>Customer ID: <input type = "number" name = "CustomerID" value = ""></td>
		 <td><input type= "submit" name = "Customer" value = "Find Customer"/></td>
		 </tr>
		 </table><br>
		 <?php
	include("connectiondb.php");
	//Customer Search
	if (isset($_POST['Customer'])){
		
		$searchfname = $_POST['FirstName'];
		$searchlname = $_POST['LastName'];
		$searchCID = $_POST['CustomerID'];
		$searchfname = preg_replace("#[^0-9 a-z]#i", "", $searchfname);
		$searchlname = preg_replace("#[^0-9 a-z]#i", "", $searchlname);
		$sql = "SELECT * FROM customers WHERE FirstName LIKE '%$searchfname%' AND LastName LIKE '%$searchlname%' AND CustomerID LIKE'%$searchCID%'";
		$query = mysqli_query($conn, $sql) or die("Could not search");
		$count = mysqli_num_rows($query);
		if($count == 0){
			print("There was no search results");
		}else {
			echo "<table border =1>";
			echo"<tr><td>First Name</td> <td>Last Name</td><td>Customer ID</td>
			<td>Contact ID</td></tr>";
			while($row = mysqli_fetch_array($query)){
			echo"<tr><td>{$row['FirstName']}</td><td>{$row['LastName']}</td>
			<td>{$row['CustomerID']}</td><td>{$row['ContactID']}</td></tr>";
			}
			echo"</table>";
		}
	}	 
	?>
		 
		 <table class = "FindOrder">
		 <h2>Find Order</h2>
		 <th><p><a>Order ID: <input type = "text" name = "OrderID"></a> </p></th>
		 <th><p><a>Order Value: <input type = "text" name= "OrderPrice"></a> </p></th>
		 <th><p><a>Order Date: <input type = "text" name = "OrderDate"></a> </p></th>
		 <th><p><a>Customer: <input type = "text" name = "Placed"></a> </p></th>
		 <th><p><a><input type = "submit" name = "Order" value = "Find Order"></a> </p></th>
		 </table>
		 <?php
		 //Order Search
	if (isset($_POST['Order'])){
		
		$searchOID = $_POST['OrderID'];
		$searchOPrice = $_POST['OrderPrice'];
		$searchODate = $_POST['OrderDate'];
		$searchPl = $_POST['Placed'];
		$searchOID = preg_replace("#[^0-9 a-z]#i", "",$searchOID);
		$searchOPrice = preg_replace("#[^0-9 a-z]#i", "", $searchOPrice);
		$searchODate = preg_replace("#[^0-9 a-z]#i", "", $searchODate);
		$searchPl = preg_replace("#[^0-9 a-z]#i", "", $searchPl);
		$sql = "SELECT * FROM orders
		WHERE OrderID LIKE '%$searchOID%' AND OrderValue LIKE '%$searchOPrice%' 
		AND OrderDate LIKE '%$searchODate%' AND CustomerID LIKE'%$searchPl%' ";
		
		$query = mysqli_query($conn, $sql) or die("Could not search Orders");
		$count = mysqli_num_rows($query);
		
		if($count == 0){ 
			print("There were no search results");
		}else {
			echo "<table border =1>";
			echo"<tr><td>Order ID</td> <td>Date Placed</td><td>Price</td><td>Customer ID</td></tr>";
			while($row = mysqli_fetch_array($query)){				
				echo"<tr><td>{$row['OrderID']}</td> <td>{$row['OrderDate']}</td><td>{$row['OrderValue']}</td><td>{$row['CustomerID']}</td></tr>";
			}
			echo"</table>";
		}
	}
		 ?>
		 
		<table class = "FindAuthor">
		<h2>Find Author</h2>
		<th><p><a>Author ID: <input type ="text" name = "AuthorID"></a> </p></th></br>
		<th><p><a>Date Of Birth: <input type = "text" name = "DOB"></a> </p></th>
		<th><p><a>Gender: <input type = "text" name = "Gender"></a> </p></th>
		<th><p><a>First Name: <input type = "text" name = "FName"></a> </p></th>
		<th><p><a>Last Name: <input type = "text" name ="LName"></a> </p></th>
		<th><p><a>ContactID: <input type = "text" name = "ContactID"></a> </p></th>
		<th><p><a><input type = "submit" name = "Author" value = "Find Author"></a> </p></th>
		</table>
		<?php
		//Author Search
	if (isset($_POST['Author'])){
		
		$searchAID = $_POST['AuthorID'];
		$searchDOB = $_POST['DOB'];
		$searchG = $_POST['Gender'];
		$searchFName = $_POST['FName'];
		$searchLName = $_POST['LName'];
		$searchCID = $_POST['ContactID'];
		$searchAID = preg_replace("#[^0-9 a-z]#i", "",$searchAID);
		$searchDOB = preg_replace("#[^0-9 a-z]#i", "",$searchDOB);
		$searchG = preg_replace("#[^0-9 a-z]#i", "",$searchG);
		$searchFName = preg_replace("#[^0-9 a-z]#i", "",$searchFName);
		$searchLName = preg_replace("#[^0-9 a-z]#i", "",$searchLName);
		$searchCID = preg_replace("#[^0-9 a-z]#i", "",$searchCID);
		$sql = "SELECT * FROM author WHERE 
		AuthorID LIKE '%$searchAID%' AND DateOfBirth LIKE '%$searchDOB%' 
		AND Gender LIKE '%$searchG%' AND FirstName LIKE '%$searchFName%' 
		AND LastName LIKE '%$searchLName%' AND ContactID LIKE '%$searchCID%'";
		
		$query = mysqli_query($conn, $sql) or die("Could not search Authors");
		$count = mysqli_num_rows($query);
		
		if($count == 0){ 
			print("There were no search results");
		}else {
			echo "<table border =1>";
			echo"<tr><td>Author ID</td><td>First Name</td><td>Last Name</td><td>Date of Birth</td><td>Gender</td><td>Contact ID</td></tr>";
			while ($row = mysqli_fetch_array($query)){				
				echo"<tr><td>{$row['AuthorID']}</td><td>{$row['FirstName']}</td><td>{$row['LastName']}</td>
				<td>{$row['DateOfBirth']}</td><td>{$row['Gender']}</td><td>{$row['ContactID']}</td></tr>";
			}
			echo"</table>";
		}
	}
		?>
		<table class = "FindDet">
		<h2>Find Contact Details</h2>
		<th><p><a>Contact ID: <input type = "text" name = "FCID" value = "" ></a></p></th>
		<th><p><a> Email:<input type = "text" name = "DEmail" value = ""></a></p></th>
		<th><p><a>Phone:<input type = "number" name = "DPhone" value = ""></a></p></th>
		<th><p><a>Address:<input type = "text" name = "DAddress" value = ""></a></p></th>
		<th><p><a><input type = "submit" name = "Details" value = "Find Details" ></a></p></th>
		</table>
		<?php
		//Search Contact Details
	if (isset($_POST['Details'])){
		$CID = $_POST['FCID'];
		$CID = preg_replace("#[^0-9]#i", "", $CID);
		$Phone = $_POST['DPhone'];
		$Address = $_POST['DAddress'];
		$Address = preg_replace("#[^0-9 a-z]#i", "", $Address);
		$Email = $_POST['DEmail'];
		$sql = "SELECT DISTINCT * FROM contact_details, phone, email, caddress 
		WHERE contact_details.ContactID LIKE '%$CID%' 
		AND phone.ContactID LIKE contact_details.ContactID AND caddress.ContactID LIKE contact_details.ContactID 
		AND email.ContactID LIKE contact_details.ContactID AND caddress.PhysicalAddress LIKE '%$Address%'
		AND email.EmailAddress LIKE '%$Email%' AND phone.PhoneNumber LIKE '%$Phone%'
		ORDER BY contact_details.ContactID";
		
		$query = mysqli_query($conn, $sql) or die("Could not search Details");
		$count = mysqli_num_rows($query);
		
		if($count == 0){ 
			print("There were no search results");
		}else {
			echo "<table border =1>";
			echo"<tr><td>ContactID</td><td>Phone</td><td>Email</td><td>Address</td></tr>";
			while ($row = mysqli_fetch_array($query)){
				echo"<tr><td>{$row['ContactID']}</td><td>{$row['PhoneNumber']}</td><td>{$row['EmailAddress']}</td><td>{$row['PhysicalAddress']}</td></tr>";
			}
		}
	}
		?>
		
		<table class = "FindSupplier">
		<h2>Find Supplier</h2>
		<th><p><a>Supplier ID: <input type = "text" name= "SupplierID"></a></p></a>
		<th><p><a>Organization: <input type = "text" name = "Org"></a></p></a>
		<th><p><a>Supplier Name: <input type = "text" name = "SName"></a></p></a>
		<th><p><a><input type = "submit" name = "Supplier" value = "Find Supplier"></th></p></a>
		</table>
		<?php
		//Search Supplier
	if (isset($_POST['Supplier'])){
		
		$SID = $_POST['SupplierID'];
		$Org = $_POST['Org'];
		$Name = $_POST['SName'];
		$SID =  preg_replace("#[^0-9 a-z]#i", "",$SID);
		$Org =  preg_replace("#[^0-9a-z ]#i", "",$Org);
		$Name = preg_replace("#[^0-9a-z ]#i", "",$Name);
		$sql = "SELECT * FROM supplier WHERE SupplierID LIKE '%$SID%' AND Organization LIKE '%$Org%' AND Sname LIKE '%$Name%'";
		$query = mysqli_query($conn, $sql) or die("Could not search Supplier");
		$count = mysqli_num_rows($query);
		
		if($count == 0){ 
			print("There were no search results");
		}else {
			echo "<table border =1>";
			echo"<tr><td>Supplier ID</td><td>Organization</td><td>Supplier Name</td></tr>";		
			while ($row = mysqli_fetch_array($query)){
				echo"<tr><td>{$row['SupplierID']}</td><td>{$row['Organization']}</td><td>{$row['Sname']}</td></tr>";
			}
			echo"</table>";
		}
	}
		?>	
		<table class = "FindBook">
		<h2>Find Book</h2>
		<th><p><a>ISBN: <input type = "text" name = "ISBN"></th></p></a>
		<th><p><a>Title<input type = "text" name = "BTITLE"></th></p></a>
		<th><p><a>Publication Date<input type = "text" name ="BPDATE"></th></p></a>
		<th><p><a> User Reviews: <input type = "text" name ="BUser"></th></p></a>
		<th><p><a>Price: <input type = "text" name = "BPrice"></th></p></a>
		<th><p><a>Supplier ID: <input type = "text" name = "BSID"></th></p></a>
		<th><p><a><input type = "submit" name = "Book" value = "Find Book"></a> </p></th>
		</table>
<?php
	//Find Book
	if (isset($_POST['Book'])){
		$BISBN = $_POST['ISBN'];
		$BTitle = $_POST['BTITLE'];
		$BDate = $_POST['BPDATE'];
		$BUser =  $_POST['BUser'];
		$BPrice =  $_POST['BPrice'];
		$BSID =  $_POST['BSID'];
		$BISBN = preg_replace("#[^0-9 a-z]#i", "",$BISBN);
		$BTitle =  preg_replace("#[^0-9 a-z]#i", "",$BTitle);
		$BDate =  preg_replace("#[^0-9 a-z]#i", "",$BDate);
		$BUser =  preg_replace("#[^0-9 a-z]#i", "",$BUser);
		$BPrice =  preg_replace("#[^0-9 a-z]#i", "",$BPrice);
		$BSID =  preg_replace("#[^0-9 a-z]#i", "",$BSID);
		$sql = "SELECT * FROM books WHERE ISBN LIKE '%$BISBN%' AND Title LIKE '%$BTitle%' AND PublicationDate LIKE '%$BDate%' AND UserReviews LIKE '%$BUser%'AND Price LIKE '%$BPrice%' AND SupplierID LIKE '%$BSID%'";
		
		$query = mysqli_query($conn, $sql) or die("Could not search Books");
		$count = mysqli_num_rows($query);
		
		if($count == 0){ 
			print("There were no search results");
		}else {
			echo "<table border =1>";
			echo"<tr><td>ISBN</td><td>Title</td><td>Publication Date</td><td>Price</td><td>Supplier ID</td><td>Reviews</td></tr>";	
			while ($row = mysqli_fetch_array($query)){
			echo"<tr><td>{$row['ISBN']}</td><td>{$row['Title']}</td><td>{$row['PublicationDate']}</td><td>{$row['Price']}</td><td>{$row['SupplierID']}</td><td>{$row['UserReviews']}</td></tr>";		
			}
			echo"</table>";
		}
	}
	
?>
	<div class = "mainintro">

		<h1> Update Information </h1></br>
	</div>
		
		<table class = "UpdateCustomer">
		<h2>Update Customer</h2>
		 <th><p><a>First Name: <input type = "text" name = "UFName" value = ""></a> </p></th>
		 <th><p><a>Last Name: <input type = "text" name = "ULName" value = ""></a> </p></th>
		 <th><p><a>Customer ID: <input type = "number" name = "UCID" value = ""></a> </p></th>
		 <th><p><a>Password: <input type = "password" name = "UCP" value = ""></a> </p></th>
		 <th><p><a>Admin: <input type = "radio" name = "UAdmin" value = "1">Yes <input type = "radio" name = "UAdmin" value = "0" checked>No</a></p></th>
		 <th><p><a><input type= "submit" name = "UCustom" value = "Update Customer"/></a></p></th></br>
		 <?php
		 if(isset($_POST['UCustom'])){
		$FName = $_POST['UFName'];
		$FName =  preg_replace("#[^a-z-]#i","",$FName);
		$LName = $_POST['ULName'];
		$LName =  preg_replace("#[^a-z-]#i","",$LName);
		$CID = $_POST['UCID'];
		$UConP = $_POST['UCP'];
		$UConP = preg_replace("#[^0-9a-z]#i","",$UConP);
		$Admin = $_POST['UAdmin'];
		if($FName == ""||$LName == ""|| $CID == ""||$UConP == ""){
			echo "Please fill all fields";
		}else{
			$sql = "UPDATE customers SET FirstName = '$FName', LastName = '$LName',
			CPassword = '$UConP', IfAdmin = $Admin WHERE CustomerID = '$CID'";
			$query = mysqli_query($conn, $sql) or die("Could not update Customer");
			echo "Customer Updated";
		}
		
	}
		 ?>
		 
		 </table> 
		 <table class ="UpdateAuthor">
		 <h2>Update Author</h2>
		 <th><p><a>Author ID: <input type = "number" name = "UAID" value = ""></a></p></th>
		 <th><p><a>First Name: <input type = "text" name = "UAFName" value = ""></a></p></th>
		 <th><p><a>Last Name: <input type = "text" name = "UALName" value = ""></a></p></th>
		 <th><p><a>Gender: <input type = "text" name = "UAGender" value = ""></a></p></th>
		 <th><p><a>Date of Birth:<input type = "date" name = "UADOB" value = ""></a></p></th>
		 <th><p><a><input type = "submit" name = "UAuthor" value = "Update Author"></a></p></th>
		 </table>
		 <?php
		 //Update Author
	if (isset($_POST['UAuthor'])){
		$AID = $_POST['UAID'];
		$FName = $_POST['UAFName'];
		$FName =  preg_replace("#[^a-z-]#i","",$FName);
		$LName = $_POST['UALName'];
		$LName =  preg_replace("#[^a-z-]#i","",$LName);
		$Gender = $_POST['UAGender'];
		$DOB = $_POST['UADOB'];
		if($AID == ""|| $FName == ""||$LName == "" || $Gender == "" || $DOB == ""){
			print("please fill all fields");
		}else{
			$sql = "UPDATE author SET FirstName = '$FName', LastName = '$LName',
			DateOfBirth = '$DOB', Gender = '$Gender' WHERE AuthorID = $AID";
			$query = mysqli_query($conn, $sql) or die("Could not update Author");
			print("Data Updated.");
			
		}
	}
		 ?>
		 <table class = "UpdateDetail">
		 <h2>Update Contact Details</h2>
		 <th><p><a>Contact ID: <input type = "number" name = "UDCID" value = ""></a></p></th>
		 <th><p><a>Phone: <input type = "number" name = "UDPhone" value = ""></a></p></th>
		 <th><p><a>Email: <input type = "email" name = "UEmail" value = ""></a></p></th>
		 <th><p><a>Address: <input type = "text" name = "UAddress" value = ""></a></p></th>
		 <th><p><a><input type = "submit" name = "UDetails" value = "Update Details"></a></p></th>
		 </table>
		 <?php
		 //Update Customer Details
	if (isset($_POST['UDetails'])){
		$CID = $_POST['UDCID'];
		$Phone = $_POST['UDPhone'];
		$Email = $_POST['UEmail'];
		$Address = $_POST['UAddress'];
		if($CID == ""||$Phone ==""||$Email == ""||$Address == ""){
			echo "Please fill all Fields";
		}else{
			$sql = "UPDATE caddress, email, phone SET caddress.PhysicalAddress = '$Address',
			phone.PhoneNumber = '$Phone', email.EmailAddress = '$Email' 
			WHERE email.ContactID = '$CID' AND phone.ContactID = email.ContactID AND caddress.ContactID = email.ContactID";
			$query = mysqli_query($conn, $sql) or die("Could not update Details");
			print("Data Updated.");
		}
		
	}
		 ?>
		 <table class = "UpdateBook">
		 <h2>Update Book</h2>
		 <th><p><a>ISBN: <input type = "number" name = "UBISBN" value = ""></a></p></th>
		 <th><p><a>Title: <input type = "text" name = "UBTitle" value = ""></a></p></th>
		 <th><p><a>Publication Date: <input type = "date" name = "UBPubDate" value = ""></a></p></th>
		 <th><p><a>User Reviews: <input type = "text" name = "UBUserRev" value = ""></a></p></th>
		 <th><p><a>Price: <input type = "number" name = "UBPrice" value = ""></a></p></th>
	     <th><p><a>Supplier ID: <input type = "number" name = "UBSID" value = ""></a></p></th>
		 <th><p><a><input type = "submit" name = "UBook" value = "Update Book"></a></p></th>
		 </table>
<?php	
	//Update Book
	if (isset($_POST['UBook'])){
		$ISBN = $_POST['UBISBN'];
		$Title = $_POST['UBTitle'];
		$PubDate = $_POST['UBPubDate'];
		$Price = $_POST['UBPrice'];
		$SID = $_POST['UBSID'];
		$UserReviews = $_POST['UBUserRev'];
		if($ISBN == ""||$Title ==""||$PubDate == ""|| $Price == ""|| $SID == ""){
			echo "Fill all voids";
		}else{
			$sql = "UPDATE books SET Title = '$Title',
			PublicationDate = '$PubDate',Price = '$Price', SupplierID = '$SID'
			WHERE ISBN = '$ISBN'";
			$query = mysqli_query($conn, $sql) or die("Could not update Book");
			if($UserReviews ==''){
				echo "Review not updated";
			}else{
				$sql2= "UPDATE books SET UserReviews = '$UserReviews'
				WHERE ISBN = $ISBN";
				$query2 = mysqli_query($conn, $sql2) or die("Could not update Book Review");
				echo "Review Updated";
			}
			echo "Book Updated";
			
		}
	}	
	?>
	<div class = "mainintro">
	<h1> Delete Information </h1></br>
	</div>
	
	<table class = "DeleteCustomer">
	<h2>Delete Customer</h2>
		<th><p><a>Customer ID: <input type = "number" name = "DCCID" value = ""></a></p></th>
		<th><p><a>Contact ID:<input type = "number" name = "DConID" value></a></p></th>
		<th><p><a><input type = "submit" name = "DCustomer" value = "DELETE THAT CUSTOMER"></a></p></th>
		<?php
		//Delete Customer
		 if (isset($_POST['DCustomer'])){
		 $CustomerID = $_POST['DCCID'];
		 $ContactID = $_POST['DConID'];
		 $check1 = mysqli_query($conn, "SELECT * FROM customers WHERE CustomerID = '$CustomerID' AND ContactID = '$ContactID'") or die("Could not update Checl");
		 $count = mysqli_num_rows($check1);
		
		if($count == 0){ 
			print("Invalid Delete Attempt");
		}else {
			$sql3="DELETE FROM contact_details  WHERE contact_details.ContactID = '$ContactID'";
			$del1 = mysqli_query($conn, $sql3) or die("Could not delete Customer");
			echo"Request Processed";
		}
	 }
		?>
	 </table>
	 <table class = "DeleteAuthor">
	 <h2>Delete Author</h2>
		<th><p><a>Author ID: <input type = "number" name = "DAAID" value = ""></a></p></th>
		<th><p><a>Contact ID:<input type = "number" name = "DACID" value></a></p></th>
		<th><p><a><input type = "submit" name = "DAuthor" value = "DELETE THAT AUTHOR"></a></p></th>
	 </table>
	 <?php
		 //Delete Author
	 if(isset($_POST['DAuthor'])){
		 $AuthorID = $_POST['DAAID'];
		 $ContactID = $_POST['DACID'];
		 $check1 = mysqli_query($conn, "SELECT * FROM author WHERE AuthorID = '$AuthorID' AND ContactID = '$ContactID'") or die("Could not update Checl");
		 $count = mysqli_num_rows($check1);
		 if($count == 0){ 
			print("Invalid Delete Attempt");
		}else {
			$sql3="DELETE FROM contact_details  WHERE contact_details.ContactID = '$ContactID'";
			$del1 = mysqli_query($conn, $sql3) or die("Could not delete Author");
			echo"Request Processed";
		}
	 }
	?>
	 <table class = "DeleteBook">
	 <h2>Delete Book</h2>
		<th><p><a>ISBN: <input type = "number" name = "DBISBN" value = ""></a></p></th>
		<th><p><a>Supplier ID:<input type = "number" name = "DBSID" value></a></p></th>
		<th><p><a><input type = "submit" name = "DBook" value = "DELETE THAT BOOK"></a></p></th>
	 </table>
	 <?php
		  //deletes book
	 if(isset($_POST['DBook'])){
		$ISBN = $_POST['DBISBN'];
		$SID = $_POST['DBSID'];
		$check = mysqli_query($conn, "SELECT * FROM books WHERE 
		 ISBN= '$ISBN' AND SupplierID = '$SID'") or die("Could not update Checl");
		 $count = mysqli_num_rows($check);
		 if($count == 0){ 
			print("Invalid Delete Attempt");
		}else {
			$sql3 = "DELETE FROM books WHERE books.ISBN = '$ISBN'";
			$del1 = mysqli_query($conn, $sql3) or die("Could not delete book");
			echo"Request Processed";
		}
	 }
	 ?>
	 <table class = "DeleteSupplier">
	 <h2> Delete Supplier</h2>
		<th><p><a>Supplier ID: <input type = "number" name = "DSID" value = ""></a></p></th>
		<th><p><a>Supplier Name:<input type = "text" name = "DSName" value></a></p></th>
		<th><p><a><input type = "submit" name = "DSupplier" value = "DELETE THAT SUPPLIER"></a></p></th>
	 </table>
	 <?php
	
	 // Delete Supplier
	 if(isset($_POST['DSupplier'])){
		 $SupplierID = $_POST['DSID'];
		 $Sname = $_POST['DSName'];
		 $check1 = mysqli_query($conn, "SELECT * FROM supplier WHERE 
		 SupplierID= '$SupplierID' AND Sname = '$Sname'") or die("Could not update Checl");
		 $count = mysqli_num_rows($check1);
		 if($count == 0){ 
			print("Invalid Delete Attempt");
		}else {
			$sql3="DELETE FROM Supplier  WHERE Supplier.SupplierID = '$SupplierID'";
			$del1 = mysqli_query($conn, $sql3) or die("Could not delete supplier");
			echo"Request Processed";
		}
		 
	 }
	
	 ?>
	</body>

</html>