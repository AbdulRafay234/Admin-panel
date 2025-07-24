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
            $query = mysqli_query($con, "SELECT * FROM `product` WHERE id=$id");
            $row = mysqli_fetch_array($query);
        }
        ?>
        <form action=""  method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="">product_name</label>
                <input type="text" name="pname" id="" value="<?php echo $row[1]?>" class="form-control" placeholder="enter your name" aria-describedby="helpId">
            </div>
            <div class="form-group mb-3">
                <label for="">price</label>
                <input type="text" name="price" id="" value="<?php echo $row[2]?>" class="form-control" placeholder="enter your price" aria-describedby="helpId">
            </div>
            <div class="form-group mb-3">
                <label for="">quantity</label>
                <input type="text" name="qty" id="" value="<?php echo $row[3]?>" class="form-control" placeholder="enter your quantity" aria-describedby="helpId">
            </div>
           <div class="form-group">
                <label for="product-image">select any category</label>
                <select name="cat">
                    <option value="">choose any category</option>
                    <?php
                    $r=mysqli_query($con,"select * from categories");
                    while($c=mysqli_fetch_array($r)){
                        ?>
                        <option value="<?php echo $c[0]?>"><?php echo $c[1]?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="product-image">Choose Image</label>
                <input type="file" id="product-image" value="<?php echo $row[5]?>" name="pimg" accept="image/*" required>
            </div>
            <input type="submit" value="update" name="btn-update" class="btn btn-info">
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['btn-update'])){
  $pname=$_POST['pname'];
  $price=$_POST['price'];
  $qty=$_POST['qty'];
  $catid=$_POST['cat'];
  $addimage=$_FILES['pimg']['name'];
  $addtmpname=$_FILES['pimg']['tmp_name'];
  $destination="img/".$addimage;
  $extension= pathinfo($addimage,PATHINFO_EXTENSION);
      if($extension=="jpg" || $extension=="png" || $extension=="jpeg"){
        if(move_uploaded_file($addtmpname,$destination)){
            $q=mysqli_query($con,"UPDATE `product` SET `product_name`='$pname',`price`='$price',`qty`='$qty',`cat-id`='$catid',`image`='$addimage' WHERE id=$id");
            if($q){
                echo "<script>alert('data updated successfully')
                 location.assign('veiw-product.php');
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