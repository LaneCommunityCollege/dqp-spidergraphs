<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
	include("header.inc.php"); 
?>

	  	<h1>Program Outcomes Report</h1>

        <h2 align="center">
		<?php
       		// Get the program name from the programs table
			$result_prog = mysql_query("SELECT prog_name FROM spidergraph_programs WHERE prog_id='$_REQUEST[program_id]'");
			$row_prog = mysql_fetch_array($result_prog);
			extract($row_prog);
			echo $prog_name;
		?>
        </h2>
		<?php
			$result_outcome = mysql_query("SELECT * FROM spidergraph_program_outcomes WHERE prog_id = '$_REQUEST[program_id]' AND inst_id = '$user_info[inst]'");
			$num = mysql_num_rows($result_outcome);
			if($num > 0)
				{
					$i = 0;
					$tot_weights = 0;
					while($row_outcome = mysql_fetch_array($result_outcome))
						{
							extract($row_outcome);
							$i++;
							$tot_weights += $po_weight;
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
	  <p><?php if(isset($po_weight)) { echo round($po_weight,2) * 100; } ?></p>
      <p><?php if(isset($po_applied)) { echo round($po_applied,2); } ?></p>
      <p><?php if(isset($po_specialized)) { echo round($po_specialized,2); } ?></p>
      <p><?php if(isset($po_intellectual)) { echo round($po_intellectual,2); } ?></p>
      <p><?php if(isset($po_broad)) { echo round($po_broad,2); } ?></p>
      <p><?php if(isset($po_civic)) { echo round($po_civic,2); } ?></p>
      <p>
      	<?php 
		 	// Get the total as it is right now to load the "Total" field
			$tot = $po_applied + $po_specialized + $po_intellectual + $po_broad + $po_civic;
			echo $tot;
		?>
      </p>
    </td>
    <td width="26%" align="left" valign="top"><h3>Outcome</h3>
      <?php if(isset($po_outcome)) { echo nl2br($po_outcome); } ?></td>
    <td width="55%" align="left" valign="top">
      <h3>Comments</h3><?php if(isset($po_comments)) { echo nl2br($po_comments); } ?>
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
