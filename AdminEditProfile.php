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
    <script type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Edit Profile</title>
</head>

<?php include('connection.php');
        session_start();
 ?>
  
<?php 
    $uname = $_SESSION['uname']; // get the value from the session
    echo "Welcome, $uname!";

    $sql = "Select * from [Employees] where Username = '$uname'";
    $result = sqlsrv_query($conn, $sql);

    $FName="";
    $LName="";
    $cnic="";
    $No="";
    $mail="";
    $DOB=NULL;
    $Pass=""; 
    $address="";
    $job="";

    while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
    {
        $Pass = $obj['Password'];
        $FName = $obj['First Name'];
        $LName = $obj['Last Name'];
        $cnic = $obj['CNIC'];
        $DOB = $obj['DOB'];
        $mail = $obj['Email ID'];
        $No = $obj['Phone Number'];
        $job = $obj['Position'];
        $address = $obj['Address'];
    }

    
?>

<body>

    <div class="container">
        <div class="row">
                <div class="col-12">
                    <!-- Page title -->
                    <div class="my-5">
                        <h3>My Profile</h3>
                        <hr>
                    </div>
                    <!-- Form START -->
                    <form class="file-upload" form action="AdminEditProfile.php" method ="Post">
                        <div class="row mb-5 gx-5">
                            <!-- Contact detail -->
                            <div class="col-xxl-8 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Contact detail</h4>
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <label class="form-label">First Name *</label>
                                            <input type="text" class="form-control" placeholder="" name="FN" aria-label="First name" value="<?php echo $FName?>">
                                        </div>
                                        <!-- Last name -->
                                        <div class="col-md-6">
                                            <label class="form-label">Last Name *</label>
                                            <input type="text" class="form-control" placeholder="" name="LN" aria-label="Last name" value="<?php echo $LName?>">
                                        </div>
                                        <!-- Phone number -->
                                        <div class="col-md-6">
                                            <label class="form-label">CNIC *</label>
                                            <input type="text" class="form-control" placeholder="" name="CNIC" aria-label="cnic" value="<?php echo $cnic?>">
                                        </div>
                                        <!-- Mobile number -->
                                        <div class="col-md-6">
                                            <label class="form-label">Mobile number *</label>
                                            <input type="text" class="form-control" placeholder="" name="Mobile" aria-label="Phone number" value="<?php echo $No?>">
                                        </div>
                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Email *</label>
                                            <input type="email" class="form-control" id="inputEmail4"  name="mail" value="<?php echo $mail?>">
                                        </div>
                                        <!-- Skype -->
                                        <div class="col-md-6">
                                            <label class="form-label">Date of Birth *</label>
                                            <input type="text" class="form-control" placeholder="" name="DOB" aria-label="dob" value="1970-11-23">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Job Position *</label>
                                            <input type="text" class="form-control" placeholder="" name="position" aria-label="pos" value="<?php echo $job?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Address *</label>
                                            <input type="text" class="form-control" placeholder="" name="addr" aria-label="addr" value="<?php echo $address?>">
                                        </div>
                                    </div> <!-- Row END -->
                                </div>
                            </div>
                             <!-- Upload profile -->
                            <div class="col-xxl-4">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Upload your profile photo</h4>
                                        <div class="text-center">
                                            <!-- Image upload -->
                                            <div class="square position-relative display-2 mb-3">
                                                <i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
                                            </div>
                                            <!-- Button -->
                                            <input type="file" id="customFile" name="file" hidden="">
                                            <label class="btn btn-success-soft btn-block" for="customFile">Upload</label>
                                            <button type="button" class="btn btn-danger-soft">Remove</button>
                                            <!-- Content -->
                                            <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Row END -->
        

        
                            <!-- change password -->
                            <div class="col-xxl-6">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="my-4">Change Password</h4>
                                        <!-- Old password -->
                                        <div class="col-md-6">
                                            <label for="exampleInputPassword1" class="form-label">Old password *</label>
                                            <input type="password" class="form-control"  name="oldpswd" id="exampleInputPassword1">
                                        </div>
                                        <!-- New password -->
                                        <div class="col-md-6">
                                            <label for="exampleInputPassword2" class="form-label">New password *</label>
                                            <input type="password" class="form-control"  name="newpswd" id="exampleInputPassword2">
                                        </div>
                                        <!-- Confirm password -->
                                        <div class="col-md-12">
                                            <label for="exampleInputPassword3" class="form-label">Confirm Password *</label>
                                            <input type="password" class="form-control" name="confirmpswd" id="exampleInputPassword3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Row END -->
                        <!-- button -->
                        <div class="gap-3 d-md-flex justify-content-md-end text-center">
                            <!--<button type="button" class="btn btn-danger btn-lg">Delete profile</button>-->
                            <button type="submit" class="btn btn-primary btn-lg">Update profile</button>
                        </div>
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $FName=$_POST['FN'];;
        $LName=$_POST['LN'];
        $cnic=$_POST['CNIC'];;
        $No=$_POST['Mobile'];;
        $mail=$_POST['mail'];;
        $DOB=$_POST['DOB'];;
        $address=$_POST['addr'];;
        $job=$_POST['position'];;
        $OPass=$_POST['oldpswd'];
        $NPass=$_POST['newpswd'];
        $CPass=$_POST['confirmpswd'];
 

        $sql = "Update [Employees] set [First Name] = '$FName', [Last Name] = '$LName', [CNIC] = '$cnic', [DOB] = '$DOB', [Email ID] = '$mail', [Phone Number] = '$No',
        Address = '$address', Position = '$job' where Username = '$uname' ";
        $result = sqlsrv_query($conn, $sql);

        if($NPass)
        {
            if($OPass == $Pass && $NPass == $CPass)
            {
                $sql2 = "Update [Employees] set [Password] = '$NPass' where Username = '$uname' ";
                $result2 = sqlsrv_query($conn, $sql2);
            }
            else
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Wrong Password or Comination.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
               </div>';
                  die('.');
            }
            
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