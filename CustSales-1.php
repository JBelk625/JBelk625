<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Customer Sales Summary</title>
    </head>
    <body>
        <h1> Customer Sales Summary</h1><!-- Header -->
        <table border="1">
            <tr>
                <th>Cust ID</th>
                <th>Cust Name</th><!-- comment -->
                <th>City/State/Zip</th><!-- comment -->
                <th>Cr. Limit</th>
                <th># Sales</th>
                <th>Tot. Sales</th> 
            </tr>
                
        <?php
        require_once("dblink.php"); //connection to database
        $query="SELECT c.CUSTOMER_ID, c.NAME, c.CITY, c.STATE, c.ZIP_CODE, "
                . " c.CREDIT_LIMIT, COUNT(s.ORDER_ID)  AS salescnt, "
                . " COALESCE (SUM(s.TOTAL), 0) as salestot "
                . " FROM CUSTOMER c LEFT JOIN SALES_ORDER s ON "
                . " c.CUSTOMER_ID = s.CUSTOMER_ID "
                . " GROUP BY c.CUSTOMER_ID, c.NAME, c.CITY, c.STATE, c.ZIP_CODE, "
                . " c.CREDIT_LIMIT "
                . " ORDER BY c.CUSTOMER_ID ";
        $result = mysqli_query($dbc,$query);
        echo "Customers on file = ". mysqli_num_rows($result). "!";
        
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" .$row['CUSTOMER_ID']. "</td>";
            echo "<td>" .$row[1]. "</td>";
            echo "<td>" .$row['CITY']. ", " .$row['STATE']. " " .$row['ZIP_CODE']. "</td>";
            echo "<td align='right'>$" .number_format($row['CREDIT_LIMIT'],2). "</td>";
            echo "<td>" .$row['salescnt']. "</td>";
            echo "<td align='right'>$" .number_format($row['salestot'],2). "</td>";
            echo "</tr>";
        }
        
        ?>
        </table>
        
    </body>
</html>
