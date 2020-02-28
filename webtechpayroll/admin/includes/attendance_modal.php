<!-- Add --> <?php
$db=mysqli_connect("localhost","root","","apsystem");

if(!$db){
  die('Coulnd not connect'.mysql_connect_error());

}?>





<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Attendance</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Employee Name</label>

                  	<div class="col-sm-9">
                    	
                      <select class="form-control" id="employee" name="employee">
                        
                      <?php $db=mysqli_connect("localhost","root","","apsystem");
                      $sql = " SELECT * FROM employees ";
                       $result = mysqli_query($db,$sql); 
                       
                       foreach($result as $row ){
                        echo "<option value=". $row['employee_id'].">".$row['firstname']." ".$row['lastname']. "</option>";
                       } 
                       
                     ?>
                      </select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date" required>
                      </div>
                    </div>
                </div>
               
                   <div class="form-group">
                  	<label for="days" class="col-sm-3 control-label">No of days present.</label>
                      <div class="col-sm-9">
                  		<input type="number" class="form-control" id="days" name="days" required>
                      </div>
                    </div>
                     <div class="form-group">
                  	<label for="late" class="col-sm-3 control-label">NO of minutes late.</label>
                      <div class="col-sm-9">
                  		<input type="number" class="form-control" id="late" name="late" required>
                      </div>
                    </div>
                      <div class="form-group">
                  	<label for="absent" class="col-sm-3 control-label">NO of days Absent.</label>
                      <div class="col-sm-9">
                  		<input type="number" class="form-control" id="absent" name="absent" required>
                      </div>
                    </div>
                      <div class="form-group">
                  	<label for="half" class="col-sm-3 control-label">NO of half day.</label>
                      <div class="col-sm-9">
                  		<input type="number" class="form-control" id="half" name="half" required>
                      </div>
                    </div>
                   
                      
                </div>
         
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_edit.php">
            		<input type="hidden" id="attid" name="id" >
                
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="eddate" required>
                      </div>
                    </div>
                </div>
               
                   <div class="form-group">
                  	<label for="edit_days" class="col-sm-3 control-label">No of days present.</label>
                      <div class="col-sm-9">
                  		<input type="number" class="form-control" id="edit_days" name="edit_days" required="">
                      </div>
                    </div>
                     <div class="form-group">
                  	<label for="late" class="col-sm-3 control-label">NO of minutes late.</label>
                      <div class="col-sm-9">
                  		<input type="number" class="form-control" id="edit_late" name="late" required>
                      </div>
                    </div>
                      <div class="form-group">
                  	<label for="absent" class="col-sm-3 control-label">NO of days Absent.</label>
                      <div class="col-sm-9">
                  		<input type="number" class="form-control" id="edit_absent" name="absent" required>
                      </div>
                    </div>
                      <div class="form-group">
                  		<label for="half" class="col-sm-3 control-label">NO of half day.</label>
                      <div class="col-sm-9">
                  		<input type="number" class="form-control" id="edit_half" name="edit_half" required="">
                      </div>
                    </div>         
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="attendance_date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_delete.php">
            		<input type="hidden" id="del_attid" name="id">
            		<div class="text-center">
	                	<p>DELETE ATTENDANCE</p>
	                	<h2 id="del_employee_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


   