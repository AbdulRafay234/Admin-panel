<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: auto;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #495057;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            border-color: #80bdff;
            outline: none;
        }

        .form-group input[type="file"] {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: 100%;
            background-color: #f8f9fa;
        }

        .form-group input[type="file"]:hover {
            background-color: #e2e6ea;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 15px;
            color: #6c757d;
        }
    </style>

</head>

<body id="page-top">

 <?php
 include ("asside.php");
 ?>   

    <div class="form-container">
        <form class="product-form" method="post" enctype="multipart/form-data">
            <h2>Add Categories</h2>
            <div class="form-group">
                <label for="product-name">Categories Name</label>
                <input type="text" id="product-name" name="pname" required>
            </div>
            <div class="form-group">
                <label for="product-description">Categories Description</label>
                <textarea id="product-description" name="pdes" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="product-image">Choose Image</label>
                <input type="file" id="product-image" name="pimg" accept="image/*" required>
            </div>
            <button type="submit" value="add" name="btn">Upload</button>
            <p class="message">Need help? <a href="#">Contact Support</a></p>
        </form>
    </div>



            <!-- Footer -->
          <?php
          include("footer.php");
          ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>

<?php
if(isset($_POST['btn'])){
    $addname=$_POST['pname'];
    $adddes=$_POST['pdes'];
    $addimage=$_FILES['pimg']['name'];
    $addtmpname=$_FILES['pimg']['tmp_name'];
    $destination="img/".$addimage;
    $extension= pathinfo($addimage,PATHINFO_EXTENSION);
    if($extension=="jpg" || $extension=="png" || $extension=="jpeg"){
        if(move_uploaded_file($addtmpname,$destination)){
            $q=mysqli_query($con,"INSERT INTO `categories`(`Categories_name`, `Categories_description`, `Categories_img`) VALUES ('$addname','$adddes','$addimage')");
            if($q){
                echo "<script>alert('Category added successfully');</script>";
            } else {
                echo "<script>alert('Failed to add category');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    } else {
        echo "<script>alert('Invalid format');</script>";
    }


}
?>