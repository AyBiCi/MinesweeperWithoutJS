<?php namespace Minesweeper\Jwt\JwtDecoder;

class JwtDecoder{
    private $header_base64;
    private $content_base64;
    private $signature;

    public function __constructor($jwt){
       if(check($jwt)){
           $jwt_parts = partJwt($jwt);
           $header_base64 = $jwt_parts[0];
           $content_base64 = $jwt_parts[1];
           $signature = $jwt_parts[2];
       }
    }

    public function getHeader(){
        return base64_decode($header_base64);
    }

    public function getContent(){
        return base64_decode($content_base64);
    }

    private static function check($jwt){
        $jwt_parts = partJwt($jwt);
        if(count($jwt_parts) != 3) return false;
        $header_base64 = $jwt_parts[0];
        $content_base64 = $jwt_parts[1];
        $signature = $jwt_parts[2];
        return calculateSignature($header_base64, $content_base64) === $signature;
    }

    private static function calculateSignature($header_base64, $content_base64){
        return hash("sha256", $header_base64 . $content_base64 . "secret");
    }

    private static function partJwt($jwt){
        return explode(".", $jwt);
    }
}