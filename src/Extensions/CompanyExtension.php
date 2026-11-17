<?php

namespace Xefi\Faker\RuRu\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
{
    public function getLocale(): ?string
    {
        return 'ru_RU';
    }

    private array $companies = [
        'ООО «Ромашка»', 'АО «Сибирские технологии»', 'ПАО «Волжская энергия»',
        'ООО «Северный ветер»', 'ООО «Уральский металл»', 'АО «Балтийская логистика»',
        'ООО «Восток-Сервис»', 'ООО «ТехноПром»', 'ЗАО «Альфа-Строй»',
        'ООО «Камская мебель»', 'АО «Приморские линии»', 'ООО «Невские традиции»',
        'ПАО «Донской хлеб»', 'ООО «Медведь и партнёры»', 'ООО «Звезда»',
        'АО «Алтайские продукты»', 'ООО «Байкал-Инвест»', 'ООО «Кедр»',
        'ООО «Русские сады»', 'АО «Черноземье Агро»', 'ООО «Ладога»',
        'ООО «Цифровые решения»', 'ООО «Меридиан»', 'АО «Енисей Телеком»',
        'ООО «Самоцвет»', 'ООО «Окская верфь»', 'ООО «Таёжный лес»',
        'ООО «Полярная звезда»', 'АО «Сокол Авиа»', 'ООО «Берёзка»',
    ];

    /**
     * Return a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Return a legal entity taxpayer number (ИНН, 10 digits with one check digit).
     *
     * @return string
     */
    public function companyInn(): string
    {
        $inn = sprintf(
            '%02d%02d%05d',
            $this->randomizer->getInt(1, 89),
            $this->randomizer->getInt(1, 99),
            $this->randomizer->getInt(0, 99999)
        );

        $sum = 0;
        foreach ([2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight) {
            $sum += (int) $inn[$i] * $weight;
        }

        return $inn.($sum % 11 % 10);
    }

    /**
     * Return a primary state registration number of a legal entity (ОГРН, 13 digits).
     *
     * @return string
     */
    public function ogrn(): string
    {
        $ogrn = sprintf(
            '%d%02d%02d%07d',
            $this->pickArrayRandomElement([1, 5]),
            $this->randomizer->getInt(2, 25),
            $this->randomizer->getInt(1, 89),
            $this->randomizer->getInt(0, 9999999)
        );

        return $ogrn.((int) $ogrn % 11 % 10);
    }
}
