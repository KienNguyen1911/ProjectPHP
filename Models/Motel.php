<?php

class Motel extends BaseModel{
    const TABLE = 'motels';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
}