<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="History.css">
    <title>History</title>
</head>
<?php include('connection.php');
        session_start();
   ?>

<body>



    <div class="container bootstrap snippets bootdey">
        <div class="panel panel-default">
            <div class="panel-body">
               
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-8 col-lg-6">
                        <!-- Section Heading-->
                        <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <h3><span>Purchase </span> History</h3>
                            <p> Look through your recent purchasing history. </p>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </br>
        </br>
    
                <div class="table-responsive">
                    <table class="table table-condensed nomargin">
                        <thead>
                            <tr>
                                <th>Booking Details</th>
                                <th>Booking No.</th>
                                <th>Quantity</th>
                                <th>Amount Paid</th>
                                <th>Purchased Date</th>
                                <th>Print Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php 
                                $uID = $_SESSION['uID'];
                                $uname = $_SESSION['uname'];
                                //echo "Welcome, $uname!";

                                $sql = "Select * from BookingHistory where Guest_ID = '$uID'";
                                $result = sqlsrv_query($conn, $sql);
                                $BN = array("","");
                                $RT = array("","");
                                $DT = array("","");
                                $QN = array("","");
                                $PR = array("","");
                                $RQ = array("","");
                                $dateObj = array("","");
                                $dateStr = array("","");
                                $i = 0;
                                while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
                                {
                                    $BN[$i] = $obj['Booking_No'];
                                    $RT[$i] = $obj['Room_Type'];
                                    $DT[$i] = $obj['Room_Booking_Date'];
                                    $QN[$i] = $obj['Quantity'];
                                    $PR[$i] = $obj['Price'];
                                    $RQ[$i] = $obj['Special_Request'];

                                    //$dateObj[$i] = DateTime::createFromFormat('Y-m-d', $DT[$i]);
                                    // convert the DateTime object to a string
                                    $dateStr[$i] = $DT[$i]->format('F j, Y');

                                    
                                
                                    echo'<td>';
                                        echo'<div><strong>'.$RT[$i].'</strong></div>';
                                        echo'<small>'.$RQ[$i].'</small>';
                                    echo'</td>';
                                    echo'<td>'.$BN[$i].'</td>';
                                    echo'<td>'.$QN[$i].'</td>';
                                    echo'<td>$'.$PR[$i].'</td>';
                                    echo'<td>'.$dateStr[$i].'</td>';
                                    echo'<td><a class="btn btn-success" href="page-invoice-print.html" target="_blank"><i class="fa fa-print"></i></a></td>';
                                    
                                    $i++;
                                    echo'<tr> </tr>';
                                }

                                $sql = "Select * from CarBookingHistory where Guest_ID = '$uID'";
                                $result = sqlsrv_query($conn, $sql);
                                $BN = array("","");
                                $RT = array("","");
                                $DT = array("","");
                                $QN = array("","");
                                $PR = array("","");
                                $RQ = array("","");
                                $dateObj = array("","");
                                $dateStr = array("","");
                                $i = 0;
                                while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
                                {
                                    $BN[$i] = $obj['Booking_No'];
                                    $RT[$i] = $obj['Car_Type'];
                                    $DT[$i] = $obj['Car_Booking_Date'];
                                    $QN[$i] = $obj['Quantity'];
                                    $PR[$i] = $obj['Price'];

                                    //$dateObj[$i] = DateTime::createFromFormat('Y-m-d', $DT[$i]);
                                    // convert the DateTime object to a string
                                    $dateStr[$i] = $DT[$i]->format('F j, Y');

                                    
                                
                                    echo'<td>';
                                        echo'<div><strong>'.$RT[$i].'</strong></div>';
                                        // echo'<small>'.$RQ[$i].'</small>';
                                    echo'</td>';
                                    echo'<td>'.$BN[$i].'</td>';
                                    echo'<td>'.$QN[$i].'</td>';
                                    echo'<td>$'.$PR[$i].'</td>';
                                    echo'<td>'.$dateStr[$i].'</td>';
                                    echo'<td><a class="btn btn-success" href="page-invoice-print.html" target="_blank"><i class="fa fa-print"></i></a></td>';
                                    
                                    $i++;
                                    echo'<tr> </tr>';
                                }
                                ?>
                            </tr>
    
                        </tbody>
                    </table>
                </div>

            </br>
        </br>
    </br>
    
                <hr class="nomargin-top">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <h4><strong>Contact</strong> US </h4>
    
                        <address>
                            PO Box 21132 <br>
                            Vivas 2355 Pakistan<br>
                            Phone: 1-800-565-2390 <br>
                            Fax: 1-800-565-2390 <br>
                            Email: support@luxurylodgings.com
                        </address>
                    </div>
    
                    
                </div>
            </div>
        </div>
    
        <div class="panel panel-default text-right">
            <div class="panel-body">
                <a class="btn btn-warning" href="#"><i class="fa fa-pencil-square-o"></i> Call</a>
                <a class="btn btn-primary" href="#"><i class="fa fa-check"></i> Message</a>
            </div>
        </div>
    </div>
    
</br>
</br>
</br>



</body>
</html>