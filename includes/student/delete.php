<?php

   // Step 2: connect to the database
   $database = connectToDB();

  // step 3: get student ID from the $_POST
  $student_id = $_POST["student_id"];

  // step 4: delete the student from the database using student ID
    // 4.1 - sql command (recipe)
    $sql = "DELETE FROM students where id = :id";
    // 4.2 - prepare (put everything into the bowl)
    $query = $database->prepare($sql);
    // 4.3 - execute (cook it)
    $query->execute([
        'id' => $student_id
    ]);

  // Step 5: redirect back to home page
  header("Location: /");
  exit;