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
            <th><p><a href="mainpage.php">Go Back</a> </p></th>
            <th><p><a href="cPage.php">Your Account</a> </p></th>
            <th><p><a href="shoppingCart.php">Shopping Cart</a> </p></th>
            </tr>
        </table>

    <?php
    include("connectiondb.php");

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    }else{
        if(isset($_GET['Filer']))
        {
        $itemFilter = $_GET['Filer'];

        $sqlgetBook = "SELECT s.Title FROM books s, assigned_to t, book_categories l WHERE l.CategoryDescription='$itemFilter' AND 
        l.CategoryCode = t.CategoryCode AND t.ISBN = s.ISBN";
        
        $query = mysqli_query($conn, $sqlgetBook) or die('Error');
        
        if(mysqli_num_rows($query)!= 0)
        {

    echo "<table class = 'phptable'>";
    echo "<tr><th>Book Titles</th></tr>";

    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        echo '<tr><th><a href="bookpage.php?title='.$row['Title'].'">'.$row['Title'].'<a/></tr></th>';
    }
    echo "</table>";  
        } 
    }
}
if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
}else{
    if(isset($_GET['Au']))
    {
    $itemFilterAu = $_GET['Au'];
    $name = explode(" ",$itemFilterAu);

    $sqlgetBook2 = "SELECT s.Title FROM books s, written_by t, author l WHERE l.FirstName='$name[0]' AND l.LastName = '$name[1]'AND
    l.AuthorID = t.AuthorID AND t.ISBN = s.ISBN";
    
    $query2 = mysqli_query($conn, $sqlgetBook2) or die('Error');
    
    if(mysqli_num_rows($query2)!= 0)
    {

echo "<table class = 'phptable'>";
echo "<tr><th>Book Titles</th></tr>";

while($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
    echo '<tr><th><a href="bookpage.php?title='.$row['Title'].'">'.$row['Title'].'<a/></tr></th>';
}
echo "</table>";  
    } 
}
}
    ?>
</html>