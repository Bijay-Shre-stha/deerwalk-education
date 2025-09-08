<?php
include_once("database.php");

require_once('phpmailer/class.phpmailer.php');
require_once("phpmailer/class.smtp.php");
require_once ("phpmailer/PHPMailerAutoload.php");

class Functions extends database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getCount($table, $cond = NULL)
    {
        $getCount = $this->select($table,"id", $cond);  //id has been compromised //can be replaced with count(id)
        return $getCount->rowCount();
    }

    public function getAllData($table)
    {
        $result = $this->select($table, "*");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getDataByField($table, $field, $cond = NULL, $order = "DESC")
    {
        $data = $this->select($table, $field, $cond, array("id" => $order));
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllDataByField($table, $field, $cond = NULL, $order = array("id" => "DESC"))
    {
        $data = $this->select($table, $field, $cond, $order);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectDataByField($table, $field, $cond)
    {
        $data = $this->select($table, $field, $cond);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function selectAllDataByField($table, $field, $cond)
    {
        $data = $this->select($table, $field, $cond);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFieldDataById($table, $field, $id)
    {
        $data = $this->select($table, $field, "id=$id");
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function numToRoman($num)
    {
        $roman = "";

        $romanValue = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1,
        );

        while ($num != 0) {
            foreach ($romanValue as $key => $value) {
                if ($num >= $value) {
                    $roman .= $key;
                    $num -= $value;
                    break;
                }
            }
        }
        return $roman;
    }


    public function getFileName($file, $folder, $fileType = 0, $page = NULL, $redirectId = NULL, $maxSize = 500000)
    {
        $fileName = $file['name'];
        $fileName = str_replace(' ', '', $fileName);
        if (!empty($fileName)) {
            $initType = explode("/", $file['type']);
            $type = end($initType);
            if ($this->typChecker($type, $fileType) == 1 && $this->mimeChecker($file['type'], $fileType) == 1) {
                $size = $file['size'];

                if ($size < $maxSize) {      //fix size needed
                    $source = $file['tmp_name'];
                    $fileName = date("Ymdhis_") . $fileName;
                    $destination = "../admin/uploads/" . $folder . "/" . $fileName;
                    $uploadStatus = move_uploaded_file($source, $destination);
                    if($uploadStatus == 1)
                        return $fileName;
                    else{
                        Page_finder::set_message("Image could not be uploaded.Please Try Again Later", 'warning');
                        if($redirectId != NULL)
                            die($this->redirect("?fold=form&page=add-$page&$redirectId"));    
                        else
                            die($this->redirect("?fold=form&page=add-$page"));
                    }
                } else {
                    Page_finder::set_message("Upload Image size exceed max allocated size", 'danger');
                    if($redirectId != NULL)
                        die($this->redirect("?fold=form&page=add-$page&$redirectId"));    
                    else
                        die($this->redirect("?fold=form&page=add-$page"));
                }
            } else {
                Page_finder::set_message("Invalid File Type", 'danger');
                if($redirectId != NULL)
                        die($this->redirect("?fold=form&page=add-$page&$redirectId"));    
                    else
                        die($this->redirect("?fold=form&page=add-$page"));
            }
        } else {
            return 0;
        }
    }


    public function typChecker($type, $fileType)
    {
        $validTypes = array("JPG", "JPEG", "PNG", "TIF", "GIF");
        if ($fileType == 0) {
            if (in_array(strtoupper($type), $validTypes))
                return 1;
        } elseif ($fileType == 1) {
            if (strtoupper($type) == "PDF")
                return 1;
        } else if ($fileType == 2){
            if (strtoupper($type) == "PNG")
                return 1;
        }
        return 0;
    }

    public function mimeChecker($mime, $fileType)
    {
        $validTypes = array("image/jpg", "image/jpeg", "image/png", "image/tif", "image/gif");
        if ($fileType == 0) {
            if (in_array(strtolower($mime), $validTypes))
                return 1;
        } elseif ($fileType == 1) {
            if (strtolower($mime) == "application/pdf")
                return 1;
        } elseif ($fileType == 2){
            if (strtolower($mime) == "image/png")
                return 1;
        }
        return 0;   
    }

    public function removeOldFile($file, $folder)
    {
        $path = "uploads/" . $folder . "/" . $file;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function checkValue($value, $page)
    {
        if ($value == NULL) {
            Page_finder::set_message("We expect some value. Please insert valid value and try again or contact system administrator", 'danger');
            die($this->redirect("?page=$page"));
        } else {
            return $value;
        }
    }

    public function selectYear($present, $value)
    {
        for ($i = $present, $j = 0; $i >= 2018; $i--, $j++) {
            $year[$j] = $i;
        }

        $value = $value - 1;
        return $year["$value"];
    }

    public function getYearOnly($date)
    {
        $date = explode("-", $date);
        $year = $date[0];
        return $year;
    }

    // public function changeDateFormat($date)
    // {
    //     $date=substr($date, 0,10);
    //     $dateArray=explode("-",$date);
    //     $newdate=$dateArray[1]."/".$dateArray[2]."/".$dateArray[0];
    //     return $newdate;        
    // }

    public function dynamicContentFetch($list1, $list2 = null, $page = null)
    {
        $retValue = "";
            if($list2 != null){
                if(count($list1) == count($list2)){
                    $list = array_combine($list1, $list2);
                    foreach ($list as $key => $value) {
                        if($key != "")
                            $retValue .= "\"".str_replace("\"", "", $key)."{".str_replace("null", "", $value)."}\",";
                    }
                }else{
                    Page_finder::set_message("Try Again With Matching Field Value.", 'warning');
                    die($this->redirect("?page=$page"));
                }
            }else{
                foreach ($list1 as $value) {
                    if($value != "")
                        $retValue .= "\"".str_replace("\"", "", $value)."\",";
                }
            }
            // if($retValue == "")
            //     $retValue = null;
            // else
                $retValue = substr($retValue, 0, -1);

            return $retValue;
    }

    public function getStrippedValue($unstripped)
    {
        if($unstripped != null)
        {
            $institute = array();
            $date = array();

            $strippedValue = $this->stripQuote($unstripped);

            $pattern = "/{.*?}/";

            foreach ($strippedValue as $value) {
                $inst = preg_replace($pattern, "", $value);
                $institute[] = $inst;

                preg_match_all("/{.*?}/", $value, $newValue);
                $newValue = $newValue[0][0];
                $dte = preg_replace('~[{}]~', '', $newValue);

                if($dte == null)
                    $dte = "null";
                $date[] = $dte;
            }

            if(count($institute) == count($date))
            {
                $newArray = array_combine($institute, $date);
                return $newArray;
            }else{
                return false;
            }
        }else{
            return [];
        }
    }

    public function stripQuote($unstripped)
    {
        if($unstripped != null)
        {
            $newValue = array();
            $pattern = "/&quot;.*?&quot;/";
            preg_match_all($pattern, $unstripped, $strippedValue);

            foreach ($strippedValue[0] as $value) {
                $newArray[] = str_replace("&quot;", "", $value);
            }

            return $newArray;
        }else{
            return [];        
        }
    }

    public function selectJoinWhere($table1, $field, $cond, $joinType, $table2, $join1, $join2)
    {
        $data = $this->select($table1, $field, $cond, NULL, NULL, $joinType, $table2, $join1, $join2);
        //print_r($data);
        //return $data;
        //die();
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function selectAllJoin($table1, $field, $order, $joinType, $table2, $join1, $join2)
    {
        $data = $this->select($table1, $field, NULL, $order, NULL, $joinType, $table2, $join1, $join2);
        //print_r($data);
        //return $data;
        //die();
        return $data;
    }

    public function getDataByLimit($table, $field, $limit, $order = "DESC")
    {
        $data = $this->select($table, $field, NULL, array("id" => $order), $limit);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function distinctSelectAllDataByField($table, $field, $cond, $order)
    {
        //print_r("here".$order);
        //die();
        $data = $this->select($table, $field, $cond, $order, NULL, NULL, NULL, NULL, NULL, true);
        //print_r($data);
        //die();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function toggleStatus($table, $field, $updateTo, $refField, $refVal)
    {
        $this->db->query("update ".$table." set ".$field."=".$updateTo." where ".$refField."=".$refVal);
    }

    public function csvReader($file, $tableName)
    {
        $lines = explode( "\n", file_get_contents( $file ) );
        $headers = str_getcsv( array_shift( $lines ) );
        $data = array();

        foreach ($lines as $line) {
            $row = array();
            
            foreach ( str_getcsv( $line ) as $key => $field )
            {
                $row[ $headers[ $key ] ] = $field;
            }

            $row = array_filter( $row );
            $data[] = $row;
        }

        $titles = explode(",", file($file)[0]);
        
        $sql = "INSERT INTO `".$tableName."` (";
        foreach ($titles as $title) {
            //initial error with RS character so replacing RS with ''
            $sql .= "".str_replace("﻿", "", $title).", ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ") VALUES ";

        foreach ($data as $key => $values) {
            $sql .= "(";
            foreach ($values as $key => $value) {
                $sql .= "'".$this->InputStringCleaner($value)."', ";
            }
            
            $sql = rtrim($sql, ", ");
            $sql .= "), ";
        }

        $sql = rtrim($sql, ", ");
        // echo $sql;
        $status = $this->db->query($sql);
        if($status == 1)
        {
            return "Data Inserted";
        }else{
            return "Data Insert Failed";
        }
    }
    
    public function getFilterDataByLimit($table, $field, $cond, $order, $limit = 1)
    {
        $data = $this->select($table, $field, $cond, $order, $limit);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkValueRe($value, $page)
    {
        if ($value == NULL) {
            Page_finder::set_message("We expect some value. Please insert valid value and try again", 'warning');
            // die("error");
            die($this->redirect("$page"));
        } else {
            return $value;
        }
    }

    public function sendMail($from,$to, $subject, $message, $cc = null, $bcc = null, $replyTo = null){
        if($from == "DWIT"){
            $email = EMAIL;
            $password = PASSWORD;
        }else if($from == "DMT"){
            $email = EMAIL2;
            $password = PASSWORD2;
        }
        
        try{
            $mailer = new PHPMailer();
            $mailer->IsSMTP();
            $mailer->SMTPSecure = 'tls';
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMPTDebug = 2;
            $mailer->Port = 587;
            $mailer->Username = $email;
            $mailer->Password = $password;
            $mailer->SMTPAuth = true;
            $mailer->From = $email;
            $mailer->FromName = $from;
            $mailer->Subject = $subject;
            $mailer->isHTML(true);
            $mailer->Body = $message;
            if($replyTo == null)
                $mailer->AddReplyTo( $email, $from );
            else
                $mailer->AddReplyTo($replyTo, '');
            
            $mailer->AddAddress($to);

            if(is_array($cc))
            {
                foreach ($cc as $ccmail) {
                      $mailer->addCC($ccmail);
                  }  
            }

            if(is_array($bcc))
            {
                foreach ($bcc as $bccmail) {
                      $mailer->addBCC($bccmail);
                  }  
            }else{
                $data = $this->selectAllDataByField('contact_person', array('email'), null);

                    foreach ($data as $value) {
                        $mailer->addBCC($value['email']);
                        // echo $value['email'];
                    }
            }

            $mailer->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            if($mailer->Send())
                return 1;
            else
                return 0;
        }catch (phpmailerException $e){
            //echo $e->errorMessage();
            return 0;
        }
          
    }

    public function getOHSMessage($name, $high_school, $phone, $house_id, $houseType)
    {
        $data = $this->selectDataByField('open_house', array('session_num', 'session_date_1', 'session_date_2', 'session_time_1', 'session_time_2', 'session_type_1', 'session_type_2'), array('id' => $house_id));

        $bookedDate = ($houseType == 1) ? date('D M d, Y', strtotime($data["session_date_1"])) :date('D M d, Y', strtotime($data["session_date_2"]));

        $bookedTime = ($houseType == 1) ? $data['session_time_1'] : $data['session_time_2'];

        $msg = '<p>' . $name . ',</p>
            <p> Your open house seat has been booked with the following details. </p>
            <p> Open House Session: ' . $data['session_num'] . '</p>
            <p> Date: ' . $bookedDate . '</p>
            <p> Time: ' . date('h:i a',strtotime($bookedTime)) . '</p>
            <p> High School: '. $high_school . '</p>
            <p> Phone Number: '. $phone . '</p>';

            //sesison_type = 1 //online session ; session_type=2//on campus session;
        if(($houseType == 1 && $data['session_type_1'] == 1) || ($houseType == 2 && $data['session_type_2'] == 1))
        {
            // $msg .= '<p>Here is the link for the Open House Session:<br>
            //         <i>https://us02web.zoom.us/j/89857162857?pwd=ZEUvblN4dHY0TUMwMWs4UUV4VkVsdz09</i></p>';
            $msg .= '<p><b>Join Zoom Meeting</b><br>
                    <i>https://us02web.zoom.us/j/83419761737?pwd=NmdwejgzelQ0RmlLZ1ljMWl4TDJTZz09</i></p>';

            $msg .= '<p><b>Meeting ID:</b> 898 5716 2857<br>';
            $msg .= '<b>Passcode:</b>  270818</p>';
            
            $msg .= '<p><i> Please join the meeting 10 minutes prior to the start time.</i></p>';
        }else{
            $msg .= '<p><i> Please be at college premises 10 minutes before the start time. </i></p>';
        }
        $msg .= '<br>'; 
        $msg .= '<p>Best Regards,<br> DWIT Admission Department</p>';

        return $msg;
    }

    public function checkAvaibility($houseId)
    {
        $data = $this->selectDataByField('open_house', array('max_count_1', 'max_count_2'), array('id' => $houseId));
        $maxCount1 = $data['max_count_1'];
        $maxCount2 = $data['max_count_2'];

        $bookedFor1 = $this->getBookedUserCount($houseId, 1);
        $bookedFor2 = $this->getBookedUserCount($houseId, 2);

        if($bookedFor1 >= $maxCount1 && $bookedFor2 >= $maxCount2)
            $this->db->query("update open_house set enable = 0 where id= '$houseId' ");
    }

    public function getBookedUserCount($houseId, $houseType)
    {
        $data = $this->selectDataByField('book', array('count(id) as bookBy'), array('open_house_id' => $houseId, 'house_type' => $houseType));
        return (int)$data['bookBy'];        
    }

    public function checkTime($date, $time)
    {
        //
        // returns 1 if date time is less than now else 0
        //

        $maxDate = date('Ymd', strtotime($date));
        $maxTime = date('Hi', strtotime($time));

        $nowDate = date('Ymd');
        $nowTime = date('Hi');

        if($nowDate < $maxDate || ($nowDate == $maxDate && $nowTime < $maxTime))
        {
            return 1;
        }else{
            return 0;
        }        
    }


    public function getIcsEventsAsArray($file) {
        $icalString = file_get_contents ( $file );
        $icsDates = array ();
        $icsData = explode ( "BEGIN:", $icalString );

        foreach ( $icsData as $key => $value ) {
            $icsDatesMeta [$key] = explode ( "\n", $value );
        }
        
        unset( $icsDatesMeta [0] ,$icsDatesMeta[1]);
        $summarized_ics_data = [];
        
        foreach($icsDatesMeta as $icsDatesMetaArray){
            $break_point = array_search("\t\r",$icsDatesMetaArray);
            if($break_point != false){    
                $summary = trim($icsDatesMetaArray[2],"\r");
                for($i=3;$i<=4;$i++){
                    $summary_parts = substr($icsDatesMetaArray[$i],1,-1);
                    $summary.=$summary_parts;
                    unset($icsDatesMetaArray[$i]);
                }
                $icsDatesMetaArray[2] = $summary;
                array_push($summarized_ics_data,$icsDatesMetaArray);
            }else{
                array_push($summarized_ics_data,$icsDatesMetaArray);

            }
        }
        /* Itearting the Ics Meta Value */
        foreach ( $summarized_ics_data as $key => $value ) {
            foreach ( $value as $subKey => $subValue ) {
                /* to get ics events in proper order */
                $icsDates = $this->getICSDates ( $key, $subKey, $subValue, $icsDates );
            }
        }
        return $icsDates;
    }

    /* funcion is to avaid the elements wich is not having the proper start, end  and summary informations */
    public function getICSDates($key, $subKey, $subValue, $icsDates) {
        if ($key != 0 && $subKey == 0) {
            $icsDates [$key] ["BEGIN"] = $subValue;
        } else {
            $subValueArr = explode ( ":", $subValue, 2 );
            if (isset ( $subValueArr [1] )) {
                $icsDates [$key] [$subValueArr [0]] = $subValueArr [1];
            }
        }
        return $icsDates;
    }

}









?>
