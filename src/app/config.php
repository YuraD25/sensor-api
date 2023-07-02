<?php

use Sensor\Db\Db;
use Sensor\Model\ReadingRepository;
use Sensor\Model\SensorRepository;
use Sensor\Repository\DatabaseReadingRepository;
use Sensor\Repository\DatabaseSensorRepository;
use function DI\create;

return [
    Db::class => DI\autowire(Db::class), // Bind the Db class
    SensorRepository::class => DI\autowire(DatabaseSensorRepository::class),
    ReadingRepository::class => DI\autowire(DatabaseReadingRepository::class),
];