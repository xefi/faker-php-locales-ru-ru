<?php

namespace Xefi\Faker\RuRu\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
{
    public function getLocale(): ?string
    {
        return 'ru_RU';
    }

    protected $regions = [
        '01' => 'Республика Адыгея', '02' => 'Республика Башкортостан', '03' => 'Республика Бурятия',
        '05' => 'Республика Дагестан', '10' => 'Республика Карелия', '11' => 'Республика Коми',
        '14' => 'Республика Саха (Якутия)', '16' => 'Республика Татарстан', '18' => 'Удмуртская Республика',
        '21' => 'Чувашская Республика', '22' => 'Алтайский край', '23' => 'Краснодарский край',
        '24' => 'Красноярский край', '25' => 'Приморский край', '26' => 'Ставропольский край',
        '27' => 'Хабаровский край', '29' => 'Архангельская область', '34' => 'Волгоградская область',
        '36' => 'Воронежская область', '38' => 'Иркутская область', '39' => 'Калининградская область',
        '47' => 'Ленинградская область', '50' => 'Московская область', '52' => 'Нижегородская область',
        '54' => 'Новосибирская область', '55' => 'Омская область', '59' => 'Пермский край',
        '61' => 'Ростовская область', '63' => 'Самарская область', '66' => 'Свердловская область',
        '72' => 'Тюменская область', '74' => 'Челябинская область', '76' => 'Ярославская область',
        '77' => 'Москва', '78' => 'Санкт-Петербург',
    ];

    protected $cities = [
        'Москва'          => ['region' => 'Москва', 'postcode' => '101'],
        'Санкт-Петербург' => ['region' => 'Санкт-Петербург', 'postcode' => '190'],
        'Новосибирск'     => ['region' => 'Новосибирская область', 'postcode' => '630'],
        'Екатеринбург'    => ['region' => 'Свердловская область', 'postcode' => '620'],
        'Казань'          => ['region' => 'Республика Татарстан', 'postcode' => '420'],
        'Нижний Новгород' => ['region' => 'Нижегородская область', 'postcode' => '603'],
        'Челябинск'       => ['region' => 'Челябинская область', 'postcode' => '454'],
        'Самара'          => ['region' => 'Самарская область', 'postcode' => '443'],
        'Омск'            => ['region' => 'Омская область', 'postcode' => '644'],
        'Ростов-на-Дону'  => ['region' => 'Ростовская область', 'postcode' => '344'],
        'Уфа'             => ['region' => 'Республика Башкортостан', 'postcode' => '450'],
        'Красноярск'      => ['region' => 'Красноярский край', 'postcode' => '660'],
        'Пермь'           => ['region' => 'Пермский край', 'postcode' => '614'],
        'Воронеж'         => ['region' => 'Воронежская область', 'postcode' => '394'],
        'Волгоград'       => ['region' => 'Волгоградская область', 'postcode' => '400'],
        'Краснодар'       => ['region' => 'Краснодарский край', 'postcode' => '350'],
        'Тюмень'          => ['region' => 'Тюменская область', 'postcode' => '625'],
        'Ижевск'          => ['region' => 'Удмуртская Республика', 'postcode' => '426'],
        'Иркутск'         => ['region' => 'Иркутская область', 'postcode' => '664'],
        'Хабаровск'       => ['region' => 'Хабаровский край', 'postcode' => '680'],
        'Ярославль'       => ['region' => 'Ярославская область', 'postcode' => '150'],
        'Владивосток'     => ['region' => 'Приморский край', 'postcode' => '690'],
        'Махачкала'       => ['region' => 'Республика Дагестан', 'postcode' => '367'],
        'Ставрополь'      => ['region' => 'Ставропольский край', 'postcode' => '355'],
        'Калининград'     => ['region' => 'Калининградская область', 'postcode' => '236'],
        'Чебоксары'       => ['region' => 'Чувашская Республика', 'postcode' => '428'],
        'Барнаул'         => ['region' => 'Алтайский край', 'postcode' => '656'],
        'Сочи'            => ['region' => 'Краснодарский край', 'postcode' => '354'],
        'Архангельск'     => ['region' => 'Архангельская область', 'postcode' => '163'],
        'Петрозаводск'    => ['region' => 'Республика Карелия', 'postcode' => '185'],
        'Сыктывкар'       => ['region' => 'Республика Коми', 'postcode' => '167'],
        'Якутск'          => ['region' => 'Республика Саха (Якутия)', 'postcode' => '677'],
        'Улан-Удэ'        => ['region' => 'Республика Бурятия', 'postcode' => '670'],
        'Майкоп'          => ['region' => 'Республика Адыгея', 'postcode' => '385'],
        'Подольск'        => ['region' => 'Московская область', 'postcode' => '142'],
        'Гатчина'         => ['region' => 'Ленинградская область', 'postcode' => '188'],
    ];

    protected $streetTypes = ['ул.', 'пр-т', 'пер.', 'б-р', 'ш.', 'наб.', 'пл.', 'проезд'];

    protected $streetNames = [
        'Ленина', 'Пушкина', 'Гагарина', 'Мира', 'Победы', 'Чехова', 'Толстого', 'Лермонтова', 'Горького', 'Кирова',
        'Маяковского', 'Гоголя', 'Жукова', 'Королёва', 'Суворова', 'Кутузова', 'Ломоносова', 'Менделеева', 'Чайковского', 'Есенина',
        'Тургенева', 'Достоевского', 'Некрасова', 'Островского', 'Крылова', 'Калинина', 'Куйбышева', 'Фрунзе', 'Чапаева', 'Строителей',
        'Космонавтов', 'Энтузиастов', 'Мичурина', 'Комарова', 'Шевченко', 'Герцена', 'Глинки', 'Шолохова', 'Циолковского', 'Пирогова',
    ];

    /**
     * Return a random federal subject (republic, krai, oblast or federal city).
     *
     * @return string
     */
    public function region(): string
    {
        return $this->pickArrayRandomElement($this->regions);
    }

    /**
     * Return a random two-digit federal subject code.
     *
     * @return string
     */
    public function regionCode(): string
    {
        return sprintf('%02d', $this->pickArrayRandomKey($this->regions));
    }

    /**
     * Return a random city.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomKey($this->cities);
    }

    /**
     * Return a random six-digit postcode.
     *
     * @return string
     */
    public function postcode(): string
    {
        return $this->postcodeFromPrefix($this->pickArrayRandomElement($this->cities)['postcode']);
    }

    /**
     * Return a random house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 150);
    }

    /**
     * Return a random street name, prefixed with its abbreviated type.
     *
     * @return string
     */
    public function streetName(): string
    {
        $streetType = $this->pickArrayRandomElement($this->streetTypes);
        $name = $this->pickArrayRandomElement($this->streetNames);

        return sprintf('%s %s', $streetType, $name);
    }

    /**
     * Return a street name followed by a house number.
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%s, д. %d', $this->streetName(), $this->houseNumber());
    }

    /**
     * Return a full address in the Russian Post order: street, house, flat, city, region, postcode.
     *
     * @return string
     */
    public function fullAddress(): string
    {
        $city = $this->city();
        $region = $this->cities[$city]['region'];
        $locality = $region === $city ? sprintf('г. %s', $city) : sprintf('г. %s, %s', $city, $region);

        return sprintf(
            '%s, кв. %d, %s, %s',
            $this->streetAddress(),
            $this->randomizer->getInt(1, 300),
            $locality,
            $this->postcodeFromPrefix($this->cities[$city]['postcode'])
        );
    }

    /**
     * Complete a three-digit sorting prefix into a six-digit postcode.
     *
     * @param string $prefix
     *
     * @return string
     */
    private function postcodeFromPrefix(string $prefix): string
    {
        return sprintf('%s%03d', $prefix, $this->randomizer->getInt(0, 999));
    }
}
