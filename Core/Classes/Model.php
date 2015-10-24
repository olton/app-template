<?php

namespace Core\Classes;

class Model extends Super {
    protected $provider;
    protected $found_rows = 0;
    public $page_size = 20;

    public function RowsFound()
    {
        return $this->found_rows;
    }

    public function __construct(MySQL $provider = null){

        if ($provider) {
            $this->provider = $provider;
        } else {
            if (isset($GLOBALS['database']['provider'])) {
                $this->provider = $GLOBALS['database']['provider'];
            } else {
                throw new \Exception("Provider is not defined", E_USER_ERROR);
            }
        }
    }

    public function __destruct () {
        unset($this->provider);
    }

    public function GetProvider(){
        return $this->provider;
    }

    public function Select($sql){
        return $this->provider->Select($sql);
    }

    public function Update($table, $data, $condition = false, $escape = false){
        return $this->provider->Update($table, $data, $condition, $escape);
    }

    public function Insert($table, $data, $on_duplicate_key = false, $ignore = false, $escape = false){
        return $this->provider->Insert($table, $data, $on_duplicate_key, $ignore, $escape);
    }

    public function Delete($table, $condition = false){
        return $this->provider->Delete($table, $condition);
    }

    public function ExecProc($name, $params){
        return $this->provider->ExecProc($name, $params);
    }

    public function ExecFunc($name, $params){
        return $this->provider->ExecFunc($name, $params);
    }

    public function Rows($handle){
        return $this->provider->Rows($handle);
    }

    public function Columns($table){
        return $this->provider->Columns($table);
    }

    public function ID(){
        return $this->provider->ID();
    }

    public function Fetch($handle = false, $how = 'ARRAY'){
        return $this->provider->Fetch($handle, $how);
    }

    public function FetchArray($handle = false){
        return $this->provider->FetchArray($handle);
    }

    public function FetchObject($handle = false, $class = false){
        return $this->provider->FetchObject($handle, $class);
    }

    public function FetchAll($handle = false){
        return $this->provider->FetchAll($handle);
    }

    public function FetchResult($handle = false, $row = 0, $field = 0){
        return $this->provider->FetchResult($handle, $row, $field);
    }

    public function Transaction(){
        return $this->provider->Transaction();
    }

    public function Commit(){
        return $this->provider->Commit();
    }

    public function Rollback(){
        return $this->provider->Rollback();
    }

    public function _e($val) {
        return $this->provider->Escape($val);
    }

    public function ExecScript($sql, $delimiter = ";")
    {
        $scripts = explode($delimiter, $sql);
        if (empty($scripts)) return false;

        foreach($scripts as $script){
            if (strlen(trim($script)) == 0) continue;
            $this->Select($script);
        }
        return true;
    }

    public function Limit($page = null){
        $start = (!$page ? 0 : $page) * $this->page_size - $this->page_size;
        $start = ($start < 0) ? 0 : $start;
        $limit = $start >= 0 ? "limit $start, {$this->page_size}" : "limit {$this->page_size}";
        //var_dump($limit);
        return $limit;
    }

    public function CheckValue($table, $field, $value, $operator = "=")
    {
        $sql = "select count(*) from " . $table . " where " . $field . $operator . $this->_e($value);
        $h = $this->Select($sql);
        return $this->FetchResult($h, 0, 0) > 0;
    }

    public function MultiQuery($sql)
    {
        return $this->provider->MultiQuery($sql);
    }

    public function GetStack(){
        return $this->provider->stack;
    }
}
