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


    <h1 class="text-center my-3">search result " python"</h1>
    <div class="container my-3">

    <?php
        
        $noresult = true;
        $query = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE match(thread_title, thread_desc) against('$query')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = 'thread.php?threadid='. $thread_id;

            $noresult = false;

            // display the results of search
            echo'<div class="flex-grow-1 ms-3">
                   <h3 class="mt-0"><a href="'. $url .'"> '. $title .'</a></h3>
                   <p>'.$desc.'</p>
                   <hr>
                </div>';
        }

        if ($noresult) {
          echo'  <div class="container my-1">
                    <div class="p-2 mb-2 bg-light rounded-3">
                        <div class="container-fluid py-2">
                            <h5 class="display-6 fw-bold">no results found</h5>
                        </div>
                    </div>
                </div>';
        }

    ?>
        

    </div>






    <script src="boot5/js/bootstrap.js"></script>
</body>

</html>