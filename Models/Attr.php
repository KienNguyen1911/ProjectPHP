
<?php 
class Attr extends BaseModel{
    CONST TABLE = 'attributes';

    public function __construct() {
        $this->table = self::TABLE;
    }

}