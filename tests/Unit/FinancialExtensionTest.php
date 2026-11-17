<?php

namespace Xefi\Faker\RuRu\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertMatchesRegularExpression('/^RU\d{2}04\d{27}$/', $iban);
            $this->assertTrue(Iban::isValid($iban));
        }
    }
}
