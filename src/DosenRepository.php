<?php

require_once "../config/database.php";

class DosenRepository{

    private $pdo;

    public function __construct($pdo){

        $this->pdo = $pdo;
    }

    public function getAll(){

        $stmt = $this->pdo->query("
            SELECT * FROM dosen
            WHERE deleted_at IS NULL
        ");

        return $stmt->fetchAll();
    }

    public function create($data){

        $stmt = $this->pdo->prepare("
            INSERT INTO dosen(
                nidn,
                nama,
                email,
                program_studi,
                foto,
                status
            )
            VALUES(?,?,?,?,?,?)
        ");

        return $stmt->execute([

            $data['nidn'],
            $data['nama'],
            $data['email'],
            $data['program_studi'],
            $data['foto'],
            $data['status']

        ]);
    }
}