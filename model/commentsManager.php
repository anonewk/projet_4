<?php

require_once("manager.php");

class CommentsManager extends Manager
{
	public function getComments(){//This function will return every comment on the chapter it belong.
		$bdd=$this->dbConnect();
		$idPage=$_GET['id'];
			$comments=$bdd->prepare('SELECT id_comm,id_chap,contenu,warning_comm,date_format(date_poste,"%d.%m.%y") AS date_poste_fr FROM commentaires WHERE id_chap=:id_chap ');
		$comments->execute(array(
						'id_chap'=>$idPage
					));
		return $comments;
     
	}


	public function addComment($textComment,$idChap){
		$bdd=$this->dbConnect();
		
		$newComm=$bdd->prepare('INSERT INTO commentaires (id_chap, contenu, date_poste) VALUES(:id_chap, :contenu, NOW()) ');

	$newComm->execute(array(
                ':contenu'=>$textComment,
                ':id_chap'=>$idChap
        
			
		));

		$newComm=$bdd->query('SELECT id_chap, contenu, date_poste FROM commentaires');
			
		header("Location:./index.php?action=selectionchapitre&id=$idChap");
	}

	 public function signalComm($warningComm,$idChap){// This function will reported a comment, and update it status in the database.
		$bdd=$this->dbConnect();
		$pbComm=$bdd->prepare('UPDATE commentaires SET warning_comm=1 WHERE id_comm=:id_comm');
		$pbComm->execute(array(
			'id_comm'=> $warningComm
		));
		
		header("Location:./index.php?action=chapitres");
	 }

	public function getReportingComments(){// In the admin section, It will list all the comments reported.
		$bdd=$this->dbConnect();
    $reportedComm=$bdd->query('SELECT * FROM commentaires WHERE warning_comm > 0');
		return $reportedComm;
	}

	public function deleteComment($id_comm){// In the admin section, Admin will deleted the comment which was reported.
		$bdd=$this->dbConnect();
		$dltComm=$bdd->prepare('DELETE FROM commentaires WHERE id_comm=?');
		$eraseComm=$dltComm->execute(array($id_comm));
		header("Location:./index.php?action=adminPage");
	}
	public function commentValidation($id_comm){//In the admin section, Admin will return the comment to it chapter.
		$bdd=$this->dbConnect();
		$pbComm=$bdd->prepare('UPDATE commentaires SET warning_comm=0 WHERE id_comm=:id_comm');
		$pbComm->execute(array(
			'id_comm'=> $id_comm
		));
		header("Location:./index.php?action=adminPage");
	}
	public function deleteAllComments($idChapter){//This function will deleted ALL the comments in One chapter.
		$bdd=$this->dbConnect();
		$dltAllComms=$bdd->prepare('DELETE FROM commentaires WHERE id_chap=?');
		$eraseComms=$dltAllComms->execute(array($idChapter));
		header("Location:./index.php?action=admin");
	}
}