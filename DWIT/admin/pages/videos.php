<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


#$getData=$obj->select("youtube_video",array("id","title","link"));

#$getCount=$obj->select("youtube_video",array(count(1)));
$totalCount = $obj->getCount("youtube_video");

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

    $getData = $obj->select("youtube_video", array("id", "title", "link"), NULL, array("id" => "DESC"), array($offset, $perPage));
} else {
    $getData = $obj->select("youtube_video", array("id", "title", "link"), NULL, array("id" => "DESC"));
}


?>

    <div><a href="?page=add-video&fold=form">
            <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Video</button>
        </a></div>
    <h2 class="text-center">Youtube Video List</h2>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th style="width: 45%;">Title</th>
            <th style="text-align: center;">Video</th>
            <th style="text-align: center; width: 20%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($pageno) && !empty($perPage)) {
            $sn = $perPage * ($pageno - 1) + 1;
        } else {
            $sn = 0;
        }
        while ($row = $getData->fetch()) {
            $sn++;
            $url = $row['link'];
            if (strpos($url, 'youtube.com/') !== false)
                $videoId = explode("v=", $url)[1];
            elseif (strpos($url, 'youtu.be/') !== false)
                $videoId = explode("youtu.be/", $url)[1];
            ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><a href="https://www.youtube.com/watch?v=<?php echo $videoId; ?>"
                       target="_blank"><?php echo $row['title']; ?></a></td>
                <td style="text-align: center;">
                    <iframe class="embed-responsive-item" width="90%" height="90%"
                            src="https://www.youtube.com/embed/<?php echo $videoId; ?>?wmode=transparent"
                            frameborder="0" allowfullscreen></iframe>
                </td>
                <td style="text-align: center;"><a href="?fold=form&page=add-video&vid=<?php echo $row['id']; ?>"><i
                                class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                            href="?fold=actpages&page=act_video&action=delete&delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>


<?php if ($totalCount > 12) {
    include("inc/paginate.php");
} ?>