<!DOCTYPE html>
<html>
    <title>FOODBANK HUB</title>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Account-Style.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>

    <body>
        <div class="content">

            <div class="leftcolumn">
                <img src="IMAGE/FBH-LOGO.png" alt="FOODBANK HUB LOGO">
            </div>

            <div class="rightcolumn">
                <div class="card"> 
                    <center>
                    <form action="Account-SignUp-Process.php" method="post">
                        <table>
                            <tr>
                                <td><label for="Email">Email</label></td>
                                <td><input type="text" placeholder="Enter Email..." name="Email" required></td>
                            </tr>
                            
                            <tr>
                                <td><label for="psw">Password</label></td>
                                <td><input type="password" placeholder="Enter Password..." name="psw" required></td>
                            </tr>

                            <tr>
                                <td><label for="psw-repeat">Repeat Password</label></td>
                                <td><input type="password" placeholder="Repeat Password..." name="psw-repeat" required></td>
                            </tr>

                            <?php
                                //Receive error lists from processing.php and output the errors
                                $errorList = explode("," , $_GET['errors'] , $limit = PHP_INT_MAX);

                                foreach($errorList as $i)
                                {
                                    echo "<b style='color:red'>" . $i . "</b>";
                                }
                            ?>

                            <tr>
                                <td colspan="2" class="table-bottom">
                                    <button class="signup-button"type="submit">Sign Up</button> 
                                </td>
                            </tr>  

                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <label>
                                        <input type="checkbox" checked="checked" name="agree" required>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
                                    </label>
                                </td>
                            </tr>
                            
                        </table>    

                        <div class="to-other-page">
                            <p>Already have an account?</p>
                            <p>Press <a href="Account-Login.php">here</a> to login now.</p>
                        </div>
                    
                    </form>
                    </center>
                
                </div>
            </div>   
        </div>

    </body>
</html>