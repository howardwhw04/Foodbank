<?php
    //Essential stuff when loading in
    session_start();
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");
    $url = "Account-Page.php";
    $error = "Account-Edit.php?error=contnum";

    //Initialize variables
    $email = $_SESSION['userloggedin'];
    $submit = $_POST['submit'];

    //Checks if it is submitted, if so submit user details changes to database

    if($submit == "submit")
    {
        //Get values from form
        $editusername = !empty($_POST['editusername']) ? $_POST['editusername'] : $_SESSION['username'];
        $editgender = $_POST['editgender'] ? $_POST['editgender'] : $_SESSION['gender'];
        $editphoneNumber = $_POST['editphonenumber'] ? $_POST['editphonenumber'] : $_SESSION['phonenumber'];

        if(!preg_match('/^\d{10,11}|\s$/' , $editphoneNumber))
        {
            header("Location: " . $error);
            die();
        }
        //Update tables
        if($_SESSION['isAdmin'] == false) //USER SIDED
        {
            $sql = "UPDATE userinfo SET UserName = '$editusername' , Gender = '$editgender' , PhoneNumber = '$editphoneNumber' WHERE Email = '$email'";
        }
        else //ADMIN SIDED
        {
            $sql = "UPDATE admininfo SET AdminName = '$editusername' , AdminGender = '$editgender' , AdminPhoneNum = '$editphoneNumber' WHERE AdminEmail = '$email'";
        }

        mysqli_query($conn , $sql);
        header("Location: " . $url);
        
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
                <form action="Account-Edit.php" method="post">
                    <h2>Editing User Details:</h2>

                    <table>
                        <tr>
                            <td><label for="editusername">Username: </label></td>
                            <td><input type="text" name="editusername" placeholder="<?php   echo $_SESSION['username']    ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="editphonenumber">Phone Number: </label></td>
                            <td><input type="text" name="editphonenumber" placeholder = "<?php   echo $_SESSION['phonenumber']   ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="editgender">Gender (<?php   echo $_SESSION['gender']?>): </label></td>
                            <td>
                                <input type="radio" name="editgender" value="male"> <label for="male">Male</label><br>
                                <input type="radio" name="editgender" value="female"> <label for="female">Female</label><br></td>
                        </tr>
                    </table>

                    <?php
                        if($_GET['error'])
                        {
                            echo "<span style='color:red'>Contact Number is invalid</span><br>";
                        }
                    ?>

                    <button style="
                    background-color: #ffa31a;
                    font-weight: bold;
                    padding: 6px;
                    margin-top:1em;"
                    type="submit" name="submit" value="submit">Submit</button>
                </form>

            </div>
        </div>    
        </center>
        
    </body>
</html>