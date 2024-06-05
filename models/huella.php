<?php
// models/huella.php

class Huella {
    private $db;

    public function __construct() {
        $this->db = new Conexion();
    }

    // Método para insertar una nueva huella en la base de datos
    public function insertarHuella($id_estudiante, $huella_template) {
        $query = "INSERT INTO huellas (id_estudiante, huella_template) VALUES (:id_estudiante, :huella_template)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id_estudiante", $id_estudiante);
        $stmt->bindParam(":huella_template", $huella_template, PDO::PARAM_LOB);
        return $stmt->execute();
    }
}
?>
