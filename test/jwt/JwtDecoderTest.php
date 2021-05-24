<?php
require_once("minesweeper/src/jwt/Jwt.php");

class JwtTest extends \PHPUnit\Framework\TestCase {
    public function testAdd(){
        create_jwt("bc", "cd");
    }
}