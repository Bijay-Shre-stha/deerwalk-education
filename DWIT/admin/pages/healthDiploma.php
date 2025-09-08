<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$getData = $obj->select("health_diploma", array("id", "title", "priority"), NULL, array("priority" => "ASC"));
?>

<div><a href="?page=add-healthDiploma&fold=form">
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Title</button>
    </a></div>
<h2 class="text-center">Diploma In Data Science: Title List</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Title</th>
        <th>Priority</th>
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
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['priority']; ?></td>
            <td style="text-align: center;">
                <a href="?page=subTopicHealth&tid=<?php echo $row['id']; ?>"><i
                            class="fas fa-eye fa-2x"></i></a>
                <a href="?fold=form&page=add-healthDiploma&hid=<?php echo $row['id']; ?>"><i
                            class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a href="?fold=actpages&page=act_healthDiploma&action=delete&delete=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>