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
        return true;
    }

    public function read($session_id) {
        try {
            if ($this->useTransactions) {
                $this->db->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
                $this->db->beginTransaction();
            } else {
                $this->unlockStatements[] = $this->getLock($session_id);
            }
            $sql =  "SELECT $this->col_expiry,$this->col_data
                    FROM $this->$this->table_sess WHERE $this->col_sid = :sid";
            if ($this->useTransactions) {
                $sql .= ' FOR UPDATE';
            }
            $selectStmt = $this->db->prepare($sql);
            $selectStmt->bindParam(':sid',$session_id);
            $selectStmt->execute();
            $results = $selectStmt->fetch(\PDO::FETCH_ASSOC);
            if ($results) {
                if($results[$this->col_expiry] <time()) {
                    return '';
                }
                return $results[$this->col_data];
            }
            if($this->useTransactions) {
                $this->initializeRecord($selectStmt);
            }
            return '';
        } catch (\PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
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