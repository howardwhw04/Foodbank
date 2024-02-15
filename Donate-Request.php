<?php
    //Start up
    session_start();

    //URL id
    $id = $_GET['id'];
    $processing = "Donate-Request-Process.php?id=$id";
    $url = "Foodbank-Page.php?id=$id";

    $mindate = date('Y-m-d');

?>

<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Donate.css">
        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   </head>

    <body>
        <center>
        <div class="content">
            <div class="card">
                <a href="<?php   echo $url   ?>"><-Back</a>
                <form action="<?php   echo $processing    ?>" method="post">

                    <h2>Donating As: <?php   echo $_SESSION['username']    ?></h2>
                    <table>
                        <tr>
                            <td><label for="address">Address: </label></td>
                            <td><input type="text" name="address" required></td>
                        </tr>

                        <tr>
                            <td valign="top"><label for="typeoffood">Types of items: </label></td>
                            <td>
                                <input type="checkbox" name="typeoffood[]" value="cannedfood"> <label for="food">Canned Food</label><br>
                                <input type="checkbox" name="typeoffood[]" value="fruit"> <label for="fruit">Fruit</label><br>
                                <input type="checkbox" name="typeoffood[]" value="vegetable"> <label for="vegetable">Vegetable</label><br>
                                <input type="checkbox" name="typeoffood[]" value="rice"> <label for="rice">Rice</label><br>
                                <input type="checkbox" name="typeoffood[]" value="oil"> <label for="oil">Oil</label><br>
                                <input type="checkbox" name="typeoffood[]" value="drink"> <label for="drink">Drinks</label><br>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="date">Preferred Date: </label></td>
                            <td><input type="date" name="date" min="<?php echo $mindate;?>" required></td>
                        </tr>

                        <tr>
                            <td><label for="time">Preferred Time: </label></td>
                            <td><input type="time" name="time" required></td>
                        </tr>
                    </table>
                    
                    <p style="color:red"><?php   if($_GET['error'] == "chkboxempty"){ echo "Please select at least one from the checkbox";}   ?></p>

                    <button
                    style="background-color: #ffa31a;
                    font-weight: bold;
                    padding: 6px;
                    margin-top: 1em;" 
                    type="submit" name="submit" value="submit">Submit</button>
                </form>
            </div>
        </div>    
        </center>
        
    </body>
</html>