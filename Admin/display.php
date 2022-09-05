<?php
include '../connect.php';
if ($_POST['action'] == 'admin') {
    $sql = "select * from admin";
    $result = mysqli_query($conn, $sql);
    $table = '';
    while ($row = mysqli_fetch_array($result)) {
        $table .= '<tr>
        <th scope="row">' . $row["idA"] . '</th>
        <td>' . $row['fName'] . ' ' . $row['lName'] . '</td>
        <td>' . $row['username'] . '</td>
        <td>' . $row['password'] . '</td>
        <td>
        <a class="edit" href="javascript:editB(' . $row['idA'] . ');"><i class="fa-solid fa-pen-to-square px-1"></i></a><a class="delete" href="javascript:deleteB(' . $row['idA'] . ');"><i class="fa-solid fa-trash-can ps-4"></i></a></td>
    </tr>';
    }
    echo $table;
}
if ($_POST['action'] == 'viewAdmin') {
    $rowID = $_POST['rowID'];
    $sql = "SELECT * FROM admin where idA = $rowID";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $jsonArray = array(
        'fname' => $data['fName'],
        'lname' => $data['lName'],
        'login' => $data['username'],
        'mdp' => $data['password'],
    );
    exit(json_encode($jsonArray));
}

if ($_POST['action'] == 'brand') {
    $sql = "select * from brand";
    $result = mysqli_query($conn, $sql);
    $table = '';
    while ($row = mysqli_fetch_array($result)) {
        $table .= '<tr>
        <th scope="row">' . $row["idB"] . '</th>
        <td>' . $row['nameB'] . '</td>
        <td>
        <a class="edit" href="javascript:editB(' . $row['idB'] . ');"><i class="fa-solid fa-pen-to-square px-1"></i></a><a class="delete" href="javascript:deleteB(' . $row['idB'] . ');"><i class="fa-solid fa-trash-can ps-4"></i></a></td>
    </tr>';
    }
    echo $table;
}
if ($_POST['action'] == 'booking') {
    $sql = "SELECT *, bookingBeta.idB as 'idBooking' FROM `bookingbeta` JOIN car ON bookingbeta.plateNum = car.plateNum JOIN brand ON car.idB = brand.idB LEFT JOIN admin on bookingbeta.confirmedBy = admin.idA ORDER BY bookingbeta.idB DESC";
    $result = mysqli_query($conn, $sql);
    $table = '';
    while ($row = mysqli_fetch_array($result)) {
        $status = "Rejected by " . $row['fName'] . " " . $row['lName'];
        $actions = '<td>
        <a href="javascript:changeState(' . $row['idBooking'] . ', 1);"><i class="text-success fa-solid fa-check"></i></a><a style="pointer-events: none;" href=""><i class="fa-solid fa-x ps-3 pe-3"></i></a><a href="javascript:view(' . $row['idBooking'] . ');"><i class="fa-solid fa-eye"></i></a></td>';
        if ($row['isConfirmed'] == 1) {
            $status = "Confirmed by " . $row['fName'] . " " . $row['lName'];
            $actions = '<td>
            <a style="pointer-events: none;" href = ""><i class="fa-solid fa-check"></i></a><a href="javascript:changeState(' . $row['idBooking'] . ', 0);"><i class="text-danger fa-solid fa-x ps-3 pe-3"></i></a><a href="javascript:view(' . $row['idBooking'] . ');"><i class="fa-solid fa-eye"></i></a></td>';
        } else if ($row['isConfirmed'] === NULL) {
            $status = 'Pending';
            $actions = '<td>
            <a href = "javascript:changeState(' . $row['idBooking'] . ', 1);"><i class="text-success fa-solid fa-check"></i></a><a href="javascript:changeState(' . $row['idBooking'] . ', 0);"><i class="text-danger fa-solid fa-x ps-3 pe-3"></i></a><a href="javascript:view(' . $row['idBooking'] . ');"><i class="fa-solid fa-eye"></i></a></td>';
        }
        $table .= '<tr>
        <th scope="row">' . $row["idBooking"] . '</th>
        <td>' . $row['fname'] . " " . $row['lname'] . '</td>
        <td>' . $row['nameB'] . " " . $row['modelName'] . '</td>
        <td>' . $row['startDate'] . '</td>
        <td>' . $row['endDate'] . '</td>
        <td>' . $status . '</td>
        ' . $actions . '
    </tr>';
    }
    echo $table;
}

if ($_POST['action'] == 'viewRow') {
    $rowID = $_POST['rowID'];
    $sql = "SELECT email, phone, address, plateNum, isConfirmed FROM `bookingBeta` where bookingBeta.idB = $rowID";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $jsonArray = array(
        'email' => $data['email'],
        'phone' => $data['phone'],
        'address' => $data['address'],
        'plateNum' => $data['plateNum'],
        'isConfirmed' => $data['isConfirmed']
    );
    exit(json_encode($jsonArray));
}
if ($_POST['action'] == 'viewMsg') {
    $idMessage = $_POST['idMessage'];
    $sql = "SELECT fullName, email, message FROM contact where idMessage = $idMessage";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $jsonArray = array(
        'fullname' => $data['fullName'],
        'email' => $data['email'],
        'message' => $data['message']
    );
    exit(json_encode($jsonArray));
}
if ($_POST['action'] == 'viewCar') {
    $plateNum = $_POST['plateNum'];
    $sql = "SELECT * FROM `car` join brand on car.idB = brand.idB where plateNum = '$plateNum'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $ab = array(
        'modelName' => $data['modelName'],
        'boite' => $data['boite'],
        'km' => $data['km'],
        'modelYear' => $data['modelYear'],
        'fuel' => $data['fuel'],
        'price' => $data['price'],
        'ac' => $data['ac'],
        'idB' => $data['idB'],
        'color' => $data['color'],
        'pic' => base64_encode($data['pic'])
    );
    exit(json_encode($ab));
}
if ($_POST['action'] == 'contact') {
    $sql = "select idMessage, fullName, email, LEFT(message, 50) as 'msg' from contact";
    $result = mysqli_query($conn, $sql);
    $table = '';
    while ($row = mysqli_fetch_array($result)) {
        $table .= '<tr>
        <th scope="row">' . $row["idMessage"] . '</th>
        <td>' . $row['fullName'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['msg'] . ' .... <a class="float-end" href="javascript:viewMsg(' . $row['idMessage'] . ')">See full message</a></td>
    </tr>';
    }
    echo $table;
}
if ($_POST['action'] == 'car') {
    $sql = "select * from car join brand on car.idB = brand.idB";
    $result = mysqli_query($conn, $sql);
    $table = '';
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
        <th scope="row">' . $row["plateNum"] . '</th>
        <td>' . $row['nameB'] . ' ' . $row['modelName'] . ' ' . $row['color'] . ' <i class="text-muted">  ' . $row['modelYear'] . '</i></td>
        <td>' . $row['fuel'] . '</td>
        <td>' . $row['boite'] . ' </td>
        <td>' . $row['price'] . ' DH </td>1
        <td>' . $avail . ' </td>
        <td>' . $ac . ' </td>
        <td><a href="javascript:ViewEditCar(\'' . $row['plateNum'] . '\', \'edit\');"><i class="fa-solid fa-pen-to-square"></i></a><a href="javascript:deleteCar(\'' . $row['plateNum'] . '\');"><i class="fa-solid fa-trash-can px-2"></i></a><a href="javascript:ViewEditCar(\'' . $row['plateNum'] . '\', \'view\');"><i class="fa-solid fa-eye"></i></a></td>
    </tr>';
    }
    echo $table;
}
