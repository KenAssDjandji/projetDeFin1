<?php
$firstname = $name = $email = $phone = $message = "";
$firstnameErr = $nameErr = $emailErr = $phoneErr = $messageErr = "";
$emailTo = "LemessiKenn05@gmail.com";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $firstname = test_entree($_POST['firstname']);
    $name = test_entree($_POST['name']);
    $email = test_entree($_POST['email']);
    $phone = test_entree($_POST['phone']);
    $message = $_POST['message'];
    $emailText = "";

    if (empty($firstname)) {
        $firstnameErr = "prénom obligatoire";
    }else {
        $emailText .= "Prénom: $firstname\n";
    }
    
    if (empty($name)) {
        $nameErr = "nom obligatoire";
    }else {
        $emailText .= "Nom: $name\n";
    }
    
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "email obligatoire";
    }else {
        $emailText .= "Email: $email\n";
    }

    if (! preg_match("/^[0-9 ]+$/", $phone)) {
        $phoneErr = "téléphone obligatoire";
    }else {
        $emailText .= "Téléphone: $phone\n";
    }

    if (empty($message)) {
        $messageErr = "message obligatoire";
    }else {
        $emailText .= "Méssage: $message\n";
    }

     if (! empty($firstname) && ! empty($name) && ! empty($email) && ! empty($phone) && ! empty($message)) {

        $headers = "DE: $firstname $name <$email>\r\nRépondre-à: $email";
         mail($emailTo, "Un messge d'un visiteur",$emailText, $headers);
         
     }

}


function test_entree($data){
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>   contactez-moi     </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="http://fonts.googleapis.com/css?family=lato" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="divider">

            </div>

            <div class="heading">
                <h2>contactez-moi</h2>
            </div>

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 " style="margin: 0 auto;">
                    <form id="contact-form" method="POST" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstname">Prénom<span class="text-primary">*</span></label>
                                <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $firstname?>" placeholder="Votre prénom">
                                <p class="comments"><?php echo $firstnameErr;?></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="name">Nom<span class="text-primary"> *</span></label>
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $name?>" placeholder="Votre nom">
                                <p class="comments"><?php echo $nameErr;?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="email">Email<span class="text-primary"> *</span></label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $email?>" placeholder="Votre email">
                                <p class="comments"><?php echo $emailErr;?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="phone">Téléphone</label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo $phone?>" placeholder="Votre téléphone">
                                <p class="comments"><?php echo $phoneErr;?></p>
                            </div>

                            <div class="col-md-12">
                                <label for="phone">Message<span class="text-primary"> *</span></label>
                                <textarea  id="message" name="message" class="form-control" value="<?php echo $message?>" placeholder="Votre message"></textarea>
                                <p class="comments"><?php echo $messageErr;?></p>
                            </div>
                            <div class="col-md-12">
                                
                                <p class="text-primary"><strong>* Ces informations sont requises</strong></p>
                            </div>
                            
                            <div class="col-md-12">
                                <input type="submit" class="button1 btn btn-success" value="Envoyer">
                            </div>
                        </div>

                        <p class="thank-you"> <?php if (! empty($firstname) && ! empty($name) && ! empty($email) && ! empty($phone) && ! empty($message)){echo "Votre message a bien été envoyé. Merci de m'avoir contacté :)"; }elseif (! empty($firstname) OR ! empty($name) OR ! empty($email) OR ! empty($phone) OR ! empty($message)) {
                            echo "<strong>Veuillez renseigner correctement tous les champs</strong>";
                        }else {
                        echo "";
                        } 
                       ?></p>

                    </form>
                </div>
            </div>

        </div>
    </body>
</html>