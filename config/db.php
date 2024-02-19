<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=combat', 'root', '');
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
