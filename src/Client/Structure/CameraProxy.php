<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Structure;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\Camera\Event;
use LauLamanApps\NestApi\Client\DeviceProxy;
use LauLamanApps\NestApi\NestClientInterface;

/**
 * @method string getDeviceId()
 * @method string getStructureId()
 * @method string getWhereId()
 * @method string getName()
 * @method string getNameLong()
 * @method string getSoftwareVersion()
 * @method bool isOnline()
 * @method bool isStreaming()
 * @method bool isAudioInputEnabled()
 * @method DateTimeImmutable getLastIsOnlineChange()
 * @method bool isVideoHistoryEnabled()
 * @method Event|null getLastEvent()
 * @method string getWebUrl()
 * @method string getAppUrl()
 */
final class CameraProxy extends DeviceProxy
{
    protected function __load(NestClientInterface $client, string $deviceId)
    {
        return $client->getCamera($deviceId);
    }
}
