<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-2" >
        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = mysqli_query($con, "SELECT * FROM `categories` WHERE id=$id");
            $row = mysqli_fetch_array($query);
        }
        ?>
        <form action=""  method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="">Categories_name</label>
                <input type="text" name="cname" id="" value="<?php echo $row[1]?>" class="form-control" placeholder="enter your name" aria-describedby="helpId">
            </div>
            <div class="form-group mb-3">
                <label for="">Categories_description</label>
                <input type="text" name="cdes" id="" value="<?php echo $row[2]?>" class="form-control" placeholder="enter your description" aria-describedby="helpId">
            </div>
            <div class="form-group mb-3">
                <label for="product-image">Choose Image</label>
                <input type="file" id="product-image" value="<?php echo $row[3]?>" name="cimg" accept="image/*" required>
            </div>
            <input type="submit" value="update" name="btn-update" class="btn btn-info">
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['btn-update'])){
  $cname=$_POST['cname'];
  $cdes=$_POST['cdes'];
  $addimage=$_FILES['cimg']['name'];
  $addtmpname=$_FILES['cimg']['tmp_name'];
  $destination="img/".$addimage;
  $extension= pathinfo($addimage,PATHINFO_EXTENSION);
      if($extension=="jpg" || $extension=="png" || $extension=="jpeg"){
        if(move_uploaded_file($addtmpname,$destination)){
            $q=mysqli_query($con,"UPDATE `categories` SET `Categories_name`='$cname',`Categories_description`='$cdes',`Categories_img`='$addimage' WHERE id=$id");
            if($q){
                echo "<script>alert('data updated successfully')
                 location.assign('veiw.php');
                </script>";

            } else {
                echo "<script>alert('Failed to update');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    } else {
        echo "<script>alert('Invalid format');</script>";
    }

}
?>