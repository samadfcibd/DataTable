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

    public function addColumn($column_name, $user_function)
    {

        // Single array
        if ($this->input_type == 1)
        {

        }
        // Array of array
        else {
            $all_data = [];
            foreach ($this->data as $row)
            {
//                echo '<pre>';
//                print_r($user_function);
//                exit;
                $row[$column_name] = $user_function();
                array_push($all_data, $row);
            }
            $this->data = $all_data;
        }
        return $this;
    }

    public function toJson()
    {
        return json_encode($this->data);
    }

    public function toXml()
    {
        // Creating a object of simple XML element
        $xml = new SimpleXMLElement('<?xml version="1.0"?><dataTable></dataTable>');

        // Visit all key value pair
        foreach ($this->data as $k => $v) {

            // If there is nested array then
            if (is_array($v)) {
                $child = $xml->addChild("row_$k");
                foreach ($v as $key => $value) {
                    $child->addChild($key, $value);
                }
//                array_walk($v, function ($value, $key) use ($child) {
//                    $child->addChild($key, $value);
//                });
            } else {
                $xml->addChild($k, $v);
            }
        }
        return $xml->saveXML();
    }

    public function toCSV()
    {

        $fileName = 'DataTable.csv';

        header("Content-Type: application/csv; charset=UTF-8");
        header("Content-Disposition: attachment; filename={$fileName}");

        // Open file with write mode
        $f = fopen('php://output', 'w');

        // Set first row as header
        $set_column_name = false;
        if ($this->input_type == 1) {
            fputcsv($f, array_keys($this->data));
            $set_column_name = true;
        }

        foreach ($this->data as $row) {
            // Set first row as header, if it hasn't been added yet
            if (!$set_column_name) {
                fputcsv($f, array_keys($row));
                $set_column_name = true;
            }

            fputcsv($f, $row);
        }
        // Close the file
        fclose($f);
        // Make sure nothing else is sent, our file is done
        exit;
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
