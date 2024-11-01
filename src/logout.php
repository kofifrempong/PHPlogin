<?php
session_start();
session_destroy();

   
echo '<script>
alert("Logged out");
window.location.href = "login.php";
</script>';
?>