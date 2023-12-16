<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap 5 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets\bootstrap\bootstrap-5.3.2-dist\css\bootstrap.css" rel="stylesheet">
  <script src="assets\bootstrap\bootstrap-5.3.2-dist\js\bootstrap.js"></script>
</head>

<body>

  <div class="row justify-content-center align-items-center h-100">
    <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">

      <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $con = mysqli_connect("localhost", "root", "", "web_app");
        if ($con == true) {

          $qry_show = "select * from std_info where std_id=$id";
          $qry_run = mysqli_query($con, $qry_show);
          if (mysqli_num_rows($qry_run)) {

            while ($row = mysqli_fetch_array($qry_run)) {
              $std_name = $row['std_name'];
              $std_class = $row['std_class'];
              $edit_id = $row['std_id'];

            }
          }
        }
      }
      ?>


      <form method="post" action="save.php">
        <div class="mb-3 mt-3">
          <label for="name" class="form-label">Name:</label>
          <?php if (isset($std_name)) { ?>
            <input type="text" class="form-control" placeholder=" <?php echo $std_name; ?>" name="name">
          <?php } else { ?>
            <input type="text" class="form-control" placeholder="Enter Name" name="name">
          <?php } ?>

        </div>
        <div class="mb-3">
          <label for="class" class="form-label">Class:</label>

          <?php if (isset($std_name)) { ?>
            <input type="text" class="form-control" placeholder=" <?php echo $std_class; ?>" name="class">
          <?php } else { ?>
            <input type="text" class="form-control" placeholder="Enter class" name="class">
          <?php } ?>


        </div>
        <?php if (isset($_GET['id'])) { ?>
          <button type="submit" class="btn btn-info" name="btn_update">Update</button>
          <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>" />
        <?php } else { ?>
          <button type="submit" class="btn btn-success" name="btn_save">Save</button>
        <?php } ?>




      </form>


    </div>
  </div>

  <div class="row justify-content-center align-items-center h-100">

    <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
      <?php
      $con = mysqli_connect("localhost", "root", "", "web_app");
      if ($con == true) {
        $qry_show = "select * from std_info";
      }
      ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $qry_run = mysqli_query($con, $qry_show);
          if (mysqli_num_rows($qry_run)) {
            while ($row = mysqli_fetch_array($qry_run)) {
              ?>
              <tr>
                <td>
                  <?php echo $row['std_id']; ?>
                </td>
                <td>
                  <?php echo $row['std_name']; ?>
                </td>
                <td>
                  <?php echo $row['std_class']; ?>
                </td>

                <td> <a href="index.php?id=<?php echo $row['std_id']; ?>" class="btn btn-primary">Edit</a></td>
                <td>
                  <form action="save.php" method='post'>
                    <input type="hidden" name="del_id" value="<?php echo $row['std_id']; ?>" />
                    <button type="submit" class="btn btn-danger" name="btn_delete">Delete</button>

                  </form>


                </td>

              </tr>
              <?php
            }
          }
          ?>
    </div>
  </div>
</body>

</html>