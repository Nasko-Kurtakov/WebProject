<?php

namespace libs;

use \PDO;

class Db
{
    private $conn;

    public function __construct()
    {
        $host = CONFIG['db']['host'];
        $db = CONFIG['db']['name'];
        $user = CONFIG['db']['user'];
        $pass = CONFIG['db']['password'];
        $charset = CONFIG['db']['charset'];

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->conn = new PDO($dsn, $user, $pass, $opt);
    }

    public function getConn()
    {
        return $this->conn;
    }

//    public function insertDiscipline(string $title,string $lecturer,string $desc): void
//    {
//        $statement = $this->conn->prepare("INSERT INTO `electives` (title, description, lecturer) VALUES (?, ?, ?) ");
//        $statement->execute([$title, $desc, $lecturer]);
//    }
//
//    public function getDiscipline(int $id): Discipline
//    {
//        $stmt = (new Db())->getConn()->prepare("SELECT * FROM `electives` WHERE id = ?");
//        $result = $stmt->execute([$id]);
//        $disciplineEntity = $stmt->fetch();
//        if(!$disciplineEntity)
//            throw new \Exception("Cannot find elective with id:$id");
//        return new Discipline($id,$disciplineEntity['title'],$disciplineEntity['lecturer'],$disciplineEntity['description']);
//    }
//
//    public function editDiscipline(Discipline $discipline):bool {
//        $statement = $this->conn->prepare("UPDATE `electives`
//        SET title = ?, description = ?, lecturer = ?
//        WHERE `id` = ?");
//        return $statement->execute([$discipline->getTitle(), $discipline->getDescription(), $discipline->getLecturerName(),$discipline->getID()]);
//    }
}