<?php
declare(strict_types=1);

include ("../db/db_creds.php");

$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

// 2. CORS (only for dev – tighten in production)
header('Content-Type: application/json');
// header('Access-Control-Allow-Origin: *');

// 3. Read the query param
$group_code = $_GET['group_code'] ?? '';

//$group_code = strip_tags($group_code);


// 4. Basic sanitisation / validation
// if (!$group_code) {
//     http_response_code(400);
//     echo json_encode(['valid' => false, 'available' => false]);
//     exit;
// }

// 5. Prepared statement – PostgreSQL will use the index
$stmt = $pdo->prepare('SELECT 1 FROM sales_main WHERE group_code = ?  LIMIT 1');
//$stmt->bind_param("s", $group_code); // "s" = 1 string
$stmt->execute([$group_code]);



echo json_encode([
    'valid'     => true,
    'available' => $stmt->fetch() === false
    

]);


