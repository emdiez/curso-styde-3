<!DOCTYPE html>
<html>
<head>
    <title><?= e($title) ?></title>
</head>
<body>
    <h1><?= e($title) ?></h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <?php e($user) ?>
        <?php endforeach; ?>
    </ul>
</body>
</html>