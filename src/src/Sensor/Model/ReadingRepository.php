<?php

namespace Sensor\Model;

interface ReadingRepository
{

    public function saveReading(string $uuid, float $temperature);
}