<?php


namespace app\models;


use app\core\DbModel;

class User extends DbModel
{
    public string $first_name = '';
    public string $last_name = '';
    public string $phone_number = '';
    public string $address = '';

    public function getTableName(): string
    {
        return 'users';
    }

    public function getAttributes(): array
    {
        return ['first_name', 'last_name', 'phone_number', 'address'];
    }

    public function rules(): array
    {
        return [
            'first_name'       => [self::RULE_REQUIRED],
            'last_name'        => [self::RULE_REQUIRED],
            'phone_number'     => [self::RULE_REQUIRED],
            'address'          => [self::RULE_REQUIRED],
        ];
    }

    public function getLabel(): array
    {
        return [
            'first_name'       => 'Full name',
            'last_name'        => 'Surname',
            'phone_number'     => 'Phone number',
            'address'          => 'Full address',
        ];
    }


    public function selectAllUsers()
    {
//        $stmt = $this->prepareStatement("
//                SELECT users.id, users.first_name, users.last_name, users.phone_number,
//                        countries.country,
//                        addresses.city, addresses.zip_code, addresses.address_line_1, addresses.address_line_2,
//                        countries.phone_prefix
//                FROM users
//                JOIN addresses ON users.address_id = addresses.id
//                JOIN countries ON countries.id = addresses.country_id;
//         ");

        $stmt = $this->prepareStatement("SELECT * FROM users");
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectUser(int $id)
    {
        $stmt = $this->prepareStatement("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function update(int $id)
    {
        $tableName = $this->getTableName();
        $attributes = $this->getAttributes();
        $params = array_map(fn($attr) => ":{$attr}", $attributes);

        $sqlArr = array_combine($attributes, $params);

        $count = count($sqlArr);

        $sql = "UPDATE {$tableName} SET ";
        foreach ($sqlArr as $attr => $param){
            if (--$count <= 0) {
                $sql .= $attr . ' = ' . $param;
            } else {
                $sql .= $attr . ' = ' . $param . ', ';
            }
        }
        $sql .= " WHERE id = :id;";

        $stmt = $this->prepareStatement($sql);

        $stmt->bindValue(":id", (int)$id);

        foreach ($attributes as $attribute){
            $stmt->bindValue(":{$attribute}", $this->{$attribute});
        }

        $stmt->execute();
        return true;
    }

    public function delete(int $id)
    {
        $tableName = $this->getTableName();

        $stmt = $this->prepareStatement("DELETE FROM {$tableName} WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return true;
    }
}