<?php
   session_start();

   echo'<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
   <div class="container-fluid ">
       <a class="navbar-brand" href="#">Navbar</a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
           aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                   <a class="nav-link active" aria-current="page" href="/forum/index.php">Home</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="#">about</a>
               </li>
               <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 Dropdown
               </a>
               <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                
                $sql = "SELECT category_name, category_id FROM `categories`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo'<li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
                }
               echo'</ul>
           </ul>   
           <form class="d-flex" action="search.php" method="get">
               <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
               <button class="btn btn-outline-light me-2" type="submit">Search</button>
           </form>';
           if (isset( $_SESSION['loggedin']) &&  $_SESSION['loggedin'] == true) {
               echo' <p class="mx-1 text-white">welcome '. $_SESSION['user'].'</p>
               <a href="partials/logout.php" class="btn btn-outline-light me-2">log out</a>
               ';
               
           }else {
               echo' <button class="btn btn-outline-light me-2" type="submit"   data-bs-toggle="modal" data-bs-target="#loginModal">login</button>
                     <button class="btn btn-outline-light" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">signup</button>';

           }
           
           

    echo'</div>
   </div>
</nav>';
include "partials/loginModal.php";
include "partials/signupModal.php";

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='true') {
    echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
           <strong>successfull!</strong>  user is registerd.
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
}
   
?>