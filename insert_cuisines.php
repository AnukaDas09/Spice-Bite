<?php
include('../functions/connect.php');
if (isset($_POST['insert_cui'])) //if this button is clicked
{
  $cuisine_title = $_POST['cuisine_title']; //accessing data inserted into the from and storing it in a variable.
  //selecting data from database
  $select_query = "Select * from `cuisines` where cuisine_title='$cuisine_title'"; //matching inserted data with rows in database
  $result_select = mysqli_query($con, $select_query);
  $number = mysqli_num_rows($result_select); //counting the number of rows with same data
  if ($number > 0) //if data is already present in the database
  {
    echo "<script>alert('cuisine is already present')</script>"; //alert will be displayed
  } else //if data is not present in the database data will be entered
  {
    $insert_query = "insert into `cuisines`(cuisine_title) value('$cuisine_title')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
      echo "<script>alert('cuisine has been inserted successfully')</script>"; //showing popup
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Cuisine</title>
</head>

<body>
  <h3 class="text-center">Insert cuisines</h3>
  <form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
      <span class="input-group-text bg-warning" id="basic-addon1">
        <i class="fa-solid fa-receipt"></i></span>
      <input type="text" class="form-control" name="cuisine_title" placeholder="Insert cuisines" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2">
      <input type="submit" class="bg-danger border-1 p-2" name="insert_cui" value="Insert Cuisine">
    </div>
  </form>
</body>

</html>