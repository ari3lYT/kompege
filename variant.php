<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ответы на KIM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .kim-info {
            background-color: #333333;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .task-card {
            background-color: #222222;
            border: 1px solid #444444;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (!empty($_GET['kim'])) {
            $kim = $_GET['kim'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://kompege.ru/api/v1/variant/kim/' . $kim);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            $response = curl_exec($ch);
            curl_close($ch);
            $dkim = json_decode($response, true);
            ?>

            <div class="kim-info">
                <h2>KIM: <?php echo $kim; ?></h2>
                <p>Скрыты-ли ответы: <?php echo ($dkim['hideAnswer'] === true) ? 'да' : 'нет'; ?></p>
            </div>

            <?php
            foreach ($dkim['tasks'] as $task) {
                ?>
                <div class="task-card">
                    <p><strong>Задание <?php echo str_replace('\n', '<br>', $task['number']); ?>:</strong><?= $task['text']; ?></p>
                    <p><?php echo nl2br($task['key']); ?></p>
                </div>
                <?php
            }
        }
        ?>
    </div>
</body>
</html>
