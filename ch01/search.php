<html>
<head>
    <title>Search | BookStore</title>
</head>
<body>
<?php
$title = '';
if (!empty($_POST['title'])){
    $title = $_POST['title'];
    echo "Finding record, {$_POST['title']}, and Result";
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    Enter your name : <input type="text" name="title"/>
    <input type="submit" value="Search"/>
</form>

<?php
$myDB= new mysqli('localhost','root','','library');
// make sure the above credentials are correct for your environment
if ($myDB->connect_error)
{
    die('Connect Error (' . $myDB->connect_error . ')' . $myDB->connect_error);
}

if ($title != '')
{
    $sql = "SELECT * FROM books WHERE available = 1 AND title LIKE '%{$title}%'
        ORDER BY title";
}else{
    $sql = "SELECT * FROM books WHERE available = 1 ORDER BY title";
}
$result = $myDB->query($sql);
?>

<table cellspacing="2" cellpadding="6" align="center" border="1">
    <tr>
        <td colspan="4">
            <h3 align="center">These Books are currently available</h3>
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