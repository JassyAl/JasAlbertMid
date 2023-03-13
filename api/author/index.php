<?php

    header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'OPTIONS') {
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
            header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
            exit();
        }
        
        include_once '../../config/Database.php';
        include_once '../../models/Author.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Author Search</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<h1>Author Search</h1>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
        <h2 id="enter-a-id">Enter Author ID:</h2>
		<input type="text" id="author_id" name="author_id"  aria-labelledby="enter-a-city" autofocus required>
		<button type="submit">Search</button>
	</form>

</body>
</html>
