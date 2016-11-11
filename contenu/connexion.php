<?php
include '../inc/header.php';
?>

<?php

if(isset($_POST['formconn']))



{

    $pseudoconn = htmlspecialchars($_POST['pseudoconn']); //Correspond au nom du champ formulaire
    $mdpconn = sha1($_POST['mdpconn']); // Idem, avec en + sha1 = Cryptage mdp

    //Si la variable mailconnect et mdpconnect n'est pas vide, on peux continuer.
    if(!empty($pseudoconn) AND !empty($mdpconn))
    {
        //On vérifie que l'utilisateur existe.
        $requser = $db->prepare("SELECT * FROM utilisateurs WHERE pseudo_utilisateur = ? AND mdp_utilisateur = ?");

        //On execute la requête
        $requser->execute(array($pseudoconn,$mdpconn));

        //rowcount, petite fonction pour compter le nbres de colonnes.
        $userexist = $requser->rowCount();

        if($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id_utilisateur'];
            $_SESSION['pseudo'] = $userinfo['pseudo_utilisateur'];
            $_SESSION['mdp'] = $userinfo['mdp_utilisateur'];




            header("location: profil.php?id=" .$_SESSION['id']);
        }
        //Sinon, la variable erreur sera égale à :
        else {
            $erreur = "Mauvais mail ou mot de passe";
        }

    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <br><h1>Connectez-vous</h1><br>

        </div>
    </div>


    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <form method="post" action="">

                <div class="form-group">
                    <label for="pseudo">Pseudo:</label>
                    <input type="text" class="form-control" name="pseudoconn" id="pseudo">
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe:</label>
                    <input type="password" class="form-control" name="mdpconn" id="mdp">
                </div>

                <input type="submit" class="form-control" value="Envoyer" name="formconn">
            </form>
            <?php

            if(isset($erreur)) {

                echo '<br /><font color="red">' . $erreur . '</font>';

            }




            ?>

        </div>
    </div>


