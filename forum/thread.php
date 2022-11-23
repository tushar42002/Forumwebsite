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


    <!-- -------------------- thread info from from database --------- -->
    <?php   
        $id = $_GET['threadid'];
        $sql = " SELECT * FROM `threads` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {

        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $time = $row['timestemp'];

        }
       
    ?>

    <!-- --------------this is used to print what is a question user asked---------- -->

    <div class="container my-1">
        <div class="p-2 mb-2 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h5 class="display-6 fw-bold"><?php echo $title;  ?></h5>
                <p class="col-md-8 fs-4"><?php echo $desc;   ?></p>
                <p class="display-7"><b>Posted by : Tushar</b></p>
                <p>At <?php echo substr($time, 0 ,16) ?></p>
            </div>
        </div>
    </div>


    <!-- -------------------add comments to user's question  ------------------ -->

    <!-- adding comment to database -->
    <?php
       $showAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
       if ($method == 'POST') {
        // insert data to database

        $comment = $_POST['comment'];
        $user_sno = $_POST['sno'];

        $comment = str_replace("<","&lt", $comment);
        $comment = str_replace(">","&gt", $comment);

       

        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment ', '$id', '$user_sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> successfull! </strong> your comment ass been added.
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

    <!-- -----------------form for comments---------------- -->

    <div class="container">
        <h1>Add your comment </h1>

        <!-- ---------$_SERVER['REQUST_URI'] IS USED TO SUBMIT ON THIS PAGE $_SERVER['PHP_SELF'] is also used but does not add like ?catid=$id after filename.php but --- $_SERVER['REQUST_URI'] will add -->

      <?php
        if (isset( $_SESSION['loggedin']) &&  $_SESSION['loggedin'] == true) {
        echo'   <form action="'. $_SERVER["REQUEST_URI"].'" method="post">
                   <div class="mb-3">
                       <label for="exampleFormControlTextarea1" class="form-label">Problem description</label>
                       <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="enter your comment here" required></textarea>
                       <input type="hidden" name="sno" value="'. $_SESSION['sno'].'">
                   </div>
                   <button type="submit" class="btn btn-primary">post comment</button>
                </form>';
        }else{
           echo' <h3>plese login to post a comment</h3>';
           
        }
      ?>         
    </div>





    <!-- ----------------showing comments--------------------- -->

    <div class="container">
        <h1>Discussions</h1>


         <?php   
            $id = $_GET['threadid'];
            $sql = " SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
              
            while ($row = mysqli_fetch_assoc($result)) {

                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $thread_user_id = $row['comment_by'];

                $sql2 = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                echo'<div class="d-flex">
                         <div class="flex-shrink-0 mt-1 rounded">
                             <img class="rounded-circle" src="partials/img/1.jpg" width="40px" height="40px" alt="...">
                         </div>
                         <div class="flex-grow-1 ms-3">
                             <h4 class="mt-0">'.$row2['user_name'].'</h4>
                             <p>'.$content.'</p>
                             <hr>
                         </div>
                     </div>';
            }
            
            if ($noResult) {
                echo'no question for that category';
        
            }
            
            
        ?>

    </div>






    <script src="boot5/js/bootstrap.js"></script>
</body>

</html>