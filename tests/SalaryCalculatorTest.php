<?php
namespace Tests;

use mysqli;
use PHPUnit\Framework\TestCase;
use App\SalaryCalculator;

class SalaryCalculatorTest extends TestCase
{
    private mysqli $mysqli;

    private SalaryCalculator $salaryCalculator;

    public function setUp(): void
    {
        parent::setUp();
        $this->mysqli = new mysqli('localhost', 'phpunit', 'phpunit', 'phpunit');
        if ($this->mysqli->error) {
            echo $this->mysqli->error . PHP_EOL;
            exit(1);
        }

        $this->salaryCalculator = new SalaryCalculator();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCalculateSalary(): void
    {
        $this->mysqli->query('INSERT INTO account SET email = "email", name = "name", salary = 11');
        $accountId = $this->mysqli->insert_id;

        $result = $this->salaryCalculator->calculateSalary($accountId);

        self::assertEquals(9.9, $result);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCalculate(float $salary, float $expected): void
    {
        $result = $this->salaryCalculator->calculate($salary);

        self::assertEquals($expected, $result);
    }

    public function dataProvider(): array
    {
        return [
            [
                10, 9
            ],
            [
                20, 18
            ],
            [
                10.5, 9.45
            ],
            [
                15.5, 13.95
            ]
        ];
    }
}
