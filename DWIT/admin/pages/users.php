<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$getData = $obj->select("user", array("id", "full_name", "email", "type", "enable"));

$user = "user";
$enable = "enable";
#$getData=$obj->select("user");
#  print_r($getData);

/*  print_r($getData);

  $total_data = $getData->rowCount();

  echo $total_data;

  $row=$getData->fetch();

  print_r($row);

  echo $row['full_name']."<br>";
  echo $row['email']."<br>";
  echo $row['type']."<br>";
  echo $row['enable']."<br>";  */

?>


<div><a href='?page=add-user&fold=form'>
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add User</button>
    </a></div>
<h2 class="text-center">Users</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
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
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td>
                <!-- <a href="#"><img src="./assets/icons/0.png ?>" ></a> -->
                <!-- <?php #echo($row['enable'] == 1)?"<a href='#''><img src='assets/icons/1.png' onclick='changeStatus(\"user\",\"enable\",".$row['enable'].",".$id.")'></a>":"<a href='#'><img src='assets/icons/0.png' onclick='changeStatus(\"user\",\"enable\",".$row['enable'].",".$id.")'></a>" ?> -->

                <a href="#"><img src="assets/icons/<?php echo $status . ".png"; ?>"
                                 onclick="changeStatus('user','enable',<?php echo $status . "," . $id; ?>)"></a>
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