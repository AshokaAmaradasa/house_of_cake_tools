<?php

  session_start();

  if(isset($_POST['order_pay_btn']))
  {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
  }

 

?>




<?php include('layouts/header.php');  ?>




   
   
   
    <!--payment-->
 <section class="my-5 py-5" id="register">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight bold"> Payment </h2>
      <hr class="mx-auto">  
    </div>
    <div class="mx-auto container text-center">


    <?php if(isset($_POST['order_status']) && $_POST['order_status']=="not paid"){?>
        <p> Due payment </p>
        <p>Total Payment: Rs. <?php echo $_POST['order_total_price'];?></p>
          <input class="btn btn-primary" type="submit" value="Pay Now"/>
      

      <?php } else if(isset($_SESSION['nettotal']) && $_SESSION['nettotal']!=0){?>
        <p> Payment @ checkout</p>
        <p>Total Payment: Rs. <?php echo $_SESSION['nettotal'];?> </p>
        <input class="btn btn-primary" type="submit" value="Pay Now"/>
      
     

      <?php } else { ?>
        <p> no order has been placed to show</p>

        <?php } ?>

  
    </div>
</section>
  













<?php include('layouts/footer.php');  ?>