<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$getData = $obj->select("batch", array("id", "name", "status"));

?>


<div><a href='?page=add-batch&fold=form'>
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Batch</button>
    </a></div>
<h2 class="text-center">Batch</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Ref. Id</th>
        <th>Name</th>
        <th style="text-align: center; width: 20%;">Action</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $sn = 0;
    while ($row = $getData->fetch()) {
        $sn++;
        $status = $row['status'];
        $id = $row['id'];
        ?>

        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $id ?></td>
            <td><?php echo $row['name']; ?></td>
            <td style="text-align: center;">
                <a href="?fold=form&page=add-batch&bid=<?php echo $row['id']; ?>"><i
                            class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                        href="?fold=actpages&page=act_batch&action=delete&delete=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a>
            </td>
            <td>
                <a href="#"><img src="assets/icons/<?php echo $status . ".png"; ?>"
                                 onclick="changeStatus('batch','status',<?php echo $status . "," . $id; ?>)"></a>
            </td>
        </tr>

        <?php } ?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>

<script>
    function changeStatus(table, field, value, uid) {
        if (confirm("Are you sure to perform this action ?")) {
            $.ajax({
                type: "post",
                url: "actpages/change_status.php",
                data: {'table': table, 'field': field, 'value': value, 'id': uid},
                dataType: "json",
                success: function (response) {
                    if (response.status == 1) {
                        location.reload();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
    }
</script>