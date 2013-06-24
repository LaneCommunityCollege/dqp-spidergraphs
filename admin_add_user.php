<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
	
	// If we hit the submit button and both fields are filled in, add the user
	if(isset($_POST['Add_User']) && 
		isset($_POST['email']) && $_POST['email'] != "" && 
		isset($_POST['pass']) && $_POST['pass'] != "" &&
		isset($_POST['inst_id']) && $_POST['inst_id'] != "")
		{
			// Crypt the password and put it in the database
			$crypt_pw = crypt($_POST['pass']); 
			
			$insert = mysql_query("INSERT INTO users VALUES('','$_POST[inst_id]','$_POST[name]','','$_POST[email]','','','$crypt_pw','y')");
			
			$msg->add("s", "User added with the user name $_POST[email] and password $_POST[pass]");
		}
	
	include("header.inc.php"); 
	
?>
<div id="TwoCol_left_50">
  <h1 align="center">Add User</h1>
	<p>Add a user if you would like someone other than yourself to manage the data in the spidergraph.</p>
	<p>If you are adding a user and would like that use to manage their own spidergraphs, you must first <a href="admin_add_institution.php">create an institution/section</a>, then assign this user to that section below.</p>
	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="29%" align="right">Email</td>
	      <td width="71%" align="left"><input type="text" name="email" id="email"></td>
        </tr>
	    <tr>
	      <td align="right">Password</td>
	      <td align="left"><input type="text" name="pass" id="pass"></td>
        </tr>
	    <tr>
	      <td align="right" valign="top">Institution / Section</td>
	      <td align="left" valign="top">
            <?php
				$result = mysql_query("SELECT * FROM institutions ORDER BY inst_id");
				while($row = mysql_fetch_array($result))
					{
						extract($row);
			?>  
              <label>
                <input type="radio" name="inst_id" value="<?php echo $inst_id; ?>" id="inst_id_<?php echo $inst_id; ?>">
                <?php echo $inst_name; ?>
              </label>
              <br />
          <?php		}	  ?>
          </td>
        </tr>
	    <tr>
	      <td align="right">&nbsp;</td>
	      <td align="left"><input type="submit" name="Add_User" id="button" value="Submit"></td>
        </tr>
      </table>

  </form>
	<p>&nbsp;</p>
</div>
        
        <div id="TwoCol_right_50">
            <?php include("admin_menu.inc.php"); ?>
            <p>&nbsp;</p>
        </div>
<?php include("footer.inc.php"); ?>
