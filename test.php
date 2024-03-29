<?php
require 'db.php';
$data = $_POST;

if (isset($data['test_sumbit'])){
  $rate=0;
  
  $test=R::findone('tests', 'name = ?', array($data['testname']));
  for ($i = 1;$i <= $test['kol'] ; $i++){
      if ($test['answer'.$i] == $data['user_answer'.$i]){
          $rate = $rate + $test['rating'.$i];
      }
  }
  $rating=R::dispense('ratings');
  $rating->user_id = $_SESSION['logged_user']->id;
  $rating->company = $test['name'];
  $rating->score = $rate;
  R::store($rating);
  header('location:/lk.php');
}

?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>WorkStock</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Source+Code+Pro:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap-5.0.0-alpha-2.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css"/>
    <link rel="stylesheet" href="assets/css/tiny-slider.css"/>
    <link rel="stylesheet" href="assets/css/glightbox.min.css"/>
    <link rel="stylesheet" href="assets/css/animate.css"/>
    <link rel="stylesheet" href="assets/css/lindy-uikit.css"/>
    <link rel="stylesheet" href="css/style.css">
    <style>.section-title { background: none;
    }
    .contact-form-wrapper{
    border-radius: 71px;
    background: #fafafa !important;
    box-shadow:  44px 44px 74px #c6c6c6,
                -44px -44px 74px #ffffff;
}
    
    </style>
  </head>
  <body>
    <section id="contact" class="contact-section contact-style-1">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 pt-50 pl-50 pr-50 pb-50 formreg">
  
              <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-10">
                  <div class="section-title mb-40">
                    <h3 class="mb-15 text-center">Первичное тестирование</h3>
                  </div>
                </div>
              </div>
  
              <div class="contact-form-wrapper pt-50 pl-50 pr-50 pb-50" id="cont">
                <form action="test.php" method="POST">
                  <div class="row">
                  <?php  
                    $test=R::findone('tests', 'name = ?', array($data['te']));
                    echo '<input type="hidden" name="testname" value="'.$data['te'].'">';
                    for ($i = 1;$i <= $test['kol'] ; $i++){
                      echo '
                    <div class="col-md-6">
                      <div class="single-input">
                        <label for="name">'.$test['question'.$i].'</label>
                        <input type="text" id="name" name="user_answer'.$i.'" class="form-input" placeholder="Введите ответ">
                      </div>
                    </div>';
                    }
                     ?>
                  <div class="form-button">
                    <button type="submit" class="button radius-30" name='test_sumbit'>Отправить ответы</button>
                  </div>
                </form>
              </div>
  
            </div>
          </div>
        </div>
      </section>
    <script src="assets/js/bootstrap.5.0.0.alpha-2-min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/imagesloaded.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
