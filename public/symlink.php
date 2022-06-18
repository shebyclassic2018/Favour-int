<?php 
    echo $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/../beta_homes/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/test/storage';
    echo $linkFolder;
    
    symlink($targetFolder,$linkFolder);
    echo 'Symlink process successfully completed';