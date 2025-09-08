<div class="paginate" style="margin-top: 1%;">
    <ul class="pagination">
        <li><a href="?page=<?php echo $_GET['page'] ?>&pageno=1">
                <button type="button" class="btn btn-info">First</button>
            </a></li>
        <li class="<?php if ($pageno <= 1) {
            echo 'disabled';
        } ?>">
            <a href="<?php if ($pageno <= 1) {
                echo '#';
            } else {
                echo "?page=" . $_GET['page'] . "&pageno=" . ($pageno - 1);
            } ?>">
                <button type="button" class="btn btn-info">Prev</button>
            </a>
        </li>
        <li class="<?php if ($pageno >= $totalPage) {
            echo 'disabled';
        } ?>">
            <a href="<?php if ($pageno >= $totalPage) {
                echo '#';
            } else {
                echo "?page=" . $_GET['page'] . "&pageno=" . ($pageno + 1);
            } ?>">
                <button type="button" class="btn btn-info">Next</button>
            </a>
        </li>
        <li><a href="?page=<?php echo $_GET['page'] ?>&pageno=<?php echo $totalPage; ?>">
                <button type="button" class="btn btn-info">Last</button>
            </a></li>
    </ul>
</div>