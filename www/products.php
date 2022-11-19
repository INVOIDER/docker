<?php
function openmysqli(): mysqli {
    $connection = new mysqli('data', 'user', 'password', 'appDB');
    return $connection;
}
function outputStatus($status, $message)
{
    echo '{status: ' . $status . ', message: "' . $message . '"}';
}
try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            addProduct();
            break;
        case 'DELETE':
            delProduct();
            break;
        case 'PATCH':
            updatePrice();
            break;
        case 'GET':
            getProdById();
            break;
        default:
            outputStatus(2, 'Invalid Mode');
    }
}
catch (Exception $e) {
    $message = $e->getMessage();
    outputStatus(2, $message);
};

function addProduct() {
    $data = json_decode(file_get_contents('php://input'), True);
    
    if (!isset($data['product']) || !isset($data['price'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $prod = $data['product'];
    $prodPrice = $data['price'];
    $result = $mysqli->query("SELECT * FROM products WHERE product = '{$prod}';");
    if ($result->num_rows === 1) {
        $message = 'product '. $prod . ' already exists';
        outputStatus(1, $message);
    } else {
        $query = "INSERT INTO products (product, price)
        VALUES ('" . $prod . "', '" . $prodPrice . "');";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Added product ' . $prod;
        outputStatus(0, $message);
    }
}
function delProduct()
{
    if (!isset($_GET['id'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $prodID = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM products WHERE ID = '{$prodID}';");
    if ($result->num_rows === 1) {
        $query = "DELETE FROM products WHERE ID = '" . $prodID . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Removed product ' . $prodID;
        outputStatus(0, $message);
    } else {
        $message = 'product ' . $prodID . ' does not exist';
        outputStatus(1, $message);
    }
}
function updatePrice()
{
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['product']) || !isset($data['price'])) {
        throw new Exception("No input provided");
    }
    $mysqli = openMysqli();
    $prod = $data['product'];
    $prodPrice = $data['price'];
    $result = $mysqli->query("SELECT * FROM products WHERE product = '{$prod}';");
    if ($result->num_rows === 1) {
        $query = "UPDATE products SET price = '" . $prodPrice . "' WHERE product = '" . $prod . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Changed price for ' . $prod;
        outputStatus(0, $message);
    } else {
        $message = $prod . ' does not exist';
        outputStatus(1, $message);
    }
}
function getProdById()
{
    if (!isset($_GET['id'])) {
        $mysqli = openMysqli();
        $result = $mysqli->query("SELECT * FROM products;");
        echo "{\nstatus: 0\n";
        foreach ($result as $info) {
            echo"product: '" . $info['product'] . "', price: '" . $info['price'] . "';\n";
        }
        echo "}";
        $mysqli->close();
    }
    else {
        $mysqli = openMysqli();
        $prodID = $_GET['id'];
        $result = $mysqli->query("SELECT * FROM products WHERE ID = '{$prodID}';");
        if ($result->num_rows === 1) {
            foreach ($result as $info) {
                echo "{status: 0, product: '" . $info['product'] . "', price: '" . $info['price'] . "';}";
            }
            $mysqli->close();
        } else {
            $message = 'product ID '. $prodID . ' does not exist';
            outputStatus(1, $message);
        }
    }
}
?>

