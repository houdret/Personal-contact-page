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
        <form action="" method="post" class=" was-validated row g-1 ">
            <label for="firstname" class="form-label">Firstname </label> 
            <input type="text" name="firstname" class="form-control is-valid" required>
            <label for="lastname" class="form-label">Lastname </label> 
            <input type="text" name="lastname" class="form-control is-valid" required>            
            <label for="password" class="form-label">Password </label> 
            <input type="password" class="form-control is-valid" placeholder="Password" required>            
            <label for="email" class="form-label">Email </label> 
            <input type="email" name="email" class="form-control is-valid" required>
            <label for="tel" class="form-label">Tel </label> 
            <input type="tel" name="tel" class="form-control is-valid" required>
            <label for="url" class="form-label">Site Web </label> 
            <input type="url" name="url" class="form-control">
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
        error_reporting(E_ALL ^ E_WARNING);
        if (isset($_POST['submit'])) {
            /* $options = array(
                'firstname'       => FILTER_SANITIZE_STRING,
                'lastname'        => FILTER_SANITIZE_STRING,
                'email'           => FILTER_SANITIZE_EMAIL,
                'tel'             => FILTER_SANITIZE_NUMBER_INT,
                'url'             => FILTER_SANITIZE_URL,
                'message'         => FILTER_SANITIZE_STRING
            );
            $result = filter_input_array(INPUT_POST, $options); */
            // 1. Sanitisation
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $firstname = filter_var(
                $_POST['firstname'],
                FILTER_SANITIZE_STRING
            );

            $password = filter_var(
                $_POST['password'],
                FILTER_SANITIZE_STRING
            );

            if (false === filter_var($firstname, FILTER_SANITIZE_STRING)) {
                $errors['firstname'] = 'This firstname is invalid.';
            } else {
                echo 'votre nom est bien nettoyé et est considérée comme valide.<hr>';
            }
            // 2. Validation
            if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'This address is invalid.';
            } else {
                echo 'Cette adresse email nettoyée est considérée comme valide.<hr>';
            }

            // 3. execution
            /* if (count($errors)> 1){
                echo "There are mistakes!";
                print_r($errors);
                exit;
            }else {
                echo 'Bravo vos données ont été bien encodées <hr>';
            } */
            $data = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'password' => sha1($_POST['password']),
                'email' => $_POST['email'],
                'tel' => $_POST['tel'],
                'url' => $_POST['url'],
                'message' => $_POST['message'],
            ];

            $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
            $insertion =
                'INSERT INTO table_essai (firstname, lastname, password, email, tel, url, message ) VALUES (:firstname,:lastname,:password,:email,:tel,:url,:message)';
            $bdd->prepare($insertion)->execute($data);

            // 4. Display the response interface.
            if ($bdd == true) {
                echo 'les données ont bien été enregistrées!<hr>';
            }
        }
        ?>
    </div>
</body>
</html>