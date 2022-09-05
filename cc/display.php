<?php
include '../connect.php';
$sql = "select * from brand";
$result = mysqli_query($conn, $sql);
$table = '';
while ($row = mysqli_fetch_array($result)) {
    $table .= '<tr>
        <th scope="row">' . $row["idB"] . '</th>
        <td>' . $row['nameB'] . '</td>
        <td class="text-center">
        <a data-bs-toggle="modal" id="' . $row["idB"] . '" data-bs-target="#EditModal" class="edi" type="button" href="javascript:void(0)"><i class="fa-solid fa-pen-to-square px-3"></i></a><a class="delete" href="javascript:deleteB(' . $row['idB'] . ');"><i class="fa-solid fa-trash-can px-3"></i></a></td>
    </tr>';
}
echo $table;
