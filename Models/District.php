<?php

class District extends BaseModel{
    const TABLE = 'districts';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
}