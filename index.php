<?php
require_once 'etc/config.php';
require_once 'vendor/autoload.php';

use App\SalaryCalculator;

$salaryCalculator = new SalaryCalculator();
echo 'Salary: ' . $salaryCalculator->calculateSalary(1) . PHP_EOL;
