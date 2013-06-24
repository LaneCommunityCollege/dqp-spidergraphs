<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
	include("header.inc.php"); 
?>
        <h1>Course Outcomes Report</h1>
        <h2 align="center">
		<?php
       		// Get the program name from the programs table
			$result_crs = mysql_query("SELECT crs_number FROM spidergraph_courses WHERE crs_id='$_REQUEST[crs_id]'");
			$row_crs = mysql_fetch_array($result_crs);
			extract($row_crs);
			echo $crs_number;
		?>
        </h2>
		<?php
			$result_outcome = mysql_query("SELECT * FROM spidergraph_course_outcomes WHERE crs_id='$_REQUEST[crs_id]'");
			$num = mysql_num_rows($result_outcome);
			if($num > 0)
				{
					$i = 0;
					$tot_weights = 0;
					while($row_outcome = mysql_fetch_array($result_outcome))
						{
							extract($row_outcome);
							$i++;
							$tot_weights += $co_weight;
		?>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11%" align="left" valign="top"><p>
      <label for="weight<?php echo $i; ?>">Weight</label>
    </p>
      <p>
        <label for="applied<?php echo $i; ?>">Applied</label>
      </p>
      <p>
        <label for="specialized<?php echo $i; ?>">Specialized</label>
      </p>
      <p>Intellectual</p>
      <p>Broad</p>
      <p>Civic</p>
      <p><strong>Total</strong></p></td>
    <td width="8%" align="left" valign="top">
	  <p><?php if(isset($co_weight)) { echo round($co_weight,2) * 100; } ?></p>
      <p><?php if(isset($co_applied)) { echo round($co_applied,2); } ?></p>
      <p><?php if(isset($co_specialized)) { echo round($co_specialized,2); } ?></p>
      <p><?php if(isset($co_intellectual)) { echo round($co_intellectual,2); } ?></p>
      <p><?php if(isset($co_broad)) { echo round($co_broad,2); } ?></p>
      <p><?php if(isset($co_civic)) { echo round($co_civic,2); } ?></p>
      <p>
      	<?php 
		 	// Get the total as it is right now to load the "Total" field
			$tot = $co_applied + $co_specialized + $co_intellectual + $co_broad + $co_civic;
			echo $tot;
		?>
      </p>
    </td>
    <td width="26%" align="left" valign="top"><h3>Outcome</h3>
      <?php if(isset($co_outcome)) { echo nl2br($co_outcome); } ?></td>
    <td width="55%" align="left" valign="top">
      <h3>Comments</h3><?php if(isset($co_comments)) { echo nl2br($co_comments); } ?>
    </td>
  </tr>
</table>
        </form>
        <br />
        <?php 			
						} 
				}
			elseif($num == 0)
				{ echo "<blockquote>No outcomes in the database for this program.</blockquote>"; }
		?>
        <p>&nbsp;</p>
<?php include("footer.inc.php"); ?>
