<?php
// include config file
require_once '_config.php';

// define variable and initialize with empty values

$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

// nhan yeu cau gui tu from data khi an submit

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

    // valid form salary
    $input_salary = trim($_POST["salary"]);
    if (empty($input_salary)) {
        $salary_err = "please enter the salary amount";
    } elseif (!ctype_digit($input_salary)) {
        $salary_err = "please enter a positive integer value";
    } else {
        $salary = $input_salary;
    }

    // check dieu kien cua cac form trong database
    if (empty($name_err) && empty($address_err) && empty($salary_err)) {
        // chuan bij insert mot phan tu database
        $sql = "INSERT INTO employees(name,address,salary) VALUES (?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // truyen tham so tu values tren vao parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address,$param_salary);

            // set paramaters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            // lien ket sql cac phan tu
            if (mysqli_stmt_execute($stmt)) {
                // records creadted successfully redicrect to  landing page
                header("location: index.php");
                exit();
            } else {
                echo "something went wrong. please try again later";
            }

        }

        // close statment
        mysqli_stmt_close($stmt);
    }

    // close connection
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
                    <h2 class="text-center mb-3">Create Record</h2>
                </div>
                <p class="mb-3">please fill this form and submit to add employee record to the database</p>

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

                <div class="form-group <?php echo (!empty($salary_err)) ? "has-error" : '';?>">
                    <label for="">salary</label>
                    <input type="text" name="salary" class="form-control" value="">
                    <span class="help-block"><?php echo $salary_err; ?></span>
                </div>

                <input type="submit" class="btn btn-primary" value="submit">
                <a href="index.php" class="btn btn-danger">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
