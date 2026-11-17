<?php

namespace Xefi\Faker\RuRu;

use Xefi\Faker\RuRu\Extensions\AddressExtension;
use Xefi\Faker\RuRu\Extensions\ColorsExtension;
use Xefi\Faker\RuRu\Extensions\CompanyExtension;
use Xefi\Faker\RuRu\Extensions\FinancialExtension;
use Xefi\Faker\RuRu\Extensions\PersonExtension;
use Xefi\Faker\RuRu\Extensions\PhoneExtension;
use Xefi\Faker\RuRu\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerRuRuServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}
