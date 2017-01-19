<?php

namespace ZipCodesREST\Database;

class GermanDatabase extends AbstractDatabase
{
    /**
     * Selects zipcodes, states and names depending on their town names
     *
     * @param string $name
     * @return array
     */
    function selectByName(string $name): array
    {
        return $this->query('Ort', $name);
    }

    /**
     * Selects names, states and zipcodes depending on their zipcodes
     *
     * @param int $zipCode
     * @return array
     */
    function selectByZipCode(int $zipCode): array
    {
        return $this->query('Plz', $zipCode);
    }

    /**
     * @param string $where
     * @param string $value
     * @return array
     */
    protected function query(string $where, string $value): array
    {
        $stmt = $this->db->prepare(
            "SELECT Plz, Bundesland, Ort FROM germany WHERE $where LIKE :placeholder LIMIT $this->returnLimit"
        );
        $stmt->bindValue(':placeholder', "$value%");
        $stmt->execute();

        $tmp = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $tmp;
    }
}