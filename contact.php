<!DOCTYPE HTML>
<html lang="nl">

<head>
  <link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' 
  type='text/css'>
  <title>Peter van Haastrecht Fotografie</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta charset="utf-8"/>
  <meta name="description"
    content="Peter van Haastrecht is een Nederlandse hobbyfotograaf, gespecialiseerd 
    in fotografie van Nederlandse vergezichten en vogels." />
  <meta name="keyword" content="landschapsfotografie, vogels, macro" />
  <link rel="stylesheet" type="text/css" href="css/main.css" media="screen"/>
  <!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if lte IE 7]>
  <script src="js/IE8.js" type="text/javascript"></script><![endif]-->
  <!--[if lt IE 7]>
  <link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="js/responsiveslides.js"></script>
  <script>
    $(function() {
      $(".rslides").responsiveSlides();
    });
  </script>
</head>
	
<body>
  <header class="gradient_background">
    <div class="widthwrap">
      <img src="images/logo.svg" alt="Vogels logo">
      <h3> Peter van Haastrecht</h3>
    </div>
    <div class="widthwrap">
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="bruiloften.html">Bruiloften</a></li>
          <li><a href="landschappen.html">Landschappen</a></li>
          <li><a href="dieren.html">Dieren</a></li>
          <li><a href="series.html">Series</a></li>
          <li><a href="biografie.html">Biografie</a></li>
          <li><a href="contact.html" class="active_page">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div id="contacttext" class="widthwrap">
    <h4>Wilt u meer weten over de foto's, over het bestellen van foto's, heeft u opmerkingen
    over de website of heeft u een fotograaf nodig voor uw bruiloft? 
    Stel hier gerust uw vragen.</h4>
  </div> 
  
  <!-- ***** Start php ***** -->
  <?php 
  // Define the variables and set to empty values
  $nameErr = $mailErr = $contentErr = "";
  $name = $mail = $content = "";
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    
    if (empty($_POST["naam"])) {
        $nameErr = "Vul hier uw naam in.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST["naam"])) {
        // Check if name only contains letters and whitespace
        $nameErr = "Gelieve alleen letters en spaties te gebruiken."; 
    } else {
        $name = $_POST["naam"];
    }
    
    
    if (empty($_POST["email"])) {
        $mailErr = "Vul hier uw E-mail adres in.";
    // Check for bots and spam:  
    } elseif (IsInjected($_POST["email"])) {
        $mailErr = "E-mail format is niet juist.";
    // Make use of build-in filter to validate an e-mail address    
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $mailErr = "E-mail format is niet juist";
    } else {
        $mail = $_POST["email"];
    }
      
    if (empty($_POST["bericht"])) {
        $contentErr = "Vul hier uw vragen of opmerkingen in.";
    } else {
        $content = $_POST["bericht"];
    }
    
    if (!empty($name) && !empty($mail) && !empty($content)&& empty($_POST["test"])) { 
      $from = "Peter";
      $to = "mirellakersten@gmail.com";
      $email_subject = "Bericht van $name via de website";
      $email_body = "Van: $mail \r\n Bericht: $content";
      $headers = "From: $from \r\n";
      mail($to, $email_subject, $email_body, $headers);
      $succes = "Uw bericht is succesvol verzonden. Ik zal u zo spoedig mogelijk een
      bericht terugsturen op het door u opgegeven adres: $mail.";
    } else {
     $nosucces = "Er is iets mis gegaan met het versturen.";
     }
  }
    
  // Function to validate against any email injection attempts (hackers)
  function IsInjected($str) {
    $injections = array('(\n+)',
                '(\r+)',
                '(\t+)',
                '(%0A+)',
                '(%0D+)',
                '(%08+)',
                '(%09+)'
                );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str)) {
      return true;
    } else {
      return false;
    }
  }
  ?>
  <!-- ***** End php ***** -->
  
  <div id="contactform">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      <p> 
        <label for="Naam">Naam:<BR></label> 
        <input type="text" name="naam" value=<?php echo $_POST["naam"];?>> 
        <span><?php echo $nameErr;?></span>
      </p> 
      <p>
        <label for="E-mail">E-mail:<BR></label> 
        <input type="text" name="email" value="<?php echo $_POST["email"];?>"> 
        <span><?php echo $mailErr;?></span>
      </p>
      <p> 
        <label for="Bericht">Uw vragen of opmerkingen:<BR></label> 
        <input rows="9" cols ="30" type="text" name="bericht" value="<?php echo $_POST["bericht"];?>">
        <span><?php echo $contentErr;?></span>
      </p>
      <!-- Dit is tegen spam -->
      <p id="last_field">
      <label>Gelieve hier niets in te vullen.</label>
      <input name="test" type="text"/>
    </p>
      <p> 
        <input type="submit" value="Verzenden"/> 
      </p> 
      <p> 
        <?php echo $nosucces;?> 
        <?php echo $succes;?> 
      </p>
    </form> 
  </div>           
  <footer>
    <h5>Copyright photos Peter van Haastrecht<br>
    Website door Mirella Kersten 2016</h5> 
  </footer>
</body>
	
</html>