<?php

//All objects that are childs of active records use these functions to work with tables
//all models are objects that work as representations of tables in the DB 

namespace Model;

class ActiveRecord {
    // DB
    protected static $db;
    protected static $columns_db = [];
    protected static $table = '';

    // Validation
    protected static $alerts = [];

    public static function setDB($database){
        self::$db = $database;
    }

    //either inserts or updates data
    public function save(){
        if(!is_null($this->id)){
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }

    //create data
    public function create() {
        $attributes = $this->sanitizeData();
        // Insert data
        $query = "INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";

        $result = self::$db->query($query);
        return [
            'result' =>  $result,
            'id' => self::$db->insert_id
         ];
    }

    //update data
    public function update(){
        // Sanitize inputs
        $attributes = $this->sanitizeData();

        $values = [];
        foreach ($attributes as $key=>$value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $result = self::$db->query($query);
        return $result;
    }
    // Delete a register
    public function delete(){
        $query = "DELETE FROM " . static::$table . " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

    // Identify all the attributes of the object
    public function attributes(){
        $attributes = [];
        foreach (static::$columns_db as $column) {
            if($column === 'id')  continue; 
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    //sanitiza data
    public function sanitizeData(){
        $attributes = $this->attributes();
        $sanitized = [];
        foreach ($attributes as $key=>$value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Validate the inputs
    public static function getAlerts() {
        return static::$alerts;
    }

    //alerts for validation
    public static function setAlerts($type, $message){
        static::$alerts[$type][] = $message;
    }

    //validations
    public function validate(){
        static::$alerts = [];
        return static::$alerts;
    }

    //selects all data form a table
    public static function all(){
        $query = "SELECT * FROM " . static::$table;
        $result = self::querySQL($query);
        return $result;
    }

    //gets an sepecific set of data given a quantity
    public static function get($quantity){
        $query = "SELECT * FROM " . static::$table . " LIMIT " . $quantity;
        $result = self::querySQL($query);
        return $result;
    }

    //where clause
    public static function where($column, $value){
        $query = "SELECT * FROM " . static::$table . " WHERE $column = '$value'";
        // debug($query);
        $result = self::querySQL($query);
        return array_shift($result); // Get the first element of the array
    }

    //finds sepecific data given an id
    public static function find($id){
        $query = "SELECT * FROM " . static::$table . " WHERE id = $id";
        $result = self::querySQL($query);
        return array_shift($result); // Get the first element of the array
    }

    public static function SQL($query){
        $result = self::querySQL($query);
        return $result;
    }

    public static function querySQL($query){
        $result = self::$db->query($query);
        $array = [];
        while($register = $result->fetch_assoc()){
            $array[] = static::createObject($register);
        }
        $result->free(); // Free the memory
        return $array;
    }

    //create an active record object
    protected static function createObject($register){
        $object = new static;
        foreach($register as $key=>$value){
            if(property_exists($object, $key)){
                $object->$key = $value;
            }
        }
        return $object;
    }

    //the following 8 functions all do the same, the only difference is the $query variable
    //each function runs a different mysql query for different needs
    public static function employeeQuery($name, $surname, $rolId, $countryId) {
        $query = "
            SELECT
            e.id,
            CONCAT(e.name, ' ', e.surname) AS Name,
            d.Name AS Department,
            r.rol AS Rol,
            e.hours,
            r.salary,
            c.socialcharge,
            (e.hours * r.salary * (1 - c.socialcharge)) AS CurrentSalary,
            DATE_ADD(e.lastPay, INTERVAL 15 DAY) AS NextPay,
            c.name AS Country
            FROM
                employee e
            JOIN
                rol r ON e.rolId = r.id
            JOIN
                department d ON e.countryId = d.id
            JOIN
                country c ON e.countryId = c.id
            WHERE
                e.name = ? AND
                e.surname = ? AND
                e.rolId = ? AND
                e.countryId = ?
        ";

        $statement = self::$db->prepare($query);

        if ($statement === false) {
            die("Query preparation failed: " . self::$db->error);
        }

        $statement->bind_param("ssii", $name, $surname, $rolId, $countryId);
        $statement->execute();
        $result = $statement->get_result();

        $array = [];
        while ($register = $result->fetch_assoc()) {
            $array[] = static::createObject($register);
        }

        $statement->close();
        return $array;
    }

    public static function employeeQueryAll() {
        $query = "
            SELECT
            e.id,
            CONCAT(e.name, ' ', e.surname) AS Name,
            d.Name AS Department,
            r.rol AS Rol,
            e.hours,
            r.salary,
            c.socialcharge,
            (e.hours * r.salary * (1 - c.socialcharge)) AS CurrentSalary,
            DATE_ADD(e.lastPay, INTERVAL 15 DAY) AS NextPay,
            c.name AS Country
            FROM
                employee e
            JOIN
                rol r ON e.rolId = r.id
            JOIN
                department d ON e.countryId = d.id
            JOIN
                country c ON e.countryId = c.id
            ";
    
            $statement = self::$db->prepare($query);

            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();

            return $array;
        }

        public static function employeeQueryDate($date) {
            $query = "
                SELECT
                e.id,
                CONCAT(e.name, ' ', e.surname) AS Name,
                d.Name AS Department,
                r.rol AS Rol,
                e.hours,
                r.salary,
                c.socialcharge,
                (e.hours * r.salary * (1 - c.socialcharge)) AS CurrentSalary,
                DATE_ADD(e.lastPay, INTERVAL 15 DAY) AS NextPay,
                c.name AS Country
                FROM
                    employee e
                JOIN
                    rol r ON e.rolId = r.id
                JOIN
                    department d ON e.countryId = d.id
                JOIN
                    country c ON e.countryId = c.id
                WHERE
                    DATE_ADD(e.lastPay, INTERVAL 15 DAY) = ? 
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->bind_param("s", $date);
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }

        public static function filterByEmployee() {
            $query = "
            SELECT 
                CONCAT(e.name, ' ', e.surname) AS Name,
                SUM(sl.amount) AS TotalSalaryCost
            FROM 
                salarylog sl
            JOIN 
                employee e ON sl.employeeid = e.id
            GROUP BY 
                sl.employeeId, e.name, e.surname;
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }

        public static function filterByRole() {
            $query = "
            SELECT 
            R.rol AS Name, SUM(S.amount) AS TotalSalaryCost
            FROM salarylog S
            JOIN employee E ON S.employeeId = E.id
            JOIN rol R ON E.RolId = R.id
            GROUP BY R.id
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }

        public static function filterByDepartment() {
            $query = "
            SELECT 
                D.name AS Name,
                SUM(S.amount) AS TotalSalaryCost
            FROM 
                salarylog S
            JOIN 
                employee E ON S.employeeId = E.id
            JOIN 
                rol R ON E.RolId = R.id
            JOIN 
                department D ON R.departmentId = D.id
            GROUP BY 
                D.name
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }

        public static function filterByCountry() {
            $query = "
            SELECT 
                C.name AS Name,
                SUM(S.amount) AS TotalSalaryCost
            FROM 
                salarylog S
            JOIN 
                employee E ON S.employeeId = E.id
            JOIN 
                rol R ON E.RolId = R.id
            JOIN 
                department D ON R.departmentId = D.id
            JOIN 
                country C ON E.countryId = C.id
            GROUP BY 
                C.name
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }

        public static function filterByCountry2() {
            $query = "
            SELECT 
                C.name As Name,
                ROUND(SUM(S.amount * C.socialcharge), 2) AS SocialChargeCost
            FROM 
                salarylog S
            JOIN 
                employee E ON S.employeeId = E.id
            JOIN 
                rol R ON E.RolId = R.id
            JOIN 
                department D ON R.departmentID = D.id
            JOIN 
                country C ON E.countryId = C.id
            GROUP BY 
                C.name
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }

        public static function filterByEmployee2() {
            $query = "
            SELECT 
                E.id,
                CONCAT(E.name, ' ', E.surname) AS Name,
                ROUND(SUM(S.amount * C.socialcharge), 2) AS SocialChargeCost
            FROM 
                salarylog S
            JOIN 
                employee E ON S.employeeId = E.id
            JOIN 
                rol R ON E.RolId = R.id
            JOIN 
                department D ON R.departmentId = D.id
            JOIN 
                country C ON E.countryId = C.id
            GROUP BY 
                E.id
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }

        public static function filterByRole2() {
            $query = " 
            SELECT 
            R.rol AS Name,
            ROUND(SUM(S.amount * C.socialcharge), 2) AS SocialChargeCost
            FROM 
                salarylog S
            JOIN 
                employee E ON S.employeeId = E.id
            JOIN 
                rol R ON E.RolId = R.id
            JOIN 
                department D ON R.departmentID = D.id
            JOIN 
                country C ON E.countryId = C.id
            GROUP BY 
                R.rol, R.id
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }

        public static function filterByDepartment2() {
            $query = "
            SELECT 
                D.name AS Name,
                ROUND(SUM(S.amount * C.socialcharge), 2) AS SocialChargeCost
            FROM 
                salarylog S
            JOIN 
                employee E ON S.employeeId = E.id
            JOIN 
                rol R ON E.RolId = R.id
            JOIN 
                department D ON R.departmentID = D.id
            JOIN 
                country C ON E.countryId = C.id
            GROUP BY 
                D.name
            ";
    
            $statement = self::$db->prepare($query);
    
            if ($statement === false) {
                die("Query preparation failed: " . self::$db->error);
            }
    
            $statement->execute();
            $result = $statement->get_result();
    
            $array = [];
            while ($register = $result->fetch_assoc()) {
                $array[] = static::createObject($register);
            }
    
            $statement->close();
            return $array;
        }
    
    

    // Sync the object with the new values
    public function sync($args = []){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}