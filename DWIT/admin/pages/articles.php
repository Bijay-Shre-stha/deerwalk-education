<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


#$getData=$obj->select("article_post",array("id","content","title","image_name"));

#$getCount=$obj->select("article_post",array(count(1)));
$totalCount = $obj->getCount("article_post");

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

    $getData = $obj->select("article_post", array("id", "content", "title", "image_name"), NULL, array("id" => "DESC"), array($offset, $perPage));
} else {
    $getData = $obj->select("article_post", array("id", "content", "title", "image_name"), NULL, array("id" => "DESC"));
}


?>
    <div><a href="?page=add-article&fold=form">
            <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Article</button>
        </a></div>
    <h2 class="text-center">Articles</h2>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Title</th>
            <th>Image</th>
            <th style="width: 30%;">Content</th>
            <th style="width: 5%;">Read More</th>
            <th style="text-align:center;width: 15%;">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($pageno) && !empty($perPage)) {
            $sn = $perPage * ($pageno - 1) + 1;
        } else {
            $sn = 0;
        }
        while ($row = $getData->fetch()) { $sn++;
            ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><img src="uploads/articles/<?php echo $row['image_name']; ?>" width=200></td>
                <td><?php

                    $text = substr($row['content'], 0, 150);
                    $finalText = substr($text, 0, strrpos($text, '.'));
                    if ($finalText == NULL)
                        $finalText = substr($text, 0, strrpos($text, '।'));
                    if ($finalText == NULL && strlen($text) > 100)
                        $finalText = substr($text, 100);
                    if (strlen($text < 100))
                        $finalText = $text;
                    echo html_entity_decode($finalText) . "...";
                    #echo(substr($row['content'],0,100));
                    ?></td>
                <td><a href="?page=articleDetail&articleId=<?php echo $row['id']; ?>"><i
                                class="fas fa-eye fa-2x"></i></a></td>
                <td style="text-align: center;"><a href="?fold=form&page=add-article&aid=<?php echo $row['id']; ?>"><i
                                class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                            href="?fold=actpages&page=act_article&action=delete&delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>

<?php if ($totalCount > 12) {
    include("inc/paginate.php");
} ?>