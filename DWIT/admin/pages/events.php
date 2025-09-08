<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$totalCount = $obj->getCount("events");
// echo($totalCount);
// die();
if ($totalCount > 12) {
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    if ($totalCount < 16)
        $perPage = 8;
    else
        $perPage = 10;

    $offset = ($pageno - 1) * $perPage;

    $totalPage = ceil($totalCount / $perPage);

    $getData = $obj->select("events", array("id", "name", "start_date", "end_date"), NULL, array("events.start_date" => "DESC"), array($offset, $perPage));
} else {    
    $getData = $obj->select("events", array("id", "name", "start_date", "end_date"), NULL, array("events.start_date" => "DESC"));

}

if (isset($_GET['eid'])) {
    $id = (int)$_GET['eid'];
    $oldData = $obj->getFieldDataById("events", array("name", "start_date", "end_date"), $id);
    $action = "edit";
} else {
    $action = "add";
}


?>


<div><a href='?page=add-calendar&fold=form'>
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Events</button>
    </a></div>
<h2 class="text-center">Events</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Event Names</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    <?php
     if (!empty($pageno) && !empty($perPage)) {
            $sn = $perPage * ($pageno - 1);
        } else {
            $sn = 0;
        }
        while ($row = $getData->fetch()) { $sn++;
            ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;"><?php echo $row['name']; ?></td>
                <td><?php echo $row['start_date']; ?></td>
                <td><?php echo $row['end_date']; ?></td>
                <td style="text-align: center;"><a href="?fold=form&page=edit-event&eid=<?php echo $row['id']; ?>"><i
                                class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                            href="?fold=actpages&page=act_calendar&action=delete&delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a>
                </td>
             </tr>

        <?php } ?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>
<?php if ($totalCount > 12) {
    include("inc/paginate.php");
} ?>
<script>
   
</script>