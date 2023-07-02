<?php

namespace Sensor\Repository;

use Sensor\Db\Db;
use Sensor\Model\Reading;
use Sensor\Model\ReadingRepository;

class DatabaseReadingRepository implements ReadingRepository
{

    public function __construct(
        private readonly Db $db
    )
    {}


    public function saveReading(string $uuid, float $temperature): void
    {
         $this->db->query(
            'INSERT INTO readings SET sensor_uuid=UUID_TO_BIN(:uuid), temperature=:temperature, created_at = NOW()',
            [':uuid' => $uuid, ':temperature' => $temperature, ],
            Reading::class
        );
    }
    public function getAverageTemperature(array $filter_data): ?array
    {
        $vars = [];
        $where = [];
        if (isset($filter_data['days'])) {
            if ($filter_data['days'] < 0) $filter_data['days'] = 0;
            $vars[':days'] = (int)$filter_data['days'];
            $where[] = 'created_at >= ( CURDATE() - INTERVAL :days DAY )';
        }
        if (isset($filter_data['hours']) && !empty($filter_data['hours'])) {
            $vars[':hours'] = (int)$filter_data['hours'];
            $where[] = 'created_at >= ( CURDATE() - INTERVAL :hours HOUR )';
        }
        if (isset($filter_data['sensor_uuid']) && !empty($filter_data['sensor_uuid'])) {
            $vars[':sensor_uuid'] = $filter_data['sensor_uuid'];
            $where[] = 'sensor_uuid = UUID_TO_BIN(:sensor_uuid)';
        }
        $sql = 'SELECT avg(temperature) as average_temperature FROM readings WHERE ' . implode(' AND ', $where);


        $result = $this->db->query(
            $sql,
            $vars,
            Reading::class
        );
        $averageTemperature = $result[0]->average_temperature;
        return ['average_temperature' => $averageTemperature];
    }
}