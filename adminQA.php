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

<?php
include('connection.php');
session_start();

$sql = "SELECT * FROM [Q/A] ORDER BY [Question_ID] DESC";
$result = sqlsrv_query($conn, $sql);
$qns = array("", "", "");
$ans = array("", "", "");
$id = array("", "", "");
$i = 0;
while ($obj = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $qns[$i] = $obj['Question'];
    $ans[$i] = $obj['Answer'];
    $id[$i] = $obj['Question_ID'];
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
                        <p> Look through the FAQs and answer the questions of our esteemed guests. </p>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- FAQ Area-->
                <div class="col-12 col-sm-10 col-lg-8">
                    <div class="accordion faq-accordian" id="faqAccordion">
                        <?php for ($i = 0; $i < count($qns); $i++) : ?>
                            <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="card-header" id="heading<?php echo $i; ?>">
                                    <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                        <?php echo $qns[$i]; ?>
                                        <span class="lni-chevron-up"></span>
                                    </h6>
                                </div>
                                <div class="collapse" id="collapse<?php echo $i; ?>" aria-labelledby="heading<?php echo $i; ?>" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        <?php if ($ans[$i]) : ?>
                                            <p><?php echo $ans[$i]; ?></p>
                                        <?php else : ?>
                                            <div class="wrapper">
                                                <h3>Answer this question?</h3>
                                                <form action="adminQA.php" method="POST">
                                                    <textarea name="answer" cols="30" rows="5" placeholder="Enter the answer..."></textarea>
                                                    <input type="hidden" name="selectedQuestion" value="<?php echo $id[$i]; ?>">
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn submit">Send</button>
                                                        <button class="btn cancel">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['answer'])) {
            $answer = $_POST['answer'];
            $selectedQuestionIndex = $_POST['selectedQuestion'];

            $sql = "UPDATE [Q/A] SET Answer = '$answer' WHERE Question_ID = '$selectedQuestionIndex'";
            $result = sqlsrv_query($conn, $sql);

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
    }
?>
</body>
</html>
