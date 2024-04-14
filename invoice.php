<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="invoice.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Invoice</title>
</head>
<?php include('connection.php');
        session_start();
        $uname = $_SESSION['uname'];
        $current_date = date("Y-m-d");
        $rno = rand(1,999);

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $Promo = $_POST['myInput'];
            $sql = "Select * from [Discount] where [Discount_ID] = '$Promo' ";
            $result = sqlsrv_query($conn, $sql);
            while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
            {
                $Disc = $obj['Percentage'];
            }
        
        }
        else
        {
            $Disc = 0;
        }
        
   ?>
<body>
    <div class="wrapper">
        <div class="invoice_wrapper">
            <div class="header">
                <div class="logo_invoice">
                    <div class="logo">
                        <img src="images/logo.jpeg" alt=""> 
                        <div class="title_wrap">
                            <label for="Tittle" >Luxury Lodgings</label>
                        </div>
                    </div>
                    <div class="invoice_sec">
                        <p id="Invoice_Label"   style="color: rgb(20, 89, 174);">  
                            INVOICE
                        </p>
                        <p class="Invoice_Info">
                           <SPan class="invo">  Invoice </SPan>
                           <span class="ID"><?php echo $rno.'</br>'?></span>
                        </p>
                        <p class="Date">
                            <span class="bold">Date</span>
                            <span class="Today"><?php echo $current_date.'</br>'?></span>
                        </p>
                    </div>
                </div>
                <div class="bill_total">  
                    <div clas="Bill_sec">
                        <p>
                            BILL TO:
                        </p>
                        <p class="username">
                            <span ><?php echo $uname.'</br>'?></span>
                        </p>
                    </div>      
                </div>
            </div>
           <div class="Boddy">
             <div class="Table">
                <div class="Table_header">
                    <div class="Row">
                        <div class="Col Col_no">NO</div>
                        <div class="Col Col_item_name">ITEM NAME</div>
                        <div class="Col Col_quantity">QUANTITY</div>
                        <div class="Col Col_price">PRICE</div>
                        <div class="Col Col_Total">TOTAL</div>
                    </div>
                </div>
                <div class="table_body"></div>
                <?php
                    //echo'<div class="Row" >';
                        

                            $uID = $_SESSION['uID'];
                            $uname = $_SESSION['uname'];

                            $current_date = date("Y-m-d");

                            // $sql = "Select * from [Bill] where Guest_ID = '$uID' and PaymentDate = '$current_date'";
                            // $result = sqlsrv_query($conn, $sql);
                            // $Price = array("","");
                            // $i = 0;
                            // while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
                            // {
                            //     $Price[$i] = $obj['TotalBill'];
                            //     $i++;
                            // 
                            $temp = "";
                            $tsql = "Select * from [Premium Customers] where Guest_ID = '$uID' ";
                            $rresult = sqlsrv_query($conn, $tsql);
                            while($obj = sqlsrv_fetch_array($rresult,SQLSRV_FETCH_ASSOC))
                            {
                                $temp = $obj['PC_ID'];
                            }
                    
                            if($temp == NULL)
                            {
                              $PC_disc = 0;
                              $PC_bill = 0;
                            }
                    
                            else
                            {
                              $PC_disc = 15;
                              $PC_bill = 350;
                            }

                            $i = 0;
                            $Total = 0;
                            $Sub = 0;
                        
                            $QN = array("","");
                            $PR = array("","");
                            $RT = array("","");

                            $sql = "Select * from BookingHistory where Guest_ID = '$uID 'and Room_Booking_Date = '$current_date'";
                            $result = sqlsrv_query($conn, $sql);
                            while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
                            {
                                $RT[$i] = $obj['Room_Type'];
                                $QN[$i] = $obj['Quantity'];
                                $PR[$i] = $obj['Price'];
                                
                            

                             echo'<div class="Row" >';
                             echo'<div class="Col Col_no">';
                             echo' <p id="Col_no">';
                             echo $i+1;
                              echo'</p>';
                              echo' </div>';
                              echo' <div class="Col Col_item_name">';
                              echo'<p id="Col_item_name">';
                                 echo $RT[$i];
                                 echo' </p>';
                                 echo'</div>';
                                 echo'<div class="Col Col_quantity">';
                                 echo'<p id="Col_quantity">';
                                 echo $QN[$i];
                                   echo'</p>';
                                   echo' </div>';
                                   echo'<div class="Col Col_price">';
                                   echo' <p id="Col_price">';
                                   echo $PR[$i];
                                 echo' </p>';
                                 echo' </div>';
                                 echo'<div class="Col Col_Total">';
                                 echo'<p id="Col_Total">';
                                 $Total = $PR[$i];
                                 $Sub = $Sub + $Total;
                                 echo $Total;
                                   echo'</p>';
                                   echo'</div>';
                                   $i++;
                            
                         
                             echo' </div>';
                            }

                            $sql = "Select * from CarBookingHistory where Guest_ID = '$uID '";
                            $result = sqlsrv_query($conn, $sql);
                            while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
                            {
                                $RT[$i] = $obj['Car_Type'];
                                $QN[$i] = $obj['Quantity'];
                                $PR[$i] = $obj['Price'];
                                
                            

                                echo'<div class="Row" >';
                             echo'<div class="Col Col_no">';
                             echo' <p id="Col_no">';
                             echo $i;
                              echo'</p>';
                              echo' </div>';
                              echo' <div class="Col Col_item_name">';
                              echo'<p id="Col_item_name">';
                                 echo $RT[$i];
                                 echo' </p>';
                                 echo'</div>';
                                 echo'<div class="Col Col_quantity">';
                                 echo'<p id="Col_quantity">';
                                 echo $QN[$i];
                                   echo'</p>';
                                   echo' </div>';
                                   echo'<div class="Col Col_price">';
                                   echo' <p id="Col_price">';
                                   echo $PR[$i];
                                 echo' </p>';
                                 echo' </div>';
                                 echo'<div class="Col Col_Total">';
                                 echo'<p id="Col_Total">';
                                 $Total = $PR[$i];
                                 $Sub = $Sub + $Total;
                                 echo $Total;
                                   echo'</p>';
                                   echo'</div>';
                                   $i++;
                            
                         
                             echo' </div>';
                            }

                            $Sub = $Sub + 200;   //adding $200 for service charges
                            $tempSub = $Sub + $PC_bill;
                            $tempSub = $tempSub + ((17/100)*$tempSub);
                            $totalDisc = $Disc + $PC_disc;
                ?>
             </div>
             <div class="payment_wrap" >
                   <div class="payment_sec">
                     <p class="bold">Payment Method</p>
                     <p>Visa Card , Master Card , Jazz Cash</p>
                   </div>
                   <div class="Total_sec">
                      <p class="bold">
                        <span >SubTotal</span>
                        <span id="SubTotal">$<?php echo $Sub.'</br>'?></span>
                      </p>
                      <p class="bold">
                        <span >Premium Bill</span>
                        <span id="Pbill">$<?php echo $PC_bill.'</br>'?></span>
                      </p>
                      <p class="bold">
                        <span >Premium Discount</span>
                        <span id="Pdisc"><?php echo $PC_disc ?>%</span>
                      </p>
                      <p class="bold">
                        <span >TAX</span>
                        <span id="GST_TAX">17%</span>
                      </p>
                      <p class="bold">
                        <span >Discount</span>
                        <span id="Discount"><?php echo $Disc ?>%</span>
                      </p>
                      <p class =butonn>
                        <form action="invoice.php" method ="Post" id="Promo">
                            <input type="text" id="myInput" name="myInput" placeholder="Promo ID"></br>
                            <button class = "Bookbtn" type = "submit">Apply Promo</button><br>
                        </form>
                     </p>
                      <p class="bold">
                        <span style="font-size: 10px;">Grand Total</span>
                        <span id="Grand_Total" style="font-size: 10px;">$<?php echo($tempSub - ($totalDisc/100)*$tempSub) ?></span>
                      </p>
                   </div>
             </div>
           </div>
           <div class="footer"></div>
           <br>
           <button type="button" class="btn btn-success" id="btngo" >Pay Now</button>
           <br>
           <br>
        </div>

    </div>
</body>

<script>
    const loginBtn = document.getElementById('btngo');
      loginBtn.addEventListener('click', function(event) {
        window.location.href ='Payment.php';
    });
</script>

<style>
  .Bookbtn {
    background-color: blue;
    color: white;
    margin-bottom: 20px;

    background-color: #007bff; /* Adjust the color code to your desired shade of blue */
    color: #fff;
    font-family: Arial, sans-serif; /* Change the font-family to your desired font */
    font-size: 16px; /* Change the font size if needed */
    padding: 8px 16px;
    
}

  input {
    margin-bottom: 20px; /* Adjust the value to add desired space */
    padding: 8px 16px;
  }
</style>


</html>