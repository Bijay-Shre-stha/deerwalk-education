<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


#$getData=$obj->select("staff",array("staff.id","staff.full_name","staff.description","staff.image_name","department.name"),NULL,NULL,NULL,"LEFT","department","department_id","id");

#$getCount=$obj->select("staff",array(count(1)));
$totalCount = $obj->getCount("staff");

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

    $getData = $obj->select("staff", array("staff.id", "staff.full_name", "staff.description", "staff.image_name", "department.name"), NULL, array("staff.full_name" => "ASC"), array($offset, $perPage), "LEFT", "department", "department_id", "id");
} else {
    $getData = $obj->select("staff", array("staff.id", "staff.full_name", "staff.description", "staff.image_name", "department.name"), NULL, array("staff.full_name" => "ASC"), NULL, "LEFT", "department", "department_id", "id");
}


?>

    <div><a href="?page=add-faculty&fold=form">
            <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Faculty</button>
        </a></div>
    <h2 class="text-center">List Faculty</h2>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Department</th>
            <th style="width: 40%;">Description</th>
            <th>Photo</th>
            <th style="text-align: center; width: 15%;">Action</th>
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
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><img src="uploads/staff/<?php echo $row['image_name']; ?>" width=200></td>
                <td style="text-align: center;"><a href="?fold=form&page=add-faculty&fid=<?php echo $row['id']; ?>"><i
                                class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                            href="?fold=actpages&page=act_faculty&action=delete&delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
            </tr>
            <?php
        } ?>
        </tbody>
    </table>
    <?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>

<?php if ($totalCount > 12) {
    include("inc/paginate.php");
} ?>