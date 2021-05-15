<?php
include("config.php");

function create_jwt($header, $content){
    $header_base64 = base64_encode($header);
    $content_base64 = base64_encode($content);
    $signature = calculate_signature($header_base64, $content_base64);
    return $header_base64 . "." . $content_base64 . "." . $signature;
}

function check_jwt($jwt){
    $jwt_parts = preg_split("/\./");
    if(count($jwt_parts) != 3) return false;
    $header_base64 = $jwt_parts[0];
    $content_base64 = $jwt_parts[1];
    $signature = $jwt_parts[2];
    return calculate_signature($header_base64, $content_base64) === $signature;
}

function get_jwt_header($jwt){
    return part_jwt($jwt)[0];
}

function get_jwt_content($jwt){
    return part_jwt($jwt)[1];
}

function calculate_signature($header_base64, $content_base64){
    return hash($jwt_hash_algo, $header_base64 . $content_base64 . $jwt_secret);
}

function part_jwt($jwt){
    return preg_split("/\./", $jwt);
}