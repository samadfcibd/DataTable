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
//$data = [
//        'name' => 'Abdus Samad',
//        'email' => 'samadocpl@gmail.com'
//];


$table = new DataTable();

if (isset($_POST['downloadCSV']))
{
    $table->of($data)->toCSV();
}

$toTable = $table->of($data)->toTable();

$toJson = $table->of($data)->toJson();

$toXml = $table->of($data)->toXml();

$value = 'Edit';
$table_after_addcolumn = $table->of($data)
    ->addColumn('Action', function ($data) use ($value) {
        return '<button class="btn btn-success btn-xs">'. $data['name'] . $value .'</button>';
    })
    ->toTable();

//$toCSV = $table->of($data)->toCSV();
//echo '<pre>';
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

    <h3>To Table</h3>
    <?php print_r($toTable); ?>

    <h3>To Json</h3>
    <?php print_r($toJson); ?>

    <h3>To XML</h3>
    <textarea rows="10" cols="40">
    <?php echo $toXml; ?>
    </textarea>


    <h3>To CSV</h3>
    <form method="post">
        <button class="btn btn-success" type="submit" value="downloadCSV" name="downloadCSV">Download CSV file</button>
    </form>
    <br/>
    <br/>

    <h3>Add Column</h3>
    <?php print_r($table_after_addcolumn); ?>


    <!--    --><?php //if (count($data) > 0): ?>
    <!--        <table class="table table-bordered">-->
    <!--            <thead>-->
    <!--            <tr>-->
    <!--                <th>--><?php //echo implode('</th><th>', array_keys(current($data))); ?><!--</th>-->
    <!--            </tr>-->
    <!--            </thead>-->
    <!--            <tbody>-->
    <!--            --><?php //foreach ($data as $row): array_map('htmlentities', $row); ?>
    <!--                <tr>-->
    <!--                    <td>--><?php //echo implode('</td><td>', $row); ?><!--</td>-->
    <!--                </tr>-->
    <!--            --><?php //endforeach; ?>
    <!--            </tbody>-->
    <!--        </table>-->
    <!--    --><?php //endif; ?>
</div>

<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>


