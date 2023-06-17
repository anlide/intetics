<?php

class database
{
    /**
     * @var mysqli|null
     */
    private static ?mysqli $mysqli = null;

    /**
     * @return void
     */
    public static function connect(): void
    {
        $config = [];
        $content = file_get_contents('.env');
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            list($key, $value) = explode('=', $line);
            $config[trim($key)] = trim($value);
        }
        self::$mysqli = new mysqli(
            $config['DB_HOST'],
            $config['DB_USER'],
            $config['DB_PASSWORD'],
            $config['DB_NAME']);
    }

    /**
     * @param $sql
     * @return array
     */
    public static function sql($sql): array
    {
        $result = self::$mysqli->query($sql);
        if (!is_bool($result) && $result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free_result();
        } else {
            $data = [];
        }
        return $data;
    }

    /**
     * @return int
     */
    public static function lastInsertId(): int
    {
        return self::$mysqli->insert_id;
    }
}