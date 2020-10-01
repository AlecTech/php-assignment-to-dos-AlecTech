<?php
// Try to avoid use of globals unless they are absolutely necessary...
$GLOBALS['pageTitle'] = 'PHP TO-DO App';

// Show our header.
include './templates/header.php';

// If we want to read values from a GET method submission...
// we use the $_GET superglobal! It is an associative array.
echo '<pre>';
var_dump( $_GET );
var_dump( $_POST ); // POST is handled the same way!
echo '</pre>';

$result = FALSE;
// if ( !empty( $_GET ) )
// {

// }
var_dump( $result );
?>

<div id="myDIV" class="header">
  <h2 style="margin:5px">Add a To-Do</h2>
    <div class="inputFieldBtns">
        <input type="text" id="myInput" placeholder="Enter a new task:">
        <span onclick="newElement()" class="addBtn">Add To List</span>
        <span onclick="newElement()" class="addBtn">Reset</span>
    </div>
</div>

<ul id="myUL">
  <li>Hit the gym</li>
  <li class="checked">Pay bills</li>
  <li>Meet Wife</li>
  <li>Buy eggs</li>
  <li>Read a book</li>
  <li>Clean office</li>
</ul>

<p>
  Welcome to Oleg's To-Do APP!
</p>

<?php // Show our footer.
include './templates/footer.php';