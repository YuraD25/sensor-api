<?php

namespace Sensor\Model;

interface SensorRepository {
    /**
     * @return Sensor[]
     */

    public function getSensors();

    public function getSensorByUuid(string $uuid);

    public function firstOrCreate(mixed $sensorIP);

}