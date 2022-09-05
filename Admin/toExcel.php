<?php
include '../connect.php';
$table = '';
$tableName = '';
if (isset($_POST['brand'])) {
    $tableName = 'Brands';
    $sql = "select * from brand";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $table .= '<table class="table" bordered="1">
                <tr>
                    <th>ID</th>
                    <th>Brand name</th>
                </tr>';
        while ($row = mysqli_fetch_array($result)) {
            $table .= '<tr>
                    <td>' . $row['idB'] . '</td>
                    <td>' . $row['nameB'] . '</td>
                </tr>';
        }

        $table .= '</table>';
    }
}
if (isset($_POST['admin'])) {
    $tableName = 'Admins';
    $sql = "select * from admin";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $table .= '<table class="table" bordered="1">
                <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>type</th>
                </tr>';
        while ($row = mysqli_fetch_array($result)) {
            $type = 'Manager';
            if ($row['isDirector'] == 1)
                $type = 'Director';
            $table .= '<tr>
                    <td>' . $row['idA'] . '</td>
                    <td>' . $row['fName'] . '</td>
                    <td>' . $row['lName'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['password'] . '</td>
                    <td>' . $type . '</td>
                </tr>';
        }

        $table .= '</table>';
    }
}
if (isset($_POST['booking'])) {
    $tableName = 'Bookings';
    $sql = "select * from bookingbeta join car on bookingbeta.plateNum = car.plateNum join brand on brand.idB = car.idB";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $table .= '<table class="table" bordered="1">
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Car plate</th>
                    <th>Car name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                </tr>';
        while ($row = mysqli_fetch_array($result)) {
            $status = 'Rejected';
            if ($row['isConfirmed'] == 1) {
                $status = 'Confirmed';
            } else if ($row['isConfirmed'] === NULL) {
                $status = 'Pending';
            }
            $table .= '<tr>
                    <td>' . $row['idB'] . '</td>
                    <td>' . $row['fname'] . " " . $row['lname'] . '</td>
                    <td>' . $row['plateNum'] . '</td>
                    <td>' . $row['nameB'] . " " . $row['modelName'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['phone'] . '</td>
                    <td>' . $row['address'] . '</td>
                    <td>' . $row['startDate'] . '</td>
                    <td>' . $row['endDate'] . '</td>
                    <td>' . $status . '</td>
                </tr>';
        }
        $table .= '</table>';
    }
}
if (isset($_POST['contact'])) {
    $tableName = 'Messages';
    $sql = "select * from contact";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $table .= '<table class="table" bordered="1">
                <tr>
                    <th>ID</th>
                    <th>full name</th>
                    <th>email</th>
                    <th>message</th>
                </tr>';
        while ($row = mysqli_fetch_array($result)) {
            $table .= '<tr>
                    <td>' . $row['idMessage'] . '</td>
                    <td>' . $row['fullName'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['message'] . '</td>
                </tr>';
        }

        $table .= '</table>';
    }
}
if (isset($_POST['car'])) {
    $tableName = 'Cars';
    $sql = "select * from car join brand on car.idB =  brand.idB";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $table .= '<table class="table" bordered="1">
                <tr>
                    <th>Plate no.</th>
                    <th>Car name</th>
                    <th>Fuel</th>
                    <th>Gearbox</th>
                    <th>Km</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Has A/C</th>
                    <th>Picture path</>
                </tr>';
        while ($row = mysqli_fetch_array($result)) {
            $avail = 'No';
            $ac = 'No';
            if ($row['dispo'] == 1) {
                $avail = 'Yes';
            }
            if ($row['ac'] == 1) {
                $ac = 'Yes';
            }
            $table .= '<tr>
            <td>' . $row["plateNum"] . '</td>
            <td>' . $row['nameB'] . ' ' . $row['modelName'] . ' ' . $row['color'] . ' ' . $row['modelYear'] . '</td>
            <td>' . $row['fuel'] . '</td>
            <td>' . $row['boite'] . ' </td>
            <td>' . $row['km'] . ' </td>
            <td>' . $row['price'] . ' DH </td>
            <td>' . $avail . ' </td>
            <td>' . $ac . ' </td>
            <td>' . $row['picture'] . '</td>
            </tr>';
        }
        $table .= '</table>';
    }
}
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=" . $tableName . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $table;
