<?php 
	include("common.php");
	include("header.inc.php"); 
?>

	<h1>Programs</h1>
    
    <?php include("scripts/old_browser.inc"); ?>
    
    <div id="graph">
        <div id="spidergraphcontainer"></div>
    </div>

	<div id="tables">
    <h2 align="center"><?php echo $institutions[$_GET['inst']]; ?></h2>
    
    <p><button class="btn" id="clearall">Clear all checkboxes</button></p>
    <table border="0" cellspacing="0" cellpadding="0" class="table_400">
      <thead>
        <tr>
          <td align="left"><strong>Program Title</strong></td>
          <td align="center"><strong>Program</strong></td>
          <td align="center"><strong>Course</strong></td>
        </tr>
      </thead>
      <?php
	  		$result = mysql_query("SELECT * FROM spidergraph_programs WHERE inst_id='$_GET[inst]'");
			while($row = mysql_fetch_array($result))
				{
					extract($row);
					
	  ?>
      <tr>
        <td align="left"><a href="program_outcomes.php?inst=<?php echo $inst_id; ?>&amp;prog_id=<?php echo $prog_id; ?>&amp;name=<?php echo $prog_name ?>"><?php echo $prog_name; ?></a></td>
        <td align="center"><?php
					// Initialize the variables for the program outcome totals.
					$tot_po_applied = 0;
					$tot_po_specialized = 0;
					$tot_po_intellectual = 0;
					$tot_po_broad = 0;
					$tot_po_civic = 0;
	
					// Get the Program Outcomes for each program
					$result_po = mysql_query("SELECT * FROM spidergraph_program_outcomes WHERE prog_id='$prog_id'");
					$num_prog_outcomes = mysql_num_rows($result_po);
				
					while($row_po = mysql_fetch_array($result_po))
						{
							extract($row_po);
							
							// Add up the program outcome totals.
							$tot_po_applied += $po_applied * $po_weight;
							$tot_po_specialized += $po_specialized * $po_weight;
							$tot_po_intellectual += $po_intellectual * $po_weight;
							$tot_po_broad += $po_broad * $po_weight;
							$tot_po_civic += $po_civic * $po_weight;
							
							// Initialize the variables for the course outcome totals.
							$tot_co_applied = 0;
							$tot_co_specialized = 0;
							$tot_co_intellectual = 0;
							$tot_co_broad = 0;
							$tot_co_civic = 0;	
					
							// Now, get the data for the courses in this program.
							// Have to get crs_id's from the course to program table, then query the course outcomes table.
							// For Each Course, TOT_APPLIED += Weight X Applied, TOT_CIVIC += Weight X Civic...
							$result_ctp = mysql_query("SELECT * FROM spidergraph_course_to_program WHERE prog_id='$prog_id'");
							$num_ctp = mysql_num_rows($result_ctp);
							
							while($row_ctp = mysql_fetch_array($result_ctp))
								{
									extract($row_ctp);
									$crs_ids[$crs_id] = $prog_id;
								
									$result_crs = mysql_query("SELECT * FROM spidergraph_course_outcomes WHERE crs_id='$crs_id'");
									while($row_crs = mysql_fetch_array($result_crs))
										{
											extract($row_crs);

											// Add up the course outcomes for this program
											$tot_co_applied += $co_weight * $co_applied;
											$tot_co_specialized += $co_weight * $co_specialized;
											$tot_co_intellectual += $co_weight * $co_intellectual;
											$tot_co_broad += $co_weight * $co_broad;
											$tot_co_civic += $co_weight * $co_civic;
										}
								}
						}
					

					// If there are course outcomes in this program, divide the totals by the number of courses.	
					if(isset($num_ctp) && $num_ctp > 0)
						{
							$tot_co_applied = $tot_co_applied / $num_ctp;
							$tot_co_specialized = $tot_co_specialized / $num_ctp;
							$tot_co_intellectual = $tot_co_intellectual / $num_ctp;
							$tot_co_broad = $tot_co_broad / $num_ctp;
							$tot_co_civic = $tot_co_civic / $num_ctp;
						}
	  ?>
          <!--					
					<script>
                    	$('#spidergraphcontainer').spidergraph('addlayer', { 
                        		'strokecolor': 'rgba(230,104,0,0.8)',
                                'fillcolor': 'rgba(230,104,0,0.6)',
                                'data': [<?php //echo round($tot_co_applied,1); ?>, <?php //echo round($tot_co_specialized,1); ?>, <?php //echo round($tot_co_intellectual,1); ?>, <?php //echo round($tot_co_broad,1); ?>, <?php //echo round($tot_co_civic,0); ?>]
                        });
                    </script>
-->
          <?php
			//	}

					if($num_prog_outcomes > 0)
						{
	  ?>
          <label class="invisible_label" for="DisplayProgramOutcome<?php echo $po_id; ?>">DisplayProgramOutcome<?php echo $po_id; ?></label>
          <input class='graphshow' type="checkbox" name="program" id="DisplayProgramOutcome<?php echo $po_id; ?>" value='{&quot;fields&quot;: [&quot;Applied&quot;, &quot;Specialized&quot;, &quot;Intellectual&quot;, &quot;Broad&quot;, &quot;Civic&quot;], &quot;scores&quot;: [&quot;<?php echo round($tot_po_applied,1); ?>&quot;, &quot;<?php echo round($tot_po_specialized,1); ?>&quot;, &quot;<?php echo round($tot_po_intellectual,1); ?>&quot;, &quot;<?php echo round($tot_po_broad,1); ?>&quot;, &quot;<?php echo round($tot_po_civic,1); ?>&quot;]}' />
          <?php 			} ?></td>
        <td align="center"><?php
					if(isset($num_ctp) && $num_ctp > 0)
						{  
	  ?>
          <label class="invisible_label" for="DisplayCourseOutcome<?php echo $co_id; ?>">DisplayCourseOutcome<?php echo $co_id; ?></label>
          <input class='graphshow' type="checkbox" name="course" id="DisplayCourseOutcome<?php echo $co_id; ?>" value='{&quot;fields&quot;: [&quot;Applied&quot;, &quot;Specialized&quot;, &quot;Intellectual&quot;, &quot;Broad&quot;, &quot;Civic&quot;], &quot;scores&quot;: [&quot;<?php echo round($tot_co_applied,1); ?>&quot;, &quot;<?php echo round($tot_co_specialized,1); ?>&quot;, &quot;<?php echo round($tot_co_intellectual,1); ?>&quot;, &quot;<?php echo round($tot_co_broad,1); ?>&quot;, &quot;<?php echo round($tot_co_civic,1); ?>&quot;]}' /></td>
        <?php 			} ?>
      </tr>
      <?php		
				} ?>
    </table>
    <p>&nbsp;</p>
        <div class="clear"></div>


<script type="text/javascript" src="scripts/jquery-1.8.1.min.js"></script>
<link href="scripts/jquery-ui-1.8.24.custom.css" rel="stylesheet" type="text/css">
<script src="scripts/jquery.spidergraph.js"></script>
<script src="scripts/jquery.tablesorter.min.js"></script>
<script src="scripts/jquery-ui-1.8.23.min.js"></script>
<script src="scripts/modernizr-2.6.1-respond-1.1.0.min.js"></script>
<script src="scripts/jquery.sparkline.min.js"></script>

<script>
	$(document).ready(function() {
		//Set up the spider graph
		$('#spidergraphcontainer').spidergraph({
			'fields': ['Applied','Specialized','Intellectual','Broad','Civic'],//TODO generalize these
			'gridcolor': 'rgba(20,20,20,1)'
		});
	});


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
