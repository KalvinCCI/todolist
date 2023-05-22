<?php require_once '../assets/blobs/session.php' ?>
<?php
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    $_SESSION['alert'] = 'S: User disconnected !';
} else {
    $_SESSION['alert'] = 'E: Can\'t disconnect if you\'re not connected !';
}

header('Location: index.php');
exit();