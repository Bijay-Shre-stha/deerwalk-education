<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


#$getData=$obj->select("inquiry",array("id","full_name","email","phNumber","message"));


#$getCount=$obj->select("inquiry",array(count(1)));
$totalCount = $obj->getCount("inquiry");

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

    $getData = $obj->select("inquiry", array("id", "full_name", "email", "phNumber", "message"), NULL, array("id" => "DESC"), array($offset, $perPage));
} else {
    $getData = $obj->select("inquiry", array("id", "full_name", "email", "phNumber", "message"), NULL, array("id" => "DESC"));
}

?>

    <h2 class="text-center" style="margin-bottom: 3%;">Inquiry List</h2>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th style="width: 20%;">Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Inquiry</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($pageno) && !empty($perPage)) {
            $sn = $perPage * ($pageno - 1) + 1;
        } else {
            $sn = 1;
        }

        while ($row = $getData->fetch()) { 
            ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phNumber']; ?></td>
                <td><?php echo $row['message']; ?></td>
            </tr>
            <?php $sn++; } ?>
        </tbody>
    </table>
    <?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>


<?php if ($totalCount > 12) {
    include("inc/paginate.php");
} ?>