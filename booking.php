<!DOCTYPE html>
<html>
<head>
	<title>Hotel Room Types</title>
    <link rel="stylesheet" href="booking_style.css">

</head>


<body>
<?php
include('connection.php');
session_start();

if (!isset($_SESSION['uID'])) {
    // User is not logged in, redirect to login pag
    header('Location: login.php');
    exit;
}
else 
{

   	$_id =$_SESSION['uID'];
	//echo $_id;
}
// User is logged in, check if coming from rooms.php
//$fromRooms = isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'rooms.php') !== false;

// if ($fromRooms) {
//     // User is coming from rooms.php, redirect to roomsreservation.php
//     header('Location: booking.php');
//     exit;
// }




$tsql  = "SELECT [Available Room] as totalrooms FROM AvailableRooms";
$stmt = sqlsrv_query($conn, $tsql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row['totalrooms'];
}
//echo $data[0];
//print_r($data);
sqlsrv_free_stmt($stmt);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$checkInDate = $_POST["checkInDate"];
$checkOutDate = $_POST["checkOutDate"];
//echo "Check-in date: " . $checkInDate . "<br>";
//echo "Check-out date: " . $checkOutDate . "<br>";
	
	$deluxerooms = $_POST['deluxerooms'];
	//echo "deluxerooms: " . $deluxerooms . "<br>";
	$ExecutiveRoom = $_POST['ExecutiveRoom'];
	//echo "ExecutiveRoom: " . $ExecutiveRoom . "<br>";
	$FamilySuite = $_POST['FamilySuite'];
	//echo "FamilySuite: " . $FamilySuite . "<br>";
	$GardenViewRoom = $_POST['GardenViewRoom'];
	//echo "GardenViewRoom: " . $GardenViewRoom . "<br>";
	$standardrooms = $_POST['standardrooms'];
	//echo "standardrooms: " . $standardrooms . "<br>";
	$roomBill = $_POST['roomBill'];
	//echo "roomBill: " . $roomBill . "<br>";
	// Use the $bookedRooms variable as needed
	if (isset($_SESSION['uID'])) {

		// If the user is already logged in, redirect to the room reservation page
		if ($standardrooms >0)
		{
			  
			//    $tsql  = "select (count(RB_ID)+1) as new_RB_ID from [Room Booking]";
			// 	$stmt = sqlsrv_query($conn, $tsql);

			// 	if ($stmt === false) {
			// 	die(print_r(sqlsrv_errors(), true));
			// 	}
				// $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				// $RB=$result['new_RB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//echo $RB;
				//sqlsrv_free_stmt($stmt);
				$room_id = 'std_05'; // set hardcoded value here
				//echo $room_id;
				$booking_date = date('Y-m-d');
				//echo $booking_date;
				$sql = "INSERT INTO [Room Booking] VALUES (NULL,'$Guest_Id', '$room_id', '$standardrooms', '$booking_date', '$checkInDate', '$checkOutDate', NULL, NULL)";   
				$stmts = sqlsrv_query($conn, $sql); 
				if ($stmts === false) {
				  die(print_r(sqlsrv_errors(), true));
			    }
				$tsql  = "SELECT Room_ID as ID FROM  [Room Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				  if ($stmt === false) {
					  die(print_r(sqlsrv_errors(), true));
				  }

				  $data = array();
				  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					  $data[] = $row['ID'];
				  }
				 // echo $data[0];
				  //print_r($data);


				  sqlsrv_free_stmt($stmt); 

				 
				
					
				 
				   
		}

		if ($GardenViewRoom >0)
		{
			  
			//    $tsql  = "select (count(RB_ID)+1) as new_RB_ID from [Room Booking]";
			// 	$stmt = sqlsrv_query($conn, $tsql);

			// 	if ($stmt === false) {
			// 	die(print_r(sqlsrv_errors(), true));
			// 	}
				// $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				// $RB=$result['new_RB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//echo $RB;
				//sqlsrv_free_stmt($stmt);
				$room_id = 'gview_02'; // set hardcoded value here
				//echo $room_id;
				$booking_date = date('Y-m-d');
				//echo $booking_date;
				$sql = "INSERT INTO [Room Booking] VALUES (NULL,'$Guest_Id', '$room_id', '$GardenViewRoom', '$booking_date', '$checkInDate', '$checkOutDate', NULL, NULL)";   
				$stmts = sqlsrv_query($conn, $sql); 
				if ($stmts === false) {
				  die(print_r(sqlsrv_errors(), true));
			    }
				$tsql  = "SELECT Room_ID as ID FROM  [Room Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				  if ($stmt === false) {
					  die(print_r(sqlsrv_errors(), true));
				  }

				  $data = array();
				  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					  $data[] = $row['ID'];
				  }
				 // echo $data[0];
				  //print_r($data);


				  sqlsrv_free_stmt($stmt); 

				 
				
					
				 
				   
		}
		if ($FamilySuite >0)
		{
			  
			//    $tsql  = "select (count(RB_ID)+1) as new_RB_ID from [Room Booking]";
			// 	$stmt = sqlsrv_query($conn, $tsql);

			// 	if ($stmt === false) {
			// 	die(print_r(sqlsrv_errors(), true));
			// 	}
				// $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				// $RB=$result['new_RB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//echo $RB;
				//sqlsrv_free_stmt($stmt);
				$room_id = 'fam_04'; // set hardcoded value here
				//echo $room_id;
				$booking_date = date('Y-m-d');
				//echo $booking_date;
				$sql = "INSERT INTO [Room Booking] VALUES (NULL,'$Guest_Id', '$room_id', '$FamilySuite', '$booking_date', '$checkInDate', '$checkOutDate', NULL, NULL)";   
				$stmts = sqlsrv_query($conn, $sql); 
				if ($stmts === false) {
				  die(print_r(sqlsrv_errors(), true));
			    }
				$tsql  = "SELECT Room_ID as ID FROM  [Room Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				  if ($stmt === false) {
					  die(print_r(sqlsrv_errors(), true));
				  }

				  $data = array();
				  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					  $data[] = $row['ID'];
				  }
				 // echo $data[0];
				  //print_r($data);


				  sqlsrv_free_stmt($stmt); 

				 
				
					
				 
				   
		}


		if ($ExecutiveRoom >0)
		{
			  
			//    $tsql  = "select (count(RB_ID)+1) as new_RB_ID from [Room Booking]";
			// 	$stmt = sqlsrv_query($conn, $tsql);

			// 	if ($stmt === false) {
			// 	die(print_r(sqlsrv_errors(), true));
			// 	}
				// $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				// $RB=$result['new_RB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//echo $RB;
				//sqlsrv_free_stmt($stmt);
				$room_id = 'exec_03'; // set hardcoded value here
				//echo $room_id;
				$booking_date = date('Y-m-d');
				//echo $booking_date;
				$sql = "INSERT INTO [Room Booking] VALUES (NULL,'$Guest_Id', '$room_id', '$ExecutiveRoom', '$booking_date', '$checkInDate', '$checkOutDate', NULL, NULL)";   
				$stmts = sqlsrv_query($conn, $sql); 
				if ($stmts === false) {
				  die(print_r(sqlsrv_errors(), true));
			    }
				$tsql  = "SELECT Room_ID as ID FROM  [Room Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				  if ($stmt === false) {
					  die(print_r(sqlsrv_errors(), true));
				  }

				  $data = array();
				  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					  $data[] = $row['ID'];
				  }
				  //echo $data[0];
				  //print_r($data);


				  sqlsrv_free_stmt($stmt); 

				
					
				 
				   
		}

		if ($deluxerooms >0)
		{
			  
			//    $tsql  = "select (count(RB_ID)+1) as new_RB_ID from [Room Booking]";
			// 	$stmt = sqlsrv_query($conn, $tsql);

			// 	if ($stmt === false) {
			// 	die(print_r(sqlsrv_errors(), true));
			// 	}
				// $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				// $RB=$result['new_RB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//echo $RB;
				//sqlsrv_free_stmt($stmt);
				$room_id = 'del_01'; // set hardcoded value here
				//echo $room_id;
				$booking_date = date('Y-m-d');
				//echo $booking_date;
				$sql = "INSERT INTO [Room Booking] VALUES (NULL,'$Guest_Id', '$room_id', '$deluxerooms', '$booking_date', '$checkInDate', '$checkOutDate', NULL, NULL)";   
				$stmts = sqlsrv_query($conn, $sql); 
				if ($stmts === false) {
				  die(print_r(sqlsrv_errors(), true));
			    }
				$tsql  = "SELECT Room_ID as ID FROM  [Room Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				  if ($stmt === false) {
					  die(print_r(sqlsrv_errors(), true));
				  }

				  $data = array();
				  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					  $data[] = $row['ID'];
				  }
				 // echo $data[0];
				  //print_r($data);


				  sqlsrv_free_stmt($stmt); 

				
					
				 
				   
		}

		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your rooms have been booked successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';

		sleep(1.5);
		header("Location: http://localhost/Profile.php", true, 307);
		exit();


		
	  }
  }
  

//sqlsrv_close($conn);



?>

	<div class="header">
		<img src="images/logo.jpeg" alt="Hotel Logo">
	</div>

	<form action="booking.php" method="POST">
    	<div class="Check_in_Availability">
		
        	<div class="check_in">
                 <div>
                  <label for="date">Check in</label>
                  <input type="date" id="checkInDate" name="checkInDate" min="<?php echo date('Y-m-d'); ?>">
                 </div>
      		</div>
      		<div class="check_out">
          		<div>
              		<label for="date_check">Check out </label >
              		<input type="date" id="checkOutDate" name="checkOutDate" min="<?php echo date('Y-m-d',strtotime('+1 day')); ?>">
          		</div>
        	</div>
			
        	<button class="check_button" id="checkbtn" type="submit" value="Book Now" name="submit">Book Now</button>
  		</div>
		  <div class="TotalBill" >
						<div>
		 					<h2 id="bill"  >
							 Lodging Fee: $ ?>
							</h2>
						</div>
					</div>
		
			<div class="container">
			
					
					<input type="hidden" name="roomBill" id="roomBill" value="0">
					
				
					<div class="room-type">
						<img src="https://www.travelandleisure.com/thmb/KtXNAD3uHjtQoBPKxWRhbMygrSo=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/MacArthur-Place-Hotel--Spa-Fireplace-Room-a3078a9f2510495d9c66441386ad111f.jpg" alt="Standard Room">
							<h2>Standard Room</h2>
						<p class="Price">Price per night: $250</p>
						<label for="standard-rooms">Select no of Rooms</label>
						<select class="Selectrooms" name="standardrooms"id="standardrooms" data-price="250"  data-max-rooms="<?php echo $data[4]; ?>" data-booked-rooms="0" > <!--disabled is an attribute to disable the functionaliity 
						w	henever we want. at first our user can't select no of rooms but when he goes through the prcedure of check in the selection of room enabled and user can seelct the rooms -->
						<?php for ($i = 0; $i <= $data[4]; $i++) { ?>
           			 	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        				<?php } ?>
						</select>
					</div>
					<div class="room-type">
							<img src="https://m.fourseasons.com/alt/img-opt/~70.1530.0,0000-0,0000-1600,0000-900,0000/publish/content/dam/fourseasons/images/web/KYO/KYO_101_aspect16x9.jpg" alt="Deluxe Room">
							<h2>Garden View Room</h2>
							<p class="Price">Price per night: $350</p>
							<label for="Garden View">Select no of Rooms</label>
							<select class="Selectrooms" name="GardenViewRoom" id="GardenViewRoom" data-price="350"  data-max-rooms="<?php echo $data[3]; ?>" data-booked-rooms="0" >
							<?php for ($i = 0; $i <= $data[3]; $i++) { ?>
				
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
							</select>
					</div>
					<div class="room-type">
						<img src="https://hi-cdn.t-rp.co.uk/images/rooms/0/50841"  alt="Deluxe Room">
						<h2>Executive Room</h2>
						<p class="Price">Price per night: $400</p>
						<label for="Executive Room">Select no of Rooms</label>
						<select class="Selectrooms" name="ExecutiveRoom" id="ExecutiveRoom" data-price="400"  data-max-rooms="<?php echo $data[1]; ?>" data-booked-rooms="0" >
						<?php for ($i = 0; $i <= $data[1]; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
						</select>
					</div>
					<div class="room-type">
						<img src="https://www.adelphihospitality.com/application/files/2515/6516/9757/201907_Adelphi_Grande_Sukhumvit_Hotel_-_Room_401_Living_Area_and_Dining_Area.jpg" alt="Deluxe Room">
						<h2>Family Suite</h2>
						<p class="Price">Price per night: $450</p>
						<label for="Family">Select no of Rooms</label>
						<select class="Selectrooms" name="FamilySuite" id="FamilySuite" data-price="450"  data-max-rooms="<?php echo $data[2]; ?>" data-booked-rooms="0" >
						<?php for ($i = 0; $i <= $data[2]; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
						</select>
					</div>
			
					<div class="room-type">
						<img src="https://www.landmarklondon.co.uk/wp-content/uploads/2018/01/Executive-Family-Room-1-1.jpg" alt="Deluxe Room">
						<h2>Deluxe Room</h2>
						<p class="Price">Price per night: $500</p>
						<label for="deluxe-rooms">Select no of Rooms</label>
						<select class="Selectrooms" name="deluxerooms" id="deluxerooms" data-price="500" data-max-rooms="<?php echo $data[0]; ?>" data-booked-rooms="0" >
						<?php for ($i = 0; $i <= $data[0]; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
						</select>
					</div>
				
		</div>
		</form>
		</div>
	 <script>
		
		var Today=new Date();
		var TodaysDate = Today.getDate();
		// the formate of Date in date function is different from minDate function. in order to set the min date as present date we have to convert into the format of minDAte and set present date as min date.
		// purpose of min date is that the user can only select dates from our mindate (set to present date) to above.
		if (TodaysDate<10)
		{
			TodaysDate = '0'+TodaysDate;  // it is string based comparison e.g 4 and 04 are two different things in string so if a date is less than 10 we have to add 0 before date . Same for month
		}
		var TodaysMonth = Today.getMonth()+1; // Reason behind to add 1 in month is that in js date function months start from 0 but in normal it start from 1 .
		if (TodaysMonth<10)
		{
			TodaysMonth = '0'+TodaysMonth;
		}
		var TodaysYear = Today.getUTCFullYear();
		if (TodaysYear<10)
		{
			TodaysYear = '0'+TodaysYear;
		}
		var minDate=0;

		minDate = TodaysYear + "-" + TodaysMonth + "-"+ TodaysDate ; // format of min date function
		document.getElementById("checkInDate").setAttribute('min' ,minDate ); //setting min date value for check in
		var TommorowDate = Today.getDate()+1;  // check out must be 1 day above from check in date
		if (TommorowDate<10)
		{
			TommorowDate = '0'+TommorowDate;
		}
		var minFDate = TodaysYear + "-" + TodaysMonth + "-"+ TommorowDate ;
		document.getElementById("checkOutDate").setAttribute('min' ,minFDate );   //setting min date value for check out
		const datePicker1 = document.getElementById("checkInDate");
		const datePicker2 = document.getElementById("checkOutDate");
		var Days=0;

		//At this point it is an temporary functiiality , in future it will change
		// the procedure is that user first input the check in date , the first listener will be activate and set the new min value range of check in 
		// then user input check out date the second listener will activate and then user  click on check available rooms button
		// if a user perform this procedure only then he will select no of rooms .
		if (datePicker1!==null)
		{
			datePicker1.addEventListener("input", ()=>{
			if (datePicker1.value)
			{
				
				var futureDate=new Date(datePicker1.value);
				var minfutureDate = futureDate.getDate()+1;
				if (minfutureDate<10)
				{
					minfutureDate = '0'+minfutureDate;
				}
				var minfutureMonth = futureDate.getMonth()+1;
				if (minfutureMonth<10)
				{
					minfutureMonth = '0'+minfutureMonth;
				}
				var minfutureYear = futureDate.getUTCFullYear();
				if (minfutureYear<10)
				{
					minfutureYear = '0'+minfutureYear;
				}
				var minFDate=0;
			    minFDate = minfutureYear + "-" + minfutureMonth + "-"+ minfutureDate ;
				document.getElementById("checkOutDate").setAttribute('min' ,minFDate );
				datePicker2.addEventListener("input" , ()=>
				{
					if (datePicker2.value)
					{
						
						var date1=new Date(datePicker1.value);
				  var date2=new Date(datePicker2.value);	
  					// Convert both dates to milliseconds
 					var date1Ms = date1.getTime();
 				    var date2Ms = date2.getTime();
 					 var diffMs = Math.abs(date1Ms - date2Ms);
 				 	// Convert the difference to days 
 				 	 Days=Math.floor(diffMs / (1000 * 60 * 60 * 24));
          					
					}
				 
				}
				)
			
			}
		} 
			);

		}
	
		// Get all the select and p tag elements
		const selectElements = document.querySelectorAll(".Selectrooms");
	const totalPriceElement = document.querySelector(".bill");
	const setBill = document.getElementById("roomBill");
	// Initialize the total price to zero
	// total for each Select div
	// max total is actual invoice
	//array is use to store the price of each Select Div (that is room type) at given index , sum of array is total bill which store in a variable called maxTotal

  	let total =0;
  	let maxtotal=0;
	let arr=[0,0,0,0,0];
  	// Loop through all the select elements and calculate the total price
	for (let i = 0; i < selectElements.length; i++) 
	{
  		const selectElement = selectElements[i];
		// here we use "change" listener not "click" beacuse we want that if a user change no of rooms then only this function perform otherwise previous value will be used
		selectElement.addEventListener("change",function()
		{
            //var Datediff= document.getElementById("dateDiff");
			//var Days = Datediff.getAttribute("value");
			console.log(Days);
			 total = 0;//every time user change value that is from 3 room to 4 rooms or 4 to 3 , first value will be set to 0 and then re-calculate
			const price = selectElement.getAttribute("data-price");
  			const quantity = selectElement.value;
			  selectElement.setAttribute("data-booked-rooms", quantity); // set the data-booked-rooms attribute to the selected quantity
    console.log(selectElement.getAttribute("data-booked-rooms"));
  			total += price * quantity;
  			arr[i]=total;
  			maxtotal=arr[0]+arr[1]+arr[2]+arr[3]+arr[4];
  			const bill = document.getElementById("bill");
  			bill.innerText = "Lodging Fee: $" + (maxtotal*Days);//setting bill value
            setBill.setAttribute("value" ,(maxtotal*Days) );
			console.log(setBill.getAttribute("value"))
		
   			
  				}) ;
	}
// Set the initial lodging fee
//totalPriceElement.innerText = "Lodging Fee: $" + (maxtotal * Days);

	</script> 
</body>
</html>

