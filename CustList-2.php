<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Customer List</title>
    </head>
    <body>
        <h1> Customer List (All) </h1><!-- Header -->
        <table border="1">
            <tr>
                <th>Cust ID</th>
                <th>Cust Name</th><!-- comment -->
                <th>City/State/Zip</th><!-- comment -->
                <th>Credit Limit</th>
            </tr>
                
        <?php
        require_once("dblink.php"); //connection to database
        $query="SELECT * FROM CUSTOMER ORDER BY NAME";
        $result = mysqli_query($dbc,$query);
        echo "Customers on file = ". mysqli_num_rows($result). "!";
        
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" .$row['CUSTOMER_ID']. "</td>";
            echo "<td>" .$row[1]. "</td>";
            echo "<td>" .$row['CITY']. ", " .$row['STATE']. " " .$row['ZIP_CODE']. "</td>";
            echo "<td align='right'>$" .number_format($row['CREDIT_LIMIT'],2). "</td>";
            echo "</tr>";
        }
        
        ?>
        </table>
        
    </body>
</html>
