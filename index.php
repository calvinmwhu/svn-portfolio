<!DOCTYPE html>
<html lang="en">
<head>
    <title>Portfolio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="www/inc/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>


<body>
    <?php include_once 'lib/header.php'; ?>
    <!-- Begin page content -->
    <div class="container"  id="index-container">
        <div class="page-header">
            <h1>Welcome to my programming studio portfolio site!</h1>
        </div>
        <p class="lead">On this site you can find a list of my previous projects and view their source code. All these projects are hosted on Subversion. You can also leave me a comment if you find anything interesting.</p>
        <a class="btn btn-lg btn-primary" href="projects_view.php" role="button">View Projects &raquo;</a>
        <a class="btn btn-lg btn-primary" href="comments_view.php" role="button">Leave Comments &raquo;</a>
    </div>
    <?php include_once 'lib/footer.php'; ?>
</body>

