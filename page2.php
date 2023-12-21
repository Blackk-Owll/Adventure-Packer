<!DOCTYPE html>
<html>
    <head>
        <title>Adventure Packer</title>
        <link rel="stylesheet" href="style/page2.css">
    </head>
    <body>
        <div id="wrapper">
            <img src="assets/Backpack.png" alt="">
            <div class="form-container">
                <form id="knapsack-form" action="algorithm.php" method="post" >
                    <label for="">Choose a capacity for the Knapsack</label>
                    <input type="text" name="capacity_W">
                    
                    <label for="">Choose the number od items</label>
                    <input type="text" name="items_N">
                    <input  class="btn-submit" type="submit" name="submit_N_W" value="DECIDE" >
                </form>
            </div>
            
            <div class="btn-container">
                <button onclick="openMainPage()">BACK</button>
                <button onclick="openMainPage()">HOME</button>
            </div>

        </div>



        <script src="script.js"></script>
    </body>
</html>