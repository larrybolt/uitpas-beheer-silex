<?php

namespace CultuurNet\UiTPASBeheer\UiTPAS;

use CultuurNet\UiTPASBeheer\CardSystem\CardSystem;
use CultuurNet\UiTPASBeheer\CardSystem\Properties\CardSystemId;
use ValueObjects\StringLiteral\StringLiteral;

final class UiTPAS implements \JsonSerializable
{
    /**
     * @var UiTPASNumber
     */
    protected $number;

    /**
     * @var UiTPASStatus
     */
    protected $status;

    /**
     * @var UiTPASType
     */
    protected $type;

    /**
     * @var CardSystem
     */
    protected $cardSystem;

    /**
     * @var StringLiteral|null
     */
    protected $city;

    /**
     * @param UiTPASNumber $number
     * @param UiTPASStatus $status
     * @param UiTPASType $type
     * @param CardSystem $cardSystem
     */
    public function __construct(
        UiTPASNumber $number,
        UiTPASStatus $status,
        UiTPASType $type,
        CardSystem $cardSystem
    ) {
        $this->number = $number;
        $this->status = $status;
        $this->type = $type;
        $this->cardSystem = $cardSystem;
    }

    /**
     * @param StringLiteral $city
     * @return UiTPAS
     */
    public function withCity(StringLiteral $city)
    {
        $c = clone $this;
        $c->city = $city;
        return $c;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $data = [
            'number' => $this->number->toNative(),
            'kansenStatuut' => $this->number->hasKansenStatuut(),
            'status' => $this->status->toNative(),
            'type' => $this->type->toNative(),
            'cardSystem' => $this->cardSystem->jsonSerialize(),
        ];

        if (!is_null($this->city)) {
            $data['city'] = $this->city->toNative();
        }

        return $data;
    }

    /**
     * @param \CultureFeed_Uitpas_Passholder_Card $cfCard
     * @return UiTPAS
     */
    public static function fromCultureFeedPassHolderCard(\CultureFeed_Uitpas_Passholder_Card $cfCard)
    {
        $number = new UiTPASNumber($cfCard->uitpasNumber);
        $status = UiTPASStatus::get($cfCard->status);
        $type = UiTPASType::get($cfCard->type);
        $cardSystem = CardSystem::fromCultureFeedCardSystem($cfCard->cardSystem);

        $card = new UiTPAS(
            $number,
            $status,
            $type,
            $cardSystem
        );

        if (!empty($cfCard->city)) {
            $card = $card->withCity(new StringLiteral($cfCard->city));
        }

        return $card;
    }

    /**
     * @param \CultureFeed_Uitpas_CardInfo $cfCardInfo
     * @return UiTPAS
     */
    public static function fromCultureFeedCardInfo(\CultureFeed_Uitpas_CardInfo $cfCardInfo)
    {
        $number = new UiTPASNumber($cfCardInfo->uitpasNumber);
        $status = UiTPASStatus::get($cfCardInfo->status);
        $type = UiTPASType::get($cfCardInfo->type);
        $cardSystem = CardSystem::fromCultureFeedCardSystem($cfCardInfo->cardSystem);

        return new UiTPAS(
            $number,
            $status,
            $type,
            $cardSystem
        );
    }
}
