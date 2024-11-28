<?php
// Define the API endpoint URL
$apiUrl = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?limit=100";

// Fetch the API response
$response = file_get_contents($apiUrl);

if ($response === FALSE) {
    die("Error: Unable to fetch data from the API.");
}

// Decode the JSON response
$data = json_decode($response, true);

if ($data === NULL) {
    die("Error: Invalid JSON data.");
}

// Safely extract results
$records = $data['results'] ?? [];

// Debugging: Uncomment these lines if needed
// echo "<pre>";
// print_r($records);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationality Data</title>
    <link href="https://unpkg.com/picocss@1.5.7/dist/pico.min.css" rel="stylesheet">
    <style>
        table {
            margin: auto; 
            text-align: center;
            width: 100%; 
            border-collapse: collapse; 
        }
        th, td {
            padding: 15px;
            border: 5px solid #ddd; 
        }
        th {
            background-color: #bae3de; 
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #7ba8a2; 
        }
        tbody tr:hover {
            background-color: #50ada1; 
        }
        @media screen and (max-width: 770px) {
            table {
                font-size: 0.15em; /
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <h1 style="text-align: center;">UOB Student Nationality Data</h1>
        <section>
            <?php if (!empty($records) && is_array($records)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Program</th>
                            <th>Nationality</th>
                            <th>College</th>
                            <th>Number of Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?= htmlspecialchars($record['year'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['semester'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['the_programs'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['nationality'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['colleges'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['number_of_students'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center;">No information is available. Please review the criteria or response from the API.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
