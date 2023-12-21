<?php
    include "db_conn.php";


    // Fetching the objects from the database:
    $objects = array();
    $object_query = "SELECT *
                    FROM objects o
                    JOIN chosen_objects c ON o.idObject = c.idObject;";
    $object_result = mysqli_query($conn, $object_query);

    if ($object_result->num_rows > 0) {
        while ($row = $object_result->fetch_assoc()) {
            $objects[] = $row;
        }
    } else {
        echo "Requête d'objets incorrecte !";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Adventure Packer</title>
        <link rel="stylesheet" href="style/page3.css">
    </head>
    <body>
        <div id="wrapper">
            <div class="table-content">
                <h1>CHOSEN ITEMS</h1>
                <div class="table-wrapper">
                    <table>
                        <tr >
                            <th>ITEM</th>
                            <th>WEIGH</th>
                            <th>ADVENTURE POINTS</th>
                        </tr>
                        <?php foreach ($objects as $object) : ?>
                          <tr>
                            <td class= "item-cell">
                                <?php echo $object['idObject']; ?>
                                <!--<img src="./assets/item.png" alt="">-->
                            </td>
                            <td><?php echo $object['weigh']; ?></td>
                            <td><?php echo $object['point']; ?></td>
                          </tr>
                    
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
                       

            <div class="btn1-container">
                <button onclick="openPage4()">BACK</button>
            </div>
            <div class="btn3-container">
                <button onclick="openMainPage()">HOME</button>
            </div>
        </div>

        

        <script src="script.js"></script>
    </body>
</html>

<?php
    mysqli_close($conn);
?>