<?php

    session_start();

    //Establishing connection to the database
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    //Initialization of variables
    $listNumber = 1;

    function GetFoodbankData($conn)
    {
        $sql = "SELECT * FROM FoodbankInfo ORDER BY FoodbankID";
        $result = mysqli_query($conn, $sql);

        $editUrl = "Foodbank-Edit.php?id=";
        $deleteUrl = "Foodbank-Delete.php?id=";

        if(mysqli_num_rows($result) > 0)
        {
            //There is data in the table
            while($row = mysqli_fetch_assoc($result))
            {
                echo '<tr>
                        <td>' . $row['FoodbankID'] . '</td>
                        <td>' . $row['FoodbankName'] . '</td>
                        <td width="300">' . $row['FoodbankLocation'] . "</td>
                        <td>
                            <a href=" . $editUrl . $row['FoodbankID']  . ">Edit |</a>
                            <a href=". $deleteUrl . $row['FoodbankID'] .">Delete</a>
                        </td>    
                    </tr>";
            }
        }
    }

    function GetCashDonationData($conn)
    {
        $sql = "SELECT * FROM cashdonationtable ORDER BY DonationID";
        $result = mysqli_query($conn, $sql);

        $deleteUrl = "Donate-Cash-Delete.php?id=";

        if(mysqli_num_rows($result) > 0)
        {
            //There is data in the table
            while($row = mysqli_fetch_assoc($result))
            {
                echo '<tr><td>' . $row['DonationID'] . '</td><td>' . $row['UserEmail'] . '</td><td>' . $row['FoodbankName'] . '</td><td> RM' . $row['CashDonated'] . '</td><td>' . $row['Date'] . '</td><td><a href="' . $deleteUrl . $row['DonationID'] . '">Delete</a></td></tr>';
            }
        }
    }
    
    function GetRequestData($conn)
    {
        $sql = "SELECT * FROM donationinfo ORDER BY RequestID";
        $result = mysqli_query($conn, $sql);

        $editUrl = "Donate-Request-Edit.php?id=";
        $deleteUrl = "Donate-Request-Delete.php?id=";

        if(mysqli_num_rows($result) > 0)
        {
            //There is data in the table
            while($row = mysqli_fetch_assoc($result))
            {
                echo '<tr>
                        <td>' . $row['RequestID'] . '</td>
                        <td>' . $row['UserEmail'] . '</td>
                        <td>' . $row['Address'] . '</td>
                        <td>' . $row['FoodbankName'] . '</td>
                        <td>' . $row['ItemType'] . '</td>
                        <td>' . $row['PreferredDate'] . '</td>
                        <td>' . $row['PreferredTime'] . '</td>
                        <td>' . $row['Status'] . '</td>
                        <td>
                            <a href=' . $editUrl . $row['RequestID'] .'>Edit |</a>
                            <a href=' . $deleteUrl . $row['RequestID'] .'>Delete</a>
                        </td>
                    </tr>';
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Admin-Style.css">
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
                <a href="Foodbank-List.php">Donate</a>
                <a href="Account-Page.php"><?php if($_SESSION['userloggedin']) { echo "Logged in as " . $_SESSION['userloggedin']; } else {echo "Account";} ?></a>
                <a href="Admin-Page.php"  class="active" style="float: right;"><i class="fa fa-unlock-alt" aria-hidden="true"></i> ADMIN</a>
            </div>
        </div>
        
        <center>
        <div class="content">
            <table>
                <caption>Foodbank Infomation</caption>
                <tr>
                    <th>No</th>
                    <th>Foodbank Name</th>
                    <th>Foodbank location</th>
                    <th>Action</th>
                </tr>

                <?php
                    GetFoodbankData($conn);
                ?>
                
                <div class="add">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td bgcolor="#303030">
                            <div class="add">
                                <a href="Foodbank-Add.php">+ ADD</a>
                            </div>
                        </td>   
                    </tr>
                </div>
            </table>

            <table>
            <caption>Donation via Cash information</caption>
                <tr>
                    <th>Donation ID</th>
                    <th>UserEmail</th>
                    <th>Foodbank Name</th>
                    <th>Cash Donated</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>

                <?php
                    GetCashDonationData($conn);
                ?>
            </table>
           
            <table>
            <caption>Donation via Request</caption>
                <tr>
                    <th>Request ID</th>
                    <th>UserEmail</th>
                    <th>Address</th>
                    <th>Foodbank Name</th>
                    <th>Food Type</th>
                    <th>Preferred Date</th>
                    <th>Preferred Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                    GetRequestData($conn);
                ?>
                </div>
            </table>            
            
            </div>
        </div>      
        </center>

        <div class="footer">
            <a>Copyright <?php echo date ('Y'); ?> FOOBBANK HUB</a>
        </div>

    </body> 
</html>