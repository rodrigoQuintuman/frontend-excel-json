<?php
include 'db.php';

class User extends DB{
    private $nombre;
    private $correo;


    public function userExists($correo, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE correo = :correo AND password = :pass');
        $query->execute(['correo' => $correo, 'pass' => $md5pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE correo = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->correo = $currentUser['correo'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>