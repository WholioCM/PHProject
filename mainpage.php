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
                  
                $sql2 = "SELECT c.IfAdmin FROM Customers c, Contact_Details f, Email z WHERE 
                  c.ContactID = f.ContactID AND f.ContactID = z.ContactID AND c.Cpassword='$cNP' AND z.EmailAddress = '$cN'";

                $result2 = mysqli_query($conn, $sql2);

                if ($row = mysqli_fetch_assoc($result2)) {
                    if ($row['IfAdmin'] == 0){
                        $admin = False;
                    }else{
                        $admin = True;
                    }
                  }
                echo "</th>";
                if ($admin == 0){
                    echo "<th><p><a href='cPage.php'>Your Account</a> </p></th>";
                }else{
                    echo "<th><p><a href='admin.php'>Your Account</a> </p></th>";
                }
            ?>
            <th><p><a href="shoppingCart.php">Shopping Cart</a> </p></th>
            </tr>
        </table>

<?php
    include("connectiondb.php");

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    }

    $sqlget = "SELECT * FROM Books";
    $sqldata = mysqli_query($conn, $sqlget) or die('Error');

    echo "<table class = 'phptable'>";
    echo "<tr><th>Book Titles</th></tr>";

    while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
        echo '<tr><th><a href="bookpage.php?title='.$row['Title'].'">'.$row['Title'].'<a/></tr></th>';
    }
    echo "</table>";

    $sqlget2 = "SELECT * FROM `Book_Categories`";
    $sqldata2 = mysqli_query($conn, $sqlget2) or die('Error');

    echo "<table class = 'genretable'>";
    echo "<tr><th>Search by Book Genres</th></tr>";

    while($row = mysqli_fetch_array($sqldata2, MYSQLI_ASSOC)) {
        echo '<tr><th><a href="filter.php?Filer='.$row['CategoryDescription'].'">'.$row['CategoryDescription'].'<a/></tr></th>';
    }
    echo "</table>";
?>

    <div class = "mainintro">

        <h2> What is Books Worldwide? </h2>

        <div class = "whats">
            <p> Books Worldwide&copy; is the ultimate online way to get your books! <br>
                We offer 24/7 customer support, money back guaranteed, <br>
                Worldwide free shipping, and many other things. </p>
        </div>

        <h2> Why should you use Books WorldWide? </h2>

        <div class = "why">
            <p> Books Worldwide&copy; offers some of the best selection of books <br>
                available to the public. Not only that but it is easy to use, and <br>
                easy to search for books. </p>
        </div>

        <h2> Whats the catch? Is it that easy?</h2>

        <div class = "catch">
            <p> There is no catch what so ever! We take customer satisfaction as <br> 
            our number 1 priority. NOW GET SHOPPING!! </p>
        </div>
    </div>

    <div class = "sign-up">
        <p> Already a member? <a href="login.php">Sign in</a> </p>
        <p> Want to sign up?? <a href="register.php">Sign up</a> </p>
    </div>
    <form  method = "post">
    <table>
		Find Book
		 <th>Search Title <input type = "text" name = "FindBook" value = ""></a></th>
		 <th><p><a><input type= "submit" name = "Book" value = "Find Book"/></a></p></th>
	</table>
    </form>

    <?php
    include("connectiondb.php");

if (isset($_POST['Book'])){
		
    $searchfbook = $_POST['FindBook'];
    $searchfbook = preg_replace("#[^0-9 a-z]#i", "", $searchfbook);
    $sqlBook = "SELECT * FROM books WHERE Title LIKE '%$searchfbook%'";
    $query = mysqli_query($conn, $sqlBook) or die("Could not search");
    $count = mysqli_num_rows($query);
    if($count == 0){
        print("There was no search results");
    }else {
        echo "<table border =1>";
        echo"<tr><td>Book</td></tr>";
        while($row = mysqli_fetch_array($query)){
            echo '<tr><th><a href="bookpage.php?title='.$row['Title'].'">'.$row['Title'].'<a/></tr></th>';
        }
        echo"</table>";
    }
}

    echo "</table>";

    $sqlget2 = "SELECT * FROM `Author`";
    $sqldata2 = mysqli_query($conn, $sqlget2) or die('Error');

    echo "<table class = 'Authortable'>";
    echo "<tr><th>Search by Author</th></tr>";

    while($row = mysqli_fetch_array($sqldata2, MYSQLI_ASSOC)) {
        echo '<tr><th><a href="filter.php?Au='.$row['FirstName'].' '.$row['LastName'].'">'.$row['FirstName'].' '.$row['LastName'].'<a/></tr></th>';
    }
    echo "</table>";
    ?>
    </body>
</html>

