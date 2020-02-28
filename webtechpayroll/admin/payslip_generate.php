<?php
    include 'includes/session.php';
    
    $range = $_POST['date_range'];
    $ex = explode(' - ', $range);
    $from = date('Y-m-d', strtotime($ex[0]));
    $to = date('Y-m-d', strtotime($ex[1]));

    $sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    $query = $conn->query($sql);
    $drow = $query->fetch_assoc();
    $deduction = $drow['total_amount'];

    $from_title = date('M d, Y', strtotime($ex[0]));
    $to_title = date('M d, Y', strtotime($ex[1]));

    require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payslip: '.$from_title.' - '.$to_title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 11);  
    $pdf->SetFont('helvetica', '', 8);  
    $pdf->AddPage(); 
    $contents = '';

    $sql = "SELECT employees.id as employee_id,employees.employee_id as empid,firstname,lastname,rate,num_hr,absent,late,halfday,description from attendance inner join employees on attendance.employee_id = employees.employee_id inner join position on position.id = employees.position_id
                       WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

    $query = $conn->query($sql);
    while($row = $query->fetch_assoc()){
        $empid = $row['employee_id'];
                      
        $casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
      

          $casql = "SELECT ifnull(sum(amount),0) as amt from employees left join cashadvance on employees.id = cashadvance.employee_id where employees.id = $empid AND  date_advance BETWEEN '$from' AND '$to'";
                      
                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $cashadvance = $carow['amt'];

                      $gross = $row['rate'] * 15;
                      $late = $row['late'] * .20;
                     $halfday = $row['halfday'];
                     $absent = $row['absent'];
                     $absentdeduct = $absent * ($row['rate']);
                     $halfdeduct = $halfday * ($row['rate']* .50);
                      $total_deduction = $deduction + $cashadvance + $late + $halfdeduct + $absentdeduct;
                      $net = $gross - $total_deduction;

        $contents .= '
            <h2>Webtech Payroll</h2>
            <h4>'.$from_title." - ".$to_title.'</h4>
            <table width="300" height="200" class="table table-bordered" >  
                <tr>  
                    <td>  Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['firstname']." ".$row['lastname'].    ' </td>
                   
                </tr>
                	<tr>
    	    		<td>  ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$row['empid'].'</td>
				 
				 	
    	    	</tr>
                 <tr>  
                    <td>  Rate:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; P'.number_format($row['rate'],2).'</td>
                  
                </tr>
                <tr>  
                    <td>  Position:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'           .$row['description'].'</td>
                  
                </tr>
                 <tr>  
                    <td>  Days:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;15 </td>
                    
                </tr>
               
                <tr> 
                    <td>  Gross Pay: P'.number_format(($row['rate']*15), 2).' </td>
                   
                </tr>

               
            </table>
                      
            <br><br>


            <table width="300" height="400" >
            <tr>
            <td><B>Deduction</B></td>
            <td>  </td>
            </tr>
            <tr>
            <td>  &nbsp;Description </td>
            <td> Amount </td>
            </tr>
            <tr>
            <td>     &nbsp;&nbsp;&nbsp;SSS </td>
            <td> P120.00  </td>
            </tr>
             <tr>
             <td>    &nbsp;&nbsp;&nbsp;PhilHealth </td>
             <td> P100.00  </td>
             </tr>
               <tr> 
                    <td>    &nbsp;&nbsp;&nbsp;Cash Advance: </td>
                    <td> P' .number_format($cashadvance, 2). ' </td> 
                </tr>
                <tr> 
                    <td>    &nbsp;&nbsp;&nbsp;Late:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $row['late'].'min </td>
                    <td> P' .number_format($late, 2) . ' </td> 
                </tr>
                 <tr> 
                    <td>    &nbsp;&nbsp;&nbsp;Half Day:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$halfday.'     </td>
                    <td> P' . number_format($halfdeduct, 2) . '</td> 
                </tr>
                 <tr> 
                    <td>    &nbsp;&nbsp;&nbsp;Absent:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$absent.'day</td>
                    <td> P' . number_format($absentdeduct, 2) . '.</td> 

                </tr>
               <tr> 
                    <td>    &nbsp;&nbsp;&nbsp;Total Deduction: </td>
                    <td><b> P' . number_format($total_deduction, 2) . '</b></td> 
                </tr>

                <tr> 
                   
                    <td><b> Net Pay: </b></td>
                    <td><b> P' . number_format($net, 2) . '.</b></td> 
                </tr>
            </table>
            <br><br><br><br>';
    }
    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');

?>