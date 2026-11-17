<?php

namespace Xefi\Faker\RuRu\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $lastNameFemale = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\RuRu\Extensions\PersonExtension(new Randomizer());
        $reflection = new ReflectionClass($personExtension);

        $this->firstNameMale = $reflection->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = $reflection->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = $reflection->getProperty('lastName')->getValue($personExtension);
        $this->lastNameFemale = $reflection->getProperty('lastNameFemale')->getValue($personExtension);
        $this->titleMale = $reflection->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = $reflection->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameFemale, $results);
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameMale, $results);
    }

    public function testFirstName(): void
    {
        $firstNames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));

        $results = [];
        for ($i = 0; $i < count($firstNames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing($firstNames, $results);
    }

    public function testFemaleSurnamesAreTheFeminineFormOfTheMaleSurnames(): void
    {
        $this->assertCount(count($this->lastName), $this->lastNameFemale);

        foreach ($this->lastName as $i => $male) {
            $expected = match (true) {
                (bool) preg_match('/(ов|ев|ёв|ин|ын)$/u', $male) => $male.'а',
                (bool) preg_match('/ский$/u', $male)              => mb_substr($male, 0, -4).'ская',
                (bool) preg_match('/ой$/u', $male)                => mb_substr($male, 0, -2).'ая',
                default                                           => $male,
            };

            $this->assertSame($expected, $this->lastNameFemale[$i]);
        }
    }

    public function testLastNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->lastName, $results);
    }

    public function testLastNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastNameFemale); $i++) {
            $results[] = $this->faker->unique()->lastName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->lastNameFemale, $results);
    }

    public function testLastName(): void
    {
        $lastNames = array_merge($this->lastName, $this->lastNameFemale);

        $results = [];
        for ($i = 0; $i < count($lastNames); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing($lastNames, $results);
    }

    public function testNameMale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_MALE));

            $this->assertContains($firstName, $this->firstNameMale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testNameFemale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_FEMALE));

            $this->assertContains($firstName, $this->firstNameFemale);
            $this->assertContains($lastName, $this->lastNameFemale);
        }
    }

    public function testNameSurnameAgreesWithTheFirstNameGender(): void
    {
        for ($i = 0; $i < 200; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name());

            if (in_array($firstName, $this->firstNameMale, true)) {
                $this->assertContains($lastName, $this->lastName, "'{$firstName} {$lastName}' mixes genders.");
            } else {
                $this->assertContains($firstName, $this->firstNameFemale);
                $this->assertContains($lastName, $this->lastNameFemale, "'{$firstName} {$lastName}' mixes genders.");
            }
        }
    }

    public function testTitleFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->titleFemale, $results);
    }

    public function testTitleMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->titleMale, $results);
    }

    public function testIndividualInnChecksumValidatorAcceptsAKnownInn(): void
    {
        $this->assertTrue($this->isValidIndividualInn('500100732259'));
        $this->assertFalse($this->isValidIndividualInn('500100732258'));
    }

    public function testIndividualInn(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $inn = $this->faker->individualInn();

            $this->assertMatchesRegularExpression('/^\d{12}$/', $inn);
            $this->assertNotSame('00', substr($inn, 0, 2));
            $this->assertTrue($this->isValidIndividualInn($inn));
        }
    }

    public function testSnilsChecksumValidatorAcceptsAKnownSnils(): void
    {
        $this->assertTrue($this->isValidSnils('112-233-445 95'));
        $this->assertFalse($this->isValidSnils('112-233-445 96'));
    }

    public function testSnils(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $snils = $this->faker->snils();

            $this->assertMatchesRegularExpression('/^\d{3}-\d{3}-\d{3} \d{2}$/', $snils);
            $this->assertTrue($this->isValidSnils($snils));
        }
    }

    private function isValidIndividualInn(string $inn): bool
    {
        $first = 0;
        foreach ([7, 2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight) {
            $first += (int) $inn[$i] * $weight;
        }

        $second = 0;
        foreach ([3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight) {
            $second += (int) $inn[$i] * $weight;
        }

        return $first % 11 % 10 === (int) $inn[10] && $second % 11 % 10 === (int) $inn[11];
    }

    private function isValidSnils(string $snils): bool
    {
        $digits = preg_replace('/\D/', '', $snils);

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $digits[$i] * (9 - $i);
        }

        $expected = match (true) {
            $sum < 100               => $sum,
            $sum === 100, $sum === 101 => 0,
            default                  => $sum % 101 === 100 ? 0 : $sum % 101,
        };

        return $expected === (int) substr($digits, 9, 2);
    }
}
