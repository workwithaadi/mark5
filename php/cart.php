<?php
  session_start();

  if(isset($_POST["add"])){
     
    if(isset($_SESSION["shopping_cart"])){
     
     $item_array_id=array_column($_SESSION["shopping_cart"],"id");
     if(!in_array($_POST["id"],$item_array_id))
     {
       $cnt=count($_SESSION["shopping_cart"]);
       $item_array= array(
        'id' => $_POST["id"],
        'dish'=>$_POST["dish"],
        'price'=>$_POST["price"],
        'quantity'=>$_POST["quantity"],
        'amount'=>$_POST["amount"]);
        $_SESSION["shopping_cart"][$cnt]=$item_array;
     }
     else{
        header('location:../html/alreadyadded.html');
     }
    }
    else{
      $item_array= array(
        'id' => $_POST["id"],
        'dish'=>$_POST["dish"],
        'price'=>$_POST["price"],
        'quantity'=>$_POST["quantity"],
        'amount'=>$_POST["amount"],
      );
      $_SESSION["shopping_cart"][0]=$item_array;
    }
  }
  if(isset($_GET["action"]))
  {
    if($_GET["action"]=="delete")
    {
      foreach($_SESSION["shopping_cart"] as $keys =>$values)
       if($values["id"] ==$_GET["id"])
       {
         unset($_SESSION["shopping_cart"][$keys]);
         echo '<script> alert("Items Removed")</script>';
         header('location:../php/cart.php');
       }
    }
   
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/normalized.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cartt.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark navbar-custom sticky-top"> 
       <div class="container-fluid">
          <a class="navbar-brand" href="../html/mark3.html">Food hub</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="../php/logout.php"> Log out </a> </li>
                </ul>
            </div>
       </div>
    </nav>
    <div class="container-fluid">
  <h1 class="display1 text-center text-light">Cart</h1>
  <div class="container-fluid">
    <table class="table table-hover">
          <tr>
              <th class="text-light"> Srno. </th>
              <th class="text-light"> Name </th>
              <th class="text-light"> Quantity </th>
              <th class="text-light"> price in (RS) </th>
              <th class="text-light"> Amount </th>
              <th class="text-light"> Total </th>
              <th class="text-light"> Remove </th>
          </tr>             
<?php 
$srno=1;
$gtotal=0;
if(!empty($_SESSION["shopping_cart"]))
{
foreach($_SESSION["shopping_cart"] as $keys =>$values)
{
$total= $values["price"] * $values["amount"];
$gtotal= $gtotal+$total;    

?>          
         <form method="post" action="checkout.php" id="form1">       
             <tr>
               <td class="text-light"> <?php echo $srno ?> <input type="hidden" name="srno[]" value="<?php echo $srno ?>"> </td>  
               <td class="text-light"> <?php echo $values["dish"] ?><input type="hidden" name="dish[]" value="<?php echo $values["dish"] ?>"> </td>
               <td class="text-light"> <?php echo $values["quantity"]  ?><input type="hidden" name="quantity[]" value="<?php echo $values["quantity"] ?>"> </td>
               <td class="text-light"> <?php echo $values["price"]  ?><input type="hidden" name="price[]" value="<?php echo $values["price"] ?>"> </td>
               <td class="text-light"> <?php echo $values["amount"] ?><input type="hidden" name="amount[]" value="<?php echo $values["amount"] ?>"> </td>
               <td class="text-light"> <?php echo $total ?> </td>
               <input type="hidden" name="gtotal" value="<?php echo $gtotal ?>">
               <input type="hidden" name="id[]" value="<?php echo $values["id"] ?>">
             <!--<td> <input type="button" class="btn btn-primary" name="event" value="update"></td>-->
             <!--td> <a href="cart.php?action=update&id=<?//php echo$values["id"];?>"><span class="Text-danger">update</span></a></td-->
              <td> <a href="cart.php?action=delete&id=<?php echo$values["id"];?>"><span class="Text-danger text-light">Remove</span></a></td>
              </tr>
         
        <?php
        $srno++;
        } 
        // $gtotal=$total+($values["price"] * $values["amount"]);
        }?>
        <tr>
        <td class="text-light">Grand Total</td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td class="text-light"> <?php echo $gtotal;?> </td>
        </tr>
         </table>
    <table class="table table-hover">
<tr>
  <td>
                <label class="text-light">Your Address </label></td><td>
                   <textarea class="text-dark textarea" name="info" form="form1" rows="2" cols="100">Your thought</textarea> 
      </td>
      </table>
                   <button type="submit" name="submit" class="btn btn-default"><b>Placeorder</button>
        </form>
            <button type="submit" class="btn btn-default"><a  href="dominosin.php"><b>Continue shopping </a></button>

</div>    
</div>

</body>
</html>