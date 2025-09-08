<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$getData = $obj->select("department", array("id", "name", "description"));
?>

<div><a href="?page=add-department&fold=form">
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Department</button>
    </a></div>
<h2 class="text-center">Department List</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th style="width: 55%;">Description</th>
        <th style="text-align: center; width: 20%;">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sn = 0;
    while ($row = $getData->fetch()) { $sn++;
        ?>
        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td style="text-align: center;"><a href="?fold=form&page=add-department&did=<?php echo $row['id']; ?>"><i
                            class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                        href="?fold=actpages&page=act_department&action=delete&delete=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>