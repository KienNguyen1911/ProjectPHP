<?php

class Province extends BaseModel{
    const TABLE = 'provinces';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
}