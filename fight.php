<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/autoload.php';

include_once 'classes/Hero.php';
include_once 'classes/Monster.php';
include_once 'classes/Lynel.php';
include_once 'classes/Lezalfos.php';
include_once 'classes/Moblin.php';
include_once 'classes/Guerrier.php';
include_once 'classes/Princesse.php';
include_once 'classes/Sheikah.php';
include_once 'classes/Zoras.php';
include_once 'classes/Goron.php';
include_once 'classes/Gerudo.php';
include_once 'classes/Piaf.php';


// Initialize variables
$isCombatStarted = false;
$hero = null;
$monster = null;
$history = [];

// Check if the hero_id is provided in the URL
if (isset($_GET['hero_id']) && !empty($_GET['hero_id'])) {
    $heroManager = new HeroManager($db);
    $hero = $heroManager->find($_GET['hero_id']);

    $fightManager = new FightManager($db);
    $monster = $fightManager->createMonster();

    $history = $fightManager->fight($hero, $monster);
    $heroManager->update($hero);

    $isCombatStarted = true;
}


// Mettre des images pour les monstres

$monsterImages = [

    'Lynel' => 'images/lynel.jpg',
    'Moblin' => 'images/moblin.png',
    'Lezalfos' => 'images/lezalfos.webp',
    'Ganondorf' => 'images/Ganondorf.webp',
];


// Mettre des images pour les héros
$heroImages = [

    'Guerrier' => 'images/zelda_link.webp',
    'Princesse' => 'images/zelda.webp',
    'Sheikah' => 'images/Sheik.webp',
    'Zoras' => 'images/sidon.jpg',
    'Goron' => 'images/goron.png',
    'Gerudo' => 'images/gerudo.jpg',
    'Piaf' => 'images/rivali.png',
    'Hero' => 'images/zelda_link.webp',

]

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>TP Combat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<style>
    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .combat-start .card {
        animation: shake 0.5s;
    }

    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        50% {
            transform: translateX(5px);
        }

        75% {
            transform: translateX(-5px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .card {
        background-color: #74BB91;
        color: white;
    }
</style>

<body>
    <?php include_once 'header.php'; ?>

    <main
        class="container mt-5 d-flex align-items-center justify-content-center <?= $isCombatStarted ? 'combat-start' : ''; ?>">
        <?php if ($hero) { ?>
            <div class="card m-2" style="width: 18rem;">
                <img src="<?= $heroImages[$hero->getType()] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $hero->getName() ?>
                    </h5>

                    <p class="card-text"><i class="fa-solid fa-heart" style="color: #e01b24;"></i>
                        <?= $hero->getHealthPoint() ?>
                    <div class="progress" role="progressbar" aria-label="Basic example"
                        aria-valuenow="<?= $hero->getHealthPoint() ?>" aria-valuemin="0" aria-valuemax="100"
                        id="hero-progress-bar">
                        <div class="progress-bar bg-danger" style="width: <?= $hero->getHealthPoint() ?>%"></div>
                    </div>
                    </p>
                </div>
            </div>
        <?php } ?>

        <?php if ($hero && $monster) { ?>
            <h1> VS </h1>

            <div class="card m-2" style="width: 18rem;">
                <img src="<?= $monsterImages[$monster->getName()] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $monster->getName() ?>
                    </h5>
                    <p class="card-text"><i class="fa-solid fa-heart" style="color: #e01b24;"></i>
                        <?= $monster->getHealthPoint() ?>
                    <div class="progress" role="progressbar" aria-label="Basic example"
                        aria-valuenow="<?= $monster->getHealthPoint() ?>" aria-valuemin="0" aria-valuemax="100"
                        id="monster-progress-bar">
                        <div class="progress-bar bg-danger" style="width: <?= $monster->getHealthPoint() ?>%"></div>
                    </div>
                    </p>
                </div>
            </div>
        <?php } ?>
    </main>

    <section class="container">
        <?php foreach ($history as $key => $message) { ?>
            <div class="alert <?= $key % 2 ? 'alert-primary' : 'alert-danger' ?>" role="alert">
                <?= $message ?>
            </div>
        <?php } ?>
    </section>

    <section class="container align-item-center">
        <div class="row">
            <div class="col-6">
                <a href="index.php" class="btn btn-primary btn-success">Retour à l'accueil</a>
            </div>
        </div>
    </section>


    <script>

        
        function updateProgressBar(healthBar, healthPoint) {
            healthBar.style.width = healthPoint + "%";
        }


        let heroHealthPoint = <?= $hero->getHealthPoint() ?>;
        let heroProgressBar = document.querySelector("#hero-progress-bar .progress-bar");
        updateProgressBar(heroProgressBar, heroHealthPoint);

        let monsterHealthPoint = <?= $monster->getHealthPoint() ?>;
        let monsterProgressBar = document.querySelector("#monster-progress-bar .progress-bar");
        updateProgressBar(monsterProgressBar, monsterHealthPoint);



        function updateHealthPoint(healthPoint, healthBar) {
            healthPoint = healthPoint < 0 ? 0 : healthPoint;
            updateProgressBar(healthBar, healthPoint);
        }

       



    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>