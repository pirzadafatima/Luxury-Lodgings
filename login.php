<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_style.css">
    <title> Login Form  </title>
</head>
<?php
  include('connection.php');
  session_start();
//   session_start();


//   if ($_SERVER["REQUEST_METHOD"] == "POST"){
//   $username = $_POST['username'];
//     $password = $_POST['password'];

   
//     $user_id = 1; // replace with your actual code to retrieve the user_id

//     // Set the user_id in the session
//     $_SESSION['user_id'] = $user_id;

//     // Check if the redirect parameter is set
//     if (isset($_GET['redirect'])) {
//         // If the redirect parameter is set, redirect to the specified page
//         header("Location: /" . $_GET['redirect']);
//     } else {
//         // If the redirect parameter is not set, redirect to the room reservation page
//         header("Location: /booking.php");
//     }
//     exit;
// }
// if (isset($_SESSION['user_id'])) {
//     // If the user is already logged in, redirect to the room reservation page
//     header("Location: /booking.php");
//     exit;
//   }
  
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    if(isset($_POST['in']))
    {
        $U = $_POST['usertextname'];
        $P = $_POST['userpassword'];

        $sql2 = "SELECT * FROM [Employees] WHERE username = '$U' AND password = '$P' AND Position = 'Manager'";
        $result2 = sqlsrv_query($conn, $sql2);
        while($obj = sqlsrv_fetch_array($result2,SQLSRV_FETCH_ASSOC))
        {
            $y = $obj['Username'];
            $z = $obj['Password'];
        }

        if($y == $U && $z == $P)
        {
            $session = true;
            $uname = $U;
            $_SESSION['uname'] = $uname;
            $_SESSION['session'] = $session;

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your entry has been submitted successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            </div>';

            echo '<script> window.location.href = "http://localhost/adminProfile.php"; </script>';
            exit();
        }




        $y = "";
        $z = "";
        $sql = "Select * from [Guests] where Username = '$U' and Password = '$P'";
        $result = sqlsrv_query($conn, $sql);
        while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
        {
            $y = $obj['Username'];
            $z = $obj['Password'];
        }

        if($y == $U && $z == $P)
        {
            $uname = $U;

            $sqll = "Select * from [Guests] where Username = '$uname'";
            $resultt = sqlsrv_query($conn, $sqll);
            while($obj = sqlsrv_fetch_array($resultt,SQLSRV_FETCH_ASSOC))
            {
                $uID =  $obj['Guest_ID'];
                echo $obj['Username'].'</br>' .$uname;
                echo $uID;
            }

            $session = true;
            $_SESSION['uname'] = $uname;
            $_SESSION['session'] = $session;
            $_SESSION['uID'] = $uID;
            
            
        }
        else
        {
            echo 'Wrong Username or Password';
        }


        if($result && $session){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your entry has been submitted successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            </div>';

            echo '<script> window.location.href = "http://localhost/Profile.php"; </script>';
            exit();
          }
          else{
              echo "The record was not inserted successfully because of this error ---> ";
              die( print_r( sqlsrv_errors(), true));
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
              </div>';
              //echo '<script> window.location.href = "http://localhost/Profile.php"; </script>';
              //exit();
          }
    }
    if(isset($_POST['reg']))
    {
        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $Uname = $_POST['Uname'];
        $pswd = $_POST['pswd'];
        $phone = $_POST['phone'];
        $cnic = $_POST['cnic'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];

        $sql = "Select * from [Guests] where Username = '$Uname'";
        $result = sqlsrv_query($conn, $sql);
        while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
        {
            $x = $obj['Username'];
        }
        if($x == NULL)
        {
            $sql = "INSERT INTO [Guests] VALUES ('$Uname','$pswd', '$Fname','$Lname', '$cnic', '$gender', NULL,  '$email', '$phone')";
            $result = sqlsrv_query($conn, $sql);

            $sql = "Select * from [Guests] where Username = '$Uname'";
            $result = sqlsrv_query($conn, $sql);
            while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
            {
                $uID = $obj['Guest_ID'];
            }

            $uname = $Uname;
            $session = true;
            $_SESSION['uname'] = $uname;
            $_SESSION['uID'] = $uID;
            $_SESSION['session'] = $session;

        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Username Already Registered.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
           </div>';
              die('.');
        }

 
        if($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          </div>';
          echo '<script> window.location.href = "http://localhost/Profile.php"; </script>';
          exit();
        }
        else{
            echo "The record was not inserted successfully because of this error ---> ";
            die( print_r( sqlsrv_errors(), true));
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            </div>';
            echo '<script> window.location.href = "http://localhost/login.php"; </script>';
            exit();
        }
    }

}
  ?>
<body>
    <div class="container"  >
        <div class="login-Sign-up-box login" id="loginSignup">
            <div class="inner-box" id="Signin">
                <button class="toggle-button" id="SignUpbtn">
                    <i class="fa fa-angle-left"></i>
                    <span>SIGN UP</span>  
                </button>
                <form method="post">
               <div style="width:100%">
                    <p>SIGN IN</p>
                    <div class="input-box">
                        <input type="text" placeholder="Enter a username" id="usertext" name="usertextname" required>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Enter a password" id="userpassword" name="userpassword" required>
                    </div>
                    <div class="Sign-in-button" id="toggle-button">
                       <button id="signinId" name="in">SIGN IN</button>
                    </div>
               </div>
               </form>
            </div>
            <div class="inner-box" id="SignUp" style="transform: scale(0);"><!--we want to show first the Sign in form to user, so Sign up form will be hidden by setting scale value to 0 -->
                <button class="toggle-button" id="SignInbtn">
                    <i class="fa fa-angle-right"></i>
                    <span>SIGN IN</span>  
                </button>
               <div style="width:100%">
               <form  method ="Post">
                    <p>SIGN UP</p>
                    <div class="input-box">
                        <input type="text" name="Fname" placeholder="Enter Your First Name">
                    </div>
                    <div class="input-box">
                        <input type="text" name="Lname" placeholder="Enter Your Last Name">
                    </div>
                    <div class="input-box">
                        <input type="text" name="Uname" placeholder="Enter a username">
                    </div>
                    <div class="input-box">
                        <input type="password" name="pswd" placeholder="Create a password">
                    </div>
					<div class="input-box">
                        <input type="number" name="phone" placeholder="Enter Your phone No">
                    </div>
                    <div class="input-box">
                        <input type="number" name="cnic" placeholder="Enter Your CNIC">
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Enter Your Email">
                    </div>
					<div class="input-box">
						<label for="male">Male</label>
					<input type="radio" name="gender" id="male" value="M">
					<label for="female">Female</label>
						<input type="radio" name="gender" id="female" value="F">		
					</div>              
                    <div class="Sign-in-button" id="SignUpButton">
                         <button type="submit" class="btn submit" name="reg" >SIGN UP</button>
                    </div>
                    </form>
               </div>
            </div>
        </div>
    </div>
    <script >
      const loginBtn = document.getElementById('signinId');
    // loginBtn.addEventListener('click', function(event) {
    //     event.preventDefault();
    //     const usernameInput = document.getElementById('usertext');
    //     const passwordInput = document.getElementById('userpassword');

    //     if (usernameInput.value.trim() === '' || passwordInput.value.trim() === '') {
    //         alert('Please enter both a username and password.');
    //     } else {
           
    //         //window.location.href ='booking.html';
    //     }
    // });
        // retrieving the specific tag by id 
        var loginSignup = document.getElementById('loginSignup');
         var signupbtn=document.getElementById('SignUpbtn');
         var signinbtn=document.getElementById('SignInbtn');

         var signup=document.getElementById('SignUp');
         var signin=document.getElementById('Signin');

         signupbtn.addEventListener('click',function(){
            loginSignup.classList.add('register');//Register is an user defined class we add at run time (e.g when click) we add css value so that Register perform its action
            //the css of register will be to shift from right to left in a container , but when it will disable it will again move left to right so that out both login/sign up form structue and css remains same.
            signin.style.transform='scale(0)';// hiding sign in form when shift to sign up
            setTimeout(function(){
                signup.style.transform='scale(1)';
            } , 600)
         })
         signinbtn.addEventListener('click',function(){
            loginSignup.classList.remove('register');
            signup.style.transform='scale(0)';
            setTimeout(function(){
                signin.style.transform='scale(1)';
            } , 600)
         })


    </script>
</body>
</html>