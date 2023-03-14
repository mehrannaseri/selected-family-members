<?php
require_once __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;

require_once "Classes/Family.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Family members</title>
    <style>
        .main-box{
            display:flex; height:100vh; align-items: center; justify-content: center
        }
        table,th,td{
            border: 1px solid rgb(230, 230, 230);
        }
        table{
            width: 50%;
            border-collapse: collapse;
        }
        th{
            background-color: black;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        th, td{
            padding: 15px;
        }
        td{
            color: rgb(91, 91, 91);
        }
        .total-box{
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="main-box">
    <?php
    $family = new Family();
    $families = $family->getData();
    ?>
    <table id="myTable">
        <thead>
        <tr>
            <th onclick="sortData(0)">SURNAME</th>
            <th onclick="sortData(1)">#MEMBERS</th>
            <th onclick="sortData(2)">FATHER</th>
            <th onclick="sortData(3)">MAXAGE</th>
            <th onclick="sortData(4)">CHILDREN</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total_members = 0;
        foreach ($families as $family){
            $total_members += $family['members'];
        ?>
        <tr class="sortable">
            <td><?php echo $family['surname']; ?></td>
            <td><?php echo $family['members']; ?></td>
            <td><?php echo $family['father']; ?></td>
            <td><?php echo $family['max_age']; ?></td>
            <td><?php echo $family['children']; ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="total-box" colspan="4"> Total Members</td>
                <td class="total-box" colspan="1"><?php echo $total_members; ?></td>
            </tr>
        </tfoot>
    </table>

</div>
</body>
<script>
    function sortData(n) {
        var table,
            rows,
            switching,
            i,
            x,
            y,
            shouldSwitch,
            dir,
            switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        dir = "asc";
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            switching = false;
            rows = table.getElementsByClassName("sortable");

            for (i = 0; i < rows.length - 1; i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
</html>
