<?php

include_once 'src/database/DatabaseConnector.php';
class DatabaseConverter
{
    private DatabaseConnector $databaseConnector;
    public function __construct()
    {
        $this->databaseConnector = new DatabaseConnector();
    }

    public function convertData(string $tableName, string $primaryKeyFieldName, array $mappedItem): bool
    {
        if ($this->doesRowExist($tableName, $primaryKeyFieldName, $mappedItem[$primaryKeyFieldName])){
            return $this->editData($tableName,$primaryKeyFieldName,$mappedItem);
        }
        return $this->insertData($tableName, $mappedItem);
    }

    public function insertData(string $tableName, array $mappedItem): bool{
        $fieldsString = '';
        $valuesString = '';
        foreach ($mappedItem as $fieldName => $fieldValue){
            $fieldValue = $this->encodeString($fieldValue);

            $fieldsString .= $fieldName . ',';
            $valuesString .= '"' . $fieldValue . '",';
        }

        $fieldsString = rtrim($fieldsString,',');
        $valuesString = rtrim($valuesString,',');
        $sql = 'INSERT INTO ' . '`' . $tableName . '`' . ' (' . $fieldsString . ') VALUES(' . $valuesString . ')';

        if($this->databaseConnector->execute($sql) === false){
            return false;
        }

        return true;
    }

    public function editData(string $tableName, string $primaryKeyFieldName, array $mappedItem): bool{
        $updatedColumnString = '';

        foreach ($mappedItem as $column => $value){
            $value = $this->encodeString($value);
            $updatedColumnString .= $column . '="' . $value . '",';
        }
        $updatedColumnString = rtrim($updatedColumnString, ',');

        $sql = 'UPDATE' . ' ' . '`' . $tableName . '`' . ' ' . 'SET' . ' ' . $updatedColumnString . ' ' . 'WHERE ' . $primaryKeyFieldName . '="' . $mappedItem[$primaryKeyFieldName] . '"';
        if($this->databaseConnector->execute($sql) === false){
            return false;
        };

        return true;
    }

    public function doesRowExist(string $tableName, string $primaryKeyFieldName, mixed $primaryKeyFieldValue)  {
        $output = $this->databaseConnector->execute('SELECT * FROM' . ' ' . '`' . $tableName . '`' . ' ' . 'WHERE ' . $primaryKeyFieldName . '="' . $primaryKeyFieldValue . '"')->fetchAll();
        if(count($output) > 0){
            return true;
        }
        return false;
    }

    public function encodeString(string $string): string{
        return trim(htmlspecialchars($string, ENT_QUOTES));
    }
    public function decodeString(string $string): string{
        $string = trim($string);
        return htmlspecialchars_decode($string,ENT_QUOTES);
    }
}