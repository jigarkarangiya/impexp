<?php 
    $connect = mysqli_connect("localhost", "root", "", "impexp");
    if(isset($_POST["submit"]))
{
    if($_FILES['file']['name'])
    {
        $filename = explode(".", $_FILES['file']['name']);
        if($filename[1] == 'csv')
        {
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while($data = fgetcsv($handle))
            {
                $ID = mysqli_real_escape_string($connect, $data[0]);
                $Name = mysqli_real_escape_string($connect, $data[1]);  
                $Email = mysqli_real_escape_string($connect, $data[2]);
                $Phone = mysqli_real_escape_string($connect, $data[3]);
                $query = "INSERT into register(`ID`,`Name`,`Email`,`Phone`) values('$ID','$Name','$Email','$Phone')";
                mysqli_query($connect, $query);
            }
            fclose($handle);
            echo "<script>alert('Import done');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <div align="center">
            <label>Select CSV File:</label>
            <input type="file" name="file" />
            <br />
            <input type="submit" name="submit" value="Import" class="btn btn-info" />
        </div>
    </form>
</body>
</html>