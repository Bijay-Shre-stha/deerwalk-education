<?php
require_once("../system/application_top.php");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
if ($_POST['action'] == "export") {

    // Define a filename for the exported CSV file (you can modify this)
    $filename = 'exported_data.csv';
    $houseID = $_POST['houseID'];
    
    // Create a file pointer for writing the CSV data
    $file = fopen($filename, 'w');
    
    // Check the selected filter and fetch data accordingly
    if (isset($_POST['filter'])) {
        $filter = (int)$_POST['filter'];
    
        if ($filter == 1) {
            // Export data for filter 1
            $getData = $obj->db->query("SELECT book.id, book.full_name, book.email, book.high_school, book.phone_no, book.booked_date, book.interest, book.house_type, GROUP_CONCAT(source.source) as source FROM book LEFT JOIN source ON book.id = source.book_id WHERE open_house_id = '$houseID' AND house_type = '1' GROUP BY source.book_id ORDER BY book.id ASC");
        } elseif ($filter == 2) {
            // Export data for filter 2
            $getData = $obj->db->query("SELECT book.id, book.full_name, book.email, book.high_school, book.phone_no, book.booked_date, book.interest, book.house_type, GROUP_CONCAT(source.source) as source FROM book LEFT JOIN source ON book.id = source.book_id WHERE open_house_id = '$houseID' AND house_type = '2' GROUP BY source.book_id ORDER BY book.id ASC");
        } else {
            // Handle other cases or errors
            echo "Invalid filter selection.";
            exit();
        }
    } else {
        // Export data without filtering
        $getData = $obj->db->query("SELECT book.id, book.full_name, book.email, book.high_school, book.phone_no, book.booked_date, book.interest, book.house_type, GROUP_CONCAT(source.source) as source FROM book LEFT JOIN source ON book.id = source.book_id WHERE open_house_id = '$houseID' GROUP BY source.book_id ORDER BY book.id ASC");
    }
    
    // Write CSV header row
    fputcsv($file, array('SN', 'Name', 'Email', 'High School', 'Phone Number', 'Booked Date', 'Source', 'Interest', 'Applied For'));
    
    $sn = 1;
    $intProgram = ['-', 'CSIT', 'BCA', 'Both'];
    
    // Write data rows
    $sessionDetail = $obj->getDataByField("open_house", array("session_num", "session_date_1", "session_date_2", "session_type_1", "session_type_2"), array("id" => $houseID));
    while ($row = $getData->fetch()) {
        $interest = ($row['interest'] <= 3 && $row['interest'] >= 0) ? $intProgram[$row['interest']] : 'Invalid Choice';
    
        // Determine the session date and type
        if ($row['house_type'] == 2) {
            $sessionDate = substr($sessionDetail['session_date_2'], 0, 10);
            $sessionType = ($sessionDetail['session_type_2'] == 1) ? '(Online)' : '(On Campus)';
        } else {
            $sessionDate = substr($sessionDetail['session_date_1'], 0, 10);
            $sessionType = ($sessionDetail['session_type_1'] == 1) ? '(Online)' : '(On Campus)';
        }
        $data = array(
            $sn,
            $row['full_name'],
            $row['email'],
            $row['high_school'],
            $row['phone_no'],
            $row['booked_date'],
            $row['source'],
            $interest,
            $sessionDate . ' ' . $sessionType
        );
    
        fputcsv($file, $data);
    
        $sn++;
    }
    
    // Close the CSV file
    fclose($file);
    
    // Set headers to force download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Output the file to the browser
    readfile($filename);
    
    // Delete the file from the server (optional)
    unlink($filename);
    
    exit();
    }
    $obj->redirect('?page=openHouse');
    ?>