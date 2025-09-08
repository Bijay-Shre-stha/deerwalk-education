<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
// Create a new PHPMailer instance
$mail = new PHPMailer();
// SMTP configuration for Gmail
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'connect@deerwalk.edu.np'; // Your Gmail email address
$mail->Password = 'Connect_154'; // Your Gmail password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Sender and recipient email addresses
$mail->setFrom('connect@deerwalk.edu.np', 'Connect Form');
$mail->addAddress('connect@deerwalk.edu.np', 'Recipient Name');

// Get the values from the $_POST data
$school = $_POST['school'];
$high_school = $_POST['high_school'];
$district = $_POST['district'];
$email = $_POST['email'];
$name = $_POST['name'];

// Email content
$mail->isHTML(true);
$mail->Subject = 'Student Info for ' . $name;

// Construct the email body using the retrieved data
$body = "Name: $name<br>";
$body .= "School: $school<br>";
$body .= "High School: $high_school<br>";
$body .= "District: $district<br>";
$body .= "Email: $email<br>";
$mail->Body = $body;

if ($mail->send()) {
    $mail2 = new PHPMailer();

    // SMTP configuration for Gmail
    $mail2->isSMTP();
    $mail2->Host = 'smtp.gmail.com';
    $mail2->SMTPAuth = true;
    $mail2->Username = 'connect@deerwalk.edu.np'; // Your Gmail email address
    $mail2->Password = 'Connect_154'; // Your Gmail password
    $mail2->SMTPSecure = 'tls';
    $mail2->Port = 587;

    // Sender and recipient email addresses for the second email
    $mail2->setFrom('connect@deerwalk.edu.np', 'DWIT Connect');
    $mail2->addAddress($email, $name); // Use the email and name from $_POST

    // Email content for the second email
    $mail2->isHTML(true);
    $mail2->Subject = "Welcome to DWIT's Connect Program - Get Personalized Guidance from our Students";

    // Construct the email body for the second email
    $body2 = 'Dear ' . $name . ',<br><br>';
    $body2 .= 'Thank you for your interest in Deerwalk Institute of Technology (DWIT) and for utilizing our "Connect" feature. We are delighted to provide you with this opportunity to connect with DWIT students.<br><br>';
    $body2 .= 'As an educational institution specializing in undergraduate programs focused on Computer Science and Information Technology (BSc.CSIT) and Bachelors of Computer Application (BCA), DWIT has been dedicated to providing exceptional learning experiences to students like you.<br><br>';
    $body2 .= "Our 'Connect' feature has proven to be highly beneficial for over 100+ students in the past, enabling them to establish direct contact with DWIT students who share similar backgrounds and experiences. This connection allows for personalized advice and firsthand knowledge about DWIT's offerings, ensuring that you have the necessary information to make an informed choice.<br><br>";
    $body2 .= "Thank you once again for reaching out to us. We assure you that within a few days, our students will contact you to provide the guidance and information you seek. If you have any further questions or queries, please feel free to reach out to us.<br><br>";
    $body2 .= "For admission related issues, follow us on:<br>";
    $body2 .= "<a href='https://www.facebook.com/dwit.college'>Facebook</a><br>";
    $body2 .= "<a href='https://www.linkedin.com/school/deerwalk-institute-of-technology/'>LinkedIn</a><br>";
    $body2 .= "<a href='https://www.instagram.com/deerwalk.college/'>Instagram</a><br>";
    $body2 .= "<a href='https://twitter.com/deerwalkcollege'>Twitter</a><br><br>";
    $body2 .= 'Best Regards,<br>';
    $body2 .= "Connect Program, Deerwalk Institute of Technology<br><br>";
    $body2 .= '
    <footer>
      <div dir="ltr">
        <p dir="ltr" style="color: rgb(34, 34, 34); line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt">
          <span style="font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; vertical-align: baseline; white-space: pre-wrap"><img src="https://ci3.googleusercontent.com/mail-sig/AIorK4yjh5SR4N1U1podmS43eZHQOl455QLfAQ8tOLqD8SCEd5x4G1P-c-KrwWR2gGnpI0QdUi95NTI" class="CToWUd" data-bit="iit"><br></span>
        </p>
        <p dir="ltr" style="color: rgb(34, 34, 34); line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt">
          <span style="font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; vertical-align: baseline; white-space: pre-wrap"><br></span>
        </p>
        <p dir="ltr" style="color: rgb(34, 34, 34); line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt">
          <span style="font-size: 10pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; vertical-align: baseline; white-space: pre-wrap"><span class="il">DWIT</span> <span class="il">Connect</span></span>
        </p>
        <span class="im"><p dir="ltr" style="color: rgb(34, 34, 34); line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt">
            <span style="font-size: 10pt; font-family: Arial; color: rgb(15, 82, 136); background-color: transparent; vertical-align: baseline; white-space: pre-wrap">Deerwalk Institute of Technology | Sifal, Kathmandu</span>
          </p></span><span style="font-size: 10pt; font-family: Arial; color: rgb(15, 82, 136); background-color: transparent; vertical-align: baseline; white-space: pre-wrap">976-167-4882 |</span>
<a href="https://deerwalk.edu.np/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://deerwalk.edu.np/&amp;source=gmail&amp;ust=1687607954465000&amp;usg=AOvVaw1rwM8z0zvN86eLIWEkjkd5"><span style="font-size: 10pt; font-family: Arial; color: rgb(17, 85, 204); background-color: transparent; vertical-align: baseline; white-space: pre-wrap">deerwalk.edu.np</span></a><br><br><a href="https://www.facebook.com/dwit.college" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/dwit.college&amp;source=gmail&amp;ust=1687607954465000&amp;usg=AOvVaw0F8D2l40s4PX4JuhcPLosM"><img src="https://ci3.googleusercontent.com/mail-sig/AIorK4w2dbrDRseuDrSTUGMU4f6E05Q3JLejCrkBEw1sg5orLRS2p9rAUYB7xZzN8qiC97k4OalvBTQ" class="CToWUd" data-bit="iit"></a>&nbsp;&nbsp;<a href="https://www.linkedin.com/school/deerwalk-institute-of-technology/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.linkedin.com/school/deerwalk-institute-of-technology/&amp;source=gmail&amp;ust=1687607954465000&amp;usg=AOvVaw2nuN5rrFmuxDSQhyW4A3Cd"><img src="https://ci3.googleusercontent.com/mail-sig/AIorK4z4z0H8HZn72jTtr6uOj8yhFOr2B2_Nc7IRbd99XvwFY3tmsKwvshknVehKNeWyf62ivWBHdB4" class="CToWUd" data-bit="iit"></a>&nbsp;&nbsp;<a href="https://www.instagram.com/deerwalk.college/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.instagram.com/deerwalk.college/&amp;source=gmail&amp;ust=1687607954465000&amp;usg=AOvVaw14D8QoS5ql9aemy8sApZj5"><img src="https://ci3.googleusercontent.com/mail-sig/AIorK4y8lhc2qOSsWiFkIIolk3-hrhxiCjdF1_FgPDWvIEkVbgXTmoWGLNAUnK61nvEJClMtehhjK48" class="CToWUd" data-bit="iit"></a>
        <div class="yj6qo"></div>
        <div class="adL"><br></div>
      </div>
    </footer>
    ';
    $mail2->Body = $body2;

    // Send the second email
    if ($mail2->send()) {
        header('Content-Type: application/json');
        echo json_encode(array("status" => 1, "detail" => "Emails sent successfully!"));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("status" => 0, "detail" => "Failed to send the second email."));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array("status" => 0, "detail" => "Failed to send email."));
}
?>
