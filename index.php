<?php include("database.php");

// Puslapiavimas

$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$perpage = isset($_GET['items']) && $_GET['items'] ? $_GET["items"] : 5;

$start = $page * $perpage - $perpage;   // nustatoma įrašų atvaizdavimo pradžia


//tikriname ar buvo naudotasi paieška


if(isset($_POST['search'])){
  $search = $_POST['search'];
}else if(isset($_GET["search"])) {
  $search = $_GET['search'];
}else{
  $search = '';
}

//// nuskaitomas atvaizduosimų įrašų skaičius

$result = $db->query("
  SELECT * FROM test 
  WHERE name LIKE '%{$search}%' 
  OR genre LIKE '%{$search}%'" );
$count = $result->num_rows;            
$pages = ceil($count / $perpage);



// duomenų iš DB įrašymas į ARRAY

$result = $db->query("
  
  SELECT * from test 
  WHERE name LIKE '%{$search}%' 
  OR genre like '%{$search}%' 
  LIMIT {$start}, {$perpage}");

$row_cnt = $result->num_rows;
  if($result->num_rows){
    while($row = $result->fetch_object()){
      $values[] = $row;
    }
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
         <h3>Žemiau atvaizduojamos visos mūsų turimos knygos <br> Paspauskite ant pavadinimo, norėdami atidaryti knygos aprašymą.</h3>
       </div>
      </div>
    </div>
     <div id="main">
       <div class="container">
     
  <!-- NAVBAR -->
        <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header navbar-left">
      <a class="navbar-brand" href="index.php">Pagrindinis</a>
    </div>
      <form class="navbar-form navbar-right" action="index.php" method="post">
        <div class="form-group">
          <input type="text" name="search" class="form-control" placeholder="Ieškoti...">
        </div>
        <button type="submit" class="btn btn-default">Pirmyn</button>
      </form>
  </div><!-- /.container-fluid -->
</nav>
  <!-- NAVBAR END -->

  <?php if ($values){
 ?>
         <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Pavadinimas</th>
              <th>Žanras</th>
              <th>Metai</th>
            </tr>
          </thead>
          <tbody>
            <tr <?php foreach ($values as $value) {
            echo  '</tr>
                  <th scope="row">'.$value->id.'</th>
                  <td><a href="book.php?id='.$value->id.'">'.$value->name.'</a></td>
                  <td>'.$value->genre.'</td>
                  <td>'.$value->year.'</td>
                  </tr>'; }?>
          </tbody>
        </table>
      <?php }else{ ?>
        <div class="well">
          <h4>Nieko nerasta!</h4>
        </div>
      <?php  };?>
      </div>
     </div> 
     <div id="footer">
       <div class="container">
         <nav aria-label="Page navigation example">
          <ul class="pagination">
           <li class="page-item <?php if (($page-1)<1) echo 'disabled';?>"><a disabled="disabled" class="page-link" <?php echo ' href="index.php?page='.($page-1).'&items='.$perpage.'&search='.$search.'">'; ?>Atgal</a></li>
            <li class="page-item <?php if (($page-1)<1) echo 'disabled'; ?>"><a class="page-link" <?php echo ' href="index.php?page='.($page-1).'&items='.$perpage.'&search='.$search.'">'.($page-1); ?></a></li>
            <li class="page-item page-link current disabled"><a class="page-link" href="#"><?php echo $page; ?></a></li>
            <li class="page-item <?php if (($page+1)>$pages) echo 'disabled'; ?>"><a class="page-link" <?php echo 'href="index.php?page='.($page+1).'&items='.$perpage.'&search='.$search.'">'.($page+1); ?></a></li>
            <li class="page-item <?php if (($page+1)>$pages) echo 'disabled'; ?>"><a class="page-link" <?php echo ' href="index.php?page='.($page+1).'&items='.$perpage.'&search='.$search.'">'; ?>Pirmyn</a></li>
          </ul>

          <ul class="pagination right">
          <li class="page-item dropdown">
              <a class="page-link" data-toggle="dropdown"  >
             Rodoma: <?php echo $perpage ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
            <li role="presentation"><a role="menuitem" href=<?php echo '"index.php?items=5&search='.$search.'"'; ?>>5</a></li>
            <li role="presentation"><a role="menuitem" href=<?php echo '"index.php?items=10&search='.$search.'"'; ?>>10</a></li>
            <li role="presentation"><a role="menuitem" href=<?php echo '"index.php?items=20&search='.$search.'"'; ?>>20</a></li>
            <li role="presentation"><a role="menuitem" href=<?php echo '"index.php?items=50&search='.$search.'"'; ?>>50</a></li>
          </li>
          </ul>
            </li>
            
          </ul>
        </nav>
       </div>
     </div>

      
   
    
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>