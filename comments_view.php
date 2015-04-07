<!DOCTYPE html>
<html lang="en">
<head>
    <title>Portfolio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="www/inc/css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>


<body>
<?php include_once 'lib/header.php';
require_once 'lib/comments.php';
?>

<?php
// define variables and set to empty values
$name = $comment = "";
$parentId = null;
$nameErr = $commentErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {  //check if the form has been submitted
    if (empty($_POST['name'])) {
        $nameErr = 'Name is required!';
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST['comment'])) {
        $commentErr = 'Comment is required!';
    } else {
        $comment = test_input($_POST["comment"]);
    }
    //here we check for parent id:
    $query_string = $_SERVER['QUERY_STRING'];
    if ($query_string)
        $parentId = explode('=', $query_string)[1];
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<div class="container">
    <div class="page-header">
        <h1>Comment Area</h1>
    </div>
    <p class="lead">Write your comment here</p>

    <form id="submit-comment" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group required">
            <label class="control-label" for="name">Name:</label>
            <input class="form-control" required="required" type="text" name="name" placeholder="your name...">
        </div>
        <div class="form-group required">
            <label class="control-label" for="comment">Comment:</label>
            <textarea class="form-control" required="required" name="comment" placeholder="your comment..."
                      rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<div class="container" id="comment-container">
    <br><br>
    <p class="lead">Previous Comments:</p>
    <?php
    $comments = new Comments;
    if ($name && $comment) {
        $comments->insert_comment($parentId, $name, $comment);
    }
    $comments->fetch_comments();
    $comments->construct_comment_tree();
    $comments->finish();
    display($comments->comments);
    ?>
</div>


<?php include_once 'lib/footer.php'; ?>
</body>
</html>

<script type="text/javascript" src="www/inc/js/script.js"></script>
