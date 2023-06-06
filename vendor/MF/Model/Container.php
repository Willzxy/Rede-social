<?php

namespace MF\Model;

use App\Connection;

class Container {
    public static function getModel($model){
        $classe = '\\App\\Models\\'.ucfirst($model);
        $connection = Connection::getDb();
        
        return new $classe($connection);
    }
}

?>