<?php
    //SQL Connection
    $conn = mysqli_connect("localhost" , "root" , "" ,  "foodbankdb");

    //Intialize Variables
    $name = $_POST['foodbankname'];
    $location = $_POST['foodbanklocation'];
    $description = $_POST['description'];
    $managerName = $_POST['managername'];
    $contactNum = $_POST['contactnum'];

    $submitted = $_POST['submit'];
    $url = "Admin-Page.php";

    function ImageProcess()
    {
        //Check if file is uploaded
        if(isset($_FILES['fileupload']))
        {
            $fileTmpPath = $_FILES['fileupload']['tmp_name'];
            $fileName = $_FILES['fileupload']['name'];
            $fileNameCmps = explode("." , $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            $allowedExtension = array('jpg' , 'gif' , 'png' , 'bmp' ,'jpeg');

            if(in_array($fileExtension, $allowedExtension))
            {
                $uploadFileDir = "uploads/";

                $destPath = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath , $destPath))
                {
                    return($destPath);
                }
                else
                {
                    //Error
                }
            }
            else
            {
                //Wrong file type
            }
        }
        else
        {
            //No files sent
        }
    }

    
    
    
    //Submitted form
    if($submitted == "submit")
    {
        $picName = ImageProcess();

        //SQL query
        $sql = "INSERT INTO foodbankinfo (FoodbankName , FoodbankLocation , Description , ManagerName , ContactNumber , PictureName) VALUES ('$name' , '$location' , '$description' , '$managerName' , '$contactNum' , '$picName')";
        $query = mysqli_query($conn, $sql);

        header("Location: " . $url);
    }

?>

<html>
    <head>
        <title>FOODBANK HUB</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Foodbank-Style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
    <body>
        <center>
            <div class="content">
                <div class="card">
                    <form action="Foodbank-Add.php" method="post" enctype="multipart/form-data">
                    <h2>Add a Foodbank</h2>
                        <table>
                            <tr>
                                <td><label for="foodbankname: ">Foodbank Name: </label></td>
                                <td><input type="text" name="foodbankname"></td>
                            </tr>

                            <tr>
                                <td><label for="foodbanklocation">Foodbank Location: </label></td>
                                <td><input type="text" name="foodbanklocation"></td>
                            </tr>

                            <tr>
                                <td><label for="description">Description: </label></td>
                                <td><textarea name="description" style="resize:non"></textarea></td>
                            </tr>

                            <tr>
                                <td><label for="managername">Manager Name: </label></td>
                                <td><input type="text" name="managername"></td>
                            </tr>

                            <tr>
                                <td><label for="contactnum">Contact Number: </label></td>
                                <td><input type="text" name="contactnum"></td>
                            </tr>

                            <tr>
                                <td><label for="fileupload">Image of Foodbank:</label><br></td>
                                <td><input type="file" name="fileupload"></td>
                            </tr>
                        </table>
                        <button type="submit" name="submit" value="submit"
                            style="background-color: #ffa31a;
                            font-weight: bold; 
                            padding: 6px;
                            margin-top:1em;">Submit</button>
                    </form>
                </div>
            </div>
        </center>
    </body>
</html>