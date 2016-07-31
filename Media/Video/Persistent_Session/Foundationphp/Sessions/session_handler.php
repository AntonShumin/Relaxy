<?php
namespace Foundationphp\Sessions;

class MysqlSessionHandler implements \SessionHandlerInterface {
    protected $db;
    protected $useTransactions;
    protected $expiry;
    protected $table_sess = 'session';
    protected $col_expiry = 'expiry';
    protected $col_data = 'data';
    protected $unluckStatements = [];

    //Failsafe, voor PDO error mode = exception
    public function __construct(\PDO $db, $useTransactions = true)
    {
        $this->db = $db;
        if ($this->db->getAttribute(\PDO::ATTR_ERRMODE) != \PDO::ERRMODE_EXCEPTION) {
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        $this->useTransactions = $useTransactions;
        $this->expiry = time() + (int) ini_get('session.gc_maxlifetime');
    }

    public function open($save_path,$name) {

    }

    public function read($session_id) {

    }

    public function write($session_id, $data) {

    }

    public function close() {

    }

    public function destroy($session_id) {

    }

    public function gc ($maxlifetime) {

    }



}