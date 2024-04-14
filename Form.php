<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="FormStyle.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Reviews</title>
</head>
<body>


    <?php include('connection.php');
          session_start();
    ?>
  
  <?php 
        $sql = "Select * from [Reviews] ORDER BY [Review_ID] DESC";
        $result = sqlsrv_query($conn, $sql);
        $review = array("","","");
        $names = array("","","");
        $i = 0;
        while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
       {
          $names[$i] = $obj['Username'];
          $review[$i] = $obj['Review'];
          $i++;
       }

        
    ?>


    <div class="maindiv">
        <div id="heading"> <h1>Customer's</h1></div> <div id="R_heading"> <h1> Review</h1></div>
    </div>
    
    <section class="main">
        <div class="full-boxer">
            <div class="comment-box">
                <div class="box-top">
                    <div class="Profile">
                        <div class="profile-image">
                            <img src="https://zeru.com/blog/wp-content/uploads/How-Do-You-Have-No-Profile-Picture-on-Facebook_25900">
                        </div>
                        <div class="Name">
                            <strong> <?php echo $names[0].'</br>'?> </strong>
                            <span>@<?php echo $names[0].'</br>'?> </span>
                        </div>
                        <div class="C_rating">
                            <input type="number" name="rating" hidden>
                            <i class='bx bxs-star star' style="--i: 0;"></i>
                            <i class='bx bxs-star star' style="--i: 1;"></i>
                            <i class='bx bxs-star star' style="--i: 2;"></i>
                            <i class='bx bxs-star star' style="--i: 3;"></i>
                            <i class='bx bxs-star star' style="--i: 4;"></i>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <p>
                    <?php echo $review[0].'</br>'?>
                    </p>
                </div>
            </div>

            <div class="comment-box">
                <div class="box-top">
                    <div class="Profile">
                        <div class="profile-image">
                            <img src="https://zeru.com/blog/wp-content/uploads/How-Do-You-Have-No-Profile-Picture-on-Facebook_25900">
                        </div>
                        <div class="Name">
                            <strong><?php echo $names[1].'</br>'?></strong>
                            <span>@<?php echo $names[1].'</br>'?></span>
                        </div>
                        <div class="C_rating">
                            <input type="number" name="rating" hidden>
                            <i class='bx bxs-star star' style="--i: 0;"></i>
                            <i class='bx bxs-star star' style="--i: 1;"></i>
                            <i class='bx bxs-star star' style="--i: 2;"></i>
                            <i class='bx bxs-star star' style="--i: 3;"></i>
                            <i class='bx bxs-star star' style="--i: 4;"></i>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <p>
                        <?php echo $review[1].'</br>'?>
                    </p>
                </div>
            </div>

            <div class="comment-box">
                <div class="box-top">
                    <div class="Profile">
                        <div class="profile-image">
                            <img src="https://zeru.com/blog/wp-content/uploads/How-Do-You-Have-No-Profile-Picture-on-Facebook_25900">
                        </div>
                        <div class="Name">
                            <strong><?php echo $names[2].'</br>'?></strong>
                            <span>@<?php echo $names[2].'</br>'?></span>
                        </div>
                        <div class="C_rating">
                            <input type="number" name="rating" hidden>
                            <i class='bx bxs-star star' style="--i: 0;"></i>
                            <i class='bx bxs-star star' style="--i: 1;"></i>
                            <i class='bx bxs-star star' style="--i: 2;"></i>
                            <i class='bx bxs-star star' style="--i: 3;"></i>
                            <i class='bx bx-star star' style="--i: 4;"></i>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <p>
                        <?php echo $review[2].'</br>'?>
                    </p>
                </div>
            </div>

            <div class="comment-box">
                <div class="box-top">
                    <div class="Profile">
                        <div class="profile-image">
                            <img src="https://zeru.com/blog/wp-content/uploads/How-Do-You-Have-No-Profile-Picture-on-Facebook_25900">
                        </div>
                        <div class="Name">
                            <strong><?php echo $names[3].'</br>'?></strong>
                            <span>@<?php echo $names[3].'</br>'?></span>
                        </div>
                        <div class="C_rating">
                            <input type="number" name="rating" hidden>
                            <i class='bx bxs-star star' style="--i: 0;"></i>
                            <i class='bx bxs-star star' style="--i: 1;"></i>
                            <i class='bx bxs-star star' style="--i: 2;"></i>
                            <i class='bx bxs-star star' style="--i: 3;"></i>
                            <i class='bx bxs-star star' style="--i: 4;"></i>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <p>
                        <?php echo $review[3].'</br>'?>
                    </p>
                </div>
            </div>
        </div>
    </section>


</br>
</br>
</br>
</br>
</br>
</br>


    <div class="wrapper">
		<h3> Rating </h3>
		<form action="Form.php" method ="Post">
			<div class="rating">
				<input type="number" name="rating" hidden>
				<i class='bx bx-star star' style="--i: 0;"></i>
				<i class='bx bx-star star' style="--i: 1;"></i>
				<i class='bx bx-star star' style="--i: 2;"></i>
				<i class='bx bx-star star' style="--i: 3;"></i>
				<i class='bx bx-star star' style="--i: 4;"></i>
			</div>
			<textarea name="opinion" cols="30" rows="5" placeholder="Share your Experience..."></textarea>
			<div class="btn-group">
				<button type="submit" class="btn submit">Submit</button>
				<button class="btn cancel">Cancel</button>
			</div>
		</form>
	</div>


    <script>
        const allStar = document.querySelectorAll('.rating .star')
        const ratingValue = document.querySelector('.rating input')

        allStar.forEach((item, idx)=> {
            item.addEventListener('click', function () {
                let click = 0
                ratingValue.value = idx + 1

                allStar.forEach(i=> {
                    i.classList.replace('bxs-star', 'bx-star')
                    i.classList.remove('active')
                })
                for(let i=0; i<allStar.length; i++) {
                    if(i <= idx) {
                        allStar[i].classList.replace('bx-star', 'bxs-star')
                        allStar[i].classList.add('active')
                    } else {
                        allStar[i].style.setProperty('--i', click)
                        click++
                    }
                }
            })
        })
    </script>


</br>
</br>
</br>
</br>
</br>
</br>



<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $experience = $_POST['opinion'];
        $rating = $_POST['rating'];
 
        //$uname = "mhamza";
        $uname = $_SESSION['uname'];
        echo "Welcome, $uname!";
        if($experience)
        {
            $sql = "INSERT INTO [Reviews] VALUES ('$uname', '$experience', '$rating')";
            $result = sqlsrv_query($conn, $sql);
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> Nothing was inserted.
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
        }

      

    }

    
?>

</body>
</html>