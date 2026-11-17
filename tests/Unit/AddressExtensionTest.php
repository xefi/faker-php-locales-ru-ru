<?php

namespace Xefi\Faker\RuRu\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\RuRu\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected array $regions = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $extension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($extension);

        $this->regions = $reflection->getProperty('regions')->getValue($extension);
        $this->cities = $reflection->getProperty('cities')->getValue($extension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($extension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($extension);
    }

    public function testRegion(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->regions); $i++) {
            $results[] = $this->faker->unique()->region();
        }

        $this->assertEqualsCanonicalizing(array_values($this->regions), $results);
    }

    public function testRegionCode(): void
    {
        $codes = array_map(fn ($code) => sprintf('%02d', $code), array_keys($this->regions));

        for ($i = 0; $i < 100; $i++) {
            $code = $this->faker->regionCode();

            $this->assertMatchesRegularExpression('/^\d{2}$/', $code);
            $this->assertContains($code, $codes);
        }
    }

    public function testEveryCityBelongsToAKnownRegion(): void
    {
        foreach ($this->cities as $city => $data) {
            $this->assertContains($data['region'], $this->regions, "{$city} has an unknown region.");
            $this->assertMatchesRegularExpression('/^[1-6]\d{2}$/', $data['postcode']);
        }
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(array_keys($this->cities), $results);
    }

    public function testPostcode(): void
    {
        $prefixes = array_column($this->cities, 'postcode');

        for ($i = 0; $i < 100; $i++) {
            $postcode = $this->faker->postcode();

            $this->assertMatchesRegularExpression('/^\d{6}$/', $postcode);
            $this->assertContains(substr($postcode, 0, 3), $prefixes);
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->houseNumber();

            $this->assertIsInt($result);
            $this->assertGreaterThanOrEqual(1, $result);
            $this->assertLessThanOrEqual(150, $result);
        }
    }

    public function testStreetName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$type, $name] = explode(' ', $this->faker->streetName(), 2);

            $this->assertContains($type, $this->streetTypes);
            $this->assertContains($name, $this->streetNames);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\S+ [\p{Cyrillic}]+, д\. \d{1,3}$/u', $this->faker->streetAddress());
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->fullAddress();

            $this->assertMatchesRegularExpression(
                '/^\S+ [\p{Cyrillic}]+, д\. \d{1,3}, кв\. \d{1,3}, г\. ([\p{Cyrillic}\- ]+)(, [\p{Cyrillic}() \-]+)?, (\d{6})$/u',
                $result,
                $result
            );

            preg_match('/г\. ([\p{Cyrillic}\- ]+?)(, [\p{Cyrillic}() \-]+)?, (\d{6})$/u', $result, $matches);
            $city = $matches[1];

            $this->assertArrayHasKey($city, $this->cities);
            $this->assertStringStartsWith($this->cities[$city]['postcode'], $matches[3]);

            if ($this->cities[$city]['region'] !== $city) {
                $this->assertStringContainsString(', '.$this->cities[$city]['region'].', ', $result);
            }
        }
    }
}
