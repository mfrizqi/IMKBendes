<?php 
	session_start();
    include "koneksi.php";
    $email = $_SESSION['email'];
    $comment = $_POST['comment'];
    $id = $_SESSION['idcomment'];
    $sql = mysqli_query($conn,"INSERT INTO `comment`(`email`, `materi`, `iduser`, `isicomment`) VALUES ('$email','atribut','u$id','$comment')");
    header("Location: diskusi.php");

?>
