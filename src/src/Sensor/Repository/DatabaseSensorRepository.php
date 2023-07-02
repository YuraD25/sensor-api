<?php
namespace Sensor\Repository;

use Sensor\Db\Db;
use Sensor\Model\Sensor;
use Sensor\Model\SensorRepository;

class DatabaseSensorRepository implements SensorRepository
{

    public function __construct(
        private Db $db
    )
    {}

    public function getSensorByUuid(string $uuid): ?Sensor
    {
        $result = $this->db->query(
            'SELECT id FROM sensors WHERE uuid=:uuid',
            [':uuid' => $uuid],
            Sensor::class
        );
        return !empty($result) ? $result[0] : null;
    }
    public function getSensors(): ?array
    {
        $results = $this->db->query(
            'SELECT id, uuid FROM sensors',
            [], Sensor::class
        );

        return !empty($results) ? $results : null;
    }

    public function firstOrCreate(mixed $sensorIP): int
    {
        $this->db->query(
            'INSERT INTO sensors (uuid) VALUES (UUID_TO_BIN(:uuid)) ON DUPLICATE KEY UPDATE reading_id=reading_id+1;',
            [':uuid' => $sensorIP], Sensor::class
        );
        $result = $this->db->query(
            'SELECT reading_id FROM sensors WHERE uuid=UUID_TO_BIN(:uuid)',
            [':uuid' => $sensorIP], Sensor::class
        );
        return $result[0]->reading_id;

    }

}