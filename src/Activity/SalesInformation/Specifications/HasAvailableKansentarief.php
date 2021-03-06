<?php

namespace CultuurNet\UiTPASBeheer\Activity\SalesInformation\Specifications;

use CultuurNet\UiTPASBeheer\Activity\SalesInformation\SalesInformation;
use CultuurNet\UiTPASBeheer\Activity\SalesInformation\Tariff\TariffType;

class HasAvailableKansentarief implements SalesInformationSpecificationInterface
{
    /**
     * @param SalesInformation $salesInformation
     * @return bool
     */
    public static function isSatisfiedBy(SalesInformation $salesInformation)
    {
        // Try to find a kansentarief tariff that has not reached its maximum
        // number of sales.
        foreach ($salesInformation->getTariffs() as $tariff) {
            if ($tariff->getType()->is(TariffType::KANSENTARIEF()) &&
                !$tariff->hasReachedMaximum()) {
                return true;
            }
        }

        // No available kansentarief found.
        return false;
    }
}
