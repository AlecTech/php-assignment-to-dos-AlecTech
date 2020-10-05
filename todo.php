<?php

session_start();

// session_unset();

// Make sure to set a default value, if this
// key/value pair does not yet exist in the associative SESSION array!
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

// ======= Pull ToDO from JSON to PHP START
$jsonArray = [];
if (file_exists('todo.json')){
    $json = file_get_contents('todo.json');
    $jsonArray = json_decode($json, true);
}
// ======= Pull ToDO from JSON to PHP END
?>
<!-- ========= Inser TODOs with JSON file START ============ -->
<?php

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

$todoName = $_POST['task'] ?? '';
$todoName = trim($todoName);
if ($todoName)
{
    if(file_exists('todo.json')){
        $json = file_get_contents('todo.json');
        $jsonArray = json_decode($json, true);
    } else {
        $jsonArray = [];
    }
    
    $jsonArray[$todoName] = ['done' => false];
    // echo '<pre>';
    // var_dump($jsonArray);
    // echo '</pre>';
    // echo $json;
    file_put_contents('todo.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
}

?>
<!-- ========= Insert TODOs with JSON file END =========== -->


<form method="POST" action="todo.php">
    <div id="myDIV" class="header">
        <h2 style="margin:5px">Add a To-Do</h2>
        <div class="inputFieldBtns">
            <input type="text" id="myInput" name="task" placeholder="Enter a new task"  >
            <button type="submit" class="addBtn" name="submit"> Add </button>
        </div>
    </div>
</form>
<br>
<h2>
    Active To-Dos
</h2>
<!-- OUTPUT ToDos from JSON FOREACH START -->

<?php foreach ($jsonArray as $todoName => $todo) : ?>
    <ul id="myUL">
        <form action="checked.php" method="post">
            <input type="hidden" name="task" value="<?php echo $todoName ?>">   
            <input type="checkbox" <?php echo $todo['done'] ? 'checked' :'' ?>>
        </form>
        <?php echo $todoName ?>
        <form action="delete.php" method="POST">
            <input type="hidden" name="task" value="<?php echo $todoName ?>">
            <button> Delete </button>
        </form>
    </ul>
<?php endforeach; ?>

<script>
    const checkMark = document.querySelectorAll('input[type=checkbox]');
    checkMark.forEach(check => {
        check.onclick = function () {
            this.parentNode.submit();
        }
    });
</script>

<!-- OUTPUT ToDos from JSON FOREACH END -->

<!-- Scan through JSON and move done tasks to Completed section START -->
<?php

if(file_exists('todo.json'))
{
    $json = file_get_contents('todo.json');
    $jsonArray = json_decode($json, true);

    // echo '<pre>';
    // var_dump($jsonArray);
    // echo '</pre>';

    
    $filtered_values = array_filter($jsonArray, function($item) {
	return $item["done"] == true;
    });
    
    // echo '<pre>';
    // var_dump($filtered_values);
    // echo '</pre>';
}

?>
<h2>
    Completed To-Dos 
</h2>

<?php foreach ($filtered_values as $todoName => $todo) : ?>
    <ul id="myUL">
        <form action="checked.php" method="post">
            <input type="hidden" name="task" value="<?php echo $todoName ?>">   
            <input type="checkbox" <?php echo $todo['done'] ? 'checked' :'' ?>>
        </form>
        <?php echo $todoName ?>
        <form action="delete.php" method="POST">
            <input type="hidden" name="task" value="<?php echo $todoName ?>">
            <button> Delete </button>
        </form>
    </ul>
<?php endforeach; ?>

<!-- Scan through JSON and move done tasks to Completed section END -->


<h2>
    Debugging
</h2>

<?php
// If we want to read values from a POST method submission...
// we use the $_POST superglobal! 
// check if Post is not empty, then push new key and value inside array
$task = FALSE;
if ( !empty( $_POST ) )
{
    array_push( $_SESSION['taskHistory'],
                "{$_POST['task']}"
              );
}

// Use var_dump, much like we did in JS with console.log.
// It outputs the data-type and value of what you pass in!
echo '<pre>';
var_dump( $_SESSION );
var_dump( $task ); 
echo '</pre>';
?>

<?php // Show our footer.
include './templates/footer.php';