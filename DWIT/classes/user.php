<?php

class User extends Database
{
    private $initializer;
    private $hashed_token;

    function __construct()
    {
        parent::__construct();
        $this->getToken();
    }

    public function hashed_password($unhashed_pass)
    {
        $salt = uniqid(mt_rand(), true);
        $option = ['salt' => $salt, 'cost' => 12];
        $hashed_pass = password_hash($unhashed_pass, PASSWORD_DEFAULT, $option);
        return $hashed_pass;
    }

    public function checkLogin($email, $upass, $typeCheck = 0)
    {
        try {
            //echo "reched here";
            $stmt = $this->db->prepare("SELECT id,password,type,version FROM user WHERE email=:email AND enable=1 LIMIT 1");
            $stmt->bindparam(":email", $email);
            $stmt->execute();

            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                if (password_verify($upass, $userRow['password'])) {
                    if ($typeCheck == 1) {
                        return "Verified";
                    }
                    $_SESSION['authid'] = $userRow['id'];
                    $_SESSION['email'] = $email;
                    $_SESSION['userPrivilege'] = $userRow['type'];
                    $_SESSION['version'] = $userRow['version'];
                    $_SESSION['last_login_timestamp']=time();
                    $this->redirect("index.php");
                    header("location:index.php");
                } else {
                    if ($typeCheck == 1) {
                        Page_finder::set_message("Incorrect Password!!! Please try again later.", 'danger');
                        die($this->redirect('?fold=form&page=change-password'));
                        return false;
                    }else{
                        $this->invalid_login();
                        Page_finder::set_message("Invalid Login Attempt!!!", 'warning');
                        die($this->redirect("login.php"));
                        return false;
                    }
                }
            } else {
                $this->invalid_login();
                Page_finder::set_message("Invalid Login Attempt!!!", 'warning');
                die($this->redirect("login.php"));
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if (isset($_SESSION['authid'])) {
            if(isset($_SESSION['last_login_timestamp']))
            {
                if( (time() - $_SESSION['last_login_timestamp']) > 1200 )   //change time to 20min
                    $this->logout();
                else
                {
                    $_SESSION['last_login_timestamp']=time();
                    return true;
                }
            } else{
                $this->logout();
            }
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['authid']);
        return true;
    }

    private function invalid_login($userId = 0)
    {

        $date_time = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->tbl = 'login_attempt';
        $this->val = array(
            'ip' => $ip,
            'logstatus' => 0,
            'userid' => $userId,
            'token' => $this->hashed_token,
            'initializer' => $this->initializer,
            'login_time' => $date_time
        );
        $this->insert();
    }

    function check_attempt($generate = TRUE)
    {
        $count_attempt = $this->count_login_attempt();
        if ($count_attempt > 3) {
            return "Blocked User";
        } else {
            return "Allow";
        }
    }

    public function count_login_attempt()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d H:i:s', strtotime('-1 day')) . "<br>";
        $sql = $this->db->query("select count(*) as count_attempt from login_attempt where ip = '$ip' and login_time > '$date'");
        $row = $sql->fetch();
        $max = $row['count_attempt'];
        if ($max > 15)
            return $max;

        $sql = $this->db->query("select count(*) as count_attempt from login_attempt where ip = '$ip' and token='$this->hashed_token' and initializer = '$this->initializer'");
        $row = $sql->fetch();
        return $row['count_attempt'];
    }

    public function setToken()
    {
        $browser_info = $_SERVER['HTTP_USER_AGENT'];
        $browser_array = explode(' ', $browser_info);
        $browser_name = $browser_array[0];
        $this->initializer = rand();
        $this->hashed_token = md5($this->initializer . $_SERVER['REMOTE_ADDR'] . $browser_name);
        $_SESSION['login_token'] = $this->hashed_token;
        $_SESSION['initializer'] = $this->initializer;
    }


    public function getToken()
    {
        if (isset($_SESSION['login_token'])) {
            $this->session_to_properties();
        } else {
            $this->setToken();
        }
        return $this;
    }

    public function session_to_properties()
    {

        $this->initializer = $_SESSION['initializer'];
        $this->hashed_token = $_SESSION['login_token'];
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