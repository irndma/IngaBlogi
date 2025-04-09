<?php
class Db {
    private $con; // Ühendus salvestatakse siia

    function __construct() {
        $this->con = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME); // this on nagu ptyhoni self
        if($this->con->connect_error) {
            echo "<strong>Viga andmebaasiga:</strong> " .$this->con->connect_error;
        } else {
            mysqli_set_charset($this->con, "utf8"); // Seadistame andmebaasi kodeeringu
        }

    }

    # UPDATE, INSERT või DELETE sql lausete jaoks
    function dbQuery($sql) {
        if($this->con) {
            $res = mysqli_query($this->con, $sql); // Käivita sql lause
            if($res == false) {
                echo "<div>Vigane päring: " .htmlspecialchars($sql). "</div>";
                return false;
            }
            return $res; // Tagasta päringu tulemus
        }
        return false; // Tagasta vale, kui ühendust pole
    }

    # SELECT sql lause jaoks
    function dbGetArray($sql){
        $res = $this->dbQuery($sql); 
        if($res != false) {
            $data = array(); // Loo tühi massiiv
            while($row = mysqli_fetch_assoc($res)) {
                $data[] = $row; // Lisa massiivi uus rida
            }
            return (!empty($data)) ? $data : false; // Tagasta data või vale. Hüüumärk on eitus
        }
        return false; // Tagasta vale, kui ühendust pole
    }

    # $_POST (vormi andmed) / $_GET (URL andmed) väärtuse tagastamine 
    function getVar(string $name, ?string $method = null) {
        if($method == 'post') {
            return $_POST[$name] ?? null; // Tagasta POST väärtus või null, kui pole olemas
        } elseif($method == 'get') {
            return $_GET[$name] ?? null; // Tagasta GET väärtus või null, kui pole olemas
        } else {
            return $_POST[$name] ?? $_GET[$name] ?? null; 
        }
    }

    # Sisendi turvalisemaks muutmine
    function dbFix($var) {
        if(!$this->con || !($this->con instanceof mysqli)) { // || võ<i>
            return 'NULL';
        }

        if(is_null($var)) {
            return 'NULL'; // Tagasta NULL, kui väärtus on tühi
        } elseif(is_bool($var)) {
            return $var ? '1' : '0'; // Tagasta 1 või 0, kui väärtus on boolean
        } elseif(is_numeric($var)) {
            return $var; // Tagasta numbriline väärtus
        } else {
            return $this->con->real_escape_string($var); // Tagasta turvaline väärtus
        }
    }

    # Inimlikul kujul massiivi sisu vaatamine
    function show($array) {
        echo "<pre>";
        print_r($array); // Prindi massiiv
        echo "</pre>";
    }

} // class Db lõpp