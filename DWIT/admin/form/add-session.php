<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['sid'])) {
    $id = (int)$_GET['sid'];
    // $oldData = $obj->getFieldDataById("open_house", array("session_num", "Session_date", "Session_date_online", "session_type", "session_time", "session_time_online", "enable", "maxCount"), $id);
    $oldData = $obj->getFieldDataById("open_house", array("session_year", "session_num", "session_date_1", "session_time_1", "max_count_1", "session_type_1", "session_date_2", "session_time_2", "max_count_2", "session_type_2"), $id);
    $action = "edit";
} else {
    $action = "add";
}

$presentYear = date('Y');

?>


<h2 class="text-center">Create Open House Session</h2>

<form action="?fold=actpages&page=act_session" id="add-session" method="POST">
    <div class="form-group">
        <label for="sessionYear">Session Year:</label>
        <input type="number" class="form-control" id="sessionYear" placeholder="Enter year" name="sessionYear"
               value="<?php if (isset($oldData)) echo $oldData['session_year']; else echo $presentYear + 1; ?>" min="2000" max="2100">
        <label id="sessionYear-error" class="error invalid-feedback" for="sessionYear"></label>
    </div>

    <div class="form-group">
        <label for="sessionNum">Session:</label>
        <select class="form-control" id="sessionNum" name="sessionNum">
            <option selected disabled>--Select a Number--</option>
            <?php for ($i = 1; $i <= 100; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php if (isset($oldData)) if ($oldData['session_num'] == $i) echo "selected"; ?> ><?php echo $i; ?></option>
            <?php } ?>
        </select>
        <label id="sessionNum-error" class="error invalid-feedback" for="sessionNum"></label>
    </div>

    <br>

    <div>
        <p><span class="h5">Session - I </span>(<span class="text-danger h6">*Required</span>)</p>
    </div>
    <hr>
    
    <div class="form-group">
        <label for="sessionDate1">Session Date:</label>
        <input type="date" class="form-control" id="sessionDate1" name="sessionDate1"
               value="<?php if (isset($oldData)) echo substr($oldData['session_date_1'], 0, 10); ?>" <?php if (!isset($oldData)) echo "min=\"" . $presentYear . "-01-01\" max=\"" . ($presentYear + 1) . "-12-31\"" ?> >
        <label id="sessionDate1-error" class="error invalid-feedback" for="sessionDate1"></label>
    </div>

    <div class="form-group">
        <label for="sessionTime1">Session Time:</label>
        <input type="time" class="form-control" id="sessionTime1" name="sessionTime1"
               value="<?php if (isset($oldData)) echo $oldData['session_time_1']; ?>">
        <label id="sessionTime1-error" class="error invalid-feedback" for="sessionTime1"></label>
    </div>

    <div class="form-group">
        <label for="maxParticipants1">Max Participants:</label>
        <input type="number" class="form-control" id="maxParticipants1" placeholder="Enter number" name="maxParticipants1"
               value="<?php if (isset($oldData)) echo $oldData['max_count_1']; ?>">
        <label id="maxParticipants1-error" class="error invalid-feedback" for="maxParticipants1"></label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="2" id="sessionType1" name="sessionType1" <?php echo isset($oldData['session_type_1']) && $oldData['session_type_1'] == 2 ? 'checked' : '' ?>>
        <label class="form-check-label" for="sessionType1">
            On Campus
        </label>
    </div>
    <hr>

    <br>

    <div>
        <p><span class="h5">Session - II </span>(<span class="text-info h6">Optional</span>)</p>
    </div>
    <hr>

    <div class="form-group">
        <label for="sessionDate2">Session Date:</label>
        <input type="date" class="form-control" id="sessionDate2" name="sessionDate2"
               value="<?php if (isset($oldData)) echo substr($oldData['session_date_2'], 0, 10); ?>" <?php if (!isset($oldData)) echo "min=\"" . $presentYear . "-01-01\" max=\"" . ($presentYear + 1) . "-12-31\"" ?> >
        <label id="sessionDate2-error" class="error invalid-feedback" for="sessionDate2"></label>
    </div>

    <div class="form-group">
        <label for="sessionTime2">Session Time:</label>
        <input type="time" class="form-control" id="sessionTime2" name="sessionTime2"
               value="<?php if (isset($oldData)) echo $oldData['session_time_2']; ?>">
        <label id="sessionTime2-error" class="error invalid-feedback" for="sessionTime2"></label>
    </div>

    <div class="form-group">
        <label for="maxParticipants2">Max Participants:</label>
        <input type="number" class="form-control" id="maxParticipants2" placeholder="Enter number" name="maxParticipants2"
               value="<?php if (isset($oldData)) echo $oldData['max_count_2']; ?>">
        <label id="maxParticipants2-error" class="error invalid-feedback" for="maxParticipants2"></label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="2" id="sessionType2" name="sessionType2" <?php echo isset($oldData['session_type_2']) && $oldData['session_type_2'] == 2 ? 'checked' : '' ?>>
        <label class="form-check-label" for="sessionType2">
            On Campus
        </label>
    </div>
    
    <hr>
    <br>

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