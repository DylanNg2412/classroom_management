<?php

 // Step 1: Connect to the database to PHP
 $database = connectToDB();

 // Step 2: Load the data from the database
   // Step 2.1: -prepare the recipe (SQL command)
   $sql = "SELECT * FROM students";
   // Step 2.2: -pour everything in the bowl (prepare your database)
   $query = $database->prepare($sql);
   // Step 2.3 -cook it
   $query->execute();
   // Step 2.4 - eat it (fetch all)
   $students = $query -> fetchAll();
?>
<?php require "parts/header.php"; ?>
  <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px;">
      <div class="card-body">
        <h3 class="card-title mb-3">My Classroom</h3>

        <?php if ( isset( $_SESSION["user"] ) ) : ?>
        <div class="d-flex gap-2 align-items-center">
          <span>User : <?= $_SESSION["user"]["name"]; ?></span>
          <a href="/logout" class="btn btn-link p-0" id="login">Logout</a>
        </div>
        <?php require "parts/error_box.php"; ?>
        <form method="POST" action="/student/add">
          <div class="mt-4 d-flex justify-content-between">
            <input
              type="text"
              class="form-control"
              placeholder="Add new student..."
              name="student_name"
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </div>
        </form>
        <?php else : ?>
          <div class="d-flex justify-content-center">
            <a href="/login" class="btn btn-link" id="login">Login</a>
            <a href="/signup" class="btn btn-link" id="signup">Sign Up</a>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if ( isset( $_SESSION["user"] ) ) : ?>
    <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px;">
      <div class="card-body">
        <h3 class="card-title mb-3">Students</h3>        
        <!--To render the $students data using foreach -->
        <?php foreach ( $students as $index => $student): ?>
          <div class="d-flex align-items-center gap-2 mt-3">
            <div class="d-flex gap-1">
              <span><?= $index+1; ?>.</span> 
            </div>            
              <!-- update student -->
              <form method="POST" action="/student/update" class="d-flex gap-1">
                <input 
                  type="text"
                  name="student_name"
                  value="<?= $student["name"]; ?>"
                  required
                  />
                  <input 
                  type="hidden"
                  name="student_id"
                  value="<?= $student["id"]; ?>" />
                <button class="btn btn-success btn-sm">Update</button>
              </form>
              <!-- delete student -->
              <form method="POST" action="/student/delete">
                <input 
                  type="hidden"
                  name="student_id"
                  value="<?= $student["id"]; ?>" />
                <button class="btn btn-danger btn-sm">Delete</button>
              </form>            
          </div>
        <?php endforeach; ?>        
      </div>
    </div>
    <?php endif; ?>

    <?php 
    require "parts/footer.php";
