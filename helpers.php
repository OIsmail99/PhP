<?php


function drawTable($header, $tableData) {

    echo '<div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
            <tr>';
    foreach ($header as $value) {
        echo "<th>$value</th>";
    }
    echo "</tr></thead><tbody>";

    foreach ($tableData as $index => $row) {
        echo "<tr>";
        foreach ($row as $field) {
            echo "<td>{$field}</td>";
        }
        echo "<td>
        <a href='delete.php?id=$index' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
      </td>";

        echo "</tr>";
    }

    echo "</tbody></table></div> </div>";

}


function generateID(){
    if(file_exists("ids.txt")){
        // read id in ids.txt
        $id=  file_get_contents("ids.txt");
        $id = (int)$id + 1;
        // increment +1
    }else{
        $id  =1 ;
    }
    // save incremented in the ids.txt
    file_put_contents("ids.txt", $id);
    // return with id
    return $id;
}


function appendDataTofile($filename, $data){
    $fileobject= fopen($filename, "a");
    if ($fileobject) {
        fwrite($fileobject, $data);
        fclose($fileobject);
        return true;
    }

    return false;

}


function validatePostData($postData){
    $errors = [];
    $valid_data = [];
    foreach ($postData as $key => $value) {
        if(! isset($value) or empty($value)){
            $errors[$key] = ucfirst("{$key} is required");
        }else{
            if(is_string($value))
            $valid_data[$key] = trim($value);
            $valid_data[$key] = $value;
        }
    }
    return ["errors" => $errors, "valid_data" => $valid_data];
}

function deleteCustomer($id, $file = "customer.txt") {
    $lines = file($file, FILE_IGNORE_NEW_LINES); // Read file into an array
    
    if (isset($lines[$id])) {
        unset($lines[$id]); // Remove the specific line
        file_put_contents($file, implode("\n", $lines) . "\n"); // Save back to file
    }
}