<html>
<head>
    <title>Search</title>
</head>
<body>

<?php
$Name = '';

if (!empty($_POST['Name'])){
    $Name = $_POST['Name'];
    echo "Finding record, {$_POST['Name']}, and Result";

}

?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    Enter your name : <input type="text" name="Name"/>
    <input type="submit" value="Search"/>
</form>
<?php
$myDB = new mysqli('localhost','root','','listcovid');
if ($myDB->connect_error)
{
    die('Connect Error (' . $myDB->connect_error . ') ' .$myDB->connect_error);
}
if ($Name != '')
{
    $sql = "SELECT * FROM covidlist WHERE Name LIKE '%{$Name}' ORDER BY Name";
}else{
    $sql = "SELECT * FROM covidlist";
}


$result = $myDB->query($sql);
?>
<table cellspacing="2" cellpadding="6" align="center" border="1">
    <tr>
        <td colspan="8">
            <h3 align="center">Danh sach so nguoi cach li</h3>
        </td>
    </tr>
    <tr>
        <td align="center">ID</td>
        <td align="center">Name</td>
        <td align="center">Address</td>
        <td align="center">F</td>
        <td align="center">Location</td>
        <td align="center">start_date</td>
        <td align="center">end_date</td>
    </tr>
    <?php
    while ($row = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>";
        echo stripslashes($row["id"]);
        echo "</td><td align='center'> ";
        echo $row["name"];
        echo "</td><td>";
        echo $row["address"];
        echo "</td><td>";
        echo $row["F"];
        echo "</td><td>";
        echo $row["location"];
        echo "</td><td>";
        echo $row["startDate"];
        echo "</td><td>";
        echo $row["endDate"];
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>