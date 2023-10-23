<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'dbconnection.php';

$message = "";
$username = $_SESSION['username'];
$digs_id = 0;
$digsName = "";
$digsPhoto = "";

$username = mysqli_real_escape_string($conn, $username);
$digsQuery = $digsQuery = "SELECT tenant_id, current_digs_id FROM tenants WHERE username = '$username'";


$result = mysqli_query($conn, $digsQuery) or die("noooooo");
if ($row = mysqli_fetch_assoc($result)) {
    $digs_id = $row['current_digs_id'];
    $tenant_id = $row['tenant_id'];  // Assuming the column is named 'id' in the tenants table
}else {
    die("Error: Couldn't fetch tenant or digs information.");
}



// Handle form submission
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rate'])) {
    $criteria_1 = isset($_POST['star1']) ? $_POST['star1'] : 0;
    $criteria_2 = isset($_POST['star2']) ? $_POST['star2'] : 0;
    $criteria_3 = isset($_POST['star3']) ? $_POST['star3'] : 0;
    $criteria_4 = isset($_POST['star4']) ? $_POST['star4'] : 0;
    $criteria_5 = isset($_POST['star5']) ? $_POST['star5'] : 0;
    ;

    $overall_rating = $criteria_1 + $criteria_2 + $criteria_3 + $criteria_4 + $criteria_5;

    // Check if the comment is set and not empty
    $comment = isset($_POST['comment']) ? mysqli_real_escape_string($conn, $_POST['comment']) : null;

    // Adjust SQL based on the presence of a comment
    $insertRatingSql = $comment !== null 
        ? "INSERT INTO ratings (digs_id, tenant_id, criteria_1, criteria_2, criteria_3, criteria_4, criteria_5, overall_rating, comment) 
           VALUES ($digs_id, $tenant_id, $criteria_1, $criteria_2, $criteria_3, $criteria_4, $criteria_5, $overall_rating, '$comment')"
        : "INSERT INTO ratings (digs_id, tenant_id, criteria_1, criteria_2, criteria_3, criteria_4, criteria_5, overall_rating) 
           VALUES ($digs_id, $tenant_id, $criteria_1, $criteria_2, $criteria_3, $criteria_4, $criteria_5, $overall_rating)";

    if (mysqli_query($conn, $insertRatingSql)) {
        $message = "Your rating was successfully submitted!";
    } else {
        $message = "Error while trying to submit your rating: " . mysqli_error($conn);
    }
}
if (!$digs_id) {
    die("Error: You don't have a digs assigned. Please contact the admin.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <title>Rate Your Digs</title>
 </head>   
    <style>  
.star-radio {
    display: none;
}

.star-label i.fas {
    color: silver; /* Default color when the star is not selected */
}

.star-radio:checked + .star-label i.fas {
    color: gold; /* Color when the star is selected */
}
.required::after {
            content: "* ";
            color: red;
        }

</style>

<body>

<h2 class="required">Rate Your Digs: <?php echo htmlspecialchars($digsName); ?></h2>

<?php if ($digsPhoto): ?>
    <img src="<?php echo htmlspecialchars($digsPhoto); ?>" alt="<?php echo htmlspecialchars($digsName); ?>" width="300">
<?php endif; ?>

<form action="tenantrate.php" method="post" onsubmit="return confirmSubmit();">

<div class="rating">
<p>Please fill in the following information. Fields marked with <span class="required"></span> are required.</p>
    <!-- Star 1 -->
    <input type="radio" name="star1" value="1" id="star1-yes" class="star-radio">
    <label for="star1-yes" class="star-label"><i class="fas fa-star"></i></label>
    <input type="radio" name="star1" value="0" id="star1-no" class="star-radio">
    
    <!-- Star 2 -->
    <input type="radio" name="star2" value="1" id="star2-yes" class="star-radio">
    <label for="star2-yes" class="star-label"><i class="fas fa-star"></i></label>
    <input type="radio" name="star2" value="0" id="star2-no" class="star-radio">
    
    <!-- Star 3 -->
    <input type="radio" name="star3" value="1" id="star3-yes" class="star-radio">
    <label for="star3-yes" class="star-label"><i class="fas fa-star"></i></label>
    <input type="radio" name="star3" value="0" id="star3-no" class="star-radio">
    
    <!-- Star 4 -->
    <input type="radio" name="star4" value="1" id="star4-yes" class="star-radio">
    <label for="star4-yes" class="star-label"><i class="fas fa-star"></i></label>
    <input type="radio" name="star4" value="0" id="star4-no" class="star-radio">
    
    <!-- Star 5 -->
    <input type="radio" name="star5" value="1" id="star5-yes" class="star-radio">
    <label for="star5-yes" class="star-label"><i class="fas fa-star"></i></label>
    <input type="radio" name="star5" value="0" id="star5-no" class="star-radio">
</div>




<p style="color: blue;">0 stars :Extremely Bad<br>
 1 star:Not bad <br>
 2 stars:Not Satisfactory<br>
4 stars: Good <br>
5 stars: Excellent.</p>

    
    <label for="comment">Comment/Review(Optional)</label><br>
    <textarea name="comment" id="comment" rows="4" cols="50"></textarea><br>
    <br>
    <input type="submit" name="rate" value="Submit Rating">
</form>

<?php
if (!empty($message)) {
    echo "<p>$message</p>";
}
?>
<script>
    function confirmSubmit() {
        return confirm("Once submitted, you cannot change your rating or comment later. Are you sure you want to continue?");
    }
</script>
</body>
</html>
