<h2 class="text-center">Upload ICS File </h2>
<div class="container1 mt-5">
    <form action="?fold=actpages&page=act_calendar" method='POST' name="myform" class="form-group"  enctype="multipart/form-data">
        </div> <div class="form-group">
            <label for="name">Calendar File:</label>
            <input type="file" class="form-control" id="ics-file" name="ics-file" required>
            <label id="ics-file-error" class="error invalid-feedback" for="ics-file"></label>
        </div>
        <input type="hidden" name="action" value="add">

        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Save</button>");
        </script>

    </form>
</div>