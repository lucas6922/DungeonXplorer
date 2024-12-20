<?php

require_once 'database/connexion_db.php';


class Classe{

    public static function getAll(){
        $conn = connect_db();

        $rqp = $conn->query('SELECT * FROM class');
        return $rqp->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($cla_id){
        $conn = connect_db();

        $rqp = $conn->prepare('SELECT * FROM class WHERE cla_id = ?');
        $rqp->execute([$cla_id]);
        return $rqp->fetch(PDO::FETCH_ASSOC);
    }
}
