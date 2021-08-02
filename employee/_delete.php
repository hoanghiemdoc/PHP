<?php
 // thuc hien xoa phan tu
  if (isset($_POST["id"]) && !empty($_POST["id"])){
      // include config file
      require_once '_config.php';

      // lua chon mot phan tu xoa trong sql
      $sql ="DELETE FROM employees WHERE id = ?";

      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "i", $param_id);

          // set lai phan tu
          $param_id = trim($_POST["id"]);

          // truyen cac phan tu lai
          if (mysqli_stmt_execute($stmt)) {
              // xoa ban ghi tren data thanh cong load lai trang
              header("location: index.php");
              exit();
          } else{
              echo "sai cu phap hoac noi vui long thu lai";
          }

      }
      // close lai phan tu
      mysqli_stmt_close($stmt);

      //close connection
      mysqli_close($link);
  }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style type="text/css">
    .wrapper{
        width: 700px;
        margin: 0 auto;
    }
</style>
<body>
  <div class="wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <h3 class="mb-3">delete record</h3>
              </div>

              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                     <div class="alert alert-danger fade in">
                         <input type="hidden" name="id" value="<?php echo trim($_GET["id"]);?>" />
                         <p>are you sure want to delete this record</p><br>
                         <p>
                             <input type="submit" value="Yes" class="btn btn-danger">
                             <a href="index.php" class="btn btn-default">no</a>
                         </p>
                     </div>
              </form>
          </div>
      </div>
  </div>
</body>
</html>
