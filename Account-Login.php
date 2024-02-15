<!--FINAL-->
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
                    <form action="Account-Login-Process.php" method="post">
                        <table>
                            <tr>
                                <td><label for="Email">Email</label></td>
                                <td><input type="text" placeholder="Enter Email..." name="Email" required></td>
                            </tr>

                            <tr>
                                <td><label for="psw">Password</label></td>
                                <td><input type="password" placeholder="Enter Password..." name="psw" required></td>
                            </tr>
                            
                            <?php
                                //Outputs any mistakes made when logging in
                                $error = $_GET['error'];
                                if (isset($error))
                                {
                                    echo "<br><b style = color:red>The email does not exist or the password is incorrect.</b>";
                                }
                            ?>

                            <tr>
                                <td colspan="2" class="table-bottom">
                                    <button class="login-button" type="submit">Login</button>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
                                </td>
                            </tr>
                        </table>

                        <div class="to-other-page">
                                <p>Does not have an account?</p>
                                <p>Press <a href="Account-SignUp.php">here</a> to sign up now.</p>
                        </div>
                        
                    </form>
                    </center>
                </div>
                
            </div>
        </div>
    </body>
</html>