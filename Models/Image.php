<?php
class Image extends BaseModel {
    const TABLE = 'images';

    public function __construct() {
        $this->table = self::TABLE;
    }
    
}