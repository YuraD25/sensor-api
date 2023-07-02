<?php

namespace Sensor\Controller;
use Sensor\Model\ReadingRepository;
use Sensor\Model\SensorRepository;
use Symfony\Component\HttpFoundation\Response;

class SensorController
{

    public function __construct(
        private readonly SensorRepository $sensorRepository,
        private ReadingRepository $readingRepository

    )
    {}


    public function simulateSensorData(mixed $sensor_ip = ''): ?Response
    {

        if (empty($sensor_ip)) {
            $response = new Response('sensor_ip is missing',Response::HTTP_BAD_REQUEST,['content-type'=>'application/json']);
        } else {
            $temperature = mt_rand(-10, 80);
            // add sensor
            $reading_id = $this->sensorRepository->firstOrCreate($sensor_ip);
            // add reading
            $this->readingRepository->saveReading($sensor_ip, $temperature);


            $response = new Response("{$reading_id},<{$temperature}>",Response::HTTP_OK,['content-type'=>'application/csv']);

        }
        $response->send();




        $this->sensorRepository->saveReading();

    }

}