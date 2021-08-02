<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table C,R,U,D </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .wrapper {
            width: 700px;
            margin: 0 auto;
        }

        .page-header h2 {
            margin-top: 0;
        }

        table tr td:last-child a {
            margin-right: 10px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="text-center pull-left mb-3">Employees details</h2>
                    <a href="_create.php" class="btn btn-success pull-right mb-3">add new employee</a>
                </div>

                <?php
                // include config file
                require_once '_config.php';
                //attempt select query execution
                $sql = "SELECT * FROM employees";
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Name</th>";
                        echo "<th>Address</th>";
                        echo "<th>Salary</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "<thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['address'] ."</td>";
                            echo "<td>" . $row['salary'] ."</td>";
                            echo "<td>";
                            echo "<a href='read.php?id=" . $row['id']
                                . " title='View Record' data-toggle='tooltip'>
                                <span class='glyphicon glyphicon-eye-open'><i class='fas fa-eye'></i></span></a>";

                            echo "<a href='_update.php?id=" . $row['id']
                                . " title='View Record' data-toggle='tooltip'>
                                <span class='glyphicon glyphicon-pencil'><i class='fas fa-pencil-alt'></i></span></a>";

                            echo "<a href='delete.php?id=" . $row['id']
                                . " title='View Record' data-toggle='tooltip'>
                                <span ><i class='fas fa-trash'></i></span></a>";
                            echo "</td>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                        // giai phong tai nguyen
                        mysqli_free_result($result);
                    } else {
                        echo "<p = class='lead'><em>no records were found</em></p>";
                    }

                } else {
                    echo "ERROR: could not available to excue $sql." . mysql_error($link);
                }

                // close connection
                mysqli_close($link);
                ?>

            </div>
        </div>
    </div>
</div>


</body>
</html>
