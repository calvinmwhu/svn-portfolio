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
    <!--    <script src="www/inc/js/script.js"></script>-->
</head>


<body>
<?php include_once 'lib/header.php'; ?>
<?php include_once 'lib/parser.php'; ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <?php
                $query = '?assignment=';
                //this is the stupid way of constructing the url, but it works:
//                $host = 'http://' . $_SERVER['HTTP_HOST'];
//                $path = $_SERVER['PHP_SELF'];
//                $url = $host . $path . $query . 'overview';

                //this is the clever way of constructing url, but sometimes it doesn't work. Don't know why....
                $root_path = htmlspecialchars($_SERVER["PHP_SELF"]).$query;
                $url=$root_path.'overview';

                //the list item for Overview tab
                echo "<li><a href=\"$url\">Overview <span class=\"sr-only\">(current)</span></a></li>";

                //list items for assignment tabs
                foreach ($parser->project_lists as $key => $project) {
                  //  $url = $host . $path . $query . $project->title;
                    $url = $root_path.$project->title;
                    echo "<li><a href=\"$url\">$project->title</a></li>";
                }

                ?>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php
            $query_string = $_SERVER['QUERY_STRING'];
            $id = '';
            if ($query_string)
                $id = explode('=', $query_string)[1];
            if (!$id) $id = "overview";
            echo "<h1 class=\"page-header\">$id</h1>";

            if ($id == 'overview') {
                echo "<p class=\"lead\">On this page you can find my svn projects. Please click on any of them in left panel to see a list of files.</p>";
            } else {
                $assignment = $parser->project_lists[$id];
                $date = $assignment->date;

                $version = $assignment->version;
                $summary = $assignment->summary;
                echo "<div class=\"row\">";
                echo "<div class=\"col-sm-4\"><p class=\"lead\"><strong>Date of Last Commit:<br></strong>$date</p></div>";
                echo "<div class=\"col-sm-4\"><p class=\"lead\"><strong>Version:<br></strong>$version</p></div>";
                echo "<div class=\"col-sm-4\"><p class=\"lead\"><strong>Summary:<br></strong>$summary</p></div>";
                echo "</div>";
                ?>

                <div class="container">
                    <h3>List of files or subdirectories:</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>File/Directory</th>
                            <th>Size(Bytes)</th>
                            <th>Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $key_numeric = 0;
                        foreach ($assignment->files as $key => $file) {
                            $short_name = end(explode('/', $file->name));
                            $json_versions = json_encode($file->versions);
                            echo "<tr>";
                            echo "<p class='invisible' id=$key_numeric>$json_versions</p>";
                            echo "<td><a href='#' class='clickable-link' data-key=$key_numeric data-shortname=$short_name data-linkToCode=$file->path data-toggle='modal' data-target='#myModal'>$file->name</a></td>";
//                            echo "<td><a href='#' class='clickable-link' data-key=$key_numeric data-shortname=$short_name data-linkToCode=$file->path>$file->name</a></td>";
                            echo "<td>$file->size</td>";
                            echo "<td>$file->type</td>";
                            echo "</tr>";
                            $key_numeric++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"></h4>
                            </div>
                            <div class="modal-body">
                                <iframe id="iframe-to-code" src="" style="zoom:0.60" width="99.6%"
                                        height="500"></iframe>
                            </div>
                            <div id="version-area">
                                <table class="table" id="table-of-pre-commits">
                                    <thead>
                                    <tr>
                                        <th>
                                            <strong>Previous Commits:</strong>
                                        </th>
                                    </tr>
                                    </thead>
                                    <thead>
                                    <tr>
                                        <th>revision no.</th>
                                        <th>author</th>
                                        <th>message</th>
                                        <th>date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>



<?php include_once 'lib/footer.php'; ?>
</body></html>

<script type="text/javascript" src="www/inc/js/script.js"></script>
