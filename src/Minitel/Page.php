<?php
/**
 * @author jambonbill
 */

namespace Minitel;

use PDO;
use Exception;
use Djang\Base;

/**
 * Minitel page (vdt)
 */
class Page
{
	private $_Base;
	private $_user;
    private $_DEBUG=false;
    private $_schema='minitel';

	public function __construct (Base $Base)
    {
        $this->_Base=$Base;
    }

    public function db()
    {
    	return $this->_Base->db();
    }

    public function _uid()
    {
    	return $this->_Base->userId();
    }


    /**
     * Return list of pages
     * @return [type] [description]
     */
    public function list()
    {
        $sql="SELECT id, name FROM `minitel`.`page` WHERE id>0;";
        $q=$this->db()->query($sql) or die(print_r($this->db()->errorInfo(), true) . "<hr />$sql");

        $dat=[];
        while($r=$q->fetch(PDO::FETCH_ASSOC)){
            $dat[]=$r;
        }
        return $dat;
    }


    /**
     * Create a new videotex page record
     * @param  string $name    [description]
     * @param  string $b64data [description]
     * @return [type]          [description]
     */
    public function create(string $name, string $b64data)
    {
        //convert b64 to datastr
        $datastr='';
        $strA=base64_decode($b64data);
        for($j=0;$j<strlen($strA);$j++){//TO BINARY
            $datastr.=$strA[$j];//chr
        }

        $sql ="INSERT INTO `minitel`.page (name, data, created_by, created_at) ";
        $sql.="VALUES (".$this->db()->quote(trim($name)).", ".$this->db()->quote($datastr).",".$this->_uid().", NOW());";

        $q=$this->db()->query($sql) or die(print_r($this->db()->errorInfo(), true) . "<hr />$sql");
        $id=$this->db()->lastInsertId();

        if (!$id) {
            return false;
        }

        return +$id;
    }

    public function update(int $id)
    {

    }



    public function updatePermalink(int $id, string $permalink)
    {
        return $id;
    }


    /**
     * Delete one record
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function delete(int $id)
    {
        $sql="DELETE FROM `minitel`.page WHERE id=$id AND created_by=".$this->_uid()." LIMIT 1;";
        $this->db()->query($sql) or die(print_r($this->db()->errorInfo(), true) . "<hr />$sql");
        //log?
        return $id;
    }

    /**
     * Import a videotex file (.vdt)
     * @param  string $filename [description]
     * @return [type]           [description]
     */
    public function import(string $filename)
    {
        if (!is_file($filename)) {
            throw new Exception("$filename not found", 1);
        }

        $data=file_get_contents($filename);

        return $this->create(basename($filename), base64_encode($data));
    }

}