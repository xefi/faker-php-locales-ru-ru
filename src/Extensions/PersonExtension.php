<?php

namespace Xefi\Faker\RuRu\Extensions;

use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
{
    public function getLocale(): ?string
    {
        return 'ru_RU';
    }

    protected $firstNameMale = [
        'Александр', 'Сергей', 'Дмитрий', 'Андрей', 'Алексей', 'Максим', 'Евгений', 'Иван', 'Михаил', 'Артём',
        'Николай', 'Владимир', 'Павел', 'Роман', 'Денис', 'Константин', 'Олег', 'Игорь', 'Юрий', 'Виктор',
        'Антон', 'Илья', 'Кирилл', 'Никита', 'Егор', 'Тимофей', 'Григорий', 'Борис', 'Вадим', 'Василий',
        'Станислав', 'Фёдор', 'Леонид', 'Пётр', 'Арсений', 'Глеб', 'Ярослав', 'Матвей', 'Степан', 'Даниил',
    ];

    protected $firstNameFemale = [
        'Анна', 'Елена', 'Ольга', 'Наталья', 'Татьяна', 'Ирина', 'Екатерина', 'Мария', 'Светлана', 'Юлия',
        'Анастасия', 'Марина', 'Людмила', 'Галина', 'Дарья', 'Ксения', 'Алина', 'Виктория', 'Полина', 'Софья',
        'Вера', 'Надежда', 'Любовь', 'Валентина', 'Евгения', 'Кристина', 'Алёна', 'Оксана', 'Нина', 'Лариса',
        'Елизавета', 'Варвара', 'Василиса', 'Маргарита', 'Вероника', 'Арина', 'Ульяна', 'Таисия', 'Зоя', 'Яна',
    ];

    protected $lastName = [
        'Иванов', 'Смирнов', 'Кузнецов', 'Попов', 'Васильев', 'Петров', 'Соколов', 'Михайлов', 'Новиков', 'Фёдоров',
        'Морозов', 'Волков', 'Алексеев', 'Лебедев', 'Семёнов', 'Егоров', 'Павлов', 'Козлов', 'Степанов', 'Николаев',
        'Орлов', 'Андреев', 'Макаров', 'Никитин', 'Захаров', 'Зайцев', 'Соловьёв', 'Борисов', 'Яковлев', 'Григорьев',
        'Романов', 'Воробьёв', 'Сергеев', 'Кириллов', 'Белов', 'Тарасов', 'Ковалевский', 'Вишневский', 'Толстой', 'Островский',
    ];

    protected $lastNameFemale = [
        'Иванова', 'Смирнова', 'Кузнецова', 'Попова', 'Васильева', 'Петрова', 'Соколова', 'Михайлова', 'Новикова', 'Фёдорова',
        'Морозова', 'Волкова', 'Алексеева', 'Лебедева', 'Семёнова', 'Егорова', 'Павлова', 'Козлова', 'Степанова', 'Николаева',
        'Орлова', 'Андреева', 'Макарова', 'Никитина', 'Захарова', 'Зайцева', 'Соловьёва', 'Борисова', 'Яковлева', 'Григорьева',
        'Романова', 'Воробьёва', 'Сергеева', 'Кириллова', 'Белова', 'Тарасова', 'Ковалевская', 'Вишневская', 'Толстая', 'Островская',
    ];

    protected $titleMale = ['г-н', 'д-р', 'проф.'];
    protected $titleFemale = ['г-жа', 'д-р', 'проф.'];

    /**
     * Return a full name whose surname agrees with the gender of the first name.
     *
     * @param string|null $gender
     *
     * @return string
     */
    public function name(?string $gender = null): string
    {
        if ($gender !== static::GENDER_MALE && $gender !== static::GENDER_FEMALE) {
            $gender = $this->randomizer->getInt(0, 1) === 0 ? static::GENDER_FEMALE : static::GENDER_MALE;
        }

        return sprintf('%s %s', $this->firstName($gender), $this->lastName($gender));
    }

    /**
     * Return a surname in its masculine or feminine form.
     *
     * @param string|null $gender
     *
     * @return string
     */
    public function lastName(?string $gender = null): string
    {
        if ($gender === static::GENDER_MALE) {
            return $this->pickArrayRandomElement($this->lastName);
        }

        if ($gender === static::GENDER_FEMALE) {
            return $this->pickArrayRandomElement($this->lastNameFemale);
        }

        return $this->pickArrayRandomElement($this->randomizer->getInt(0, 1) === 0 ? $this->lastNameFemale : $this->lastName);
    }

    /**
     * Return an individual taxpayer number (ИНН, 12 digits with two check digits).
     *
     * @return string
     */
    public function individualInn(): string
    {
        $inn = sprintf(
            '%02d%02d%06d',
            $this->randomizer->getInt(1, 89),
            $this->randomizer->getInt(1, 99),
            $this->randomizer->getInt(0, 999999)
        );

        $inn .= $this->innCheckDigit($inn, [7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
        $inn .= $this->innCheckDigit($inn, [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);

        return $inn;
    }

    /**
     * Return a pension insurance number (СНИЛС) formatted as XXX-XXX-XXX YY.
     *
     * @return string
     */
    public function snils(): string
    {
        $number = sprintf('%09d', $this->randomizer->getInt(1001999, 999999999));

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $number[$i] * (9 - $i);
        }

        $checksum = $sum % 101;
        if ($checksum === 100) {
            $checksum = 0;
        }

        return sprintf('%s-%s-%s %02d', substr($number, 0, 3), substr($number, 3, 3), substr($number, 6, 3), $checksum);
    }

    /**
     * Compute an INN check digit for the given weights.
     *
     * @param string $digits
     * @param array  $weights
     *
     * @return int
     */
    private function innCheckDigit(string $digits, array $weights): int
    {
        $sum = 0;
        foreach ($weights as $i => $weight) {
            $sum += (int) $digits[$i] * $weight;
        }

        return $sum % 11 % 10;
    }
}
