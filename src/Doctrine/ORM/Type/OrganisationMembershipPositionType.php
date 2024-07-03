<?php

declare(strict_types=1);

namespace App\Doctrine\ORM\Type;

class OrganisationMembershipPositionType extends EnumType
{
    public const POSITION_OWNER = 'owner';

    public const POSITION_EMPLOYEE = 'employee';

    static protected string $name = 'organisationMemberPositionType';

    static protected string $choicePrefix = 'organisation.member.position.type.';

    static protected string $choiceSuffix = '';

    static protected array $values = [
        self::POSITION_OWNER,
        self::POSITION_EMPLOYEE,
    ];
}
