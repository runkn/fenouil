<?php

$db = new PDO('mysql:host=localhost;dbname=grostest', 'root', 'root');

if(isset($_POST['form_inscription'])) {
    $nom = htmlspecialchars($_POST['nom_utilisateur']);
    $prenom = htmlspecialchars($_POST['prenom_utilisateur']);
    $mail = htmlspecialchars($_POST['email_utilisateur']);
    $mail2 = htmlspecialchars($_POST['email2_utilisateur']);
    $pseudo = htmlspecialchars($_POST['pseudo_utilisateur']);
    $mdp = sha1($_POST['mdp_utilisateur']);
    $mdp2 = sha1($_POST['mdp2_utilisateur']);

    if(!empty($_POST['nom_utilisateur']) AND !empty($_POST['prenom_utilisateur']) AND !empty($_POST['email_utilisateur']) AND !empty($_POST['email2_utilisateur']) AND !empty($_POST['pseudo_utilisateur']) AND !empty($_POST['mdp_utilisateur'])AND !empty($_POST['mdp2_utilisateur'])) {
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 255) {
            if($mail == $mail2) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $db->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    $reqpseudo = $db->prepare("SELECT * FROM utilisateurs WHERE pseudo_utilisateur = ?");
                    $reqpseudo->execute(array($pseudo));
                    $pseudoexist = $reqpseudo->rowCount();

                    if($pseudoexist == 0) {
                        if($mailexist == 0) {
                            if ($mdp == $mdp2) {
                                $insertmbr = $db->prepare("INSERT INTO utilisateurs(id_role_utilisateur, nom_utilisateur, prenom_utilisateur, email_utilisateur, pseudo_utilisateur, mdp_utilisateur) VALUES(2,?, ?, ?, ?, ?)");
                                $insertmbr->execute(array($nom, $prenom, $mail, $pseudo, $mdp));


                                $erreur = "Votre compte a bien été créé !";

                            } else {
                                $erreur = "Vos mots de passes ne correspondent pas !";
                            }
                        }
                    } else {
                        $erreur = "Votre pseudo déjà utilisée !";
                    }
                } else {
                    $erreur = "Votre mail est déjà utilisé";
                }
            } else {
                $erreur = "Vos adresses mail ne correspondent pas !";
            }
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

<form method="POST" id="form_inscription">

    <div class="form-group">
        <label for="nom_utilisateur">Nom :</label><br/>
        <input type="text" placeholder="Votre Nom" name="nom_utilisateur"  value="<?php if(isset($nom)){
            echo $nom;
        } ?>" />
    </div>
    <div class="form-group">
        <label for="prenom_utilisateur">Prénom :</label><br/>
        <input type="text" placeholder="Votre prénom" name="prenom_utilisateur" value="<?php if(isset($prenom)){
            echo $prenom;
        } ?>" />
    </div>
    <div class="form-group">
        <label for="email_utilisateur">Email :</label><br/>
        <input type="text" placeholder="Votre email" name="email_utilisateur" value="<?php if(isset($mail)){
            echo $mail;
        } ?>" />
    </div>
    <div class="form-group">
        <label for="email2_utilisateur">Email :</label><br/>
        <input type="text" placeholder="Votre email" name="email2_utilisateur" value="<?php if(isset($mail2)){
            echo $mail2;
        } ?>" />
    </div>
    <div class="form-group">
        <label for="pseudo_utilisateur">Pseudo :</label><br/>
        <input type="text" placeholder="Votre pseudo" name="pseudo_utilisateur" value="<?php if(isset($pseudo)){
            echo $pseudo;
        } ?>" />
    </div>
    <div class="form-group">
        <label for="mdp_utilisateur">Mdp :</label><br/>
        <input type="password" placeholder="Votre mdp" name="mdp_utilisateur" />
    </div>
    <div class="form-group">
        <label for="mdp2_utilisateur">Mdp2 :</label> <br/>
        <input type="password" placeholder="Veuillez confirmer votre mdp" name="mdp2_utilisateur" />
    </div>
    <div class="form-group">
        <input type="submit" name="form_inscription" value="S'inscrire !" />
    </div>


</form>
<br/>
<?php

if(isset($erreur)) {

    echo $erreur;

}

?>
</br.>