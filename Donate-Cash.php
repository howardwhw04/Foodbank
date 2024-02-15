<?php

   //Essential stuff when loading in
   session_start();
   $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");
   $id = $_GET['id'];
   $confirmUrl = "Confirm.php?id=$id";
   $backUrl = "Foodbank-Page.php?id=$id";

   //SQL
   $sql = "SELECT * FROM foodbankinfo WHERE FoodbankID = $id";
   $result = mysqli_query($conn , $sql);
   $target = mysqli_fetch_assoc($result);
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
            <form action="<?php echo $confirmUrl ?>" method="post">

               <a href="<?php echo $backUrl ?>"><-Cancel</a>
               <!--<img style="max-width: 24.5em; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);" src="<?php  echo $target['PictureName']   ?>">-->
               
               <h2>Donating to: <?php  echo $target['FoodbankName']   ?></h2>
               

               <table>
                  <tr>
                     <td><p><b>Items can be purchased:<b></p></td>
                  </tr>
                  
                  <tr>
                     <td><label for="rice">Rice 5KG x 1 Pack - RM13.00</label></td>
                     <td><input type="number" name="rice" min="0"></td>
                  </tr>

                  <tr>
                     <td><label for="milo">Milo 1KG x 1 Pack - RM16.00</label></td>
                     <td><input type="number" name="milo" min="0"></td>
                  </tr>

                  <tr>
                     <td><label for="oats">Nestum Oats 1 Pack - RM3.40</label></td>
                     <td><input type="number" name="oats" min="0"></td>
                  </tr>

                  <tr>
                     <td><label for="noodle">Instant Noodle 4 Pack - RM13.60</label></td>
                     <td><input type="number" name="noodle" min="0"><br></td>
                  </tr>

                  <tr>
                     <td><label for="biscuit">Biscuits 1 Pack - RM4.50</label></td>
                     <td><input type="number" name="biscuit" min="0"><br></td>
                  </tr>
               </table>

               <?php
               if($_GET['err'] == "nodon")
                  {
                     echo "<span style='color:red'>Donate at least one item</span><br>";   
                  }
               ?>

               <button 
               style="background-color: #ffa31a;
               font-weight: bold;
               padding: 6px;
               margin-top: 1em;"
               type="submit" value="submit">Check Out</button>
            </form>
         </div>
      </div>
      </center>
   </body>
</html>