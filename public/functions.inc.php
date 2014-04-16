<?
function myRand($max){
    do{
        $result = floor($max*(hexdec(bin2hex(openssl_random_pseudo_bytes(4)))/0xffffffff));
    }while($result == $max);
    return $result;
}
function hashsalt($password, $salt){
	$hash=hash('sha256',hash('sha256',$password.$salt));
	return $hash;
}
?>
