<!DOCTYPE html>
<html>
<head>
	<title>Book a Car</title>
	<meta name="description" content="Book a car rental for your upcoming trip and explore your destination with ease.">
	<meta name="keywords" content="book a car, car rental, rental car, transportation">
	<link rel="stylesheet" href="CarBookingCSS.css">
	
</head>
<body>
<header>
		<h1>Book a Car</h1>
		
	</header>
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

   	$uID =$_SESSION['uID'];
	echo $uID;
}
// session_start();

// if (!isset($_SESSION['user_id'])) {
//     // User is not logged in, redirect to login pag
//     header('Location: login.php');
//     exit;
// }
// else 
// {

//    	$_id =$_SESSION['user_id'];
// 	echo $_id;
// }
// // User is logged in, check if coming from rooms.php
// $fromRooms = isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'rooms.php') !== false;

// if ($fromRooms) {
//     // User is coming from rooms.php, redirect to roomsreservation.php
//     header('Location: CarBooking.php');
//     exit;
// }


	




	$tsql  = "SELECT [Available Cars] as totalcars FROM AvailableCars";
	$stmt = sqlsrv_query($conn, $tsql);

	if ($stmt === false) {
		die(print_r(sqlsrv_errors(), true));
	}

	$data = array();
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$data[] = $row['totalcars'];
	}
	print_r($data);
	sqlsrv_free_stmt($stmt);
	$tsql="SELECT min([Check_In]) as Guest_CheckIN  FROM [Room Booking] where [Booking_ID]=(select [Booking_ID]  from Bookings where Guest_ID=$uID and Status='active' )";
	$stmt = sqlsrv_query($conn, $tsql);
	$row = sqlsrv_fetch_array($stmt);
	$minCheckInDate = $row['Guest_CheckIN']->format('Y-m-d');
	echo 'Minimum check-in date is: ' . $minCheckInDate;
	sqlsrv_free_stmt($stmt);
	$tsql="SELECT max([Check_Out]) as Guest_CheckOUT  FROM [Room Booking] where [Booking_ID]=(select [Booking_ID]  from Bookings where Guest_ID=$uID and Status='active' )";
	$stmt = sqlsrv_query($conn, $tsql);
	$row = sqlsrv_fetch_array($stmt);
	$minCheckOutDate = $row['Guest_CheckOUT']->format('Y-m-d');
	echo 'Minimum check-in date is: ' . $minCheckOutDate;
	sqlsrv_free_stmt($stmt);
	$tsql="SELECT * from  [Travel_guide_info]";	
	$result = sqlsrv_query($conn, $tsql);
	if ($result === false) {
		die(print_r(sqlsrv_errors(), true));
	}
	$rows = array();
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $rows[] = $row;
}
sqlsrv_free_stmt($result);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$PickUpDate = $_POST["PickUpDate"];
		$returnDate = $_POST["returnDate"];
		echo "Check-in date: " . $PickUpDate . "<br>";
		echo "Check-out date: " . $returnDate . "<br>";
		$pickUpLocation = $_POST["pickUpLocation"];
		$returnlocation = $_POST["returnlocation"];
		echo "pickUpLocation: " . $pickUpLocation . "<br>";
		echo "returnlocation " . $returnlocation . "<br>";
		$PickUptime = date('H:i:s', strtotime($_POST['PickUptime']));
		$returntime = date('H:i:s', strtotime($_POST['returntime']));
		echo "CPickUptime " . $PickUptime . "<br>";
		echo "returntimee: " . $returntime . "<br>";
		$LuxurySuv = $_POST['LuxurySuv'];
		echo "LuxurySuv: " . $LuxurySuv . "<br>";
		$LuxurySedan = $_POST['LuxurySedan'];
		echo "LuxurySedan: " . $LuxurySedan . "<br>";
		$HatchBack = $_POST['HatchBack'];
		echo "HatchBack: " . $HatchBack . "<br>";
		$Executive = $_POST['Executive'];
		echo "Executive: " . $Executive . "<br>";
		$carBill = $_POST['carBill'];
		echo "carBill: " . $carBill . "<br>";
		if ($LuxurySuv >0)
		{
			  
			   $tsql  = "select (count(CB_ID)+1) as new_CRB_ID from [Car Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				if ($stmt === false) {
				die(print_r(sqlsrv_errors(), true));
				}
				$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				$CRB=$result['new_CRB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//$Guest_Id = 1;
				echo $CRB . "<br>";
				sqlsrv_free_stmt($stmt);
				$car_id = 1; // set hardcoded value here
				echo $car_id. "<br>";
				$booking_date = date('Y-m-d');
				echo $booking_date. "<br>";
				if(isset($_POST['TG_ID']))
				{
					$tg = $_POST['TG_ID'];
						echo "tg: " . $tg . "<br>";
						$sql = "INSERT INTO [Car Booking] ([CB_ID],[Booking_ID], [Guest_ID], [Car_ID], [TravelGuide], [Start_time], [End_time], [pickup_location], [dropoff_location], [Price], 
						[tg_rating],  [pickup_date], [return_date], Quantity) VALUES
   						($CRB, NULL,$Guest_Id, 1,'$tg', '$PickUptime', '$returntime', '$pickUpLocation', '$returnlocation',NULL , NULL ,'$PickUpDate', '$returnDate' , $LuxurySuv)";   
						$stmts = sqlsrv_query($conn, $sql); 
						if ($stmts === false) {
						die(print_r(sqlsrv_errors(), true));
					}
				}
				if(!isset($_POST['TG_ID']))
				{
					$sql = "INSERT INTO [Car Booking] ([CB_ID],[Booking_ID], [Guest_ID], [Car_ID], [TravelGuide], [Start_time], [End_time], [pickup_location], [dropoff_location], [Price], 
					[tg_rating],  [pickup_date], [return_date], Quantity) VALUES 
					($CRB, NULL,$Guest_Id, 1,NULL, '$PickUptime', '$returntime', '$pickUpLocation', '$returnlocation',NULL , NULL ,'$PickUpDate', '$returnDate' , $LuxurySuv)";   
					$stmts = sqlsrv_query($conn, $sql); 
					if ($stmts === false) {
					die(print_r(sqlsrv_errors(), true));
						}
				}	 
				   
		}
		if ($LuxurySedan >0)
		{
			  
			   $tsql  = "select (count(CB_ID)+1) as new_CRB_ID from [Car Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				if ($stmt === false) {
				die(print_r(sqlsrv_errors(), true));
				}
				$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				$CRB=$result['new_CRB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//$Guest_Id = 1;
				echo $CRB . "<br>";
				sqlsrv_free_stmt($stmt);
				$car_id = 2; // set hardcoded value here
				echo $car_id. "<br>";
				$booking_date = date('Y-m-d');
				echo $booking_date. "<br>";
				if(isset($_POST['TG_ID']))
				{
					$tg = $_POST['TG_ID'];
						echo "tg: " . $tg . "<br>";
						$sql = "INSERT INTO [Car Booking] ([CB_ID],[Booking_ID], [Guest_ID], [Car_ID], [TravelGuide], [Start_time], [End_time], [pickup_location], [dropoff_location], [Price], 
						[tg_rating],  [pickup_date], [return_date], Quantity) VALUES ($CRB, NULL,$Guest_Id, 2,'$tg', '$PickUptime', '$returntime', '$pickUpLocation', '$returnlocation',NULL , NULL ,'$PickUpDate', '$returnDate' , $LuxurySedan)";   
						$stmts = sqlsrv_query($conn, $sql); 
						if ($stmts === false) {
						die(print_r(sqlsrv_errors(), true));
					}
				}
				if(!isset($_POST['TG_ID']))
				{
					$sql = "INSERT INTO [Car Booking] ([CB_ID],[Booking_ID], [Guest_ID], [Car_ID], [TravelGuide], [Start_time], [End_time], [pickup_location], [dropoff_location], [Price], 
					[tg_rating],  [pickup_date], [return_date], Quantity) VALUES ($CRB, NULL,$Guest_Id, 2,NULL, '$PickUptime', '$returntime', '$pickUpLocation', '$returnlocation',NULL , NULL ,'$PickUpDate', '$returnDate' , $LuxurySedan)";   
						$stmts = sqlsrv_query($conn, $sql); 
						if ($stmts === false) {
						die(print_r(sqlsrv_errors(), true));
						}
				}	 
				   
		}
		if ($HatchBack >0)
		{
			  
			   $tsql  = "select (count(CB_ID)+1) as new_CRB_ID from [Car Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				if ($stmt === false) {
				die(print_r(sqlsrv_errors(), true));
				}
				$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				$CRB=$result['new_CRB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//$Guest_Id = 1;
				echo $CRB . "<br>";
				sqlsrv_free_stmt($stmt);
				$car_id = 3; // set hardcoded value here
				echo $car_id. "<br>";
				$booking_date = date('Y-m-d');
				echo $booking_date. "<br>";
				if(isset($_POST['TG_ID']))
				{
					$tg = $_POST['TG_ID'];
						echo "tg: " . $tg . "<br>";
						$sql = "INSERT INTO [Car Booking] ([CB_ID],[Booking_ID], [Guest_ID], [Car_ID], [TravelGuide], [Start_time], [End_time], [pickup_location], [dropoff_location], [Price], 
						[tg_rating],  [pickup_date], [return_date], Quantity) VALUES ($CRB, NULL,$Guest_Id, 3,'$tg', '$PickUptime', '$returntime', '$pickUpLocation', '$returnlocation',NULL , NULL ,'$PickUpDate', '$returnDate', $HatchBack)";   
						$stmts = sqlsrv_query($conn, $sql); 
						if ($stmts === false) {
						die(print_r(sqlsrv_errors(), true));
					}
				}
				if(!isset($_POST['TG_ID']))
				{
					$sql = "INSERT INTO [Car Booking] ([CB_ID],[Booking_ID], [Guest_ID], [Car_ID], [TravelGuide], [Start_time], [End_time], [pickup_location], [dropoff_location], [Price], 
					[tg_rating],  [pickup_date], [return_date], Quantity) VALUES ($CRB, NULL,$Guest_Id, 3,NULL, '$PickUptime', '$returntime', '$pickUpLocation', '$returnlocation',NULL , NULL ,'$PickUpDate', '$returnDate', $HatchBack)";   
						$stmts = sqlsrv_query($conn, $sql); 
						if ($stmts === false) {
						die(print_r(sqlsrv_errors(), true));
						}
				}	 
				   
		}
		
		if ($Executive >0)
		{
			  
			   $tsql  = "select (count(CB_ID)+1) as new_CRB_ID from [Car Booking]";
				$stmt = sqlsrv_query($conn, $tsql);

				if ($stmt === false) {
				die(print_r(sqlsrv_errors(), true));
				}
				$result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
				$CRB=$result['new_CRB_ID'];
				$Guest_Id = $_SESSION['uID'];
				//$Guest_Id = 1;
				echo $CRB . "<br>";
				sqlsrv_free_stmt($stmt);
				$car_id = 4; // set hardcoded value here
				echo $car_id. "<br>";
				$booking_date = date('Y-m-d');
				echo $booking_date. "<br>";
				if(isset($_POST['TG_ID']))
				{
					$tg = $_POST['TG_ID'];
						echo "tg: " . $tg . "<br>";
						$sql = "INSERT INTO [Car Booking] ([CB_ID],[Booking_ID], [Guest_ID], [Car_ID], [TravelGuide], [Start_time], [End_time], [pickup_location], [dropoff_location], [Price], 
						[tg_rating],  [pickup_date], [return_date], Quantity) VALUES ($CRB, NULL,$Guest_Id, 4,'$tg', '$PickUptime', '$returntime', '$pickUpLocation', '$returnlocation',NULL , NULL ,'$PickUpDate', '$returnDate', $Executive)";   
						$stmts = sqlsrv_query($conn, $sql); 
						if ($stmts === false) {
						die(print_r(sqlsrv_errors(), true));
					}
				}
				if(!isset($_POST['TG_ID']))
				{
					$sql = "INSERT INTO [Car Booking] ([CB_ID],[Booking_ID], [Guest_ID], [Car_ID], [TravelGuide], [Start_time], [End_time], [pickup_location], [dropoff_location], [Price], 
					[tg_rating],  [pickup_date], [return_date], Quantity) VALUES ($CRB, NULL,$Guest_Id, 4,NULL, '$PickUptime', '$returntime', '$pickUpLocation', '$returnlocation',NULL , NULL ,'$PickUpDate', '$returnDate', $Executive)";   
						$stmts = sqlsrv_query($conn, $sql); 
						if ($stmts === false) {
						die(print_r(sqlsrv_errors(), true));
						}
				}	 
				   
		}
		
		
	  }
  
  

//sqlsrv_close($conn);



?>
	

			<div class="TotalBill">
				<div>
					<h2 id="bill">
						Car Services Free: $0
					</h2>
				</div>
			</div>
			
				<form action="CarBooking.php" method="post"> 
				<div style="text-align: center;" >
					<label for="location">Pick-up Location:&nbsp;</label>
					<select id="pickUpLocation" name="pickUpLocation" required>
						<option value="">Select a Location</option>
						<option value="Main Lobby">Main Lobby</option>
						<option value="Pool Area Entrance">Pool Area Entrance</option>
						<option value="Spa Entrance">Spa Entrance</option>
						<option value="Tennis Courts Entrance">Tennis Courts Entrance</option>
						<option value="Golf Course Entrance">Golf Course Entrance</option>
					</select>  &nbsp; &nbsp; &nbsp;
					<label for="date">Pick-up Date:&nbsp;</label>
					<input type="date" id="PickUpDate" name="PickUpDate" min="<?php echo $minCheckInDate; ?>" max="<?php echo $minCheckOutDate; ?>" required>&nbsp; &nbsp; &nbsp; &nbsp;
					<label for="time">Pick-up Time:&nbsp;</label>
					<input type="time" id="PickUptime" name="PickUptime" min="" required>&nbsp; &nbsp; &nbsp; &nbsp;<br><br>
					<label for="return-location">Return Location: &nbsp;</label>
					<select id="returnlocation" name="returnlocation" required>
						<option value="">Select a Location</option>
						<option value="Main Lobby">Main Lobby</option>
						<option value="Pool Area Entrance">Pool Area Entrance</option>
						<option value="Spa Entrance">Spa Entrance</option>
						<option value="Tennis Courts Entrance">Tennis Courts Entrance</option>
						<option value="Golf Course Entrance">Golf Course Entrance</option>
					</select> &nbsp; &nbsp; &nbsp;
					<label for="return-date">Return Date:&nbsp;</label>
					<input type="date" id="returnDate" name="returnDate" min="<?php echo $minCheckInDate; ?>" max="<?php echo $minCheckOutDate; ?>"required>  &nbsp; &nbsp; &nbsp; &nbsp;
					<label for="return-time">Return Time:&nbsp;</label>
					<input type="time" id="returntime" name="returntime" min="" required>  &nbsp; &nbsp; &nbsp; &nbsp;<br><br>
					<label for="cartype" style="font-size: 40px; font-weight: bold;">Choose Your Cars: </label>

					<div class="container">
			
					
							<input type="hidden" name="carBill" id="carBill" value="0">
							
						
							<div class="Car-type">
								<img src="https://assets.newatlas.com/dims4/default/a3144e5/2147483647/strip/true/crop/1440x810+0+135/resize/1200x675!/quality/90/?url=http%3A%2F%2Fnewatlas-brightspot.s3.amazonaws.com%2Farchive%2Frolls-royce-cullinan-pictures-23.jpg" alt="Standard Room">
									<h2>Luxury SUV</h2>
								<p class="Price">Price per Day: $180</p>
								<label for="Luxury-Suv">Select no of cars</label>
								<select class="Selectcars" name="LuxurySuv"id="LuxurySuv" data-price="180"  data-max-cars="<?php echo $data[0];  ?>" data-booked-cars="0" > <!--disabled is an attribute to disable the functionaliity 
								w	henever we want. at first our user can't select no of rooms but when he goes through the prcedure of check in the selection of room enabled and user can seelct the rooms -->
								<?php for ($i = 0; $i <= $data[0]; $i++) { ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="Car-type">
								<img src="https://img-ik.cars.co.za/specimages/tr:n-spec_large/mercmaybs2sl1_1.jpg" alt="Standard Room">
									<h2>Luxury Sedan</h2>
								<p class="Price">Price per Day: $150</p>
								<label for="Luxury-Sedan">Select no of cars</label>
								<select class="Selectcars" name="LuxurySedan"id="LuxurySedan" data-price="150"  data-max-cars="<?php  $data[1]; ?>" data-booked-cars="0" > <!--disabled is an attribute to disable the functionaliity 
								w	henever we want. at first our user can't select no of rooms but when he goes through the prcedure of check in the selection of room enabled and user can seelct the rooms -->
								<?php for ($i = 0; $i <= $data[1]; $i++) { ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="Car-type">
								<img src="data:image/jpeg;base64,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" alt="Standard Room">
									<h2>Hatchback</h2>
								<p class="Price">Price per Day: $80</p>
								<label for="Hatch Back">Select no of cars</label>
								<select class="Selectcars" name="HatchBack"id="HatchBack" data-price="80"  data-max-cars="<?php  $data[2]; ?>" data-booked-cars="0" > <!--disabled is an attribute to disable the functionaliity 
								w	henever we want. at first our user can't select no of rooms but when he goes through the prcedure of check in the selection of room enabled and user can seelct the rooms -->
								<?php for ($i = 0; $i <= $data[2]; $i++) { ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="Car-type">
								<img src="https://imgd.aeplcdn.com/1280x720/n/cw/ec/51317/kia-carnival-right-front-three-quarter6.jpeg?wm=0" alt="Standard Room">
									<h2>Executive</h2>
								<p class="Price">Price per Day: $120</p>
								<label for="Executive">Select no of cars</label>
								<select class="Selectcars" name="Executive"id="Executive" data-price="120"  data-max-cars="<?php $data[3];  ?>" data-booked-cars="0" > <!--disabled is an attribute to disable the functionaliity 
								w	henever we want. at first our user can't select no of rooms but when he goes through the prcedure of check in the selection of room enabled and user can seelct the rooms -->
								<?php for ($i = 0; $i <= $data[3]; $i++) { ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
								</select>
							</div>

						</div>
						
					<label for="TravelGuide">Would you like to add a travel guide?&nbsp;</label><br><br>

							<label for="yes">Yes</label>
							<input type="radio" id="yes" name="answer" value="yes">

							<label for="no">No</label>
							<input type="radio" id="no" name="answer" value="no">
							
					<br><br>
				<div id = "TravelGuides" style="opacity: 0">
						<h2>Available Tour Guides</h2>
						<table>
							<tr>
								<th>ID</th>
								<th>FIRST NAME</th>
								<th>LAST NAME</th>
								<th>GENDER</th>
								<th>EXPERIENCE (Years)</th>
								<th>RATING</th>
							</tr>
							<?php foreach ($rows as $row): ?>
							<tr>
								<td><?= $row['Emp_ID'] ?></td>
								<td><?= $row['First Name'] ?></td>
								<td><?= $row['Last Name'] ?></td>
								<td><?= $row['Gender'] ?></td>
								<td><?= $row['Experience'] ?></td>
								<td><?= $row['Rating'] ?></td>
							</tr>
							<?php endforeach; ?>
						</table>
						<br><br>
					<label for="travelGuideSelection">Enter the travel guide ID of your choice:&nbsp;</label>
					<select id="TG_ID" name="TG_ID" value="" required>
					<option value="0">Select the travel guide ID</option>
						<?php foreach ($rows as $row): ?>
							<option value="<?= $row['Emp_ID'] ?>"><?= $row['Emp_ID'] ?></option>
						<?php endforeach; ?>
						</select> <br><br>
					
					<p>**Please inform of your desired return location when booking your car service. If you need to change the return location, please let us know at least 30 minutes before the scheduled pickup time.</p>
					
				</div>
				<div class="BookBtn">
					<button  id="checkbtn" type="submit" value="Book Now" name="submit"> 
						<span>
							book now
						</span>
					 </button>
					 </div>
								
		</div>	
		</form>
	
</body>
<footer>
	<p>&copy; 2023 Luxury Lodgings. All rights reserved.</p>
</footer>
<script>
		
		
		const datePicker1 = document.getElementById("PickUpDate");
		const datePicker2 = document.getElementById("returnDate");
		var Days=0;
		if (datePicker1!==null)
		{
			datePicker1.addEventListener("input", ()=>{
			if (datePicker1.value)
			{
				
				var futureDate=new Date(datePicker1.value);
				var minfutureDate = futureDate.getDate();
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
				document.getElementById("returnDate").setAttribute('min' ,minFDate );
// 				var TodayDateTime= futureDate.getDate();
//				var Today=new Date();
//				var TodaysDate = Today.getDate();
// 				if (TodayDateTime==TodaysDate)
// 				{
// 				   const now = new Date();

// 					// Set the minimum time to the current time
// 					const minTime = now.setHours(now.getHours(), now.getMinutes());
// 					const minTimeString = new Date(minTime).toISOString().slice(0, -8);
// 					// Set the min attribute on the input element
// 					const input = document.getElementById("PickUptime");
// 					input.setAttribute("min", minTimeString);
// 					input.setAttribute("required", true);
// 					const minTimeString = input.getAttribute("min");

// // Log the minimum time to the console
// 					console.log("Minimum time:", minTimeString);

// 					const minTime = now.setHours(now.getHours() +1, now.getMinutes());
// 					const minTimeString = new Date(minTime).toISOString().slice(0, -8);
// 					// Set the min attribute on the input element
// 					const input = document.getElementById("returntime");
// 					input.setAttribute("min", minTimeString);
// 					console.log(input.getAttribute("min"))


// 				}
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
					 Days+=1;
          					
					}
				 
				}
				)
			
			}
		} 
			);

		}
	
		// Get all the select and p tag elements
		const selectElements = document.querySelectorAll(".Selectcars");
	const totalPriceElement = document.querySelector(".bill");
	const setBill = document.getElementById("carBill");


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
			selectElement.setAttribute("data-booked-cars", quantity); // set the data-booked-rooms attribute to the selected quantity
   	 		console.log(selectElement.getAttribute("data-booked-cars"));
  			total += price * quantity;
  			arr[i]=total;
  			maxtotal=arr[0]+arr[1]+arr[2]+arr[3];
  			const bill = document.getElementById("bill");
  			bill.innerText = "Car Services Fee: $" + (maxtotal*Days);//setting bill value
            setBill.setAttribute("value" ,(maxtotal*Days) );
			console.log(setBill.getAttribute("value"))
		
   			
  				}) ;
	}
	const radios = document.querySelectorAll('input[name="answer"]');
  let selectedValue;
  
  radios.forEach(radio => {
    	radio.addEventListener('change', event => {
      		selectedValue = event.target.value;
			console.log("Selected value: ",selectedValue);
			const yesRadio = document.getElementById("yes");
					if (yesRadio.checked) {
						console.log("User selected Yes");
						const travel = document.getElementById("TravelGuides");
						travel.style.opacity = 1;
						selectElement=document.getElementById("TG_ID");
						selectElement.addEventListener("change",function()
						{
							selectedValue = selectElement.value;
							selectElement.setAttribute("value", selectedValue);
							console.log(selectElement.getAttribute("value"));
						}
						);
		
					} else {
						const travel = document.getElementById("TravelGuides");
						travel.style.opacity = 0;
					}

    	});
  });
  
 

	</script> 

</html>
