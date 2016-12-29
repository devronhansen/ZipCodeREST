<?php

namespace ZipCodesREST\database;

class GermanDatabase extends AbstractDatabase
{
    /**
     * GermanDatabase constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Selects zipcodes, states and names depending on their town names
     *
     * @param string $name
     * @return array
     */
    function selectByName(string $name): array
    {
        $stmt = $this->db->prepare(
            "SELECT Plz, Bundesland, Ort FROM germany WHERE Ort LIKE :ort LIMIT $this->returnLimit"
        );
        $stmt->bindValue(':ort', "$name%");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Selects names, states and zipcodes depending on their zipcodes
     *
     * @param int $zipCode
     * @return array
     */
    function selectByZipCode(int $zipCode): array
    {
        $stmt = $this->db->prepare(
            "SELECT Ort, Bundesland, Plz FROM germany WHERE Plz LIKE :zip LIMIT $this->returnLimit"
        );
        $stmt->bindValue(':zip', "$zipCode%");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}