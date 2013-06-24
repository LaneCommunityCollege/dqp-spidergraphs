<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="english">
<head>

	<title>DQP in Oregon - Spidergraphs</title>
    <link href="styles_spidergraph.css" rel="stylesheet" type="text/css" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<script src="scripts/jquery-1.8.1.min.js"></script>
</head>

<body>
<a name="top"></a>

<?php include("scripts/chrome_frame.inc"); ?>

<div id="header">
	<img src="images/DQP color logo.png" alt="DQP Logo" width="300" height="103">
</div>

<div class="clear"></div>
<?php echo $msg->display(); 	// Display Messages ?>
<div id="sg_wrap">

    <div id="top-menu">
    <ul>
        <li><a href="http://www.oregondqp.org">DQP Home</a></li>
        <li><a href="index.php">Spidergraph Home</a></li>
        <li><a href="admin_index.php">Spidergraph Admin</a></li>
	  	<?php 
			if($_SESSION['multi-inst'] = 1)
				{
		?>
        <li><a href="#">Institutions</a>
			<ul>
			<?php
				// Create array of institutions with published workplans
				$result = mysql_query("SELECT * FROM institutions WHERE inst_id < '25'");
				while($row = mysql_fetch_array($result))
					{
						extract($row);
						echo "<li><a href='programs.php?inst=$inst_id'>$inst_name</a></li>";
					}
			?>
            </ul>
        </li>
	  	<?php  } ?>
    </ul>
    </div><!-- Top Menu -->
    
    <p>&nbsp;</p>
