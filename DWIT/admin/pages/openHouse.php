<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$presentYear = date('Y') + 1;
#$totalCount = $obj->getCount("open_house", "year(session_date)>=$presentYear");

do {
    $totalCount = $obj->getCount("open_house", "session_year >= $presentYear");
    if ($totalCount == 0)
        $presentYear--;
    if ($presentYear == 2017)
        break;
} while ($totalCount == 0);

if (isset($_GET['pageno']) && !empty($_GET['pageno'])) {
    $yearValue = (int)$_GET['pageno'];
    $year = $obj->selectYear($presentYear, $yearValue);
    $pageno = $_GET['pageno'];
} else {
    $year = $presentYear;
    $pageno = 1;
}

$getData = $obj->select("open_house", array("id", "session_num", "session_year", "session_date_1", "session_time_1", "session_date_2", "session_time_2", "enable", "max_count_1", "max_count_2"), "session_year=$year", array("session_num" => "DESC"));

$totalPage = ($presentYear - 2018) + 1;

// max year backward is 2018
?>


<div><a href="?page=add-session&fold=form">
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Session</button>
    </a></div>
<h2 class="text-center">Open House<?php if ($totalCount != 0) echo " - " . $year; ?></h2>

<table class="table table-hover">
    <thead>
        <tr>
            <th>SN</th>
            <th>Session Number</th>
            <th>Session Date 1</th>
            <th>Session Time 1</th>
            <th>Session Date 2</th>
            <th>Session Time 2</th>
            <th>Bookings</th>
            <th>Action</th>
            <th>Visibility</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sn = 0;
        while ($row = $getData->fetch()) {
            $sn++;
            $status = $row['enable'];
            $id = $row['id'];
        ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $obj->numToRoman($row['session_num']); ?></td>
                <td><?php echo substr($row['session_date_1'], 0, 10); ?></td>
                <td><?php echo $row['session_time_1']; ?></td>
                <td><?php echo ($row['session_date_2'] == NULL) ? ' - ' : substr($row['session_date_2'], 0, 10); ?></td>
                <td><?php echo ($row['session_time_2'] == NULL) ? ' - ' : $row['session_time_2']; ?></td>
                <td><a href="?page=openHouseDetail&openHouseID=<?php echo $row['id']; ?>"><i
                            class="fas fa-eye fa-2x"></i>(<?php echo $obj->getCount("book", array("open_house_id" => $row['id'])); ?>)</a></td>
                <td><a href="?fold=form&page=add-session&sid=<?php echo $row['id']; ?>"><i
                            class="fas fa-edit fa-2x"></i></a></td>
                <td><a href="#"><img src="assets/icons/<?php echo $status . ".png"; ?>"
                            onclick="changeStatus('open_house','enable',<?php echo $status . "," . $id; ?>)"></a>
                </td>
            </tr>

        <?php } ?>
    </tbody>
</table>
<?php if ($sn == 0) echo "<center><b>No Data Found!</b></center>" ?>

<?php
if ($totalCount != 0)
    include("inc/paginate.php");
?>

<script>
    function changeStatus(table, field, value, uid) {
        if (confirm("Are you sure to perform this action ?")) {
            $.ajax({
                type: "post",
                url: "actpages/change_status.php",
                data: {
                    'table': table,
                    'field': field,
                    'value': value,
                    'id': uid
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1) {
                        location.reload();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
    }
</script>