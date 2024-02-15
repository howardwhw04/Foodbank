<?php
    //FINAL
    session_start();

    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    $email = $_SESSION['userloggedin'];
    if($_SESSION['isAdmin'] == false)
    {
        $sql = "SELECT * FROM userinfo WHERE Email = '$email'";
        $result = mysqli_query($conn, $sql);
        $target = mysqli_fetch_assoc($result);

        //Get information in database
        $_SESSION['username'] = $target['UserName'];
        $_SESSION['gender'] = $target['Gender'];
        $_SESSION['phonenumber'] = $target['PhoneNumber'];

    }
    else
    {
        $sql = "SELECT * FROM admininfo WHERE AdminEmail = '$email'";
        $result = mysqli_query($conn, $sql);
        $target = mysqli_fetch_assoc($result);

        //Get information in database
        $_SESSION['username'] = $target['AdminName'];
        $_SESSION['gender'] = $target['AdminGender'];
        $_SESSION['phonenumber'] = $target['AdminPhoneNum'];
    }

    

    if(!isset($_SESSION['userloggedin']))
    {
        header("Location:  Account-Login.php");
    }

    function GetRequestData($conn)
    {
        $sql = "SELECT * FROM donationinfo WHERE UserEmail = '$_SESSION[userloggedin]' ORDER BY RequestID";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            //There is data in the table
            while($row = mysqli_fetch_assoc($result))
            {
                echo '<tr style="
                        border: 2px black solid;
                        border-collapse: collapse;">
                        <td>' . $row['Address'] . '</td>
                        <td>' . $row['FoodbankName'] . '</td>
                        <td>' . $row['ItemType'] . '</td>
                        <td>' . $row['PreferredDate'] . '</td>
                        <td>' . $row['PreferredTime'] . '</td>
                        <td>' . $row['Status'] . '</td>
                    </tr>';
            }
        }
        else
        {
            echo '<tr><td colspan="6">No Data</td>';
        }
    }

?>

<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Account-Page.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>

    <body>
        <center>
        <div class="content">

            <div class="card"> 
                <a href="Homepage.php"><-Back to Home</a>
                <!--<img style="max-width: 24.5em; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);" src="<?php  echo $target['PictureName']   ?>">-->
                <h2>Welcome, <?php   echo $_SESSION['username']?></h2>

                <table>
                    <tr>
                        <td><p>User Email:</p></td>
                        <td><p><?php echo $_SESSION['userloggedin']?></p></td>
                    </tr>

                    <tr>
                        <td><p>Gender:</p></td>
                        <td><p><?php echo $_SESSION['gender']?></p></td>
                    </tr>

                    <tr>
                        <td><p>Phone Number:</p></td>
                        <td><p><?php echo $_SESSION['phonenumber']?></p></td>
                    </tr>
                </table>
                <div style="margin-top: 2em;">
                    <a href="Account-Edit.php">Edit Information</a>
                </div>
                
                <br>
                <br>
                <!--HERE-->
                <table
                style="
                text-align: center;
                border: 2px black solid;
                border-collapse: collapse;"
                >
                    <caption><b>Donation via Request</caption>
                        <tr>
                            <th valign="top">Address</th>
                            <th valign="top">Foodbank Name</th>
                            <th valign="top">Food Type</th>
                            <th valign="top">Preferred Date</th>
                            <th valign="top">Preferred Time</th>
                            <th valign="top">Status</th>
                        </tr>

                        <?php
                            GetRequestData($conn);
                        ?>
                </table>   

                <form action="Homepage.php" method="post">
                    <button 
                    style="background-color: #ffa31a;
                    font-weight: bold;
                    padding: 6px;
                    margin-top:1em;" 
                    type="submit" name="logout" value="logout">Log Out</button>
                </form>

                <script>
                    function PopUp()
                    {
                        document.getElementById("popupdiv").style.display = "block";
                    }
                    function RemovePopUp()
                    {
                        document.getElementById("popupdiv").style.display = "none";
                    }
                </script>
            </div>
        </div>
        </center>
    </body>
</html>