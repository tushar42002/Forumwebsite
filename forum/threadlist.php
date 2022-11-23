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
       include "partials/dbconnect.php";
       include "partials/navbar.php";
    ?>


   <!-- --------------data related to category --------  -->
    <?php   
        $id = $_GET['catid'];
        $sql = " SELECT * FROM `categories` WHERE category_id=$id";
        $result = mysqli_query($conn, $sql);
    
        while ($row = mysqli_fetch_assoc($result)) {
       
        $catname = $row['category_name'];
        $catdescription = $row['category_description'];

        }
       
    ?>

    <!-- --------php for posting/add question---- -->
    <?php
       $showAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
       if ($method == 'POST') {
        // insert data to database

        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_desc = str_replace("<","&lt", $th_desc);
        $th_desc = str_replace(">","&gt", $th_desc);

        $th_title = str_replace("<","&lt", $th_title);
        $th_title = str_replace(">","&gt", $th_title);

        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestemp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp()) ";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> successfull! </strong> your query has been added.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'; 
                }else {
            echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong> ERROR!</strong> somthing is wrong try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        

       }
    ?>

   

    <div class="container my-3">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold"><?php echo $catname;  ?></h1>
                <p class="col-md-8 fs-4"><?php echo $catdescription;   ?></p>
                <button class="btn btn-primary btn-lg" type="button">Example button</button>
            </div>
        </div>
    </div>
              
         <!-- ---------- posting/add question html ------- -->
    <div class="container">
        <h1>Ask a Question</h1>

        <!-- ---------$_SERVER['REQUST_URI'] IS USED TO SUBMIT ON THIS PAGE $_SERVER['PHP_SELF'] is also used but does not add like ?catid=$id after filename.php but --- $_SERVER['REQUST_URI'] will add -->

       <?php
            if (isset( $_SESSION['loggedin']) &&  $_SESSION['loggedin'] == true) {
          echo' <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">keep your title as short as possible</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Problem description</label>
                        <input type="hidden" name="sno" value"'.$_SESSION['sno'].'">
                        <textarea class="form-control" id="desc" name="desc" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Query</button>
                </form>';   
            }else{
                echo'<h3>please login to post your question</h3>';
            }
       ?>     
    </div>



    <!-- ----------- all the question------ -->
    <div class="container my-3">
        <h1>Browse Question</h1>
        <?php   
            $id = $_GET['catid'];
            $sql = " SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
              
            while ($row = mysqli_fetch_assoc($result)) {

                $noResult = false;
                $id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_user_id = $row['thread_user_id'];

                $sql2 = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);


                echo'<div class="d-flex">
                         <div class="flex-shrink-0 mt-1 rounded">
                             <img class="rounded-circle" src="partials/img/1.jpg" width="40px" height="40px" alt="...">
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h2 class="mt-0">'.$row2['user_name'].'</h2>
                             <h4 class="mt-0"><a href="thread.php?threadid='.$id.'">'.$title.'</a></h4>
                             <p>'.$desc.'</p>
                             <hr>
                         </div>
                     </div>';
            }
            
            if ($noResult) {
                echo'no question for that category';
        
            }
            
            
        ?>


    </div>




    <footer class="pt-3 mt-4 text-light text-center pb-3 bg-dark border-top">
        all the &copy; copyright are reserved to trilok since 2022
    </footer>

    <script src="boot5/js/bootstrap.js"></script>
</body>

</html>