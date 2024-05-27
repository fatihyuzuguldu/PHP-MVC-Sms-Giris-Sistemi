<?php

require_once '../Core/Database.php';

class Users
{
    use Database;

    private $table = 'users';

    public function getAll()
    {
        $query = "SELECT * FROM {$this->table}";
        return $this->query($query);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->get_row($query, ['id' => $id]);
    }

    public function create($data)
    {
        $query = "INSERT INTO {$this->table} (UserPhone, UserEmail, UserFullName, UserPassword, UserRole) VALUES (:UserPhone, :UserEmail, :UserFullName, :UserPassword, :UserRole)";
        return $this->query($query, $data);
    }

    public function update($id, $data)
    {
        $data['id'] = $id;
        $query = "UPDATE {$this->table} SET UserPhone = :UserPhone, UserEmail = :UserEmail, UserFullName = :UserFullName, UserPassword = :UserPassword, UserRole = :UserRole, UserUpdatedAt = NOW() WHERE id = :id";
        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->query($query, ['id' => $id]);
    }
}
