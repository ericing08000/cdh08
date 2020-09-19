<?php

$pseudoUser = htmlspecialchars($_POST['pseudoUser'], ENT_QUOTES);

// sleep(2);

$login = array('eric');

if(in_array($pseudoUser,$login)){
    echo'le pseudo existe déjà';
}else{
    echo'le pseudo est libre';
}

?>