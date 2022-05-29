<?php

session_start();

include('server/connection.php');

if(isset($_SESSION['logged_in']))
{
  header('location:account.php');
  exit;
}


if(isset($_POST['login_btn']))
{
  $email = $_POST['email'];
  $password = md5($_POST['password']);


  $stmt = $conn->prepare("select user_id, user_name, user_email, user_password from users where user_email = ? AND user_password = ? LIMIT 1");


  $stmt->bind_param('ss',$email,$password);

  if($stmt->execute())
  {
    $stmt->bind_result($user_id,$user_name,$user_email,$user_password);
      $stmt->store_result();

    if($stmt->num_rows()==1)
    {
      $row = $stmt -> fetch();
    

      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['logged_in'] = true;

      header('location: account.php?login_success=logged in successfully');                                                                                              

    }
    else
    {
      header('location: login.php?error=could not verify account');
    }
  }
  else
  {
    //error
    header('location: account.php?message=something went wrong');
  }

}

?>



<?php include('layouts/header.php');  ?>







<!--login-->
<section class="my-5 py-5" id="login">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight bold">Login</h2>
    <hr class="mx-auto">  
  </div>
  <div class="mx-auto container">
    <form id="login-form" method="POST" action="login.php">
      <p class="text-center" style="color:red"><?php if(isset($_GET['message'])){ echo $_GET['message']; }?>
    
      </p>
      <p style="color:red;" class="text_center"><?php if(isset($_GET['error'])) { echo $_GET['error'];} ?>
      <div class="form-group">
        <label> Email </label>
        <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required/>
      </div>
      <div class="form-group">
        <label> Password </label>
        <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
      </div>
      <div class="form-group">
        <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
      </div>
      <div class="form-group">
        <a id="register-url"  href="register.php" class="btn">Don't have an account? Register</a>
      </div>


    </form>

  </div>
</section>





<?php include('layouts/footer.php');  ?>





 