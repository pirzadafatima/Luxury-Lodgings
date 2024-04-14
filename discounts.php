<!DOCTYPE html>
<html>
    <head>
        <title>Discounts & Offers</title>
        <link rel = "stylesheet" href = "discountstyle.css">
    </head>
<?php include('connection.php');
   session_start();
?>
    <body>
        <header>
            <img src="images/maindisc.jpg" alt="">
            <section class='pic'>
               <h1>Discounts & Offers</h1>
            </section>
         </header>
          <br><br>
          <div class = "intro">
            <p>Experience luxury at an unbeatable price with our exclusive discounts and offers at Luxury Lodgings. From discounted rates on room bookings to special packages 
                that include free services, and more, we've got everything you need to enjoy a luxurious getaway at a fraction of the cost. Don't miss out on these 
                limited-time offers and book your stay today!</p>
        </div>
        <br><br><br>
        <div class = "discounts">
            <?php
                $sql = "SELECT * FROM [Discount]";
                $result = sqlsrv_query($conn, $sql);

                while ($discount = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo '<div class="d1">';
                    echo '<h2>'.$discount['Type'].'</h2>';
                    echo '<p>'.$discount['Description'].'<br><br>';
                    echo 'Valid from: '.$discount['Date_start']->format('Y-m-d').'<br>';
                    echo 'Valid till: '.$discount['Date-end']->format('Y-m-d').'</p>';
                    echo '<h2> Promo Code:' .$discount['Discount_ID'].'</h2>';
                    echo '<p>Note: add the promo code on the invoice page to avail the offer.</p>';
                    echo '</div>';
                    echo '<br><br>';
                }
            ?>
        </div>  
        <br><br><br>
        <h1>Premium Membership</h1>
        <div class = "intro">
            <p> As a token of our appreciation for your loyalty, we offer a specified discount available only to our Premium Members. Just purchase our membership for a one-time cost and enjoy 
                this one of a kind discount for all bookings for a lifetime. This is the perfect way to elevate your stay to the next level and create unforgettable memories.</p>
        </div>
        <br>
        <br><br><h4>Please Note: You can become a part of the premium membership today for only $350 and gain access to a world of luxury by getting a 15% discount on your bill - 
            tailor-made to enhance your luxury experience.</h4>
             <form action="#P" method ="Post" id="P">
               <button class = "Bookbtn" type = "submit">Get Premium Now</button><br>
            </form>
    </body>


  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $uID = $_SESSION['uID'];
        $temp = NULL;

        $sql = "Select * from [Premium Customers] where [Guest_ID] = $uID";
        $result = sqlsrv_query($conn, $sql);
        while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
        {
            $temp = $obj['PC_ID'];
        }

        if($temp == NULL)
        {
            $tsql  = "select (count(PC_ID)+1) as new_PC_ID from [Premium Customers]";
			$stmt = sqlsrv_query($conn, $tsql);
            $resultt = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
			$PC=$resultt['new_PC_ID'];

            $sql = "Insert into [Premium Customers] Values('$PC', '$uID')";
            $result = sqlsrv_query($conn, $sql);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You are now added to Premium Customers!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
         </div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Already Premium Customer.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
               </div>';
                  die('.');
        }


        
    }


  ?>
</html>