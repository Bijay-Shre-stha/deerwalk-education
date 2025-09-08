<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$getData = $obj->select("article_post", array("content", "title", "image_name"), array("id" => $_GET['articleId']));
$row = $getData->fetch();
?>
<h2 style="margin: 2%; padding-top: 2%;"><?php echo $row['title']; ?></h2>
<div style="width: 600px;">
    <img src="uploads/articles/<?php echo $row['image_name']; ?>" alt="Responsive image"
         style="margin: 2%; width: 100%">

</div>
<div style="width:900px;">
    <p style="text-align: left;width: 900px; margin: 1%; padding: 1%;"><?php echo html_entity_decode($row['content']); ?></p>
</div>
<a href="?fold=form&page=add-article&aid=<?php echo $_GET['articleId']; ?>">
    <button type="button" class="btn btn-info" style="margin: 1% 0% 1% 2%;">Edit</button>
</a>
<a href="?fold=actpages&page=act_article&action=delete&delete=<?php echo $_GET['articleId']; ?>">
    <button type="button" class="btn btn-danger" onclick="return confirm('Are You Sure?')">Delete</button>
</a>
<a href="?page=articles">
    <button type="button" class="btn btn-secondary">More article</button>
</a>