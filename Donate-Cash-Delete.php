<?php

    //Startup essentials
    session_start();
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");
    $id = $_GET['id'];

    //Urls for easier writing
    $url = "Donate-Cash-Delete.php?id=$id";

    $sql = "SELECT * FROM cashdonationtable WHERE DonationID = '$id'";
    $result = mysqli_query($conn , $sql);
    $target = mysqli_fetch_assoc($result);

    //Confirm to delete
    if($_POST['submit'] == "submit")
    {
        //Get URL
        $confirmUrl = "Admin-Page.php";

        //SQL
        $sql = "DELETE FROM cashdonationtable WHERE DonationID = '$id'";
        mysqli_query($conn , $sql);

        header("Location: " . $confirmUrl);
    }
    else if($_POST['submit'] == "cancel")
    {
        $cancelUrl = "Admin-Page.php";
        header("Location: " . $cancelUrl);
    }

?>

<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Donate-Style.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>

    <body>
        <center>
            <div class="content">
                <div class="card">
                    <table>
                        <form action="<?php echo $url ?>" method="POST">
                        <h2>Are you sure to delete?</h2>

                        <tr>
                            <td><p>Donation ID:</p></td>
                            <td><p><?php echo $target['DonationID'] ?></p></td>
                        </tr>

                        <tr>
                            <td><p>Donated By:</p></td>
                            <td><p><?php echo $target['UserEmail'] ?></p></td>
                        </tr>

                        <tr>
                            <td><p>Donated To:</p></td>
                            <td><p><?php echo $target['FoodbankName'] ?></p></td>
                        </tr>

                        <tr>
                            <td><p>Amount Donated:</p></td>
                            <td><p><?php echo $target['CashDonated'] ?></p></td>
                        </tr>

                        <tr>
                            <td><p>Date of Donation:</p></td>
                            <td><p><?php echo $target['Date'] ?></p></td>
                        </tr>
                    </table>
                
                    <button type="submit" name="submit" value="submit" 
                            style="background-color: #ffa31a;
                            font-weight: bold;
                            padding: 6px;
                            margin-top:1em;" >Confirm</button>

                    <button type="submit" name="submit" value="cancel"
                            style="background-color: #ffa31a;
                            font-weight: bold; 
                            padding: 6px;
                            margin-top:1em;" >Cancel</button>
                    </form>                
                </div>
            </div>
        </center>

    </body>
</html>