<?php 
	include("common.php");
	include("header.inc.php"); 
?>
    <h1>Course Outcomes</h1>
    <div id="graph">
        <div id="spidergraphcontainer"></div>
    </div>

	<div id="tables">
    <h2 align="center"><?php echo $institutions[$_GET['inst']]; ?></h2>
    <h3 align="center"><?php echo $_GET['course']; ?></h3>

    
	    <h3>Courses</h3>
        <p><button class="btn" id="clearall">Clear all checkboxes</button></p>
	    <table border="0" cellspacing="0" cellpadding="0" class="table_600">
	      <thead>
          <tr class="text_small">
	        <td align="left" valign="middle">Weight</td>
	        <td align="center" valign="middle">Outcomes</td>
	        <td align="center" valign="middle"><a href="dqp_outcome_descriptions.php?#applied" title="Description of Applied Learning">Applied Learning</a></td>
	        <td align="center" valign="middle"><a href="dqp_outcome_descriptions.php?#specialized" title="Description of Specialized Knowledge">Specialized Knowledge</a></td>
	        <td align="center" valign="middle"><a href="dqp_outcome_descriptions.php?#intellectual" title="Description of Intellectual Skills">Intellectual Skills</a></td>
	        <td align="center" valign="middle"><a href="dqp_outcome_descriptions.php?#broad" title="Description of Integrative/Broad Knowledge">Integrative/Broad Knowledge</a></td>
	        <td align="center" valign="middle"><a href="dqp_outcome_descriptions.php?#civic" title="Description of Civic Learning">Civic Learning</a></td>
	        <td align="center" valign="middle">&nbsp;</td>
	        <td align="center" valign="middle">&nbsp;</td>
          </tr>
          </thead>
	      <?php
			// Initialize the variables for the course outcome totals.
			$tot_co_applied = 0;
			$tot_co_specialized = 0;
			$tot_co_intellectual = 0;
			$tot_co_broad = 0;
			$tot_co_civic = 0;	
						
			// Get the course outcome data to go with the weigh we are holding onto from above
			$result_co = mysql_query("SELECT * FROM spidergraph_course_outcomes WHERE crs_id='$_GET[crs_id]'");
			while($row_co = mysql_fetch_array($result_co))
				{
					extract($row_co);
								
					// Add up the course outcomes for this program
					$tot_co_applied += $co_weight * $co_applied;
					$tot_co_specialized += $co_weight * $co_specialized;
					$tot_co_intellectual += $co_weight * $co_intellectual;
					$tot_co_broad += $co_weight * $co_broad;
					$tot_co_civic += $co_weight * $co_civic;
						
					// Get the course number (BA-151) from the courses table
					$result_crsNum = mysql_query("SELECT crs_number FROM spidergraph_courses WHERE crs_id='$crs_id'");
					$row_crsNum = mysql_fetch_array($result_crsNum);
					extract($row_crsNum);
								
		  ?>
		  <tr class="text_small">
			<td align="center" valign="middle"><?php echo round($co_weight,3) * 100; ?>%</td>
			<td align="left" valign="middle"><?php echo $co_outcome; ?></td>
			<td align="center" valign="middle"><?php echo round($co_applied,1); ?>%</td>
			<td align="center" valign="middle"><?php echo round($co_specialized,1); ?>%</td>
			<td align="center" valign="middle"><?php echo round($co_intellectual,1); ?>%</td>
			<td align="center" valign="middle"><?php echo round($co_broad,1); ?>%</td>
			<td align="center" valign="middle"><?php echo round($co_civic,1); ?>%</td>
			<td align="center" valign="middle">
            	<span class="inlinebar">
					<?php echo round($co_applied,1); ?>,
					<?php echo round($co_specialized,1); ?>,
                	<?php echo round($co_intellectual,1); ?>,
                    <?php echo round($co_broad,1); ?>,
                    <?php echo round($co_civic,1); ?>
                </span>
            </td>
			<td align="center" valign="middle">
            	<label class="invisible_label" for="DisplayOutcome<?php echo $co_id; ?>">DisplayOutcome<?php echo $co_id; ?></label>
            	<input class='graphshow' type="checkbox" name="course" id="DisplayOutcome<?php echo $co_id; ?>" value='{"fields": ["Applied", "Specialized", "Intellectual", "Broad", "Civic"], "scores": ["<?php echo $co_applied; ?>", "<?php echo $co_specialized; ?>", "<?php echo $co_intellectual; ?>", "<?php echo $co_broad; ?>", "<?php echo $co_civic; ?>"]}'>
            </td>
		  </tr>
		<?php
				} // End co
		?>
        </table>
        <p>&nbsp;</p>
        <div class="clear"></div>




<link href="scripts/jquery-ui-1.8.24.custom.css" rel="stylesheet" type="text/css">
<script src="scripts/jquery-1.8.1.min.js"></script>
<script src="scripts/jquery.spidergraph.js"></script>
<script src="scripts/jquery-ui.min.js"></script>
<script src="scripts/modernizr-2.6.1-respond-1.1.0.min.js"></script>
<script src="scripts/jquery.sparkline.min.js"></script>

<script>
	$(document).ready(function() {
		graph_data = {"fields": ["Applied", "Specialized", "Intellectual", "Broad", "Civic"], "scores": ["<?php echo $tot_co_applied; ?>", "<?php echo $tot_co_specialized; ?>", "<?php echo $tot_co_intellectual; ?>", "<?php echo $tot_co_broad; ?>", "<?php echo $tot_co_civic; ?>"]}
		$('#spidergraphcontainer').spidergraph({
			'fields': graph_data['fields'],
			'gridcolor': 'rgba(20,20,20,1)'
		});
		$('#spidergraphcontainer').spidergraph('addlayer', {
			'strokecolor': 'rgba(130,104,230,0.7)',
			'fillcolor': 'rgba(130,104,230,0.5)',
			'data': graph_data['scores'].map(function(x){return parseInt(x)})
		});
		//$('#course_outcomes').tablesorter({headers:{8:{sorter:false},9:{sorter:false}}});
	});
</script>

        
<script>
    $(function(){
        $('.inlinebar').sparkline('html', {type: 'bar', barColor: 'red', chartRangeMin: 0} );
    });
    c_colors = ['rgba(255,230,1','rgba(255,180,1','rgba(255,130,1','rgba(255,80,1'];
    p_colors = ['rgba(8,170,230','rgba(8,120,180','rgba(8,70,130','rgba(8,20,80'];
       
	//Function to clear all the existing checkboxes
    $('#clearall').click(function(){
        $('#spidergraphcontainer').spidergraph('resetdata');
        $('#tables').find('input').each(function(){
            $(this).attr('checked',false);
            $(this).parent('td').css('background-color', 'transparent');
        });
        
	 	//Throw that average data back on
        if (typeof graph_data != 'undefined'){
            $('#spidergraphcontainer').spidergraph('addlayer', {
                'strokecolor': 'rgba(130,104,230,0.7)',
                'fillcolor': 'rgba(130,104,230,0.5)',
                'data': graph_data['scores'].map(function(x){return parseInt(x)})
            });
        }
    });
      
	//If someone presses refresh, turn the checkboxes off again.
    $('#tables').find('input:checked').each(function(){
        $(this).attr('checked', false);
        $(this).attr('disabled', false);
    });
        
	//handle clicking checkboxes in the table
    $('.graphshow').click(function(){
        //if we just checked it
        if($(this).is(':checked')){
            var data = $.parseJSON($(this).val())['scores'].map(function(x){return parseInt(x)});
            if($(this).attr('name') == 'program'){
                var cur_color = p_colors.pop();
                var fill_color = cur_color + ',0.5)';
                $(this).attr('cur_color', cur_color);
                //set the table cell to our background
                $(this).parent('td').css('background-color',fill_color);
                $('#spidergraphcontainer').spidergraph('addlayer', {
                    'strokecolor': cur_color + ',0.7)',
                    'fillcolor': fill_color,
                    'data': data
                });
                if(p_colors.length == 0){
                    $('#tables input[name="program"]:not(:checked)').attr('disabled', true);
                }
            }
           
			//courses
            else{
                var cur_color = c_colors.pop();
                var fill_color = cur_color + ',0.5)';
                $(this).attr('cur_color', cur_color);
                //set the table cell to our background
                $(this).parent('td').css('background-color',fill_color);
                $('#spidergraphcontainer').spidergraph('addlayer', {
                    'strokecolor': cur_color + ',0.7)',
                    'fillcolor': fill_color,
                    'data': data
                });
                if(c_colors.length == 0){
                    $('#tables input[name="course"]:not(:checked)').attr('disabled', true);
                }
            }
        }
           
		//if we just unchecked it
        else{
            if($(this).attr('name') == 'program'){
                p_colors.push($(this).attr('cur_color'));
                $('#tables input[name="program"]').attr('disabled', false);
            }
           
		    //courses
            else{
                c_colors.push($(this).attr('cur_color'));
                $('#tables input[name="course"]').attr('disabled', false);
            }
            $(this).parent('td').css('background-color','transparent');
            $('#spidergraphcontainer').spidergraph('resetdata');
         
		    //Throw that average data back on
            if (typeof graph_data != 'undefined'){
                $('#spidergraphcontainer').spidergraph('addlayer', {
                    'strokecolor': 'rgba(130,104,230,0.7)',
                    'fillcolor': 'rgba(130,104,230,0.5)',
                    'data': graph_data['scores'].map(function(x){return parseInt(x)})
                });
            }
            $('#tables').find('input:checked').each(function(){
                $('#spidergraphcontainer').spidergraph('addlayer', {
                    'strokecolor': $(this).attr('cur_color') + ",0.7)",
                    'fillcolor': $(this).attr('cur_color') + ",0.5)",
                    'data': $.parseJSON($(this).val())['scores'].map(function(x){return parseInt(x)})
                });
            });
        }
    });
        
	//comments popups
    $('a.comments').live('click',function(e){
        e.preventDefault();
        comment = $(this).attr('title');
        $('#comments_dialog').dialog({model:true, minWidth:300, title:"Comments"});
        $('#comments_inner').text(comment);
    });
</script>

<?php include("footer.inc.php"); ?>
