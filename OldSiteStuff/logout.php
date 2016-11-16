<?php
setcookie ("user", "", time()-60000);
setcookie ("userid", "", time()-60000);
header("Location: index.php");
?>