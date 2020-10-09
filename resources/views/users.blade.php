<!DOCTYPE html>
<html>
<head>
    <title><?= e($title) ?></title>
</head>
<body>
    <h1><?= e($title) ?></h1>
    <ul>
        <?php
        /*
        <?php foreach ($users as $user): ?>
            <?php e($user) ?>
        <?php endforeach; ?>
        */
        ?>

        @if(! empty($users))
            @foreach($users as $user)
                <li>{{ $user }}</li>
            @endforeach
        @else
            <p>No hay usuarios registrados.</p>
        @endif

        <hr>

        @unless(empty($users))
            @foreach($users as $user)
                <li> {{ $user }} </li>
            @endforeach
        @else
            <p>No hay usuarios registrados.</p>
        @endunless

        <hr>

        @empty($users)
            <p>No hay usuarios registrados.</p>
        @else
            @foreach($users as $user)
               <li> {{ $user }} </li>
            @endforeach
        @endempty

        <hr>

        @forelse($users as $user)
            <li>{{ $user }}</li>
            @empty
            <p>No hay usuarios registrados</p>
        @endforelse

    </ul>
</body>
</html>