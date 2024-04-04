<!DOCTYPE html>
<!--

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sales Detail Report</title>
    </head>
    <body>
        <script src="ajax.js"></script>
        <script src="Sales.js"></script>
        <h1>Customer Sales Detail</h1><!-- Header -->
        <p> Select customer from drop down list and press 'Go':</p><!-- Operation instruction text displayed on page -->
        <form id="CustomerForm" action="SalesResults.php" method="get"> <!-- Drop down population -->
        <?php
            require_once("dblink.php"); //connection to database
            $query = "SELECT * FROM CUSTOMER ORDER BY NAME"; //get every value from "customer" field and order alphabetically
            $result = mysqli_query($dbc, $query);
            if (mysqli_num_rows($result) > 0) {
                echo "<select id='custid' name='custid'>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" .$row['CUSTOMER_ID']. "'>" //line by line populate drop-down menu with values
                            .$row['NAME']. "</option>";
                }
                echo "</select>";
            }
        ?>
            <input type="submit" name="go" id="go" value="Go"/> <!-- Go button -->
            
        </form>
        <div id="results"></div>
    </body>
</html>
