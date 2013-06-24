<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
	include("header.inc.php"); 
?>
        <h2 align="center"><?php echo $institutions[$user_info['inst']]; ?></h2>
        <p>&nbsp;</p>
        <div id="TwoCol_left_50">
        	<p align="center"><img src="images/Spidergraph-Locked.jpg" alt="Spider Graph with Lock" width="250" height="240" /></p>
        </div>
        
        <div id="TwoCol_right_50">
            <?php include("admin_menu.inc.php"); ?>
            <p>&nbsp;</p>
        </div>
<?php include("footer.inc.php"); ?>
