<?php

session_start();

// Make sure to set a default value, if this
// key/value pair does not yet exist in the
// associative SESSION array!
// *** We can't array_push() to a NULL
//     (undefined) value!
if ( !isset( $_SESSION['taskHistory'] ) )
{
  $_SESSION['taskHistory'] = array();
}

// Try to avoid use of globals unless they are absolutely necessary...
$GLOBALS['pageTitle'] = 'PHP TO-DO App';

// Show our header.
include './templates/header.php';

// If we want to read values from a GET method submission...
// we use the $_GET superglobal! It is an associative array.
echo '<pre>';
// var_dump( $_GET );
var_dump( $_POST ); // POST is handled the same way!
echo '</pre>';

$task = FALSE;
// if ( !empty( $_GET ) )
// {


    array_push(
        $_SESSION['taskHistory'],
        "{$_POST['task']}"
      );
// }
var_dump( $task );



echo '<pre>';
var_dump( $_SESSION );
// Use var_dump, much like we did in JS with console.log.
// It outputs the data-type and value of what you pass in!
var_dump( $task ); // What is our result, right now!?
echo '</pre>';
?>

<form method="POST" action="todo.php">
    <div id="myDIV" class="header">
        <h2 style="margin:5px">Add a To-Do</h2>
        <div class="inputFieldBtns">
            <!-- <input type="text" id="myInput" placeholder="Enter a new task:" name="name">
            
            <span onclick="newElement()" class="addBtn">Add To List</span>
            <span onclick="newElement()" class="addBtn">Reset</span> -->
            <input type="text" id="addBtn" name="task" value="" >
            <button type="submit" class="addBtn" name="submit"> Add </button>
        </div>
    </div>

 <?php if ( isset( $_SESSION['taskHistory'] ) ) : // Check if there IS a task history! ?>
    <ul id="myUL">
        <?php foreach ( $_SESSION['taskHistory'] as $newTask ) : ?>
            <li>
                <?php echo $newTask; // Output the value from our taskHistory array! ?>
            </li>
        <?php endforeach; ?>
        <!-- <li>Hit the gym</li>
        <li class="checked">Pay bills</li>
        <li>Meet Wife</li>
        <li>Buy eggs</li>
        <li>Read a book</li>
        <li>Clean office</li> -->
    </ul>
 <?php endif; ?>

</form>

<p>
  Welcome to Oleg's To-Do APP!
</p>

<?php if ( $task != FALSE ) : ?>
  <p>
<?php echo $task; ?>
  </p>
<?php endif; ?>

<?php // Show our footer.
include './templates/footer.php';