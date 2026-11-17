<?php

namespace Xefi\Faker\RuRu\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $defaultPrefix = '8';

    public string $indicator = '+7';

    public function getLocale(): ?string
    {
        return 'ru_RU';
    }

    protected array $landlineFormats = [
        '{separator}3{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '{separator}4{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{separator}{d}{d}',
        '{separator}8{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{separator}{d}{d}',
    ];

    protected array $cellFormats = [
        '{separator}9{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{separator}{d}{d}',
    ];
}
