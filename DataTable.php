<?php

namespace DT_library;

class DataTable
{

    /*
     * 1 = Single array
     * 2 = Multidimensional array
     */
    private $input_type;

    private $keys;

    protected static $key_count;

    public function toTable($array)
    {
        $this->keys = self::get_array_keys($array);

        $table_head_columns = '<thead>';
        $table_body_columns = '<tbody>';

        if ($this->input_type == 1)
        {
            foreach ($array as $key => $value)
            {
                $table_head_columns .= '<th>' . $key . '</th>';
                $table_body_columns .= '<tr><td>' . $value . '</td></tr>';
            }
        } else {
            foreach ($this->keys as $key) {
                $table_head_columns .= '<th>' . $key . '</th>';

                $column_values = array_column($array, $key);
                $table_body_columns .= '<tr>';
                foreach ($column_values as $value) {
                    $table_body_columns .= '<td>' . $value . '</td>';
                }
                $table_body_columns .= '</tr>';
            }
        }
        $table_head_columns .= '</thead>';
        $table_body_columns .= '</tbody>';
        return '<table class="table table-bordered">' . $table_head_columns . $table_body_columns . '</table>';
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
