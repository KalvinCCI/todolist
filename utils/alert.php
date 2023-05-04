<?php 
if(session_status() === PHP_SESSION_NONE) session_start();
if(isset($_SESSION['alert'])) :
?>
<aside class="alert">
    <p><?=$_SESSION['alert']?></p>
    <button type="button" onclick="document.body.removeChild(this.parentNode)">Fermer</button>
</aside>
<?php 
    unset($_SESSION['alert']);
endif 
?>
