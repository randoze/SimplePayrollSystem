<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../images/profile.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree" color="blue">
        
        <li class="header">MANAGE</li>
       
        <li><a href="attendance.php"><i class="fa fa-calendar"></i> <span>Attendance Monitor</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>HR Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="employee.php"><i class="fa fa-circle-o"></i> View Employee </a></li>

            <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Overtime</a></li>
            <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> Cash Advance</a></li>
          <!--  <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Schedules</a></li>-->
             <li><a href="position.php"><i class="fa fa-suitcase"></i> Designation</a></li>
            <!--<li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Employee Schedule</span></a></li> -->
          </ul>
        </li>
        <li><a href="deduction.php"><i class="fa fa-file-text"></i> <span>Deductions</span></a></li>
     
        <li class="header">PRINTABLES</li>
        <li><a href="payroll.php"><i class="fa fa-pie-chart"></i> <span>Payroll</span></a></li>
   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>