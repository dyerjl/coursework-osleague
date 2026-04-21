<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="stylesheet.css">

<script>
  $(window).scroll(function() {
  $(".slideanim").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide");
    }
  });
});
</script>

<!-------------------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE HTML>
<html>

<div class="jumbotron text-center" id="main-jumbotron">
  <div class="row">
    <div class="col-sm-4" id="jumbo-left-column"></div>
    <div class="col-sm-4" id="jumbo-mid-column"></div>
    <div class="col-sm-4"></div>
  </div>
</div>

    <head>
        <title>OS League</title>
    </head>

    <body>
        <?php
            session_start();
            //print_r($_SESSION); 
            if(isset($_SESSION["loggedinuser"])){
                echo("Hello ".$_SESSION["firstname"]);

            }
        ?>
        <h1>Main Page</h1>
        
        
            
    </body>
</html> 