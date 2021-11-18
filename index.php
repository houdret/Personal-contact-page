<?php

include_once('sendMessage.php');
error_reporting(E_ALL ^ E_WARNING);
$sujet = 'Validation de votre compte';
$object = 'Heureux que vous soyez inscrit sur notre site'.$firstname;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Création et validation d'un formulaire">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>How Contact Me!</title>
</head>
<body>
    
    <div class="container mt-5">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contacts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
            </li>
        </ul>
        <h1>Formulaire</h1>
        <div class="col-12 ">        
            <img src="./asset/img/moi.png" alt="moi" class="rounded float-end p-2" widht="75px" height="75px" >   
        </div>
        <form action="" method="post" class=" was-validated row g-1 ">
            <label for="firstname" class="form-label">Firstname </label> 
            <input type="text" name="firstname" class="form-control is-valid" required>
            <label for="lastname" class="form-label">Lastname </label> 
            <input type="text" name="lastname" class="form-control is-valid" required>            
            <label for="gender" class="form-label">Gender </label> 
            <input type="text" name="gender" class="form-control is-valid" required>            
            <label for="email" class="form-label">Email </label> 
            <input type="email" name="email" class="form-control is-valid" required>
            <label for="company" class="form-label">Company </label> 
            <input type="text" name="company" class="form-control is-valid" required>
            <label for="subject" class="form-label" >Subject </label> 
            <select class="form-select" name="subject"  aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">Job</option>
                <option value="2">Internship</option>
                <option value="3">Other</option>
                </select>
            <div class="mb-3">
                <label for="message" class="form-label">Message </label> 
                <textarea class="form-control is-invalid" rows="5" cols="40" placeholder="Required example textarea" name="message" required></textarea>
                <div class="invalid-feedback">
                    Please enter a message in the textarea.
                </div>
            </div>                  
            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary mb-3">Valider</button>
            </div> 
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $errors = array();           
            $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
            $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
            $gender = filter_var($_POST['gender'],FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $company = filter_var($_POST['company'],FILTER_SANITIZE_STRING);
            $subject = filter_var($_POST['subject'],FILTER_SANITIZE_STRING);
            $commentaire = filter_var($_POST['message'],FILTER_SANITIZE_STRING);

            if (false === filter_var($firstname, FILTER_SANITIZE_STRING)) {
                $errors['firstname'] = '<div class="alert alert-danger" role="alert">This firstname is invalid.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">votre prénom est bien nettoyé et est considérée comme valide.</div>';
            }
            if (false === filter_var($lastname, FILTER_SANITIZE_STRING)) {
                $errors['lastname'] = '<div class="alert alert-danger" role="alert">This lastname is invalid.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">votre nom est bien nettoyé et est considérée comme valide.</div>';
            }
            if (false === filter_var($gender, FILTER_SANITIZE_STRING)) {
                $errors['gender'] = '<div class="alert alert-danger" role="alert">This gender is invalid.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">votre genre est bien nettoyé et est considérée comme valide.</div>';                
            }
            if (false === filter_var($email, FILTER_SANITIZE_EMAIL)) {
                $errors['email'] = '<div class="alert alert-danger" role="alert">This email is invalid.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">votre email est bien nettoyé et est considérée comme valide.</div>';
            }
            if (false === filter_var($company, FILTER_SANITIZE_STRING)) {
                $errors['company'] = '<div class="alert alert-danger " role="alert">This company is invalid.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">votre compagnie est bien nettoyé et est considérée comme valide.</div>';
            }
            if (false === filter_var($subject, FILTER_SANITIZE_STRING)) {
                $errors['subject'] = '<div class="alert alert-danger" role="alert">This subject is invalid.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">votre subjet est bien nettoyé et est considérée comme valide.</div>';
            }
            if (false === filter_var($commentaire, FILTER_SANITIZE_STRING)) {
                $errors['message'] = '<div class="alert alert-danger" role="alert">This message is invalid.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">votre message est bien nettoyé et est considérée comme valide.</div>';
            }
            
            if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = '<div class="alert alert-danger" role="alert">This address is invalid.</div>';
            } else {
                echo '<div class="alert alert-success" role="alert">Cette adresse email est considérée comme valide.</div>';
            }            
            
            if (count($errors) > 0){
                echo "<div class='alert alert-danger' role='alert'>There are mistakes!</div>";
                print_r($errors);
                exit;
            }else {
                echo '<div class="alert alert-success" role="alert">Bravo vos données ont été bien encodées </div>';
            }
            
            $data = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'gender' => ($_POST['gender']),
                'email' => $_POST['email'],
                'company' => $_POST['company'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
            ];

            $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
            $insertion =
                'INSERT INTO portfolio (firstname, lastname, gender, email, company, subject, message ) VALUES (:firstname,:lastname,:gender,:email,:company,:subject,:message)';
            $bdd->prepare($insertion)->execute($data);

            
            if ($bdd == true) {
                echo '<div class="alert alert-success" role="alert">les données ont bien été enregistrées! </div>';
            }
            //envois avec phpmailer problème
            sendMail($sujet, $object, $email, $lastname);
            //envois avec sendmail
            if(isset($_POST['email'])){

                $header="MIME-Version: 1.0\r\n";
                $header.='From:"houdret-portfolio-web-dev.me"<houdret-portfolio-web-dev.me>'."\n";
                $header.='Content-Type:text/html; charset="UTF-8"'."\n";
                $header.='Content-Transfer-Encoding: 8bit';

                $msg='
                <html>
                    <body>
                        <div align="left">   
                            Vous êtes le bien venu sur mon site<br/> 
                            Votre validation est bien enregistrée ' .$firstname.', '.$lastname.                        
                            
                        '</div>
                    </body>
                </html>
                ';

                mail($email, "Validation formulaire", $msg, $header);

            }
        }
        ?>
        <footer>
            <a href="mailto:jeanhoudret@gmail.com?subject=Mail pour me contacter"><img src="./asset/img/gmail.png" width="30px" height="30px" alt="gmail"></a>
            <a href="mailto:github.com/houdret"><img src="./asset/img/github.png" width="45px" height="45px" alt="github"></a>
            <a href="mailto:www.linkedin.com/in/jean-louis-houdret-88250255/"><img src="./asset/img/In.png" width="30px" height="30px" alt="In"></a>
        </footer> 
    </div>
</body>
</html>