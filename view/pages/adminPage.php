<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="view/css/menu.css">
    <link rel="stylesheet" type="text/css" href="view/css/styles.css">
    <link rel="stylesheet" type="text/css" href="view/css/stylesA.css">
    <link rel="stylesheet" type="text/css" href="view/css/stylesResponsiv.css">
    <title>Admin</title>
</head>

<body>
   
    <section id="adminPannel">
        <article id="WrittingChap">

            <h2><span class="maj">é</span>crire un nouveau chapitre:</h2>

            <form id="getNewChapter" action="./index.php?action=postChap" method="post">

                <label>Titre:<input type="text" name="title" id="title" value="" required /></label>

                <textarea class="tinymce" name="tinymce_Chap"></textarea>

                <input type="submit" id="send" value="Publier" />
            </form>
        </article>

        <aside id="gestionBlock">

            <div id="CommAdmin">
                <h2> Liste des commentaires à vérifier:</h2>
                <?php
                
						while ($listReportedComm = $reportedComments->fetch() ) {
                            
					?>
                <p class="warning"><strong>Message:</strong>
                    <?= nl2br($listReportedComm['contenu']);?> <br />
                    <?php echo htmlspecialchars($listReportedComm['date_poste']);?>

                    <span id="deletButton">
                        <a href="./index.php?action=deleteComm&amp;id=<?php echo $listReportedComm['id_comm']; ?>">Supprimer</a>
                    </span>
                    <span id="okButton">
                        <a href="./index.php?action=commentChecked&amp;id=<?php echo $listReportedComm['id_comm']; ?>">Valider</a>
                    </span>
                </p>

                <?php
						}
              
							$reportedComments-> closeCursor();
                
					?>

            </div>
            <div id="line_Ink">
                <!--Ink line add in css-->
            </div>
            <div id="ChapAdmin">
                <h2> Liste des chapitres déjà publié:</h2>
                <?php
						while ($list=$listChapters->fetch() ) {
					?>
                <p class="warning">
                    <?php echo $list['titre']?>

                    <span id="deleteChap">
                        <a href="./index.php?action=eraseChap&amp;id=<?php echo $list['id']; ?>"> Effacer</a>
                    </span>
                    <span id="changeButton">
                        <a href="./index.php?action=editChap&amp;id=<?php echo $list['id']; ?>">Modifier</a>
                    </span>

                    <br />
                </p>
                <?php
							}
							$listChapters->closeCursor();
						?>

            </div>
        </aside>

    </section>

</body>

</html>
