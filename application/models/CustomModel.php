<?php

class CustomModel extends ci_model
{
    public function insertInto($tableName = null, $data = null)
    {
        $this->db->insert($tableName, $data);
        $insert_id = $this->db->insert_id();
        return $this->db->affected_rows() ? $insert_id : FALSE;
    }
    public function selectAllWhere($tableName = null, $condition = null)
    {
        $this->db->where($condition);
        $query = $this->db->get($tableName)->result_array();
        return $this->db->affected_rows() ? $query : false;
    }
    // function to extract all data form data base by table name short by given 
    public function selectAll($tableName = null, $order_col = null)
    {
        $this->db->order_by($order_col, "asc");
        $result = $this->db->get($tableName)->result_array();

        return $this->db->affected_rows() ? $result : FALSE;
    }

    // function to extract distinct data from given table
    public function selectDistict($tableName = null, $selection_value = null)
    {
        $this->db->distinct();
        $this->db->select($selection_value);
        $result = $this->db->get($tableName)->result_array();
        return $this->db->affected_rows() ? $result : FALSE;
    }
    // function to select all data from database in given condition 
    public function selectAllFromWhere($tableName = null, $condition = null, $order_col = null)
    {
        $this->db->order_by($order_col, "asc");
        $query = $this->db->get_where($tableName, $condition)->result_array();
        if ($query != null) {
            return $this->db->affected_rows() ? $query : FALSE;
        } else {
            return FALSE; //$this->db->affected_rows()?$query[0][$query]:FALSE;
        }
    }

    // update table 

    public function update_table($table = null, $condition = null, $data = null)
    {
        // $this->db->set('status', $data);
        $this->db->where($condition);
        $query = $this->db->update($table, $data);
        if ($query != null) {
            return true;
        } else {
            return false;
        }
    }
    // function to delete row with given condition
    public function deleteRow($tableName = null, $condition = null)
    {
        $this->db->where($condition);
        $query = $this->db->delete($tableName);
        return ($query != null) ? FALSE : TRUE;
    }
}
