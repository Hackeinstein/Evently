<?php
session_start();
?>
<html lang="en"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    
    <title>YOUR TICKETS</title>
  </head>
  <body data-new-gr-c-s-check-loaded="14.1143.0" data-gr-ext-installed="">
  

  <div class="content">
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          

          <div class="row justify-content-center">
            <div class="col-md-6" >
            <center>
              <h3 class="heading mb-4">Euphoria Hangout!</h3>
              <p>Scan the Qr code to access venue </p>
              
              <p><img src="<?php echo $_SESSION['qr'];?>" alt="Image" class="img-fluid center"></p>
              </center>

            </div>
            <div class="col-md-6">
              
              <form class="mb-5" method="post" id="contactForm">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control"  placeholder="<?php echo $_SESSION['name'];?>" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    
                  </div>
                </div>
                
                  
                <div class="row">
                  <div class="col-12"><center>
                    <input type="button" value="Save" class="btn btn-primary rounded-0 py-2 px-4" name="buy">
                    </center>
                  <span class="submitting"></span>
                  </div>
                </div>
              </form>

              <div id="form-message-warning mt-4"></div> 
              <div id="form-message-success">
                Preparing Payment link..........
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>

  
</body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration></html>