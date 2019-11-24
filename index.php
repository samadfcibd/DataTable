<?php
require('DataTable.php');

use DT_library\DataTable;

//$data = [
//    [
//        'name' => 'Abdus Samad',
//        'email' => 'samadocpl@gmail.com'
//    ],
//    [
//        'name' => 'Ibrahim Ahad',
//        'email' => 'ahad@gmail.com'
//    ]
//];
$data = [
        'name' => 'Abdus Samad',
        'email' => 'samadocpl@gmail.com'
];


$table = new DataTable();
$html_table = $table->toTable($data);
//var_dump($html_table);
?>


<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<div class="container" id="main-content">
    <h2>Welcome to my website!</h2>
    <p>Some content goes here! Let's go with the classic "lorem ipsum."</p>

    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
        laborum.
    </p>

    <?php echo $html_table; ?>
</div>

<script
        src="https://code.jquery.com/jquery-3.4.1.slim.js"
        integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</body>
</html>


