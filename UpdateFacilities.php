<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="EditProfile.css">
    <title>Update Facilities</title>
</head>

<?php include('connection.php');
        session_start();
 ?>

<body>
    <div class="container">
        <div class="row">
                <div class="col-12">
                    <!-- Page title -->
                    <div class="my-5">
                        <h3>Update a Facility</h3>
                        <hr>
                    </div>
                    <!-- Form START -->
                    <form class="file-upload" form action="UpdateFacilities.php" method ="Post">
                    <input type="hidden" name="action" value="addRoom">
                        <div class="row mb-5 gx-5">

                            <div class="col-xxl-8 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Update a Room</h4>
                                     
                                        <div class="col-md-6">
                                            <label class="form-label">Room ID </label>
                                            <input type="text" class="form-control" placeholder="" name = "ID" aria-label="RoomId" value="x02-xxxx">
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <label class="form-label">Price per Night </label>
                                            <input type="number" class="form-control" id="price" name="price" min="" max="" value="450">
                                        </div>
                                      
                                        <div class="col-md-6">
                                            <label class="form-label">Number of People </label>
                                            <input type="number" class="form-control" id="numOfppl" name="numOfppl" min="" max="" value="2">
                                        </div>
                                   
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Number of rooms </label>
                                            <input type="number" class="form-control" id="numRooms" name ="numRooms" min="" max="" value="10">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> <!-- Row END -->
                        <button type="submit" class="btn btn-primary">Update Room</button>
                        <!-- <input type = "submit" name = "add room" value = "Add Room">  -->
                    </form>
                        
                    <br><br><br>
                    <form class="file-upload" form action="UpdateFacilities.php" method ="Post">
                    <input type="hidden" name="action" value="addCar">
                        <div class="row mb-5 gx-5">

                            <div class="col-xxl-8 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Update a Car</h4>
                                     
                                        <div class="col-md-6">
                                            <label class="form-label">Car ID *</label>
                                            <input type="number" class="form-control" id="carID" name="carID" min="" max="" value="6">
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <label class="form-label">Price </label>
                                            <input type="number" class="form-control" id="prices" name="price" min="" max="" value="150">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Number of Cars *</label>
                                            <input type="number" class="form-control" id="numCars" name="numCars" min="" max="" value="10">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> <!-- Row END -->
        
                        </div> <!-- Row END -->
                        <button type="submit" class="btn btn-primary">Update Car</button>
                        <!-- <input type = "submit" name = "add car" value = "Add Car">  -->
                    </form> <!-- Form END -->
                </div>
            </div>
            </div>


        </br>
    </br>
</br>
</br>
</br>
</br>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if ($_POST['action'] == 'addRoom') 
    {
        $roomID = $_POST['ID'];
        $numPeople = $_POST['numOfppl'];
        $priceP = $_POST['price'];
        $totalNumRooms = $_POST['numRooms'];

        $sql = "UPDATE [Rooms] 
        SET [Price] = '$priceP', [NoOfPeople] = '$numPeople', [NoOfRooms] = '$totalNumRooms' WHERE [Room_ID] = '$roomID'";
        $result = sqlsrv_query($conn, $sql);

    }

    if ($_POST['action'] == 'addCar') 
    {
        $carID = $_POST['carID'];
        $pprice = $_POST['price'];
        $totalcars = $_POST['numCars'];

        $sql = "UPDATE [Cars] 
        SET [Price] = '$pprice', [NoOfCars] = '$totalcars' WHERE [Car_ID] = '$carID'";
        $result = sqlsrv_query($conn, $sql);

    }

    if($result){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your changes have been saved successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
       </div>';
      }
      else{
           echo "The record was not inserted successfully because of this error ---> ";
           die( print_r( sqlsrv_errors(), true));//print_r(die(sqlsrv_errors($conn)));
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
       </div>';
      }

}

?>
  
</body>
</html>