<?php
define('method','aes-256-cbc');
define('iv','k193jsxm1sak14m1');
define('key','bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=');

function my_encrypt($data){    
    return openssl_encrypt($data, method, key, 0,iv);    
}

function my_decrypt($data){
    return openssl_decrypt($data, method, key, 0, iv);        
}

?>
