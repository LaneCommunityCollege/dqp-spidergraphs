<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
?>
<?php 
	if(isset($_REQUEST['course_id']))
		{ $_SESSION['course_id'] = $_REQUEST['course_id']; }
	
	if(isset($_REQUEST['add_outcome']))
		{
			// Fix some of the data
			if(isset($_REQUEST['outcome'])) { $outcome = htmlentities($_REQUEST['outcome'], ENT_QUOTES); }
			if(isset($_REQUEST['comments'])) { $comments = htmlentities($_REQUEST['comments'], ENT_QUOTES); }
			// If any of the numbers are < 1, they need to be multiplied by 100.
			if(isset($_REQUEST['weight'])) 
				{ if($_REQUEST['weight'] > 1) { $_REQUEST['weight'] = $_REQUEST['weight'] / 100; } }
			if(isset($_REQUEST['outcome'])) 
				{ if($_REQUEST['outcome'] < 1) { $_REQUEST['outcome'] = $_REQUEST['outcome'] * 100; } }
			if(isset($_REQUEST['applied'])) 
				{ if($_REQUEST['applied'] < 1) { $_REQUEST['applied'] = $_REQUEST['applied'] * 100; } }
			if(isset($_REQUEST['specialized'])) 
				{ if($_REQUEST['specialized'] < 1) { $_REQUEST['specialized'] = $_REQUEST['specialized'] * 100; } }
			if(isset($_REQUEST['intellectual'])) 
				{ if($_REQUEST['intellectual'] < 1) { $_REQUEST['intellectual'] = $_REQUEST['intellectual'] * 100; } }
			if(isset($_REQUEST['broad'])) 
				{ if($_REQUEST['broad'] < 1) { $_REQUEST['broad'] = $_REQUEST['broad'] * 100; } }
			if(isset($_REQUEST['civic'])) 
				{ if($_REQUEST['civic'] < 1) { $_REQUEST['civic'] = $_REQUEST['civic'] * 100; } }
				
			// Insert the data
			$insert = mysql_query("INSERT INTO spidergraph_course_outcomes
										(co_id, crs_id, co_weight, co_applied, co_specialized, 
										 co_intellectual, co_broad, co_civic, co_outcome, co_comments, inst_id)
								VALUES ('', '$_REQUEST[course_id]', '$_REQUEST[weight]', '$_REQUEST[applied]',
										'$_REQUEST[specialized]', '$_REQUEST[intellectual]', '$_REQUEST[broad]',
										'$_REQUEST[civic]', '$outcome', '$comments', '$user_info[inst]')")
								or die(mysql_error());
								
			unset($_REQUEST);		
		
			$msg->add('s', 'Course Outcome successfully added.');
		
		}
		
		
	// Delete a course outcome
	if(isset($_GET['action']) && isset($_GET['co_id']))
		{ $delete = mysql_query("DELETE FROM spidergraph_course_outcomes WHERE co_id='$_GET[co_id]'"); }	
	
	
	// Update a Course Outcome
	if(isset($_REQUEST['update_outcome']))
		{
			// Fix some of the data
			if(isset($_REQUEST['outcome'])) { $outcome = htmlentities($_REQUEST['outcome'], ENT_QUOTES); }
			if(isset($_REQUEST['comments'])) { $comments = htmlentities($_REQUEST['comments'], ENT_QUOTES); }
			// If any of the numbers are < 1, they need to be multiplied by 100.
			if(isset($_REQUEST['weight'])) 
				{ if($_REQUEST['weight'] > 1) { $_REQUEST['weight'] = $_REQUEST['weight'] / 100; } }
			if(isset($_REQUEST['outcome'])) 
				{ if($_REQUEST['outcome'] < 1) { $_REQUEST['outcome'] = $_REQUEST['outcome'] * 100; } }
			if(isset($_REQUEST['applied'])) 
				{ if($_REQUEST['applied'] < 1) { $_REQUEST['applied'] = $_REQUEST['applied'] * 100; } }
			if(isset($_REQUEST['specialized'])) 
				{ if($_REQUEST['specialized'] < 1) { $_REQUEST['specialized'] = $_REQUEST['specialized'] * 100; } }
			if(isset($_REQUEST['intellectual'])) 
				{ if($_REQUEST['intellectual'] < 1) { $_REQUEST['intellectual'] = $_REQUEST['intellectual'] * 100; } }
			if(isset($_REQUEST['broad'])) 
				{ if($_REQUEST['broad'] < 1) { $_REQUEST['broad'] = $_REQUEST['broad'] * 100; } }
			if(isset($_REQUEST['civic'])) 
				{ if($_REQUEST['civic'] < 1) { $_REQUEST['civic'] = $_REQUEST['civic'] * 100; } }
			
			$update = mysql_query("UPDATE spidergraph_course_outcomes
									SET co_weight='$_REQUEST[weight]', co_applied='$_REQUEST[applied]', co_specialized='$_REQUEST[specialized]',
										co_intellectual='$_REQUEST[intellectual]', co_broad='$_REQUEST[broad]', co_civic='$_REQUEST[civic]',
										co_outcome='$outcome', co_comments='$comments'
									WHERE co_id='$_REQUEST[co_id]'");
					
			$msg->add('s', 'Course Outcome successfully updated.');
			
			// Kill all the POST vars so we don't re-populate the insert form.
			unset($_REQUEST);
		}
		
		
		
	include("header.inc.php"); 
?>
<script type="text/javascript">
	function toggle(id) {
	  var e = document.getElementById(id);
	 
	  if(e.style.display == '')
		e.style.display = 'none';
	  else
		e.style.display = '';
	}
</script>


<h1>Input / Edit Course Outcomes</h1>

		<h2 align="center"><?php echo $institutions[$user_info['inst']]; ?></h2>
        <blockquote>
          <p>Add as many outcomes as you like for this course, but please make sure the outcome weights add up to 100 at the end.</p>
        </blockquote>
		<div id="TwoCol_left_60">
        <form id="form1" name="form1" method="post" action="">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tr>
		      <td width="30%" align="right" valign="top"><label for="course_id">Course</label></td>
		      <td width="70%" align="left" valign="top"><select name='course_id' id='course_id'>
		        <?php
						// If we haven't already chosen a course...
						if(!isset($_SESSION['course_id']) && !$_SESSION['course_id'])
							{ echo "<option value='' selected='selected'>Choose a Course</option>"; }
						
						// Only show courses if we've chosen a program
						$result_crs = mysql_query("SELECT * FROM spidergraph_courses WHERE inst_id='$user_info[inst]' ORDER BY crs_number");
						while($row_crs = mysql_fetch_array($result_crs))
							{
								extract($row_crs);
								
								// If we've already chosen a program, make sure it's selected in the form field
								if(isset($_SESSION['course_id']) && $_SESSION['course_id'] == $crs_id) 
									{ $selected = "selected='selected'"; }
								else { $selected = ""; }  
								
								echo "<option value='$crs_id' $selected>". stripslashes($crs_number) ."</option>";
							}
					?>
	          </select>
              <br />
		      <span class="text_small">Not seeing the course you need? <a href="create_course.php">Add it here</a>.</span></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="outcome">Outcome</label></td>
		      <td align="left" valign="top"><textarea name="outcome" id="outcome" cols="45" rows="5"><?php if(isset($_REQUEST['outcome'])) { echo $_REQUEST['outcome']; } ?>
		      </textarea></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="comments">Comments</label></td>
		      <td align="left" valign="top"><textarea name="comments" id="comments" cols="45" rows="5"><?php if(isset($_REQUEST['comments'])) { echo $_REQUEST['comments']; } ?>
		      </textarea></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="weight">Weight</label></td>
		      <td align="left" valign="top"><input name="weight" type="text" id="weight" value="<?php if(isset($_REQUEST['weight'])) { echo $_REQUEST['weight']; } else { echo "0"; } ?>" size="3" /></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="applied">Applied Learning</label></td>
		      <td align="left" valign="top"><input name="applied" type="text" id="applied" value="<?php if(isset($_REQUEST['applied'])) { echo $_REQUEST['applied']; } else { echo "0"; } ?>" size="3" onblur="recalculateSum();" />
		        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="error">&gt;</span></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="specialized">Specialized Knowledge</label></td>
		      <td align="left" valign="top"><input name="specialized" type="text" id="specialized" value="<?php if(isset($_REQUEST['specialized'])) { echo $_REQUEST['specialized']; } else { echo "0"; } ?>" size="3" onblur="recalculateSum();" />
		        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="error">&gt; &gt; </span></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="intellectual">Intellectual Skills</label></td>
		      <td align="left" valign="top"><input name="intellectual" type="text" id="intellectual" value="<?php if(isset($_REQUEST['intellectual'])) { echo $_REQUEST['intellectual']; } else { echo "0"; } ?>" size="3" onblur="recalculateSum();" />
		        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="error">&gt; &gt; &gt;</span> &nbsp;&nbsp;&nbsp;
		        <input type="text" id="Sum" value="" size="5"  tabindex="-1" />
		        <strong><span class="text_small"><label for="Sum">(Must equal 100)</label></span></strong>
                <script>
					function recalculateSum()
						{
							var a = parseInt(document.getElementById("applied").value);
							var b = parseInt(document.getElementById("specialized").value);
							var c = parseInt(document.getElementById("intellectual").value);
							var d = parseInt(document.getElementById("broad").value);
							var e = parseInt(document.getElementById("civic").value);
							document.getElementById("Sum").value = a + b + c + d + e;
						}
				</script>
              </td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="broad">Integrative / Broad Knowledge</label></td>
		      <td align="left" valign="top"><input name="broad" type="text" id="broad" value="<?php if(isset($_REQUEST['broad'])) { echo $_REQUEST['broad']; } else { echo "0"; } ?>" size="3" onblur="recalculateSum();" />
		        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="error">&gt; &gt;</span></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="civic">Civic Learning</label></td>
		      <td align="left" valign="top"><input name="civic" type="text" id="civic" value="<?php if(isset($_REQUEST['civic'])) { echo $_REQUEST['civic']; } else { echo "0"; } ?>" size="3" onblur="recalculateSum();" />
		        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="error">&gt;</span></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top">&nbsp;</td>
		      <td align="left" valign="top"><input type="submit" name="add_outcome" id="add_outcome" value="Submit" /></td>
	        </tr>
	      </table>
	    </form>
		</div>
        
        <div id="TwoCol_right_40">
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><?php include("admin_menu.inc.php"); ?></td>
            </tr>
          </table>
        </div>
        <div class="clear"></div>
        <br />
        <hr />
        <br />
		<a name="outcomes"></a>
        <h2 align="center"><?php echo $institutions[$user_info['inst']]; ?></h2>
        <h3>
		<?php
       		// Get the course number (name) from the courses table
			$result_crs = mysql_query("SELECT crs_number FROM spidergraph_courses WHERE crs_id='$_SESSION[course_id]'");
			$row_crs = mysql_fetch_array($result_crs);
			@extract($row_crs);
			echo $crs_number;
		?>
        </h3>
		<?php
			$result_outcome = mysql_query("SELECT * FROM spidergraph_course_outcomes WHERE crs_id = '$_SESSION[course_id]' AND inst_id = '$user_info[inst]'");
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
		<form id="form<?php echo $i; ?>" name="form<?php echo $i; ?>" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><span onclick="toggle('<?php echo $i; ?>')"><img src="images/button_COMMENTS_ARROWS.png" /></span></td>
            <td align="center"><span class="text_small">Weight</span><br />
              <input name="weight" type="text" id="weight" value="<?php if(isset($co_weight)) { echo round($co_weight,2) * 100; } ?>" size="5" /></td>
            <td align="center"><textarea name="outcome" id="outcome" cols="30" rows="2"><?php if(isset($co_outcome)) { echo $co_outcome; } ?>
		      </textarea></td>
            <td align="center"><span class="text_small">Applied</span><br />
              <input name="applied" type="text" id="applied<?php echo $i; ?>" value="<?php if(isset($co_applied)) { echo round($co_applied,2); } ?>" size="5" onblur="recalculateSum<?php echo $i; ?>();"  /></td>
            <td align="center"><span class="text_small">Specialized</span><br />
              <input name="specialized" type="text" id="specialized<?php echo $i; ?>" value="<?php if(isset($co_specialized)) { echo round($co_specialized,2); } ?>" size="5" onblur="recalculateSum<?php echo $i; ?>();"  /></td>
            <td align="center"><span class="text_small">Intellectual</span><br />
              <input name="intellectual" type="text" id="intellectual<?php echo $i; ?>" value="<?php if(isset($co_intellectual)) { echo round($co_intellectual,2); } ?>" size="5" onblur="recalculateSum<?php echo $i; ?>();"  /></td>
            <td align="center"><span class="text_small">Broad</span><br />
              <input name="broad" type="text" id="broad<?php echo $i; ?>" value="<?php if(isset($co_broad)) { echo round($co_broad,2); } ?>" size="5" onblur="recalculateSum<?php echo $i; ?>();"  /></td>
            <td align="center"><span class="text_small">Civic</span><br />
              <input name="civic" type="text" id="civic<?php echo $i; ?>" value="<?php if(isset($co_civic)) { echo round($co_civic,2); } ?>" size="5" onblur="recalculateSum<?php echo $i; ?>();"  /></td>
            <td align="center"><strong><span class="text_small">Total</span></strong><br />
              <?php 
			  	// Get the total as it is right now to load the "Total" field
				$tot = $co_applied + $co_specialized + $co_intellectual + $co_broad + $co_civic;
			  ?>
              <input type="text" id="Sum<?php echo $i; ?>" value="<?php echo $tot; ?>" size="5"  tabindex="-1" />
				<script>
					function recalculateSum<?php echo $i; ?>()
						{
							var a<?php echo $i; ?> = parseInt(document.getElementById("applied<?php echo $i; ?>").value);
							var b<?php echo $i; ?> = parseInt(document.getElementById("specialized<?php echo $i; ?>").value);
							var c<?php echo $i; ?> = parseInt(document.getElementById("intellectual<?php echo $i; ?>").value);
							var d<?php echo $i; ?> = parseInt(document.getElementById("broad<?php echo $i; ?>").value);
							var e<?php echo $i; ?> = parseInt(document.getElementById("civic<?php echo $i; ?>").value);
							document.getElementById("Sum<?php echo $i; ?>").value = a<?php echo $i; ?> + b<?php echo $i; ?> + c<?php echo $i; ?> + d<?php echo $i; ?> + e<?php echo $i; ?>;
						}
				</script>
            </td>
            <td align="center"><input name="co_id" type="hidden" id="co_id" value="<?php echo $co_id; ?>" /> <input type="submit" name="update_outcome" id="button" value="Update" /></td>
            <td align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete&amp;co_id=<?php echo $co_id; ?>" border="0"><img src="images/button_delete_tiny.png" /></a></td>
          </tr>
          <tr id="<?php echo $i; ?>" style="display:none;">
            <td colspan="11" align="center"><span class="text_small">Comments</span><br /><textarea name="comments" id="comments" cols="85" rows="3"><?php if(isset($co_comments)) { echo $co_comments; } ?>
		      </textarea></td>
          </tr>
        </table>
	    </form>
        <br />
        <?php 			
						} 
					// Display total for weights
					echo "<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL &uarr; (weights) = ". $tot_weights * 100 ." / 100</h4>";
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='text_small'>(Weights should add up to 100.)</span>";
				}
			elseif($num == 0)
				{ echo "<blockquote>No outcomes in the database for this course.</blockquote>"; }
		?>
		<p align="right">&uarr; <a href="#top">Add Course Outcome</a> &uarr;</p>

<?php include("footer.inc.php"); ?>
