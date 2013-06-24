<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
	
	if(isset($_POST['Add_Inst']) && isset($_POST['name']) && $_POST['name'] != "")
		{
			$insert = mysql_query("INSERT INTO institutions VALUES('','$_POST[name]','','','','')");
			$msg->add("s", "Institution / Section Added");
		}
	
	
	include("header.inc.php"); 
	
?>
<div id="TwoCol_left_50">
  <h1 align="center">Add an Institution / Section</h1>
	<p>If you wish to have more than just your institution / section mapped, you can add more here.</p>
	<p>The original spidergraph was set up to allow institutions from all over Oregon add/manage their own spidergraphs without interfering with other institutions. In this case, you could do the same thing for different departments/segments/users of your own institution.</p>
	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="29%" align="right">Institution / Section Name</td>
	      <td width="71%" align="left"><input type="text" name="name" id="name"></td>
        </tr>
	    <tr>
	      <td align="right">&nbsp;</td>
	      <td align="left"><input type="submit" name="Add_Inst" id="button" value="Submit"></td>
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
