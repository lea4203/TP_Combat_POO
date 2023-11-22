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

$heroManager = new HeroManager($db);

if (isset($_POST['hero_name'], $_POST['hero_class']) && !empty($_POST['hero_name']) && !empty($_POST['hero_class'])) {
    $heroName = htmlspecialchars($_POST['hero_name']);
    $heroClass = $_POST['hero_class'];

   
    switch ($heroClass) {
        case 'Guerrier':
            $hero = new Guerrier(['name' => $heroName, 'type' => 'Guerrier']);
            break;
        case 'Princesse':
            $hero = new Princesse(['name' => $heroName, 'type' => 'Princesse']);
            break;
        case 'Sheikah':
            $hero = new Sheikah(['name' => $heroName, 'type' => 'Sheikah']);
            break;
        case 'Zoras':
            $hero = new Zoras(['name' => $heroName, 'type' => 'Zoras']);
            break;
        case 'Goron':
            $hero = new Goron(['name' => $heroName, 'type' => 'Goron']);
            break;
        case 'Gerudo':
            $hero = new Gerudo(['name' => $heroName, 'type' => 'Gerudo']);
            break;
            case 'Piaf':
            $hero = new Piaf(['name' => $heroName, 'type' => 'Piaf']);
            break;
        default:
            $hero = new Hero(['name' => $heroName, 'type' => 'Hero']);
            break;

          
    }
    
    $heroManager->add($hero);
    
}

$heroes = $heroManager->findAllAlive();



$heroImages = [

    'Guerrier' => 'images/zelda_link.webp',
    'Princesse' => 'images/zelda.webp',
    'Sheikah' => 'images/impa.png',
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
.custom-form {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form-label {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

.form-control {
    border: 2px solid #ddd;
    border-radius: 4px;
    padding: 10px;
    font-size: 1rem;
}

.form-control:focus {
    outline: none;
    border-color: #74BB91;
    box-shadow: 0 0 4px rgba(116, 187, 145, 0.5);
}

.form-select {
    appearance: none;
    background-color: #fff;
    border: 2px solid #ddd;
    border-radius: 4px;
    padding: 10px;
    font-size: 1rem;
    width: 100%;
}

.form-select:focus {
    outline: none;
    border-color: #74BB91;
    box-shadow: 0 0 4px rgba(116, 187, 145, 0.5);
}

.btn-primary {
    background-color: #74BB91;
    border: none;
    border-radius: 4px;
    padding: 12px 20px;
    font-size: 1rem;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.2s;
}

.btn-primary:hover {
    background-color: #63A87F;
}
</style>
<body>
    <?php include_once 'header.php'; ?>
    
    <main class="container mt-5">
    <form method="post" class="custom-form">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Ajouter un nouveau personnage</label>
            <input type="text" class="form-control" placeholder="Nom du personnage" name="hero_name" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">Classe du personnage</label>
            <select class="form-select" name="hero_class" required>
                <option value="Guerrier">Guerrier</option>
                <option value="Princesse">Princesse</option>
                <option value="Sheikah">Sheikah</option>
                <option value="Zoras">Zoras</option>
                <option value="Goron">Goron</option>
                <option value="Gerudo">Gerudo</option>
                <option value="Piaf">Piaf</option>
            </select>
        </div>
     
        <button type="submit" class="btn btn-primary btn-success">Ajouter</button>
    </form>

    <div class="d-flex flex-wrap" style = "color:green">
        <?php foreach ($heroes as $hero) { ?>
            <div class="card m-2" style="width: 18rem;">
                <img src="<?= $heroImages[$hero->getType()] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $hero->getName() ?></h5>
                    <p class="card-text">Classe : <?= $hero->getType() ?></p>
                    <p class="card-text"><i class="fa-solid fa-heart" style="color: #e01b24;"></i>
                        <?= $hero->getHealthPoint() ?>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $hero->getHealthPoint() ?>" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger" style="width: <?= $hero->getHealthPoint() ?>%"></div>
                        </div>
                    </p>
                    <a href="./fight.php?hero_id=<?= $hero->getId() ?>" class="btn btn-primary btn-success " >Selectionner</a>
                </div>
            </div>
        <?php } ?>
    </div>
</main>


        






    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
