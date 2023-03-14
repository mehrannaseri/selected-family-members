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
    <table>
        <thead>
        <tr>
            <th>SURNAME</th>
            <th>#MEMBERS</th>
            <th>FATHER</th>
            <th>MAXAGE</th>
            <th>CHILDREN</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total_members = 0;
        foreach ($families as $family){
            $total_members += $family['members'];
        ?>
        <tr>
            <td><?php echo $family['surname']; ?></td>
            <td><?php echo $family['members']; ?></td>
            <td><?php echo $family['father']; ?></td>
            <td><?php echo $family['max_age']; ?></td>
            <td><?php echo $family['children']; ?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td class="total-box" colspan="4"> Total Members</td>
            <td colspan="1"><?php echo $total_members; ?></td>
        </tr>
        </tbody>
    </table>

</div>
</body>
</html>
