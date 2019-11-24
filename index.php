<?php
require('DataTable.php');
use DT_library\DataTable;

$data = [
    [
        'name' => 'Abdus Samad',
        'email' => 'samadocpl@gmail.com'
    ],
    [
        'name' => 'Ibrahim Ahad',
        'email' => 'ahad@gmail.com'
    ]
];


$table = new DataTable();

echo $table::toTable($data);


