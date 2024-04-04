<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Sales Results</title>
    </head>
    <body>
        <h1>Sales Results</h1>
        <?php
            $custid = $_GET['custid'];
            echo "Customer ID Selected = " .$custid. " ";
            require_once("dblink.php");
            $query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = '$custid' ";
            //echo "SQL: " .$query. " ";
            $result = mysqli_query($dbc, $query);
            
            if (mysqli_num_rows($result) > 0) { //Customer details display
                $row = mysqli_fetch_array($result);
                
                echo "<table>";
                echo "<tr><td>Customer #:</td><td>" .$row['CUSTOMER_ID']. "</td></tr>";
                echo "<tr><td>Customer name:</td><td>" .$row['NAME']. "</td></tr>";
                echo "<tr><td>Address: </td><td>" .$row['ADDRESS']. "</td></tr>";
                echo "<tr><td>City/State/Zip: </td><td>" .$row['CITY']. ", " .$row['STATE']. " " .$row['ZIP_CODE']. "</td></tr>";
                echo "</table><br>";                        
            } else {
                echo "<p>Customer ID: " .$custid. " is not found on file.</p>";
            }
                       
            echo "<table border='1'>"; //order details display
            echo "<caption>Sales on File</caption>";
            echo "<tr>";
            echo "<th>Order ID</th>";
            echo "<th>Order Date</th>";
            echo "<th>Ship Date</th>";
            echo "<th>Total</th>";
            echo "</tr>";
            
            $query2 = "SELECT * FROM SALES_ORDER WHERE CUSTOMER_ID = '$custid' ORDER BY ORDER_DATE DESC";
            $result2 = mysqli_query($dbc, $query2);
            if (mysqli_num_rows($result2) == 0) {
                echo "<tr>";
                echo "<td>No sales on file.</td>";
                echo "</tr>";
            }
            else {
                while ($row = mysqli_fetch_array($result2)) {                
                    echo "<tr>";
                    echo "<td>" .$row['ORDER_ID']. "</td>";
                    echo "<td>" .$row[1]. "</td>";
                    echo "<td>" .$row[3]. "</td>";
                    echo "<td>$" .number_format($row[4], 2). "</td>";
                    echo "</tr>";
                    } 
            }

            echo "</table>";
            
            $query3 = "SELECT sum(TOTAL) AS totsales FROM SALES_ORDER WHERE CUSTOMER_ID = '$custid'";
            $result3 = mysqli_query($dbc, $query3);
            $row_sales = mysqli_fetch_array($result3);
            echo "<p>Total for account: $" .number_format($row_sales['totsales'], 2). "</p>";
            
            
        ?>
    </body>
</html>
