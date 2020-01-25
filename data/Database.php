<?php 

require_once 'config.php';

class Database 
{
	protected $user = username,
			  $host = hostname,
			  $pass = password,
			  $db_name = database,
			  $dbh,
			  $stmt;

	public function __construct()
	{
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->db_name;
		$this->dsn = $dsn;
		$dbh = new PDO($dsn, $this->user, $this->pass);
		$this->dbh = $dbh;

	}

	public function execute()
	{
		return $this->stmt->execute();
	}

	public function get($tb_name)
	{
		$this->stmt = $this->dbh->prepare('SELECT * FROM '.$tb_name);
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function get_where($tb_name, $cl_name, $conj, $name)
	{
		$this->stmt = $this->dbh->prepare('SELECT * FROM '.$tb_name.' WHERE '.$cl_name.' '.$conj.''.'"'.$name.'"');
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($query, $data)
	{
		$this->stmt = $this->dbh->prepare($query);
		return $this->execute($data);

	}


}

$db = new Database();

?>