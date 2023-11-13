<?php 
namespace Model;

class EmployeeResults extends ActiveRecord{
    protected static $table = 'employeeresults';
    protected static $columns_db = ['Name', 'Department', 'Rol', 'hours', 'salary', 'socialcharge', 'currentSalary', 'NextPay'];

    public $Name;
    public $Department;
    public $Rol;
    public $hours;
    public $salary;
    public $socialcharge;
    public $CurrentSalary;
    public $NextPay;

    public function __construct($args = []){
        $this->Name = $args['Name'] ?? '';
        $this->Department = $args['Department'] ?? '';
        $this->Rol = $args['Rol'] ?? '';
        $this->hours = $args['hours'] ?? null;
        $this->salary = $args['salary'] ?? null;
        $this->socialcharge = $args['socialcharge'] ?? null;
        $this->CurrentSalary = $args['CurrentSalary'] ?? null;
        $this->NextPay = $args['NextPay'] ?? null;
    }
}