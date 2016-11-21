<?php
include '../inc/header.php';

if ($_SESSION['role'] != 1)
{
    header('location: ../index.php?oh=oui');
}


$brouillonn = 0 ;

if (isset($_POST['form'])) {
    if (!empty($_POST['titren']) AND !empty($_POST['texten']) AND !empty($_POST['daten']) AND !empty($_POST['selectcat'])) {

        if (isset($_POST['brouillon'])) {
            $brouillonn = 1;
        }

        else
        {
            $brouillonn = 0;
        }





        $titren = htmlspecialchars($_POST['titren']);
        $texten = htmlspecialchars($_POST['texten']);
        $catp = $_POST['catp'];
        $daten = $_POST['daten'];
        $categorien = $_POST['selectcat'];
        $auteur = $_SESSION['id'];




        if(isset($_FILES['image'])){
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            $tmp = explode('.',$_FILES['image']['name']);
            $file_ext=strtolower(end($tmp));

            $expensions= array("jpeg","jpg","png");


            $categ = intval($categorien);
            $narticle = $db->prepare('INSERT INTO articles (id_categorie_article, titre_article, txt_article, date_article, brouillon_article, id_utilisateur_article, catp_article, img_article) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $narticle->execute(array($categ, $titren, $texten, $daten, $brouillonn, $auteur, $catp, $file_name));

            header("Location: admin.php?published=yes");

        } else {
            echo 'veuillez remplir tous les champs.';
        }


        if(in_array($file_ext,$expensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
        }

        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"images/".$file_name);

            echo "Image Uploadé !";
        }else{
            print_r($errors);
        }
    }

}
?>


    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <h1>Ecrire un nouvel article : </h1><br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-6">
                <div class="well">


                    <form method="POST" id="form">
                        <div class="form-group">
                            <label for="titren">Titre:</label>
                            <input type="text" class="form-control" name="titren" id="titren"/>
                        </div>
                        <div class="form-group">
                            <label for="daten">Date:</label>
                            <input type="date" class="form-control" name="daten" id="daten"/>
                        </div>
                        <div class="form-group">
                            <label for="texten">Texte:</label>
                            <textarea rows="4" cols="50" class="form-control" name="texten"id="texten"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categorien">Categorie:</label>
                            <select name="selectcat" id="selectcat">
                                <?php

                                $reqcattn = $db->query("SELECT * from categories");


                                while ($row = $reqcattn->fetch())
                                {

                                    ?>
                                    <option value="<?=$row['id_categorie']?>" name="categorie" id="categorie"><?=ucfirst($row['nom_categorie']) ?></option>

                                    <?php

                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="catp">Categorie principale:</label>
                            <select id="catp" name="catp">
                                <option value="sucre">Sucré</option>
                                <option value="sale">Salé</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brouillon">Brouillon</label>
                            <input type="checkbox" id="brouillon" name="brouillon" value="">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control" name="form" value="Envoyer" />
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>


<?php include '../inc/footer.php'; ?>
