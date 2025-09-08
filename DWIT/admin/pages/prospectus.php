<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$getData = $obj->select("prospectus", array("id", "name", "year", "path"), NULL, array("year" => "DESC"));
?>

<div><a href="?page=add-prospectus&fold=form">
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Prospectus</button>
    </a></div>
<h2 class="text-center">Prospectus List</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Year</th>
        <th style="text-align: center;">Download</th>
        <th style="text-align: center;">Action</th>
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
            <td><?php echo $row['year']; ?></td>
            <td style="text-align: center;"><a href="./uploads/prospectus/<?php echo $row['path']; ?>" target="_blank"><i
                                class="fas fa-download fa-2x"></i></a></td>
            <td style="text-align: center;"><a
                        href="?fold=actpages&page=act_prospectus&action=delete&delete=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>