<?php

 // Step 2: Connect to the database to PHP
 $database = connectToDB();

 // Step 3: get all the data from the form using $_POST
 $email = $_POST["email"];
 $password = $_POST["password"];

 // Step 4: error checking
  if ( empty( $email ) || empty( $password ) ) {
    setError( "All the fields are required.", "/login" );
  } else {
  // Step 5: login the user
   // 5.1 - retrieve the user data from your users table using the email provided by the user
    // 5.1.1 - sql command (recipe)
    $sql = "SELECT * FROM users WHERE email = :email";
    // 5.1.2 - prepare
    $query = $database->prepare($sql);
    // 5.1.3 - execute
    $query->execute([
      'email' => $email
    ]);
    // 5.1.4 - fetch 
    $user = $query->fetch(); // get only one row of data
    
    // 5.2 - make sure the $user is not empty
    if ( empty( $user ) ) {
      $_SESSION["error"] ="The email provided does not exists";
      // redirect back to login page
      header("Location: /login");
      exit;
      } else {
        // 5.3 - make sure the password is correct
        if ( password_verify( $password, $user["password"] ) ) {
          // 5.4 - if password is valid, login the user
          $_SESSION["user"] = $user;

          // Step 6: redirect back to home page
          header("Location: /");
          exit;
        } else {
          setError( "The password provided is incorrect", "/login" );
        }
      }


}

