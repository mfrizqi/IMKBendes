<?php 
	session_start();
    include "koneksi.php";
    $email = $_SESSION['email'];
    $comment = $_POST['comment1'];
    $id = $_POST['idcomment'];
    $sql = mysqli_query($conn,"INSERT INTO `comment`(`email`, `materi`, `idcomment`, `isicomment`, `idreply`,`isireply`) VALUES ('$email','atribut','','','$id','$comment')");
    header("Location: diskusi.php");

?>