<?

// funcao de replace
function sanitizeString($string) {

    // matriz de entrada
    $entrada = array( 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

    // matriz de saída
    $saida   = array( 'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','a','a','e','i','o','u','n','n','c','c','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );

    // devolver a string
    return str_replace($entrada, $saida, $string);
}

// funcao de pegar a ultima palavra
function explodeString($string){
    
    // faz um array
    $inicioString = explode(" ",$string);

    // pega a ultima palavra
    $ultimaPalavra = end($inicioString);

    //devolve a string
    return $ultimaPalavra;
}


?>