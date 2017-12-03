<?php
include 'smtp/Send_Mail.php';

/* Set e-mail recipient */
$myemail  = "manish8081@gmail.com";
$to=$myemail;

/* Check all form inputs using check_input function */
$yourname = check_input($_POST['yourname'], "Enter your name");
$subject  = check_input($_POST['subject'], "Write a subject");
$email    = check_input($_POST['email']);
$view  = check_input($_POST['view']);
$comments = check_input($_POST['comments'], "Write your comments");

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}

/* Let's prepare the message for the e-mail */
$message = "Hello! <br/> <br/>

Your contact form has been submitted by: <br/> <br/>

Name: $yourname <br/> <br/>
E-mail: $email <br/> <br/>
Subject: $subject <br/> <br/>

Like the website? $view <br/> <br/>

Comments: <br/> <br/>
$comments <br/> <br/>

End of message
";

/* Send the message using mail() function */
Send_Mail($to, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: thanks.htm');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>