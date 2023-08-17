<?php

namespace Core;

use Core\Contracts\DatabaseInterface;
use Exception;
use PDO;

/**
 * Class for Database operations
 * It can connect to DB and base CRUD operations
 */
class Database implements DatabaseInterface
{

    /**
     * PHP Data Object (PDO)
     * 
     * @var PDO
     */
    private PDO $pdo;

    public function __construct(array $c)
    {
        $host = $c['host'];
        $dbname = $c['base'];
        $pass = $c['pass'];
        $user = $c['user'];

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "DB connection failed: " . $e->getMessage();
            die;
        }
    }

    /**
     * @inheritdoc
     */
    public function getRows(string $query): array
    {
        try {
            $stmt = $this->pdo->query($query);
            $result = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    /**
     * @inheritdoc
     */
    public function getRowBy(
            int $idValue,
            string $table,
            string $by = 'id'
    ): array|null
    {
        try {

            $query = "SELECT * FROM $table WHERE $by = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':' . $by, $idValue, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $row;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    /**
     * @inheritdoc
     */
    public function getRowById(int $id, string $table): array|null
    {
        return $this->getRowBy($id, $table, 'id');
    }

    /**
     * @inheritdoc
     */
    public function insertRow(string $table, array $data, array $fields): bool
    {
        try {
            if (empty($data) || empty($fields)) {
                throw new Exception("Data and fields arrays must not be empty.");
            }

            $fieldsetFields = implode(', ', $fields);
            $fieldsetValues = ':' . implode(', :', $fields);

            $query = "INSERT INTO $table ($fieldsetFields) VALUES ($fieldsetValues)";

            $stmt = $this->pdo->prepare($query);

            foreach ($data as $field => $value) {
                if (in_array($field, $fields)) {
                    $stmt->bindValue(':' . $field, $value);
                }
            }

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception("Insert failed: " . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function updateRow(
            string $table,
            array $data,
            array $fields,
            int $id
    ): bool
    {

        try {
            if (empty($data) || empty($fields)) {
                throw new Exception("Data and fields arrays must not be empty.");
            }

            $setFields = '';
            foreach ($fields as $field) {
                if (array_key_exists($field, $data)) {
                    $setFields .= "$field = :$field, ";
                }
            }
            $finalSetFields = rtrim($setFields, ', ');

            $query = "UPDATE $table SET $finalSetFields WHERE id = :id";

            $stmt = $this->pdo->prepare($query);

            foreach ($data as $field => $value) {
                if (array_key_exists($field, $data)) {
                    $stmt->bindValue(':' . $field, $value);
                }
            }
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Update failed: " . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function deleteRowById(string $table, int $id): bool
    {
        try {
            $query = "DELETE FROM $table WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Delete failed: " . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function deleteRowsByField(
            string $table,
            string $fieldName,
            string $fieldValue
    ): bool
    {
        try {
            $query = "DELETE FROM $table WHERE $fieldName = :value";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':value', $fieldValue);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Delete failed: " . $e->getMessage());
        }
    }
}
