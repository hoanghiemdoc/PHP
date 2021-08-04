<?php
// thuc hien xoa phan tu
if (isset($_POST["id"]) && !empty($_POST["id"])){
    // include config file
    require_once 'configCovid.php';

    // lua chon mot phan tu xoa trong sql
    $sql ="DELETE FROM covidlist WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // set lai phan tu
        $param_id = trim($_POST["id"]);

        // truyen cac phan tu lai
        if (mysqli_stmt_execute($stmt)) {
            // xoa ban ghi tren data thanh cong load lai trang
            header("location: indexCovid.php");
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
    <!-- Latest compiled and minified CSS -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
    <!---->
    <!--    <!-- Optional theme -->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->
    <!---->
    <!--    <!-- Latest compiled and minified JavaScript -->
    <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->

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

                <div class="alert alert-danger" role="alert">
                    <input type="hidden" name="id" value="<?php echo trim($_GET["id"]);?>" />
                    <p>are you sure want to delete this record</p><br>
                    <p>
                        <input type="submit" value="Yes" class="btn btn-danger">
                        <a href="indexCovid.php" class="btn btn-warning">no</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>


