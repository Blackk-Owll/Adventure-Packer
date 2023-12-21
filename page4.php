<?php
    include "db_conn.php";


    // Fetching the objects from the database:
    
    $nbItems_query = "SELECT count(c.idObject) as itemCount
                    FROM objects o
                    JOIN chosen_objects c ON o.idObject = c.idObject; ";
    $nbItems_result = mysqli_query($conn, $nbItems_query);

    if ($nbItems_result->num_rows > 0) {
        while ($row = $nbItems_result->fetch_assoc()) {
            $nbItems = $row['itemCount'];
        }
    } else {
        echo "Requête d'objets incorrecte !";
    }


    $nbPoint_query = "SELECT sum(point) as pointCount
                    FROM objects o
                    JOIN chosen_objects c ON o.idObject = c.idObject; ";
    $nbPoint_result = mysqli_query($conn, $nbPoint_query);

    if ($nbPoint_result->num_rows > 0) {
        while ($row = $nbPoint_result->fetch_assoc()) {
            $nbPoints = $row['pointCount'];
        }
    } else {
        echo "Requête d'objets incorrecte !";
    }

   

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Adventure Packer</title>
        <link rel="stylesheet" href="style/page4.css">
    </head>
    <body>
        <div id="wrapper">
           
             <h1>SOLUTION</h1>   
             
             <div class="content">
                <h2>Number of items taken:</h2>
                <h3><?php echo $nbItems;   ?> item</h3>
                <br>
                <h2>Points gathered for the adventure:</h2>
                <h3><?php echo $nbPoints;   ?> point</h3>
                
             </div>

            <div class="btn-container">
                <button onclick="openPage3()">BACK</button>
            
                <button onclick="openPage5()">VIEW CHOSEN</button>
            
                <button onclick="openMainPage()">HOME</button>
            </div>
        </div>

        

        <script src="script.js"></script>
    </body>
</html>

<?php
    mysqli_close($conn);
?>