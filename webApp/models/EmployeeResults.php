<?php 
namespace Model;

class EmployeeResults extends ActiveRecord{
    protected static $table = 'employeeresults';
    protected static $columns_db = ['id', 'Name', 'Department', 'Rol', 'hours', 'salary', 'socialcharge', 'currentSalary', 'NextPay', 'Country'];

    public $id;
    public $Name;
    public $Department;
    public $Rol;
    public $hours;
    public $salary;
    public $socialcharge;
    public $CurrentSalary;
    public $NextPay;
    public $Country;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->Name = $args['Name'] ?? '';
        $this->Department = $args['Department'] ?? '';
        $this->Rol = $args['Rol'] ?? '';
        $this->hours = $args['hours'] ?? null;
        $this->salary = $args['salary'] ?? null;
        $this->socialcharge = $args['socialcharge'] ?? null;
        $this->CurrentSalary = $args['CurrentSalary'] ?? null;
        $this->NextPay = $args['NextPay'] ?? '';
        $this->Country = $args['Country'] ?? '';
    }
}