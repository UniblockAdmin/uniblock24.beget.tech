<?

function parseRole($wallet,$sender,$rec){
    if($wallet == $sender){
        return 0;
    }else{
        return 1;
    }
}

?>