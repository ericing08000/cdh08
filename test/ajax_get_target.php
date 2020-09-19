<?php

if(!empty($_GET)){

    $text = strip_tags($_GET['text']);
    $length = strlen($text);

    echo 'Le texte compte '.$length.' caractères';
    
}
    
?>
