<?php
	include("common.php");
	include("header.inc.php");
?>

  <blockquote>
    <img src="images/Spidergraph.jpg" alt="" align="right" /><h1>Institutions</h1>
    <p>
      <ul>
	  	<?php
			if($_SESSION['multi-inst'] = 1)
				{
					// Create a list of institutions with published workplans
					$result = mysql_query("SELECT DISTINCT inst_id FROM institutions WHERE inst_id < 100 ORDER BY inst_id");
					while($row = mysql_fetch_array($result))
						{
							extract($row);
							$inst_list[] = $inst_id;
							echo "<li><a href='programs.php?inst=$inst_id'>$institutions[$inst_id]</a></li>";
						}
				}
			else
				{
					echo "<li><a href='programs.php?inst=0'>View Programs</a></li>";
				}
		?>
      </ul>
    </p>
  </blockquote>
	
<?php
	include("footer.inc.php");
?>