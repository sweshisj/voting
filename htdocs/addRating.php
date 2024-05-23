<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Retrieve the rating value from the AJAX request
$rating = floatval($_POST['rating']);

// Create a new document with the rating value
$document = [
    'userRating' => $rating
];

// Create an insert command object
$command = new MongoDB\Driver\Command([
    'insert' => 'voting',
    'documents' => [$document],
]);

// Execute the insert command
$result = $manager->executeCommand('barayamal', $command);

// Check if the insert was successful
if ($result->getInsertedCount() > 0) {
    // Return a success response to the AJAX request
    echo "Rating added successfully";
} else {
    // Return an error response to the AJAX request
    echo "Failed to add rating";
}
?>