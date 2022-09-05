<?php

require 'connect.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
$start = ($page - 1) * $limit;
if (isset($_POST['action'])) {
    $sql = "select * from car join brand on car.idB = brand.idB where modelName != ''";
    if (isset($_POST['search'])) {
        $search = $_POST['search'][0];
        $sql .= "AND nameB LIKE '%$search%'";
    }
    if (isset($_POST['brand'])) {
        $brand = implode("','", $_POST['brand']);
        $sql .= "AND nameB IN('" . $brand . "')";
    }
    if (isset($_POST['fuel'])) {
        $fuel = implode("','", $_POST['fuel']);
        $sql .= "AND fuel IN('" . $fuel . "')";
    }
    if (isset($_POST['gearbox'])) {
        $gearbox = implode("','", $_POST['gearbox']);
        $sql .= "AND boite IN('" . $gearbox . "')";
    }
    if (isset($_POST['price'])) {
        $minPrice = floatval($_POST['price'][0]);
        $maxPrice = floatval($_POST['price'][1]);
        if ($maxPrice > 1) {
            $sql .= "AND price BETWEEN '$minPrice' AND '$maxPrice'";
        }
    }
    if (isset($_POST['order'])) {
        $order = $_POST['order'];
        if ($order != 'none') {
            $sql .= "order by price $order ";
        }
    }
    $sql .= "LIMIT $start, $limit";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $hasAC = "No";
        $disp = '<div class="disp text-white bg-success text-center">Available</div>';
        if ($row['ac'] == 1) {
            $hasAC = "Yes";
        }
        if ($row['dispo'] == 0) {
            $disp = '<div class="disp text-white bg-danger text-center">Rented !</div>';
        }
        echo  '<div class="col-md-4 my-2">
        <div class="card carItem px-2" style="width:22vw; height:100%">
            <img class="card-img-top" height = 100% src="data:image;base64, ' . base64_encode($row['pic']) . '">
            ' . $disp . '
            <div class="text-center mt-4">
                <h4>' . $row['nameB'], " ", $row['modelName'] . '</h4>
                <p class="text-muted"><i>Model ' . $row['modelYear'] . '</i></p>
                <div class="d-flex justify-content-between">
                    <p><img class="iconCar px-1" src="assets/fuel.png" alt=""> ' . $row['fuel'] . '</p>
                    <p><img class="iconCar px-1" src="assets/ac.png" alt=""> ' . $hasAC . '</p>
                    <p><img class="iconCar px-1" src="assets/gearbox.png" alt=""> ' . $row['boite'] . '</p>
                </div>
            </div>
            <div class="text-center">
                <h6><b>' . $row['price'] . ' DH </b><small class="text-muted"> / per day</small></h6>
                <form method="post" action="checkout.php">
                <input type="text" value= "' . $row['plateNum'] . '"name="plate" style="display: none;">
                <a href="checkout.php"><button type="submit" class="btn">Book it</button></a>
                </form>
                </div>
        </div>
    </div>';
    }
}
