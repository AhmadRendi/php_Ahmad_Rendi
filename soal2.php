<?php
session_start();

if (!isset($_GET['step'])) {
    $_GET['step'] = 1;
    unset($_SESSION['form_data']);
}

$step = (int)$_GET['step'];

if ($_POST) {
    if (!isset($_SESSION['form_data'])) {
        $_SESSION['form_data'] = array();
    }
    
    switch ($step) {
        case 1:
            $_SESSION['form_data']['nama'] = $_POST['nama'];
            header('Location: ?step=2');
            exit;
        case 2:
            $_SESSION['form_data']['umur'] = $_POST['umur'];
            header('Location: ?step=3');
            exit;
        case 3:
            $_SESSION['form_data']['hobi'] = $_POST['hobi'];
            header('Location: ?step=4');
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Multi-Step</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border: 2px solid black;
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 30px;
        }
        
        label {
            font-size: 18px;
            font-weight: normal;
            margin-right: 10px;
        }
        
        input[type="text"], input[type="number"] {
            border: 2px solid black;
            padding: 8px 12px;
            font-size: 16px;
            width: 200px;
        }
        
        .submit-btn {
            border: 2px solid black;
            background: white;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        
        .submit-btn:hover {
            background: #f0f0f0;
        }
        
        .result-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border: 2px solid black;
            padding: 30px;
        }
        
        .result-item {
            font-size: 18px;
            margin-bottom: 10px;
            border-bottom: 1px solid black;
            padding-bottom: 5px;
        }
        
        .restart-btn {
            border: 2px solid black;
            background: white;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
        }
        
        .restart-btn:hover {
            background: #f0f0f0;
        }
    </style>
</head>
<body>

<?php if ($step == 1): ?>
    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama Anda :</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <button type="submit" class="submit-btn">SUBMIT</button>
        </form>
    </div>

<?php elseif ($step == 2): ?>
    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="umur">Umur Anda :</label>
                <input type="number" id="umur" name="umur" required>
            </div>
            <button type="submit" class="submit-btn">SUBMIT</button>
        </form>
    </div>

<?php elseif ($step == 3): ?>
    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="hobi">Hobi Anda :</label>
                <input type="text" id="hobi" name="hobi" required>
            </div>
            <button type="submit" class="submit-btn">SUBMIT</button>
        </form>
    </div>

<?php elseif ($step == 4): ?>
    <div class="result-container">
        <?php if (isset($_SESSION['form_data'])): ?>
            <div class="result-item">
                <strong>Nama:</strong> <?php echo htmlspecialchars($_SESSION['form_data']['nama']); ?>
            </div>
            <div class="result-item">
                <strong>Umur:</strong> <?php echo htmlspecialchars($_SESSION['form_data']['umur']); ?>
            </div>
            <div class="result-item">
                <strong>Hobi:</strong> <?php echo htmlspecialchars($_SESSION['form_data']['hobi']); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

</body>
</html>
