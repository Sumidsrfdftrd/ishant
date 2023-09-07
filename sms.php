<?php
// Define the file path where you want to save the data
$txtFilePath = 'sms.txt';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the content of the POST request
    $content = file_get_contents('php://input');

    if ($content !== false) {
        // Read existing data from the text file, if it exists
        $existingData = '';
        if (file_exists($txtFilePath)) {
            $existingData = file_get_contents($txtFilePath);
        }

        // Append the new data to the existing data
        $combinedData = $existingData . "\n" . $content;

        // Save the combined data to the text file
        if (file_put_contents($txtFilePath, $combinedData) !== false) {
            http_response_code(200);
            echo 'Data saved successfully.';
        } else {
            http_response_code(500);
            echo 'Error saving data.';
        }
    } else {
        http_response_code(400);
        echo 'No content sent in the request.';
    }
} else {
    http_response_code(405);
    echo 'This endpoint only accepts POST requests.';
}
?>
