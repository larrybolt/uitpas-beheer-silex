<?php

namespace CultuurNet\UiTPASBeheer\PassHolder;

use CultuurNet\UiTPASBeheer\CardSystem\CardSystem;
use CultuurNet\UiTPASBeheer\CardSystem\Properties\CardSystemId;
use CultuurNet\UiTPASBeheer\KansenStatuut\KansenStatuut;
use CultuurNet\UiTPASBeheer\KansenStatuut\KansenStatuutCollection;
use CultuurNet\UiTPASBeheer\KansenStatuut\KansenStatuutStatus;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\Address;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\BirthInformation;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\ContactInformation;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\Gender;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\INSZNumber;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\Name;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\PrivacyPreferenceEmail;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\PrivacyPreferences;
use CultuurNet\UiTPASBeheer\PassHolder\Properties\PrivacyPreferenceSMS;
use ValueObjects\DateTime\Date;
use ValueObjects\DateTime\Month;
use ValueObjects\DateTime\MonthDay;
use ValueObjects\DateTime\Year;
use ValueObjects\Number\Integer;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Web\EmailAddress;

trait PassHolderDataTrait
{
    /**
     * @return PassHolder
     */
    public function getCompletePassHolderUpdate()
    {
        return (new PassHolder(
            (new Name(
                new StringLiteral('Layla'),
                new StringLiteral('Zyrani')
            ))->withMiddleName(
                new StringLiteral('Zoni')
            ),
            (new Address(
                new StringLiteral('1090'),
                new StringLiteral('Jette (Brussel)')
            ))->withStreet(
                new StringLiteral('Rue Perdue 101 /0003')
            ),
            (new BirthInformation(
                Date::fromNativeDateTime(new \DateTime('1976-09-13'))
            ))->withPlace(
                new StringLiteral('Casablanca')
            )
        ))->withINSZNumber(
            new INSZNumber('93051822361')
        )->withGender(
            Gender::FEMALE()
        )->withNationality(
            new StringLiteral('Maroc')
        )->withContactInformation(
            (new ContactInformation())
                ->withEmail(
                    new EmailAddress('zyrani_.hotmail.com@mailinator.com')
                )->withTelephoneNumber(
                    new StringLiteral('0488694231')
                )->withMobileNumber(
                    new StringLiteral('0499748596')
                )
        )->withPrivacyPreferences(
            new PrivacyPreferences(
                PrivacyPreferenceEmail::ALL(),
                PrivacyPreferenceSMS::NOTIFICATION()
            )
        );
    }

    /**
     * @param Gender|null $gender
     *
     * @return PassHolder
     */
    public function getCompletePassHolder(Gender $gender = null)
    {
        if (!$gender) {
            $gender = Gender::FEMALE();
        }

        $kansenStatuten = (new KansenStatuutCollection())
            ->withKey(
                10,
                (new KansenStatuut(
                    new Date(
                        new Year('2015'),
                        Month::getByName('SEPTEMBER'),
                        new MonthDay(15)
                    )
                ))->withStatus(
                    KansenStatuutStatus::IN_GRACE_PERIOD()
                )->withCardSystem(
                    new CardSystem(
                        new CardSystemId('10'),
                        new StringLiteral('UiTPAS Regio Aalst')
                    )
                )
            )
            ->withKey(
                30,
                (new KansenStatuut(
                    new Date(
                        new Year('2015'),
                        Month::getByName('SEPTEMBER'),
                        new MonthDay(15)
                    )
                ))->withStatus(
                    KansenStatuutStatus::EXPIRED()
                )->withCardSystem(
                    new CardSystem(
                        new CardSystemId('30'),
                        new StringLiteral('UiTPAS Regio Brussel')
                    )
                )
            );

        return (new PassHolder(
            (new Name(
                new StringLiteral('Layla'),
                new StringLiteral('Zyrani')
            ))->withMiddleName(
                new StringLiteral('Zoni')
            ),
            (new Address(
                new StringLiteral('1090'),
                new StringLiteral('Jette (Brussel)')
            ))->withStreet(
                new StringLiteral('Rue Perdue 101 /0003')
            ),
            (new BirthInformation(
                Date::fromNativeDateTime(new \DateTime('1976-09-13'))
            ))->withPlace(
                new StringLiteral('Casablanca')
            )
        ))->withINSZNumber(
            new INSZNumber('93051822361')
        )->withGender(
            $gender
        )->withNationality(
            new StringLiteral('Maroc')
        )->withPicture(
            new StringLiteral('R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=')
        )->withContactInformation(
            (new ContactInformation())
                ->withEmail(
                    new EmailAddress('zyrani_.hotmail.com@mailinator.com')
                )->withTelephoneNumber(
                    new StringLiteral('0488694231')
                )->withMobileNumber(
                    new StringLiteral('0499748596')
                )
        )->withKansenStatuten(
            $kansenStatuten
        )->withPrivacyPreferences(
            new PrivacyPreferences(
                PrivacyPreferenceEmail::ALL(),
                PrivacyPreferenceSMS::NOTIFICATION()
            )
        )->withPoints(
            new Integer(20)
        );
    }
}
