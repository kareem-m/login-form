<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST["phone"], FILTER_SANITIZE_NUMBER_INT);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    $formErrors = [];
    
    if (strlen($name) <=3) {
      $formErrors[] = "Name must be larger than 3 characters";
    }

    if (strlen($email) <=5) {
      $formErrors[] = "Email must be larger than 5 characters";
    }

    if (strlen($message) <=20) {
      $formErrors[] = "message must be larger than 20 characters";
    }

    $headers = "From " . $email . "\r\n";
    if (empty($formErrors)) {
      mail("kareemmoh1911@gmail.com", "Contact Form", $message, $headers);

      $name = "";
      $email = "";
      $phone = "";
      $message = "";
    }
  }
  mail("kareemmoh1911@gmail.com", "Test", "Hello Kareem", "this message from me for only test");
?>
<!DOCTYPE html>
<html lang="en">
  <?php
    $headTitle = "Login Form";
    include("includes/head.php");
  ?>
  <body>
    <div class="overflow"></div>
    <main>
      <div class="max-width">
        <h1>Contact Me</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <input type="text" name="name" placeholder="Type Your Name" require value="<?php if(isset($name)) {echo $name;} ?>">

          <input type="email" name="email" placeholder="Type Your Email" require value="<?php if(isset($email)) {echo $email;} ?>">

          <input type="text" name="phone" placeholder="Type Your Call Phone" require value="<?php if(isset($phone)) {echo $phone;} ?>">

          <textarea name="message" require placeholder="Your Message"><?php if(isset($message)) {echo $message;} ?></textarea>

          <input type="submit" value="Send Message">

        </form>
      </div>
    </main>
    <?php if (!empty($formErrors)) { ?>
      <div class="errors">
        <div class="close">X</div>
        <?php
          foreach ($formErrors as $error) {
            echo $error . "<br>";
          }
        ?>
    </div>
    <?php } ?>
  </body>
</html>