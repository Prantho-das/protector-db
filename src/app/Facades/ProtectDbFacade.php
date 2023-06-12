<?php
namespace Pranthokumar\ProtectDb\App\Facades;

use Illuminate\Support\Facades\File;

class ProtectDbFacade
{
    public $host = "";
    public $port = "";
    public $username = "";
    public $password = "";
    public $database = "";
    public $fileName = "";

    public function __construct()
    {
        $this->host = config('protect-db.host');
        $this->port = config('protect-db.port');
        $this->username = config('protect-db.username');
        $this->password = config('protect-db.password') ?? '';
        $this->database = config('protect-db.database');
        $this->fileName = $this->database . '-' . date('Y-m-d-h-m-i') . '.sql';

    }

    public function protect()
    {
        switch (config('protect-db.connection')) {
            case 'mysql':
                return $this->protectMysql();
                break;
            case 'pgsql':
                return $this->protectPostgres();
                break;
            case 'sqlite':
                return $this->protectSqlite();
                break;
            case 'mongodb':
                return $this->protectMongo();
                break;
            case 'redis':
                return $this->protectRedis();
                break;
            default:
                return "No database connection found";
                break;
        }
    }

    public function protectMysql()
    {

        $command = "mysqldump -u{$this->username} --password={$this->password} {$this->database} > {$this->fileName}";

        try {
            //code...
            exec($command, $output);
            passthru($command);
            $this->dbLog();
            return true;
        } catch (\Exception $th) {
            return $th->getMessage();
        }

    }

    public function protectPostgres()
    {
        $command = "pg_dump -U {$this->username} -h {$this->host} -p {$this->port} {$this->database} > {$this->fileName}";
        try {
            //code...
            exec($command);

            return true;
        } catch (\Exception $th) {
            return $th->getMessage();
        }

    }

    public function protectSqlite()
    {
        $command = "sqlite3 {$this->database} .dump > {$this->fileName}";
        try {
            //code...
            exec($command);

            return true;
        } catch (\Exception $th) {
            return $th->getMessage();
        }

    }

    public function protectMongo()
    {
        $command = "mongodump --host {$this->host} --port {$this->port} --username {$this->username} --password {$this->password} --db {$this->database} --out {$this->database}.sql";
        try {
            //code...
            exec($command);

            return true;
        } catch (\Exception $th) {
            return $th->getMessage();
        }

    }

    public function protectRedis()
    {
        $command = "redis-cli save";
        try {
            //code...
            exec($command);

            return true;
        } catch (\Exception $th) {
            return $th->getMessage();
        }

    }

    protected function dbLog($file = null)
    {
        $message = "Database backup successfully done at " . date('Y-m-d h:m:i') . "\n";
        File::append(storage_path('logs/db-logs.log'), $message);
        File::append(__DIR__ . '/../../logs/db-logs.log', $message);

        return true;
    }

    public function getTotalBackups()
    {
        $fileExists = File::exists(__DIR__ . '/../../logs/db-logs.log');
        if (!$fileExists) {
            return collect([]);
        }
        $fileData = File::get(__DIR__ . '/../../logs/db-logs.log');
        $fileData = explode("\n", $fileData);
        $fileData = array_filter($fileData);
        return collect($fileData)->paginate(10);
    }
}