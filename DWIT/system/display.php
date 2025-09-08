<?php

class Page_finder
{
    public static function findPage($page = "users", $folder = "pages")
    {
        if ($page == "")
            $page = 'users';
        if ($folder == "")
            $folder = "pages";


        $path = $folder . "/" . $page . ".php" or die();

        if (file_exists($path))
            return $path;
        else
            return "pages/404.php";
    }

    public static function getStatus($status)
    {
        if ($status == "i-success") {
            echo '<div class="box">
	                     <div class="box_head"><img src="images/check-64.png" />Content Successfully Added!!</div>
	                    </div>';
        } elseif ($status == "u-success") {
            echo '<div class="box">
	                    <div class="box_head"><img src="images/check-64.png" />Content Successfully Edited!!</div>
	                    </div>';
        }
    }

    public static function set_message($msg, $type)
    {
        if (!empty($msg)) {
            $_SESSION['session_message'] = $msg;
            $_SESSION['session_type'] = $type;
        }
    }

    public static function get_message()
    {
        if (isset($_SESSION['session_message']) && $_SESSION['session_message'] != "") {
            $msg = '<div class="alert alert-' . $_SESSION['session_type'] . '">
	                    <strong> ' . $_SESSION['session_message'] . '</strong>
	                   </div>';
            unset($_SESSION['session_message']);
            unset($_SESSION['session_type']);
            return $msg;
        } else {
            return FALSE;
        }
    }
}

?>