<?php
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$human = intval($_POST['human']);
		$humanRes = intval($_POST['humanResult']);

		$from = 'Contact Form'; 
		$to = 'modernshipwrecks@gmail.com'; 
		$subject = 'Message from Contact';
		
		$body ="From: $name\n E-Mail: $email\n Message:\n $message";
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
		}
		//Check if simple anti-bot test is correct
		if ($human !== $humanRes) {
			$errHuman = 'Your anti-spam is incorrect';
		}
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
	if (mail ($to, $subject, $body, $from)) {
		$result='<div class="alert alert-success">Thank you for the message !!</div>';
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	}
}
	}
?>
<!DOCTYPE html >

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>About</title>
  <style>
    html,body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
    }
    .contactDiv{
    margin: 20px;
    }
    .contactinfoDiv{
      margin: 20px;
      background-color: #f0f0f0;
      border-radius: 3%;
      float: right;
    }

    .navbargradient {
      background: #ffffff;
      /* Old browsers */
      background: -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 100%);
      /* FF3.6-15 */
      background: -webkit-linear-gradient(top, #ffffff 0%, #e5e5e5 100%);
      /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%);
      /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5', GradientType=0);
      /* IE6-9 */
    }
 
    
  </style>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

<script type="text/javascript">
        $(document).ready(function() {
               var minNumber = 0;
               var maxNumber = 100;
               var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber);
               var randomnumber2 = Math.floor(Math.random() * (maxNumber + 2) + minNumber);
               $('#humanCheck').html(randomnumber + ' + ' + randomnumber2 + ' = ' + ' ? ' );
               $('#humanResult').val(randomnumber + randomnumber2);
        });
    </script>
</head>

<body class="animated fadeInRight">
  <div>
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded navbargradient">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
      <a class="navbar-brand" href="index.php" style="font-weight: bold">Modern Shipwrecks</a>
      <div class="collapse navbar-collapse" id="navbarToggle">
        <ul class="navbar-nav mr-auto mt-2 mt-md-0">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data-download.php">Data</a>
          </li>
          <li class="nav-item">
	    <a class="nav-link" href="analyze.php">Analyze</a>
          </li>
          <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Resources
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="pmsimages.php">Photos</a>
		          <a class="dropdown-item" href="pmsdocs.php">Documents</a>
		          <a class="dropdown-item" href="glossary.html">Ship Glossary</a>
		          <a class="dropdown-item" href="metadata.html">Data Dictionary</a>
		          <a class="dropdown-item" href="astrolabes.php">Astrolabes</a>		          
		        </div>
		      </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>      
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
      <div>
        <a href="https://www.tamu.edu/"><img border="0" alt="TAMU" src="../images/Capture.png" width="200px"></a>
      </div>
    </nav>
  </div>
  
<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
  <form class="form-horizontal" role="form" method="post" action="contact.php">
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
			<?php echo "<p class='text-danger'>$errName</p>";?>
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
			<?php echo "<p class='text-danger'>$errEmail</p>";?>
		</div>
	</div>
	<div class="form-group">
		<label for="message" class="col-sm-2 control-label">Message</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
			<?php echo "<p class='text-danger'>$errMessage</p>";?>
		</div>
	</div>
	<div class="form-group">
                <div id="humanCheck" class="col-sm-2 control-label"></div>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
			<input type="hidden" id="humanResult" name="humanResult">
			<?php echo "<p class='text-danger'>$errHuman</p>";?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<?php echo $result; ?>	
		</div>
	</div>
  </form> 
</div>
<div class="col-sm-4 contactinfoDiv">
   <div style="padding:15px"><b>Contact Information</b></div>
   <div style="padding:15px">Email: <a href="mailto:modernshipwrecks@gmail.com?Subject=Hello%20again" target="_top">modernshipwrecks@gmail.com</a></div>
   <div style="padding:15px">Social Media:</div>
   <div style="padding:15px"><a href="http://tamu.academia.edu/FilipeCastro">http://tamu.academia.edu/FilipeCastro</a></div>
   <div style="padding:15px"><a href="http://tamu.academia.edu/CeciliaSmith">http://tamu.academia.edu/CeciliaSmith</a></div>
</div>
</div>
</div>
 </body>
</html>