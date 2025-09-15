<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['did'])) {
    $id = (int)$_GET['did'];
    $oldData = $obj->getFieldDataById("pdfdocument", array("pdfurl", "title", "category"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>


<h2 class="text-center">Add Document</h2>

<form action="?fold=actpages&page=act_document" id="add-document" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="docTitle">Document Title :</label>
        <input type="text" class="form-control" id="docTitle" placeholder="Enter Document title" name="docTitle"
               value="<?php if (isset($oldData)) echo $oldData['title']; ?>">
        <label id="docTitle-error" class="error invalid-feedback" for="docTitle"></label>
    </div>

    <div class="form-group">
        <label for="docCategory">Category :</label>
        <select class="form-control" id="docCategory" name="docCategory">
            <option selected disabled>--Select Category--</option>
            <option value="B.Sc.CSIT - DAT - QUESTION PAPER" <?php if (isset($oldData)) {
                if ("B.Sc.CSIT - DAT - QUESTION PAPER" == $oldData['category']) echo "selected";
            } ?> >B.Sc.CSIT - DAT - QUESTION PAPER
            </option>
            <option value="B.Sc.CSIT - TU[IOST] - QUESTION PAPER" <?php if (isset($oldData)) {
                if ("B.Sc.CSIT - TU[IOST] - QUESTION PAPER" == $oldData['category']) echo "selected";
            } ?> >B.Sc.CSIT - TU[IOST] - QUESTION PAPER
            </option>
            <option value="B.Sc.CSIT - TU[IOST] - ENTRANCE RESULT" <?php if (isset($oldData)) {
                if ("B.Sc.CSIT - TU[IOST] - ENTRANCE RESULT" == $oldData['category']) echo "selected";
            } ?> >B.Sc.CSIT - TU[IOST] - ENTRANCE RESULT
            </option>
            <option value="BCA - DAT - QUESTION PAPER" <?php if (isset($oldData)) {
                if ("BCA - DAT - QUESTION PAPER" == $oldData['category']) echo "selected";
            } ?> >BCA - DAT - QUESTION PAPER
            </option>
            <option value="BCA - TU[FOHSS] - QUESTION PAPER" <?php if (isset($oldData)) {
                if ("BCA - TU[FOHSS] - QUESTION PAPER" == $oldData['category']) echo "selected";
            } ?> >BCA - TU[FOHSS] - QUESTION PAPER
            </option>
            <option value="APPLICATION FORMS" <?php if (isset($oldData)) {
                if ("APPLICATION FORMS" == $oldData['category']) echo "selected";
            } ?> >APPLICATION FORMS
            </option>
            <option value="OTHER UPLOADS" <?php if (isset($oldData)) {
                if ("OTHER UPLOADS" == $oldData['category']) echo "selected";
            } ?> >OTHER UPLOADS
            </option>
        </select>
        <label id="docCategory-error" class="error invalid-feedback" for="docCategory"></label>
    </div>

    <div class="form-group">
        <label for="file">File:</label>
        <input type="file" name="file" class="form-control" id="file" <?php if (!isset($oldData)) echo "required"; ?>>
        <label id="file-error" class="error invalid-feedback" for="file"></label>
        <?php if (isset($oldData)): ?>
            <p style="color: red;">*Select New File only to change the previous file</p>
        <?php endif ?>
    </div>

    <!-- <input type="file" name="file"> -->


    <?php if (isset($oldData)) { ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php } ?>
    <input type="hidden" name="action" value="<?php echo $action; ?>">

    <?php if ($action == "edit") { ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Update</button>");
        </script>
    <?php }else{ ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Save</button>");
        </script>
    <?php } ?>


    <noscript>
        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b>
        <p>
    </noscript>

</form>