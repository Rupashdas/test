<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
                $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $occupation = trim($_POST["occupation"]);
        $fburl = trim($_POST["fburl"]);
        $testimonial = trim($_POST["testimonial"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($occupation) OR empty($fburl) OR empty($testimonial) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "rupash.das.40@gmail.com";

        // Set the email subject.
        $subject = "New contact from $name";

        // Build the email content.
        $email_content = "First Name: $name\n";
        $email_content = "occupation: $occupation\n";
        $email_content .= "fburl: $fburl\n\n";
        $email_content .= "testimonial: $testimonial\n\n";

        // Build the email headers.
        $email_headers = "From: $name <$testimonial>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>