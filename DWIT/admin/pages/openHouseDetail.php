<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_GET['openHouseID'])) {
    $houseID = (int)$_GET['openHouseID'];
} else {
    $obj->redirect('?page=openHouse');
}

//use this to fetch source in multiple row//
#$getData = $obj->select("book", array("book.id", "book.full_name", "book.email", "book.high_school", "book.phone_no", "book.booked_date", "source.source"), array("open_house_id" => $houseID), array("book.id" => "ASC"), NULL, "LEFT", "source", "id", "book_id");


// use this to fetch source in single row //
// echo "Here";
if (isset($_GET['filter'])) {
    // house_type = 1 => session_date_1 booked
    // house_type = 2 => session_date_2 booked
    if ((int)$_GET['filter'] == 1) {
        $getData = $obj->db->query("SELECT book.id, book.full_name, book.email, book.high_school, book.phone_no, book.booked_date, book.interest, book.house_type, GROUP_CONCAT(source.source) as source FROM book LEFT JOIN source ON book.id = source.book_id WHERE open_house_id = '$houseID' AND house_type = '1' GROUP BY source.book_id ORDER BY book.id ASC");
    } elseif ((int)$_GET['filter'] == 2) {
        $getData = $obj->db->query("SELECT book.id, book.full_name, book.email, book.high_school, book.phone_no, book.booked_date, book.interest, book.house_type, GROUP_CONCAT(source.source) as source FROM book LEFT JOIN source ON book.id = source.book_id WHERE open_house_id = '$houseID' AND house_type = '2' GROUP BY source.book_id ORDER BY book.id ASC");
    }
} else {
    $getData = $obj->db->query("
    SELECT book.id, book.full_name, book.email, book.high_school, book.phone_no,
    book.booked_date, book.interest, book.house_type, book.source
    FROM book
    WHERE open_house_id = '$houseID'
    ORDER BY book.id ASC
");
}

$sessionDetail = $obj->getDataByField("open_house", array("session_num", "session_date_1", "session_date_2", "session_type_1", "session_type_2"), array("id" => $houseID));

?>

<h2 class="text-center">Open House
    Session <?php echo $obj->numToRoman($sessionDetail['session_num']); ?> Bookings </h2>

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle float-left" type="button" id="dropdownMenuButton"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 1%; margin-bottom: 1%;">
        Filter
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="?page=openHouseDetail&openHouseID=<?php echo (int)$_GET['openHouseID']; ?>">All</a>
        <?php if (strtotime($sessionDetail['session_date_2']) > 0): ?>
            <a class="dropdown-item" href="?page=openHouseDetail&openHouseID=<?php echo (int)$_GET['openHouseID']; ?>&filter=1">Session I</a>
            <a class="dropdown-item" href="?page=openHouseDetail&openHouseID=<?php echo (int)$_GET['openHouseID']; ?>&filter=2">Session II</a>
        <?php endif; ?>
    </div>
</div>
<br>
<br>
<div>
    <form action="./export.php" id="add-session" method="POST">
        <input type="hidden" name="action" value="export">
        <input type="hidden" name="houseID" value="<?php echo $houseID; ?>">
        <input type="hidden" name="filter" value="<?php echo isset($_GET['filter']) ? (int)$_GET['filter'] : 1; ?>">
        <button type="submit" class="btn btn-primary float-right" style="margin: 3%;">Export</button>
    </form>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Email</th>
            <th>High School</th>
            <th>Phone Number</th>
            <th style="width: 10%;">Booked Date</th>
            <th>Source</th>
            <th>Interest</th>
            <th style="width: 10%;">Applied For</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sn = 1;

        $intProgram = ['-', 'CSIT', 'BCA', 'Both'];

        while ($row = $getData->fetch()) {
            #print_r($row);
            #echo "<br>";
        ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['high_school']; ?></td>
                <td><?php echo $row['phone_no']; ?></td>
                <td><?php echo $row['booked_date']; ?></td>
                <td><?php echo $row['source']; ?></td>
                <td><?php echo ($row['interest'] <= 3 && $row['interest'] >= 0) ? $intProgram[$row['interest']] : 'Invalid Choice'; ?></td>
                <td>
                    <?php
                    if ($row['house_type'] == 2) {
                        echo substr($sessionDetail['session_date_2'], 0, 10);
                        if ($sessionDetail['session_type_2'] == 1) {
                            echo "<br>(Online)";
                        } else {
                            echo "<br>(On Campus)";
                        }
                    } else {
                        echo substr($sessionDetail['session_date_1'], 0, 10);
                        if ($sessionDetail['session_type_1'] == 1) {
                            echo "<br>(Online)";
                        } else {
                            echo "<br>(On Campus)";
                        }
                    }
                    ?>
                </td>
            </tr>
        <?php $sn++;
        } ?>
    </tbody>
</table>