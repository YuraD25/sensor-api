<?php

namespace Sensor\Model;

class Reading {

    public int $id;
    public string $sensor_uuid;
    public float $temperature;
    public float $created_at;

}
