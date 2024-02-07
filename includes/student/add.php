<?php

  // Step 1: list out all the database info
  $host = 'devkinsta_db';
  $database_name = 'Classroom_Management';
  $database_user = 'root';
  $database_password = 'sU3R6Rm2wtOI8xQA';


  // Step 2: connect to the database
    $database = connectToDB();

  // Step 3: grab the name from $POST
    $student_name = $_POST["student_name"];

    // do error checking and check if $student_name is empty or not
    if ( empty( $student_name ) ) {
      echo 'Please enter a name';
    } else {

  // Step 4: add the name into the database
    //4.1 - sql command
    $sql = 'INSERT INTO students(`name`) VALUES (:name)';
    // 4.2 -prepare
    $query = $database ->prepare($sql);
    // 4.3 - execute
    $query-> execute([
        'name' => $student_name
    ]);

  // Step 5: redirect the user back to home page
   header("Location: /");
   exit;
  }

