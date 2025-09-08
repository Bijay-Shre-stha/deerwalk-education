<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$totalCount = $obj->getCount("workshop");

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

    $getData = $obj->select("workshop", array("workshop.id", "workshop.name AS workshopName", "workshop.title", "workshop.start_date", "workshop.end_date", "trainer.name AS trainerName"), NULL, array("workshop.id" => "DESC"), array($offset, $perPage), "LEFT", "trainer", "trainer_id", "id");
} else {
    $getData = $obj->select("workshop", array("workshop.id", "workshop.name AS workshopName", "workshop.title", "workshop.start_date", "workshop.end_date", "trainer.name AS trainerName"), NULL, array("workshop.id" => "DESC"), NULL, "LEFT", "trainer", "trainer_id", "id");
}

?>


<div><a href='?page=add-workshop&fold=form'>
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Workshop</button>
    </a></div>
<h2 class="text-center">Workshop Details</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Workshop Name</th>
        <th>Workshop Title</th>
        <th>Trainer</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th style="text-align: center; width: 15%;">Action</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $sn = 0;
    while ($row = $getData->fetch()) {
        $sn++;
        $id = $row['id'];
        ?>

        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $row['workshopName']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['trainerName']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td style="text-align: center;"><a href="?fold=form&page=add-workshop&wid=<?php echo $row['id']; ?>"><i
                                class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                            href="?fold=actpages&page=act_workshop&action=delete&delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
           
        </tr>

        <?php } ?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>

<script>
   
</script>