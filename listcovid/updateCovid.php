<?php
// include config file

require_once 'configCovid.php';

// goi cac gia tri set ve gtri rong

$name = $address = $F = $location = $startDate = $endDate = "";
$name_err = $address_err = $F_err = $location_err = $startDate_err = $endDate_err = "";



// set data khi submit from
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // lay gia tri id va an di

    $id = $_POST["id"];

    // valid name moi;

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "please enter a name";
    } elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => "/^[a-zA-Z'-.\s ]+$/")))) {
        $name_err = "please enter a name valid giong nhau vui long nhap lai";
    } else {
        $name = $input_name;
    }

    // valid form address
    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "please enter an address";
    } else {
        $address = $input_address;
    }

    // valid form F0,F1,F2
    $input_F = trim($_POST["F"]);
    if (empty($input_F)) {
        $F_err = "please enter the f0,f1,f2";
    }else {
        $F = $input_F;
    }

    // valid location
    $input_location = trim($_POST["location"]);
    if (empty($input_location)) {
        $location_err = "please enter an location";
    } else {
        $location = $input_location;
    }

    $input_startDate = trim($_POST["startDate"]);
    if (empty($input_startDate)) {
        $startDate_err = "please enter start date move";
    } else {
        $startDate = $input_startDate;
    }

    $input_endDate = trim($_POST["endDate"]);
    if (empty($input_endDate)) {
        $endDate_err = "please enter end date move";
    } else {
        $endDate = $input_endDate;
    }


    // check input errors before inserting in database
    if (empty($name_err) && empty($address_err) && empty($F_err) && empty($location_err) && empty($startDate_err) && empty($endDate_err)) {
        //  insert id phan tu trong database
        $sql = "UPDATE covidlist SET name= ?, address=?, F=? ,location=?,startDate=?,endDate=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // truyen cac phan tu cac parameter vao
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_name, $param_address,$param_F,$param_location,$param_startDate,$param_endDate, $param_id);

            // set parameters
            $param_name = $name;
            $param_address = $address;
            $param_F = $F;
            $param_location = $location;
            $param_startDate = $startDate;
            $param_endDate = $endDate;
            $param_id = $id;

            // truyen cac phan tu lai

            if (mysqli_stmt_execute($stmt)) {
                // khi update thanh cong loading lai trang
                header("location:indexCovid.php");
                exit();
            } else {
                echo "something went wrong. please try again later";

            }

        }
        // close statement
        mysqli_close($stmt);
    }

    // close conection
    mysqli_close($link);

} else {
    // check exittence of id paramter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // get URL parameter
        $id = trim($_GET["id"]);

        // lay du lieu id tren form day len database
        $sql = "SELECT * FROM covidlist WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // bind variables to the preared statment as parameter
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // set parameter ID
            $param_id = $id;

            // attempt to excue the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) === 1) {
                    //fetch tra ve mot mang. set gia tri boolean co trong no,chung ta ko su dung vong lap while

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // tra ve cac gia tri
                    $name = $row["name"];
                    $address = $row["address"];
                    $F = $row["F"];
                    $location = $row["location"];
                    $startDate = $row["startDate"];
                    $endDate = $row["endDate"];
                } else {
                    // ko co gia tri tra ve loi chung o file error.php tong
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "oops! something went wrong.please try again later";
            }

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
    <title>update cord</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


</head>
<style type="text/css">
    .wrapper {
        width: 700px;
        margin: 0 auto;
    }
</style>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="page-header">
                <h2 class="mb-3">update record</h2>
            </div>
            <p class="mb-3">please fill this form list covid and submit to add employee record to the database</p>

            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <div class="form-group  <?php echo (!empty($name_err)) ? 'has-error' : '';?>">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                    <span class="help-block"><?php echo $name_err; ?> </span>
                </div>

                <div class="form-group <?php echo (!empty($address_err)) ? "has-error" : '';?>">
                    <label for="">address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                    <span class="help-block"><?php echo $address_err; ?> </span>
                </div>

                <div class="form-group <?php echo (!empty($F_err)) ? "has-error" : '';?>">
                    <label for="">F</label>
                    <input type="text" name="F" class="form-control" value="<?php echo $F; ?>">
                    <span class="help-block"><?php echo $F_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($location_err)) ? "has-error" : '';?>">
                    <label for="">location</label>
                    <input type="text" name="location" class="form-control" value="<?php echo $location; ?>">
                    <span class="help-block"><?php echo $location_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($startDate_err)) ? "has-error" : '';?>">
                    <label for="">startDate</label>
                    <input type="text" name="startDate" class="form-control" value="<?php echo $startDate; ?>">
                    <span class="help-block"><?php echo $startDate_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($endDate_err)) ? "has-error" : '';?>">
                    <label for="">endDate</label>
                    <input type="text" name="endDate" class="form-control" value="<?php echo $endDate; ?>">
                    <span class="help-block"><?php echo $endDate_err; ?></span>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" class="btn btn-primary" value="submit">
                <a href="indexCovid.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>

