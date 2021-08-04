<?php
require_once 'configCovid.php';

$name = $address = $f = $location = $startDate = $endDate = "";
$name_err = $address_err = $f_err = $location_err = $startDate_err = $endDate_err = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate name

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
    $input_f = trim($_POST["f"]);
    if (empty($input_f)) {
        $f_err = "please enter the f0,f1,f2";
    }else {
        $f = $input_f;
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


    // check dieu kien cua cac form trong database
    if (empty($name_err) && empty($address_err) && empty($f_err) && empty($location_err) && empty($startDate_err) && empty($endDate_err)) {
        // chuan bij insert mot phan tu database
        $sql = "INSERT INTO covidlist(name,address,f,location,startDate,endDate) VALUES (?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // truyen tham so tu values tren vao parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_address,$param_f,$param_location,$param_startDate,$param_endDate);

            // set paramaters
            $param_name = $name;
            $param_address = $address;
            $param_f = $f;
            $param_location = $location;
            $param_startDate = $startDate;
            $param_endDate = $endDate;

            // lien ket sql cac phan tu
            if (mysqli_stmt_execute($stmt)) {
                // records creadted successfully redicrect to  landing page
                header("location:indexCovid.php");
                exit();
            } else {
                echo "something went wrong. please try again later";
            }

        }
        // close statment
        mysqli_stmt_close($stmt);
    }
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
    <title>update PHP</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


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
            <div class="col-md-12">
                <div class="page-header">
                    <h2 class="text-center mb-3">Create  list covid</h2>
                </div>
                <p class="mb-3">please fill this form list covid and submit to add employee record to the database</p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group  <?php echo (!empty($name_err)) ? 'has-error' : '';?>">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="">
                        <span class="help-block"><?php echo $name_err; ?> </span>
                    </div>

                    <div class="form-group <?php echo (!empty($address_err)) ? "has-error" : '';?>">
                        <label for="">address</label>
                        <input type="text" name="address" class="form-control" value="">
                        <span class="help-block"><?php echo $address_err; ?> </span>
                    </div>

                    <div class="form-group <?php echo (!empty($f_err)) ? "has-error" : '';?>">
                        <label for="">f</label>
                        <input type="text" name="f" class="form-control" value="">
                        <span class="help-block"><?php echo $f_err; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($location_err)) ? "has-error" : '';?>">
                        <label for="">location</label>
                        <input type="text" name="location" class="form-control" value="">
                        <span class="help-block"><?php echo $location_err; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($startDate_err)) ? "has-error" : '';?>">
                        <label for="">startDate</label>
                        <input type="date" name="startDate" class="form-control" value="">
                        <span class="help-block"><?php echo $startDate_err; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($endDate_err)) ? "has-error" : '';?>">
                        <label for="">endDate</label>
                        <input type="date" name="endDate" class="form-control" value="">
                        <span class="help-block"><?php echo $endDate_err; ?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" value="submit">
                    <a href="indexCovid.php" class="btn btn-danger">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
