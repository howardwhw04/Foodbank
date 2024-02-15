<?php

    //On startup
    session_start();
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    function ListFoodbanks($conn)
    {
        //SQL query
        $sql = "SELECT * FROM FoodbankInfo ORDER BY FoodbankID";
        $result = mysqli_query($conn, $sql);

        $url = "Foodbank-Page.php?id=";

        while($row = mysqli_fetch_assoc($result))
        {
            echo
            "
            <a href='$url$row[FoodbankID]'>
                <div>
                    <img style='width:30em; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);' src=" . $row['PictureName'] . "><br>
                    <h4>" . $row['FoodbankName'] . "</h4>
                    <p>" . $row['FoodbankLocation'] . "</p>
                    <br>
                    <hr>
                </div>
            </a>
            ";
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="FBH-Style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
    
    <body>
        <div>
            <div class="header">
                <a href="Homepage.php"><img class="logo" src="IMAGE/FBH-LOGO.png" alt="FOODBANK HUB LOGO"></a>
                <a href="Homepage.php"><h1>FOODBANK HUB</h1></a>
            </div>

            <div class="topnav">
                <a href="Homepage.php">Home</a>
                <a href="Foodbank-List.php" class="active">Donate</a>
                <a href="Account-page.php"><?php if($_SESSION['userloggedin']) { echo "Logged in as " . $_SESSION['userloggedin']; } else {echo "Account";} ?></a>
                <a href="Admin-Page.php"  class="active" style="float: right; <?php  if($_SESSION['isAdmin'] != true){ echo "display: none"; } ?>"><i class="fa fa-unlock-alt" aria-hidden="true"></i> ADMIN</a>
            </div>
        </div>
        
        <center>
        <div class="content">
            <div class="fbcard">
                <h2>List of Foodbanks Available</h2>    
                <?php   ListFoodbanks($conn)?>
            </div> 
        </div>  
        </center>

        <div class="footer">
            <a>Copyright <?php echo date ('Y'); ?> FOOBBANK HUB</a>
        </div>

    </body>
</html>