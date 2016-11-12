<?php
include '../inc/header.php';
session_start();


?>

<?php


if(isset($_SESSION['id'])) {
    $requser = $db->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    /* echo '<pre>';

        var_dump($user);
    echo '</pre>';*/
    if (isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo_utilisateur']) {

        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $db->prepare("UPDATE utilisateurs SET pseudo_utilisateur = ? WHERE id_utilisateur = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        /*header("Location: profil.php?id=" .$_SESSION['id']);*/
    }
    if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email_utilisateur']) {

        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $db->prepare("UPDATE utilisateurs SET email_utilisateur = ? WHERE id_utilisateur = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        /*header("Location: profil.php?id=" .$_SESSION['id']);*/
    }
    if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {

        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);

        if ($mdp1 == $mdp2) {

            $insertmdp = $db->prepare("UPDATE utilisateurs SET mdp_utilisateur = ? WHERE id_utilisateur = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            /*header("Location: profil.php?id=" . $_SESSION['id']);*/
        } else {
            $msg = "Vos deux mots mdp ne correspondent pas !";
        }
    }

    if (isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $user['pseudo_utilisateur']) {

    header("Location: profil.php?id=" . $_SESSION['id']);

    }

    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Editez votre profil</h1><br>

                <form method="POST" action="" enctype="multipart/form-data">

                    <label>Pseudo :</label>
                    <input type="text" class="form-control" name="newpseudo" placeholder="Pseudo"
                           value="<?php echo $user['pseudo_utilisateur']; ?>"/>
                    <br/> <br/>
                    <label>Mail :</label>
                    <input type="text" name="newmail" class="form-control" placeholder="Mail"
                           value="<?php echo $user['email_utilisateur']; ?>"/>
                    <br/> <br/>
                    <label>Mot de passe :</label>
                    <input type="password" name="newmdp1" class="form-control" placeholder="Mot de passe"/>
                    <br/> <br/>
                    <label>Confirmation - mot de passe :</label>
                    <input type="password" name="newmdp2" class="form-control"
                           placeholder="Confirmation du mot de passe"/>
                 <!--   <br/> <br/>
                    <label>Avatar</label> <br/>
                    <input type="file" class="form-control" name="avatar"/>
                    <br/> <br/>-->
                    <input type="submit" class="form-control" value="Mettre à jour mon profil"/>
                    <br/> <br/>

                </form>
                <br/>
            </div>
        </div>
    </div>

    </body>
    </html>
    <?php
}
else {
    header('Location:connexion.php');
}

?>