<?php

namespace Xefi\Faker\RuRu\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^8[3489]\d{9}$/', $this->faker->phoneNumber());
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^89\d{9}$/', $this->faker->cellPhoneNumber());
        }
    }

    public function testLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^8[348]\d{9}$/', $this->faker->landlinePhoneNumber());
        }
    }

    public function testSpacedPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^8 [3489]\d{2} \d{3} \d{2} \d{2}$/', $this->faker->spacedPhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+7[3489]\d{9}$/', $this->faker->indicatoredPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+7 9\d{2} \d{3} \d{2} \d{2}$/', $this->faker->spacedIndicatoredCellPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+7-[348]\d{2}-\d{3}-\d{2}-\d{2}$/', $this->faker->dashedIndicatoredLandlinePhoneNumber());
        }
    }
}
