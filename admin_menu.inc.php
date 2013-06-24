<div class="arrowlistmenu">
	<h3>Spidergraph Menu</h3>
    <br />
	<h3 class="headerbar">Institutional Outcomes</h3>
    <ul>
      <li><a href="admin_inst_outcomes.php">View Your Institutional Outcomes</a></li>
      <li><a href="admin_inst_outcomes_report.php">View Institutional Outcome Report</a></li>
  </ul>
    <h3 class="headerbar">Program / Course Lists</h3>
    <ul>   
      <li><a href="admin_course-program_list.php">View Your Course / Program List</a>	</li>
      <li><a href="admin_inactive_list.php">Inactive  Program List</a></li>
    </ul>    
    <h3 class="headerbar">Programs</h3>    
    <ul>    
      <li><a href="admin_create_program.php">Create a Program</a></li>
      <li><a href="admin_program_outcomes.php">Add/Edit Program Outcomes</a></li>
    </ul>
    <h3 class="headerbar">Courses</h3>
    <ul>    
      <li><a href="admin_create_course.php">Create a Course</a></li>
      <li><a href="admin_course_outcomes.php">Add/Edit Course Outcomes</a></li>
      <li><a href="admin_course_to_program.php">Connect a Course to a Program</a></li>
    </ul>
</div>

<?php
	// Only show the MISC menu items on external sites.  Never show on oregondqp.org.
	if(substr_count($_SERVER['HTTP_HOST'],"oregondqp.org") == 0)
		{
?>
<p>&nbsp;</p>
<div class="arrowlistmenu">
  <h3 class="headerbar">MISC</h3>
    <ul>
      <li><a href="admin_add_user.php">Add a User</a></li>
      <li><a href="admin_add_institution.php">Add an Institution / Section</a></li>
      <li><a href="admin_remove_sample_data.php">Remove All Sample Data</a></li>
  </ul>
</div>
<?php	}	?>