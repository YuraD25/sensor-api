<?php

namespace Sensor\Controller;
use Sensor\Model\ReadingRepository;
use Symfony\Component\HttpFoundation\Response;

class ReadingController
{
    public function __construct(
        private readonly ReadingRepository $readingRepository

    )
    {}

    /**
     * @param array $reading
     * @return array|null
     */
    public function saveReading(array $reading = []): ?string
    {

        $sensorUUID = $reading['sensor_uuid'] ?? '';
        $temperature = $reading['temperature'] ?? '';
        $error = [];

        if (empty($sensorUUID)) {
            //throw new \Exception('sensor_uuid is missing');
            $error[] = 'sensor_uuid is missing';
        }
        if (empty($temperature)) {
            //throw new \Exception('temperature is missing');
            $error[] = 'temperature is missing';
        }
        if (!$error) {
            $this->readingRepository->saveReading($sensorUUID, $temperature);
            $response = new Response('success!',Response::HTTP_OK,['content-type'=>'application/json']);
        } else {
            $response = new Response(implode(', ', $error),Response::HTTP_BAD_REQUEST,['content-type'=>'application/json']);
        }
        $response->send();
    }

    public function getAverageTemperatureDays(int $days = 7): Response
    {
        $filter_data['days'] = $days;
        $result = $this->readingRepository->getAverageTemperature($filter_data);
        $response = new Response(json_encode($result),Response::HTTP_OK,['content-type'=>'application/json']);
        $response->send();
    }
    public function getAverageTemperatureBySensor(string $sensor_uuid = '', int $hours = 1): Response
    {
        $filter_data['sensor_uuid'] = $sensor_uuid;
        $filter_data['hours'] = $hours;
        $result = $this->readingRepository->getAverageTemperature($filter_data);
        $response = new Response(json_encode($result),Response::HTTP_OK,['content-type'=>'application/json']);
        $response->send();
    }

}