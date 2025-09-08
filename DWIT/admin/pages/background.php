<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$getData = $obj->select("background_image", array("id", "image_name", "selected"));

?>


<div><a href='?page=add-background&fold=form'>
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Background</button>
    </a></div>
<h2 class="text-center">Background</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Preview</th>
        <th>Delete</th>
        <th>Selected</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $sn = 0;
    while ($row = $getData->fetch()) {
        $sn++;
        $status = $row['selected'];
        $id = $row['id'];
        ?>

        <tr>
            <td><?php echo $sn; ?></td>
            <td><img src="<?php echo('./uploads/background/'.$row['image_name']) ?>" width=100></td>
            <td><a
                        href="?fold=actpages&page=act_background&action=delete&delete=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
            <td>
                <a href="#"><img src="assets/icons/<?php echo $status . ".png"; ?>"
                                 onclick="changeStatus('background_image','selected',<?php echo $status . "," . $id; ?>)"></a>
            </td>
        </tr>

        <?php } ?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>

<script>
    function changeStatus(table, field, value, uid) {
        if(value == 0)
        {
            if (confirm("Are you sure to perform this action ?")) {
                $.ajax({
                    type: "post",
                    url: "ajax/disableAll.php",
                    data: {'table': table, 'column': field, 'id': uid},
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
    }
</script>