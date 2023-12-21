<?php
    include "db_conn.php";



function selectedItems($N, $W, &$P, &$poids, &$gain, $conn){
    $i = $N;
    $j = $W;

    while ($i > 0 && $j > 0) {
        if ($P[$i][$j] != $P[$i - 1][$j]) {
            // Insert data into the database
            $stmt = $conn->prepare("INSERT INTO chosen_objects (idObject) VALUES (?)");
            $stmt->bind_param("i", $i);
            $stmt->execute();
            $stmt->close();
            $j -= $poids[$i];
        }
        $i--;
    }
}


function generateSolution( $N, $W, &$P, &$poids, &$gain, $conn) {
    
    // Delete existing data from the tables
    $conn->query("DELETE FROM objects");
    $conn->query("DELETE FROM chosen_objects");

    srand(time());
    for ($k = 0; $k < $N; $k++) {
        $poids[$k] = rand(1, $N);
        $gain[$k] = rand(3 * $N, 3 * $N * 2);


        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO objects (idObject, weigh, point) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $k, $poids[$k], $gain[$k]);
        $stmt->execute();
        $stmt->close();

    }

    for ($i = 0; $i <= $N; $i++) {
        for ($j = 0; $j <= $W; $j++) {
            if ($i == 0 || $j == 0) {
                $P[$i][$j] = 0;
            } elseif ($j < $poids[$i]) {
                $P[$i][$j] = $P[$i - 1][$j];
            } else {
                $P[$i][$j] = ($P[$i - 1][$j] > $P[$i - 1][$j - $poids[$i]] + $gain[$i]) ?
                    $P[$i - 1][$j] : ($P[$i - 1][$j - $poids[$i]] + $gain[$i]);
            }
        }
    }

    selectedItems($N, $W, $P, $poids, $gain, $conn);

    

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_POST["capacity_W"]) || isset($_POST["items_N"])) {
        $W = (int)$_POST["capacity_W"];
        $N = (int)$_POST["items_N"];

        $P = array_fill(0, $N + 1, array_fill(0, $W + 1, 0));
        $poids = array_fill(0, $N + 1, 0);
        $gain = array_fill(0, $N + 1, 0);

        generateSolution($N, $W, $P, $poids, $gain, $conn);

        
        header("Location: page3.php");
        exit();

        
    } else {
        echo "Error: Missing parameters.";
    }
} else {
    echo "Error: Unsupported method.";
}
?>
