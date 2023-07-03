Sensor Homework
=====================================

Installation instructions
-------------------------


## Requirements
- Docker 19+
- docker-compose >= 1.24


### Development Installation with Docker

1. ```bash
   download archive 
   ```


2. ```bash
   docker-compose up -d
   ```

How to test?
-------------------------

routes are:

POST 127.0.0.1:8080/api/push


```bash
{
  "reading": {
      "sensor_uuid": "unique uuid of sensor",
      "temperature": "decimal format, xxx.xx, in celsius" }
}
```

GET 127.0.0.1:8080/sensor/read/{sensor_ip}

GET 127.0.0.1:8080/api/average/{days}

GET 127.0.0.1:8080/api/average/{sensor_uuid}/{hours}
