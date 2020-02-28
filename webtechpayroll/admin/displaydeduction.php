<?php 
include 'includes/session.php';

 $deductsql = "SELECT * FROM deductions";
    $result = mysqli_query($conn,$deductsql);
       $res;
        foreach ($result as $rowded) {
          $res = "<tr>
            <td>" .$rowded['description'].""."
           </td> <td>".$rowded['amount'].""."
          </td>
          </tr>
          </table>";
        }




  ?>