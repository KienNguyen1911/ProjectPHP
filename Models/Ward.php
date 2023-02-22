<?php
class Ward extends BaseModel{
    const TABLE = 'wards';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
}