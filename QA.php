<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>FAQs</title>
    <link rel="stylesheet" href="QA.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </head>
  <?php include('connection.php');
        session_start();
   ?>
  
  <?php 
        $sql = "Select * from [Q/A] ORDER BY [Question_ID] DESC";
        $result = sqlsrv_query($conn, $sql);
        $qns = array("","","");
        $ans = array("","","");
        $i = 0;
        while($obj = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
       {
          $qns[$i] = $obj['Question'];
          //echo $qns[$i].'</br>';
          $ans[$i] = $obj['Answer'];
          //echo $ans[$i].'</br>';
          $i++;
       }

        
    ?>



  <body>
    <div class="faq_area section_padding_130" id="faq">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-12 col-sm-8 col-lg-6">
                  <!-- Section Heading-->
                  <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                      <h3><span>Frequently </span> Asked Questions</h3>
                      <p> Look through the FAQs or ask us about your questions. </p>
                      <div class="line"></div>
                  </div>
              </div>
          </div>
          <div class="row justify-content-center">
              <!-- FAQ Area-->
              <div class="col-12 col-sm-10 col-lg-8">
                  <div class="accordion faq-accordian" id="faqAccordion">
                      <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                          <div class="card-header" id="headingOne">
                              <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">   <?php echo $qns[0].'</br>'?> <span class="lni-chevron-up"></span></h6>
                          </div>
                          <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#faqAccordion">
                              <div class="card-body">
                                  <p>  <?php echo $ans[0].'</br>'?> </p>
                              </div>
                          </div>
                      </div>
                      <div class="card border-0 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                          <div class="card-header" id="headingTwo">
                              <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">  <?php echo $qns[1].'</br>'?> <span class="lni-chevron-up"></span></h6>
                          </div>
                          <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                              <div class="card-body">
                                  <p>  <?php echo $ans[1].'</br>'?> </p>
                              </div>
                          </div>
                      </div>
                      <div class="card border-0 wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                          <div class="card-header" id="headingThree">
                              <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">  <?php echo $qns[2].'</br>'?> <span class="lni-chevron-up"></span></h6>
                          </div>
                          <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#faqAccordion">
                              <div class="card-body">
                                  <p>  <?php echo $ans[2].'</br>'?> </p>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  
                  <div class="wrapper">
                    <h3> Still have any Queries? </h3>
                    <form action="QA.php" method ="Post">
                        <textarea name="question" cols="30" rows="5" placeholder=" Ask Your Questions here.... "></textarea>
                        <textarea name="mail" cols="30" rows="1" placeholder=" Your Email Address "></textarea>
                        <div class="btn-group">
                            <button type="submit" class="btn submit">Send </button>
                            <button class="btn cancel">Cancel</button>
                        </div>
                    </form>
                </div>

              </div>
          </div>
      </div>
  </div>


  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $question = $_POST['question'];
        $email = $_POST['mail'];

        //$uname = "mhamza";
        $uname = $_SESSION['uname']; // get the value from the session
        echo "Welcome, $uname!";
        if($question)
        {
            $sql = "INSERT INTO [Q/A] VALUES ('$uname', '$question', NULL)";
            $result = sqlsrv_query($conn, $sql);
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> No Query was inserted.
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
