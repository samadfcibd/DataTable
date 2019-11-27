<?php

namespace DT_library;

use SimpleXMLElement;

class DataTable
{

    /*
     * 1 = Single array
     * 2 = Multidimensional array
     */
    private $input_type;

    private $keys;

    private $data;

    protected static $key_count;

    public function of($array)
    {
        if (count($array) != count($array, COUNT_RECURSIVE)) {
            $this->input_type = 2;
            $this->data = $array;
        } else {
            $this->input_type = 1;
            $this->data = $array;
        }
        return $this;
    }

    public function toTable()
    {
        if ($this->input_type == 2) {

            $table_head_columns = '<thead><tr>';
            foreach (array_keys($this->data[0]) as $key => $value) {
                $table_head_columns .= '<th>' . $value . '</th>';
            }
            $table_head_columns .= '</tr><thead>';

            $table_body_columns = '';
            foreach ($this->data as $key => $value) {
                // $column_values = array_column($array, $value);
                $table_body_columns .= '<tr>';
                foreach ($value as $key => $value) {
                    $table_body_columns .= '<td>' . $value . '</td>';
                }
                $table_body_columns .= '</tr>';
            }
            $table_body_columns = '<tbody>' . $table_body_columns . '</tbody>';
            return '<table class="table table-bordered">' . $table_head_columns . $table_body_columns . '</table>';

        } else {

            $table_head_columns = '<thead><tr>';
            $table_body_columns = '<tbody><tr>';
            foreach ($this->data as $key => $value) {
                $table_head_columns .= '<th>' . $key . '</th>';
                $table_body_columns .= '<td>' . $value . '</td>';
            }
            $table_head_columns .= '<tr></thead>';
            $table_body_columns .= '<tr></tbody>';
            return '<table class="table table-bordered">' . $table_head_columns . $table_body_columns . '</table>';
        }
    }

    public function toJson()
    {
        return json_encode($this->data);
    }

    public function toXml()
    {
        // Creating a object of simple XML element
        $xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

        // function call to convert array to xml
        array_walk_recursive($this->data, array ($xml, 'addChild'));
        print $xml->asXML();
    }

    private function get_array_keys($array)
    {
        if (count($array) != count($array, COUNT_RECURSIVE)) {
            $this->input_type = 2;
            $key_temp = [];
            foreach ($array as $key => $value) {
                foreach ($value as $key => $value) {
                    array_push($key_temp, $key);
                }
            }
            return array_unique($key_temp);
        }
        $this->input_type = 1;
    }
}
