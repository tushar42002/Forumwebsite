<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iForum</title>
    <link rel="stylesheet" href="boot5/css/bootstrap.css">
</head>

<body>

    <!-- ------includeing navbar and connecting to database-----  -->
    <?php
       require "partials/dbconnect.php";
       include "partials/navbar.php";
    ?>

    <div class="container my-3">
        <h1 class="text-center my-3">iForum - categories</h1>
        <div class="row">


            <!-- ------------fetching categories from database--------- -->
            <?php    

            
             $sql = "SELECT * FROM `categories`";
             $result = mysqli_query($conn, $sql);
             while ($row = mysqli_fetch_assoc($result)) {

                $id = $row['category_id'];
                $cat = $row['category_name'];
                $description = $row['category_description'];
                echo ' <div class="col-md-4 my-2">
                            <div class="card" style="width: 18rem;">
                                <img src="partials/img/1.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href"threadlist.php?catid='.$id.'">'.$cat.'</a></h5>
                                    <p class="card-text">'.substr($description, 0,30).'....
                                    </p>
                                    <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">Go to threads</a>
                                </div>
                            </div>
                        </div>';
                
               }
                 
             
             
            ?>


        </div>
    </div>






    <script src="boot5/js/bootstrap.js"></script>
</body>

</html>