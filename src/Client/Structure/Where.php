<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Structure;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static Where attic()
 * @method bool isAttic()
 * @method static Where backDoor()
 * @method bool isBackDoor()
 * @method static Where backyard()
 * @method bool isBackyard()
 * @method static Where basement()
 * @method bool isBasement()
 * @method static Where bathroom()
 * @method bool isBathroom()
 * @method static Where bedroom()
 * @method bool isBedroom()
 * @method static Where deck()
 * @method bool isDeck()
 * @method static Where den()
 * @method bool isDen()
 * @method static Where diningRoom()
 * @method bool isDiningRoom()
 * @method static Where downstairs()
 * @method bool isDownstairs()
 * @method static Where driveway()
 * @method bool isDriveway()
 * @method static Where entryway()
 * @method bool isEntryway()
 * @method static Where familyRoom()
 * @method bool isFamilyRoom()
 * @method static Where frontDoor()
 * @method bool isFrontDoor()
 * @method static Where frontYard()
 * @method bool isFrontYard()
 * @method static Where garage()
 * @method bool isGarage()
 * @method static Where guestHouse()
 * @method bool isGuestHouse()
 * @method static Where guestRoo()
 * @method bool isGuestRoo()
 * @method static Where hallway()
 * @method bool isHallway()
 * @method static Where kidsRoom()
 * @method bool isKidsRoom()
 * @method static Where kitchen()
 * @method bool isKitchen()
 * @method static Where livingRoom()
 * @method bool isLivingRoom()
 * @method static Where masterBedroom()
 * @method bool isMasterBedroom()
 * @method static Where office()
 * @method bool isOffice()
 * @method static Where outside()
 * @method bool isOutside()
 * @method static Where patio()
 * @method bool isPatio()
 * @method static Where shed()
 * @method bool isShed()
 * @method static Where sideDoor()
 * @method bool isSideDoor()
 * @method static Where upstairs()
 * @method bool isUpstairs()
 */
final class Where extends AbstractEnum
{
    private const ATTIC = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdDwn4ZQMIxNLQ';
    private const BACK_DOOR = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdAmKZQqbtINmw';
    private const BACKYARD = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdA-hcIFBgFKRw';
    private const BASEMENT = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdCJ9QZJEom44A';
    private const BATHROOM = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdBg1bFS3QejQA';
    private const BEDROOM = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdA2trAbwAOa6Q';
    private const DECK = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdA_duqJr9n_6g';
    private const DEN = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdAWZzi0x6WfBQ';
    private const DINING_ROOM = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdCDJZkPV18stQ';
    private const DOWNSTAIRS = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdCyKNHKRjgLMQ';
    private const DRIVEWAY = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdAH_LtrO20oXg';
    private const ENTRYWAY = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdDFNz8PTiPcBw';
    private const FAMILY_ROOM = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdBzyo4xVGd4GA';
    private const FRONT_DOOR = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdCBrmt3uW1Rlw';
    private const FRONT_YARD = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdD4xbv1kcsP1g';
    private const GARAGE = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdASDnH26RGx2g';
    private const GUEST_HOUSE = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdAaZ4aKgcYgPw';
    private const GUEST_ROO = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdBOXMkktzD-VQ';
    private const HALLWAY = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdBBT3HiqFbf2g';
    private const KIDS_ROOM = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdB63FEi4CyeRw';
    private const KITCHEN = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdBm1TS3NdJczA';
    private const LIVING_ROOM = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdCkkcxb8oJweA';
    private const MASTER_BEDROOM = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdBD44gB_13HlQ';
    private const OFFICE = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdBbFhBiWtUAOw';
    private const OUTSIDE = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdAJNQaKtpMK8g';
    private const PATIO = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdDZssknN6eyAg';
    private const SHED = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdDzhhW1iLW59Q';
    private const SIDE_DOOR = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdBfPG1gmDhfEA';
    private const UPSTAIRS = 'v1H46Ty8xdp1WpWCpLD_i6QmUY8QdS0HRhLRy92_VdDKe7hsT81FGw';
}
