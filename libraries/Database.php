<?php
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;
    private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8mb4';
        $options = [
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
            // TiDB Cloud requires TLS. Vercel's PHP runtime commonly provides
            // the system CA bundle at this path; override it with DB_SSL_CA if needed.
            PDO::MYSQL_ATTR_SSL_CA => getenv('DB_SSL_CA') ?: '/etc/ssl/certs/ca-certificates.crt',
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
        ];

        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    }

    public function query($query) { $this->stmt = $this->dbh->prepare($query); }

    public function bind($param, $value, $type = null)
    {
        if ($type === null) {
            $type = is_int($value) ? PDO::PARAM_INT : (is_bool($value) ? PDO::PARAM_BOOL : (is_null($value) ? PDO::PARAM_NULL : PDO::PARAM_STR));
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() { return $this->stmt->execute(); }
    public function resultset() { $this->execute(); return $this->stmt->fetchAll(); }
    public function single() { $this->execute(); return $this->stmt->fetch(); }
    public function rowCount() { return $this->stmt->rowCount(); }
    public function lastInsertId() { return $this->dbh->lastInsertId(); }
    public function beginTransaction() { return $this->dbh->beginTransaction(); }
    public function endTransaction() { return $this->dbh->commit(); }
    public function cancelTransaction() { return $this->dbh->rollBack(); }
}
