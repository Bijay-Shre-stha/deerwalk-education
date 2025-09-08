<?php

require_once dirname(dirname(__FILE__)) . '/system/config.php';

class Database
{
    public $db;

    public function __construct()
    {
        try {
            #$this->db = new PDO("mysql:host=localhost;dbname=dwit;", 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            #************utf-8 went unrecognised by database**************
            $this->db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";", DB_USER, DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    //$getData=$obj->select("staff",array("id","full_name","description","image_name"),NULL,NULL,NULL,LEFT,department,staff.department_id,department.id);


    public function select($table, $field = '*', $cond = NULL, $order = NULL, $limit = NULL, $joinType = NULL, $table2 = NULL, $fld1 = NULL, $fld2 = NULL, $uniq = false)
    {
        // print_r($cond);
        $field_name = "";
        try {
            if (is_array($field)) {
                foreach ($field as $val) {
                    $field_name .= $val . ',';
                }
                $field_name = substr($field_name, 0, -1);

                if(!$uniq)
                    $sql = "Select $field_name from $table";
                else
                    $sql = "Select distinct $field_name from $table";
            } else {
                if(!$uniq)
                    $sql = "Select $field from $table";
                else
                    $sql = "Select distinct $field from $table";
            }

            if (!empty($joinType)) {
                $sql .= " " . $joinType . " " . "JOIN" . " " . $table2 . " " . "ON" . " " . $table . "." . $fld1 . "=" . $table2 . "." . $fld2;
            }

            if (is_array($cond)) {
                foreach ($cond as $key => $val) {
                    $requiredKey = $key;
                    if(strpos($key, ".") !== false)
                    {
                        $tempKey = explode(".", $key);
                        $requiredKey = $tempKey[1];
                    }
                    $cond_Arr[] = "$key=:$requiredKey";
                }
                $sql .= " where " . implode(" and ", $cond_Arr);
            } elseif ($cond != NULL) {
                $sql .= " where " . $cond;
            }

            if (is_array($order)) {
                foreach ($order as $key => $val) {
                    $or_arr[] = "$key $val";
                }
                $sql .= " order by " . implode(',', $or_arr);
            }

            if (is_array($limit)) {
                $sql .= " LIMIT " . $limit[0] . ", " . $limit[1];
            }elseif($limit != NULL){
                $sql .= " LIMIT ". $limit;
            }

            //  echo $sql;
            if (is_array($cond)) {

                $stmt = $this->db->prepare($sql);
                foreach ($cond as $key => &$val) {
                    $requiredKey = $key;
                    if(strpos($key, ".") !== false)
                    {
                        $tempKey = explode(".", $key);
                        $requiredKey = $tempKey[1];
                    }
                    $stmt->bindParam($requiredKey, $val);

                    // die($val);
                }
            } else {
                $stmt = $this->db->query($sql);
            }
            // $stmt->debugDumpParams();
            $stmt->execute();
            return $stmt;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        //  echo $sql;
    }

    public function insert()
    {
        try {
            $sql = "insert into $this->tbl";

            foreach ($this->val as $key => $val) {
                $f_arr[] = $key;
                $v_arr[] = ":" . $key;
            }
            $field = implode(',', $f_arr);
            $value = implode(',', $v_arr);

            $sql .= "($field) VALUES ($value)";
            //echo $sql; die();

            $stmt = $this->db->prepare($sql);

            foreach ($this->val as $k => &$v) {
                //echo $v."<br>";
                $stmt->bindParam(":$k", $v, PDO::PARAM_INT | PDO::PARAM_STR); //Reference Variable needed
                //$stmt->bindValue(":$k", $v,PDO::PARAM_STR);   // No refrence variable needed   
            }

            $stmt->execute();
            //echo $sql;
            //$stmt->debugDumpParams();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        return $this->db->lastInsertId();
    }

    public function redirect($url)
    {
        echo '<script>window.location="' . str_replace('"', '\"', $url) . '"</script>';
        header("Location: $url");
    }


    public function update()
    {
        try {
            $sql = "update  $this->tbl set ";

            foreach ($this->val as $key => $val) {
                $f_arr[] = "$key=:$key";
            }

            $sql .= implode(',', $f_arr);

            foreach ($this->cond as $key => $val) {
                $cond_arr[] = "$key=:$key";
            }


            $sql .= " where " . implode(" and ", $cond_arr);
            //  echo $sql; die();
            $stmt = $this->db->prepare($sql);

            foreach ($this->val as $k => &$v) {
                $stmt->bindParam(":$k", $v, PDO::PARAM_INT | PDO::PARAM_STR);
            }

            foreach ($this->cond as $key => &$val) {
                $stmt->bindParam(":$key", $val, PDO::PARAM_INT | PDO::PARAM_STR);
            }

            $stmt->execute();
            //  $stmt->debugDumpParams();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function delete()
    {
        $sql = "delete from $this->tbl where ";
        foreach ($this->cond as $k => $v) {
            $cond_arr[] = "$k=:$k";
        }
        $sql .= implode("and", $cond_arr);
        $stmt = $this->db->prepare($sql);
        foreach ($this->cond as $key => $val) {
            $stmt->bindParam(":$key", $val, PDO::PARAM_INT);
        }
        $stmt->execute();
    }

    public function alert($msg, $url)
    {

        echo '<script> alert("' . $msg . '"); </script>';
        echo '<script>window.location="' . str_replace('"', '\"', $url) . '"</script>';
    }

    public function countRow($query)
    {
        return $query->rowCount();
    }

    public function StringInputCleaner($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = (filter_var($data, FILTER_SANITIZE_STRING));
        return $data;
    }

    public function cleanInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function getREQUEST($strVarName, $strDefaultVal = '')
    {
        $strReturnVal = false;
        $strReturnVal = $strDefaultVal;
        if (isset($_GET[$strVarName]))
            $strReturnVal = $_GET[$strVarName];
        elseif (isset($_POST[$strVarName]))
            $strReturnVal = $_POST[$strVarName];
        elseif (isset($_COOKIE[$strVarName]))
            $strReturnVal = $_COOKIE[$strVarName];
        return $strReturnVal;
    }

    public function insertOrUpdate()
    {
        try {
            $sql = "insert into $this->tbl";

            foreach ($this->val as $key => $val) {
                $f_arr[] = $key;
                $v_arr[] = ":" . $key;
            }
            $field = implode(',', $f_arr);
            $value = implode(',', $v_arr);




            $sql .= "($field) VALUES ($value)";
            // echo $value; die();
            

            $sql .= " ON DUPLICATE KEY UPDATE ";

            foreach ($this->val as $key => $val) {
                $sql .= $key.'=:'.$key.',';
            }

            $sql = rtrim($sql, ',');

            $stmt = $this->db->prepare($sql);


            foreach ($this->val as $k => &$v) {
                $stmt->bindParam(":$k", $v, PDO::PARAM_INT | PDO::PARAM_STR); //Reference Variable needed
            }

            $stmt->execute();
            //echo $sql;
            //$stmt->debugDumpParams();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        return $this->db->lastInsertId();
    }
}

?>
