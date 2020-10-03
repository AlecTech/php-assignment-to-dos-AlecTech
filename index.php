<?php
// GLOBAL variables are stored in PHP's
// $GLOBALS array.
$GLOBALS['pageTitle'] = 'Home';

// Show our header.
include './templates/header.php';


?>

<p>
  Welcome to our
  <?php echo $GLOBALS['pageTitle']; ?>
  page!
</p>



<?php // Show our footer.
include './templates/footer.php';