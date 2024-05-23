<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$countQuery = new MongoDB\Driver\Query([]);
$query = new MongoDB\Driver\Query([]);

$cursor = $manager->executeQuery('barayamal.voting', $query);
$countCursor = $manager->executeQuery('barayamal.voting', $countQuery);
$total_ratings = count($countCursor->toArray());

$totalRatingValue = 0;

// Iterate through the documents and calculate the total rating and total ratings
foreach ($cursor as $document) {
  if (isset($document->userRating)) {
    $totalRatingValue += $document->userRating;
  }
}

// Calculate the average rating if there are ratings available
if ($total_ratings > 0) {
  $public_rating_of_RAP = $totalRatingValue / $total_ratings;
} else {
  $public_rating_of_RAP = "N/A";
}

$company_name = "Barayamal";
$company_description = "We’re committed to elevating the role of First Nations entrepreneurship in fostering social, environmental and economic development, paving the way for a better future that’s built on Indigenous community values.";

$barayamal_rating = 4;
$total_rating_value = $public_rating_of_RAP * $total_ratings; // Total value of all ratings.---avg*total
?>

<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
<div class="container">
  <div class="company-details">
    <h2><?php echo $company_name; ?></h2>
    <p><?php echo $company_description; ?></p>
    <div class="rating-value">
      <div>
        <p><strong>Barayamal Rating</strong></p>
        <p> <span id="barayamal-rating-value"><?php echo $barayamal_rating; ?></span></p>
      </div>
      <div>
        <p><strong>Public Rating of RAP</strong></p>
        <p> <span id="public-rating-value"><?php echo round($public_rating_of_RAP, 2); ?></span></p>
      </div>
    </div>
  </div>
  <!-- Sliding Score Submit Rating -->
  <div class="rating-section">
    <label for="user-rating">Rate Us: </label>
    <div class="rating-value-container">
      <input type="range" id="user-rating" name="user-rating" min="1" max="5">
      <span id="user-rating-value">3</span>
      <span id="rating-emoticon"></span>
    </div>
    <button id="submit-rating-btn" class="btn btn-primary">Vote</button>
  </div>
</div>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="script.js"></script>

<script>
  // Display the value of the slider to the user
  document.getElementById('user-rating').oninput = function () {
    document.getElementById('user-rating-value').textContent = this.value;

  }

  // Handle the submission of the rating
  document.getElementById('submit-rating-btn').onclick = function () {
    var userRatingValue = parseFloat(document.getElementById('user-rating-value').textContent);
    var avg_value = <?php echo $totalRatingValue; ?>; // Accessing $totalRatingValue in JavaScript
    var total_ratings = <?php echo $total_ratings; ?>; // Accessing $total_ratings in JavaScript

    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'addRating.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Update the total rating value and total ratings
        avg_value += userRatingValue;
        total_ratings++;

        // Calculate the new average rating
        var newAverage = avg_value / total_ratings;
        document.getElementById('public-rating-value').textContent = newAverage.toFixed(2); // Display the average rounded to two decimal places

        // Disable the slider and button after submission to prevent multiple votes from the same visitor
        document.getElementById('user-rating').disabled = true;
        document.getElementById('submit-rating-btn').disabled = true;
      }
    };

    // Send the user rating value to the server
    xhr.send('rating=' + userRatingValue);
  }

</script>