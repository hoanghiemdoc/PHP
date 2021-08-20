<?php
$myDB= new mysqli('localhost','root','','library');
if ($myDB->connect_error)
{
    die('Connect Error (' . $myDB->connect_error . ') ' . $myDB->connect_error);
}
$sql = "SELECT * FROM books WHERE available = 1 ORDER BY title";
$result = $myDB->query($sql);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dethi PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .page-header h2 {
            margin-top: 0;
        }
        table tr td:last-child  {
            margin-right: 10px;
        }
        table tr td:last-child:hover  {
            margin-right: 10px;
            background: #ddd;
        }

    </style>
</head>
<body>
<table cellspacing="2" cellpadding="6" align="center" border="1">
    <tr>
        <td colspan="4">
            <h3 style="color:#00bf00" align="center">These Books are currently available</h3>
        </td>
    </tr>
    <tr>
        <td align="center">Title</td>
        <td align="center">Year Published</td>
        <td align="center">ISBN</td>
    </tr>

    <?php
    while ($row = $result->fetch_assoc() )
    {
        echo "<tr>";
        echo "<td>";
        echo stripslashes($row["title"]);
        echo "</td><td align='center'>";
        echo $row["pub_year"];
        echo "</td><td>";
        echo $row["ISBN"];
        echo "</td>";
        echo "</tr>";

    }
    ?>
</table>
</body>
</html>