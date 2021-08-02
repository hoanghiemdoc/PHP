<?php
// kiem tra id phan doc truoc khi filter;

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // include config file
    require_once '_config.php';

    // prepare a select statment;

    $sql = "SELECT *FROM employees WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // truyen phan tu vao mot parameters(tham so)
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // set parameters
        $param_id = trim($_GET["id"]);

        // attemp to excue the prepared statment

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 1) {
                //fetch tra ve mot mang. set gia tri boolean co trong no,chung ta ko su dung vong lap while

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // tra ve cac gia tri
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else {
                // ko co gia tri tra ve loi chung o file error.php tong
                header("location: error.php");
                exit();
            }
        } else {
            echo "oops! something went wrong.please try again later";
        }

        // close statment
        mysqli_stmt_close($stmt);

        //close connection
        mysqli_close($link);


    } else {
        // ko co gia tri tra ve loi chung o file error.php tong
        header("location: error.php");
                exit();
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>view record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>

<style type="text/css">
    .wrapper{
        width: 700px;
        margin:  0  auto;
    }
</style>

<body>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>view record</h1>
                </div>
                  <div class="form-group">
                      <label for="">Name</label>
                      <p class="form-control-static"><?php echo $row["name"]; ?></p>
                  </div>

                <div class="form-group">
                    <label for="">address</label>
                    <p class="form-control-static"><?php echo $row["address"]; ?></p>
                </div>

                <div class="form-group">
                    <label for="">salary</label>
                    <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                </div>
                <p><a href="index.php" class="btn btn-primary">Back</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
