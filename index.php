<?php
require 'bootstrap.php';

?>
<!doctype html>
<html>
  <head>
    <link href="js/theme/style.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <link href="sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.jstree.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <meta charset="utf-8">
  </head>
  <body>
 <div class="container">
    <div class="row">
      <div class="page-header">
        <a href="/"><h1>Google Cloud Storage Bucket Browser</h1></a>
	<h2><small>Project ID</small> <?php echo DEFAULT_PROJECT?></h2>
	<h2><small>Bucket Name</small> <?php echo DEFAULT_BUCKET?></h2>
	<?php
        if(isset($authUrl) && !isset($_SESSION['access_token'])) {
          print "<a class='login' href='$authUrl'>Login to browse bucket contents</a>";
        } else {
          print "<a class='logout' href='?logout'>Logout</a>";
?>
  </div>
    <div class="row">
      <div class="span7">
        <h3>Bucket Contents</h3>
      </div>
      <div class="offset1 span4">
        <h3>File Metadata</h3>
      </div>
    </div>
    <div class="row">
      <div class="span7 bucket-contents"><div id="jstree-container"></div></div>
      <div class="offset1 file-metadata"><div id="file-props"></div></div>
    </div>
  </div>

<?php
        }
        ?>
    
<script type="text/javascript">

</script>
  </body>
</html>
