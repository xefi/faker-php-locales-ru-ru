<?php

namespace Xefi\Faker\RuRu\Tests\Unit;

use Random\Randomizer;
use Xefi\Faker\RuRu\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new \ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing(
            $this->companies,
            $results
        );
    }

    public function testCompaniesHaveALegalForm(): void
    {
        foreach ($this->companies as $company) {
            $this->assertMatchesRegularExpression('/^(ООО|АО|ПАО|ЗАО) «[^«»]+»$/u', $company);
        }
    }

    public function testCompanyInnChecksumValidatorAcceptsAKnownInn(): void
    {
        $this->assertTrue($this->isValidCompanyInn('7707083893'));
        $this->assertFalse($this->isValidCompanyInn('7707083894'));
    }

    public function testCompanyInn(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $inn = $this->faker->companyInn();

            $this->assertMatchesRegularExpression('/^\d{10}$/', $inn);
            $this->assertNotSame('00', substr($inn, 0, 2));
            $this->assertTrue($this->isValidCompanyInn($inn));
        }
    }

    public function testOgrnChecksumValidatorAcceptsAKnownOgrn(): void
    {
        $this->assertTrue($this->isValidOgrn('1027700132195'));
        $this->assertFalse($this->isValidOgrn('1027700132196'));
    }

    public function testOgrn(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $ogrn = $this->faker->ogrn();

            $this->assertMatchesRegularExpression('/^[15]\d{12}$/', $ogrn);
            $this->assertTrue($this->isValidOgrn($ogrn));
        }
    }

    private function isValidCompanyInn(string $inn): bool
    {
        $sum = 0;
        foreach ([2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight) {
            $sum += (int) $inn[$i] * $weight;
        }

        return $sum % 11 % 10 === (int) $inn[9];
    }

    private function isValidOgrn(string $ogrn): bool
    {
        return (int) substr($ogrn, 0, 12) % 11 % 10 === (int) $ogrn[12];
    }
}
