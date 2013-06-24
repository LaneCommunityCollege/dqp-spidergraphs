<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
	include("header.inc.php"); 
?>

	  	<h1>Institutional Outcomes Report</h1>

        <h2 align="center">
			<?php 
				$inst_id = $user_info['inst'];
				echo $institutions[$user_info['inst']];	
			?>
        </h2>
		<?php
			$result_outcome = mysql_query("SELECT * FROM spidergraph_inst_outcomes WHERE inst_id='$user_info[inst]'");
			$num = mysql_num_rows($result_outcome);
			if($num > 0)
				{
					$i = 0;
					$tot_weights = 0;
					while($row_outcome = mysql_fetch_array($result_outcome))
						{
							extract($row_outcome);
							$i++;
							$tot_weights += $io_weight;
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
	  <p><?php if(isset($io_weight)) { echo round($io_weight,2) * 100; } ?></p>
      <p><?php if(isset($io_applied)) { echo round($io_applied,2); } ?></p>
      <p><?php if(isset($io_specialized)) { echo round($io_specialized,2); } ?></p>
      <p><?php if(isset($io_intellectual)) { echo round($io_intellectual,2); } ?></p>
      <p><?php if(isset($io_broad)) { echo round($io_broad,2); } ?></p>
      <p><?php if(isset($io_civic)) { echo round($io_civic,2); } ?></p>
      <p>
      	<?php 
		 	// Get the total as it is right now to load the "Total" field
			$tot = $io_applied + $io_specialized + $io_intellectual + $io_broad + $io_civic;
			echo $tot;
		?>
      </p>
    </td>
    <td width="26%" align="left" valign="top"><h3>Outcome</h3>
      <?php if(isset($io_outcome)) { echo nl2br($io_outcome); } ?></td>
    <td width="55%" align="left" valign="top">
      <h3>Comments</h3><?php if(isset($io_comments)) { echo nl2br($io_comments); } ?>
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
