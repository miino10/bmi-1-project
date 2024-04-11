<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LBM and BMI Calculator Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="handle-form-main-container">

    <header>
        <h1>LBM and BMI RESULT</h1>
    </header>

    <div class="middle-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"] ?? '';
            $weight = isset($_POST["weight"]) ? floatval($_POST["weight"]) : null;
            $height = isset($_POST["height"]) ? floatval($_POST["height"]) : null;
            $age = isset($_POST["age"]) ? intval($_POST["age"]) : null;
            $gender = $_POST["gender"] ?? '';

            if (empty($name) || is_null($weight) || is_null($height) || is_null($age) || empty($gender)) {
                echo "<p class='error-message'>All fields are required.</p>";
            } else {
                $bmi = $weight / ($height * $height);
                $lbm = ($gender == 'Male') ? (1.20 * $bmi) + (0.23 * $age) - 16.2 : (1.20 * $bmi) + (0.23 * $age) - 5.4;

                $lbmPercentage = ($lbm / $weight) * 100;
                $lbmCategory = 'Unknown';
                
                if ($gender == 'Male') {
                    if ($lbmPercentage >= 2 && $lbmPercentage <= 5) {
                        $lbmCategory = 'Essential Fat';
                    } elseif ($lbmPercentage >= 6 && $lbmPercentage <= 13) {
                        $lbmCategory = 'Athletes';
                    } elseif ($lbmPercentage >= 14 && $lbmPercentage <= 17) {
                        $lbmCategory = 'Fitness';
                    } elseif ($lbmPercentage >= 18 && $lbmPercentage <= 25) {
                        $lbmCategory = 'Average';
                    } elseif ($lbmPercentage > 26) {
                        $lbmCategory = 'Obese';
                    }
                } else { 
                    if ($lbmPercentage >= 10 && $lbmPercentage <= 13) {
                        $lbmCategory = 'Essential Fat';
                    } elseif ($lbmPercentage >= 14 && $lbmPercentage <= 20) {
                        $lbmCategory = 'Athletes';
                    } elseif ($lbmPercentage >= 21 && $lbmPercentage <= 24) {
                        $lbmCategory = 'Fitness';
                    } elseif ($lbmPercentage >= 25 && $lbmPercentage <= 31) {
                        $lbmCategory = 'Average';
                    } elseif ($lbmPercentage > 32) {
                        $lbmCategory = 'Obese';
                    }
                }
                echo "<div  class='output'>";
                echo "<p>Name: " . htmlspecialchars($name) . "</p>";
                echo "<p>Weight: " . htmlspecialchars($weight) ." kg". "</p>";
                echo "<p>Height: " . htmlspecialchars($height) . " m"."</p>";
                echo "<p>Gender: " . htmlspecialchars($gender) . "</p>";
                echo "<p>Age: " . htmlspecialchars($age) . "</p>";
                echo "</div>";

                echo "<div  class='bml'>";
                echo "<p>BMI: " . number_format($bmi, 2). "</p>";
                echo "<p>LBM Category: " .  htmlspecialchars($lbmCategory) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='error-message'>Please submit the form.</p>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 LBM and BMI Calculator</p>
    </footer>

</div>
</body>
</html>
