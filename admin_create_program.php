<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
?>
<?php 
	/*
		Adds a program to the spidergraph_programs table.
		No weights or anything.  Simply attaches a program to an institution so
		it can be chosen later.
	*/
	
	if(isset($_POST['add_program']) && $_POST['name'] != "")
		{
			// Clean up the name and comments
			$name = htmlentities($_POST['name'], ENT_QUOTES);
			$comments = htmlentities($_POST['comments'], ENT_QUOTES);

			//  Make sure this program isn't already in the db for this institution
			$result = mysql_query("SELECT * FROM spidergraph_programs WHERE inst_id = '$user_info[inst]' AND prog_name = '$name'");
			$num = mysql_num_rows($result);
			if($num > 0)
				{ $msg->add('e', 'A program with this name already exists for '. $institutions[$user_info['inst']] .'.'); }
			else
				{
					// Insert the program into the db
					$insert = mysql_query("INSERT INTO spidergraph_programs (prog_id, inst_id, prog_name, prog_comments, prog_active)
																VALUES ('', '$user_info[inst]', '$name', '$comments', 'y')");
																
					header("Location: admin_program_outcomes.php");
				}
		}
	elseif(isset($_POST['add_program']) && $_POST['name'] == "")
		{ $msg->add('e', 'Program Name is required.  Comments/Description are also helpful, but are optional.'); }
	
	
	
	include("header.inc.php"); 
?>

	  	<h1>Create a Program</h1>

		<h2 align="center"><?php echo $institutions[$user_info['inst']]; ?></h2>
		<blockquote>
		  <p>	      This page is for adding programs for your institution.  A simple name and description or comments about the program are all that is required.  You will be asked to add outcomes and weights to this program after you submit this very basic information.
	      </p>
	    </blockquote>
		<div id="TwoCol_left_60">
        <form id="form1" name="form1" method="post" action="">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tr>
		      <td width="30%" align="right" valign="top"><label for="name"><strong>Program Name</strong></label>
	          </td>
		      <td width="70%" align="left" valign="top">
		        <input name="name" type="text" id="name" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" size="30" />
		      </td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="comments"><strong>Comments / Description</strong></label></td>
		      <td align="left" valign="top"><textarea name="comments" id="comments" cols="45" rows="5"><?php if(isset($_POST['comments'])) { echo $_POST['comments']; } ?>
	            </textarea>
              <br />
              <br /></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top">&nbsp;</td>
		      <td align="left" valign="top"><input type="submit" name="add_program" id="button" value="Submit" /></td>
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
		<p>&nbsp;</p>



<?php include("footer.inc.php"); ?>
