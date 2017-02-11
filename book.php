<?php 
include("database.php");

// tikriname ar url esantis įrašas atitinka db esančią info
$bool = false;
if (isset($_GET["id"])){
    $knyga = $_GET["id"];
    $book = $db->query("SELECT * from test where id = '{$knyga}' ");
      if($book->num_rows){
       $bool = true;
      }else{
       $bool = false;
  };
};
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Knygos</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="well">
      <div id="header">
       <div class="container">
         <h1>Knygos</h1>
         <h3>Žemiau atvaizduojamas jūsų pasirinktos knygos aprašymas <br> Norėdami grįžti, spauskite - Pagrindinis.</h3>
       </div>
      </div>
    </div>
     <div id="main">
       <div class="container">
     
  <!-- NAVBAR -->
        <nav class="navbar navbar-default" style="margin-bottom: -5px">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header navbar-left">
      <a class="navbar-brand" href="index.php">Pagrindinis</a>
    </div>
      <form class="navbar-form navbar-right" action="index.php" method="post"">
        <div class="form-group">
          <input type="text" name="search" class="form-control" placeholder="Ieškoti...">
        </div>
        <button type="submit" class="btn btn-default">Pirmyn</button>
      </form>
  </div><!-- /.container-fluid -->
</nav>
  <!-- NAVBAR END -->
      <div class="well">

        <?php if($bool){
      $bookinfo = $book->fetch_object();
     ?>
        <div class="row">
          <div class="col-md-8">
            <div class="pull-left">
              <img src="https://store.lexisnexis.com/__data/assets/image/0003/26571/dummy_cover.jpg" alt="bookcover">
            </div>
            <div >
              <?php echo
               ' <h3><b>'.$bookinfo->name.'</b> | <span>'.$bookinfo->year.'</span></h3>
                               <h4>Autorius: '.$bookinfo->author.'</h4>
                               <h4>Žanras: '.$bookinfo->genre.'</h4>
                               <p>'.$bookinfo->description.'</p>';
              ?>
            </div>
          </div>
        </div>

<?php  }else{
        echo '<h4 style="text-align:center">Deja, jūsų norimos knygos rasti nepavyko.</h4>';  
      };
?>

      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>