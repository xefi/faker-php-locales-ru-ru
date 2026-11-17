<?php

namespace Xefi\Faker\RuRu\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    public function getLocale(): ?string
    {
        return 'ru_RU';
    }

    /**
     * Russia does not use IBAN: build an IBAN-shaped value from a BIK (9 digits) and an account number (20 digits).
     *
     * @param string|null $countryCode
     * @param string|null $format
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'RU';
        }

        if ($format === null) {
            $format = sprintf(
                '04%s%s',
                str_repeat('{d}', 7),
                str_repeat('{d}', 20)
            );
        }

        return parent::iban($countryCode, $format);
    }
}
