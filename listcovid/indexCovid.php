
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>list COVID</title>
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
                    <h2 class="text-center pull-left mb-3">list Covid nguoi cach ly</h2>

                    <form class="d-flex mb-3">
                        <button  class="btn btn-outline-success" type="submit"><a href="search.php">Search</a></button>
                        <a href="create.php" style="margin-left: 10px;margin-top: 5px" class="btn btn-success pull-right mb-3 ">add new listCOVID</a>
                    </form>
                </div>
                <?php
                     require_once 'configCovid.php';
                         //lien ket sql voi php
                     $sql ="SELECT * FROM covidList";
                     if ($result = mysqli_query($link,$sql)){
                         if (mysqli_num_rows($result) >0) {
                             echo "<table class='table table-bordered table-striped'>";
                             echo "<thead>";
                             echo "<tr>";
                             echo "<th>#</th>";
                             echo "<th>name</th>";
                             echo "<th>Address</th>";
                             echo "<th>F</th>";
                             echo "<th>location</th>";
                             echo "<th>startDate</th>";
                             echo "<th>endDate</th>";
                             echo "<th>Action</th>";
                             echo "</tr>";
                             echo "<thead>";
                             echo "<tbody>";
                               while ($row = mysqli_fetch_array($result)){
                                   echo "<tr>";
                                   echo "<td>" .$row['id']."</td>";
                                   echo "<td>" .$row['name']."</td>";
                                   echo "<td>" .$row['address']."</td>";
                                   echo "<td>" .$row['F']."</td>";
                                   echo "<td>" .$row['location']."</td>";
                                   echo "<td>" .$row['startDate']."</td>";
                                   echo "<td>" .$row['endDate']."</td>";
                                   echo "<td>";
                                   echo "<a href='updateCovid.php?id=" . $row['id']
                                       . " title='View Record' data-toggle='tooltip'>
                                <span class='glyphicon glyphicon-pencil'><i class='fas fa-pencil-alt'></i></span></a>";

                                   echo "<a href='deleteCovid.php?id=" . $row['id']
                                       . " title='View Record' data-toggle='tooltip'>
                                <span ><i class='fas fa-trash'></i></span></a>";
                                   echo "</td>";

                               }
                             echo "</tbody>";
                             echo "</table>";
                             mysqli_free_result($result);

                         } else{
                             echo "<p class='lead'><em>no records list covid</em></p>";
                         }
                     }  else {
                         echo "ERROR: could not available to excue list covid $sql." . mysql_error($link);
                     }
                     mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>




</body>
</html>
