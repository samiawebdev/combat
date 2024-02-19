<?php

require_once 'config/autoload.php';
require_once 'config/db.php';

/**
 * @var PDO $db;
 */

$heroManager = new HeroesManager($db);

if(isset($_POST['hero_id'])) {
    $id = $_POST['hero_id'];
} else {
    header('Location: index.php');
}

$hero = $heroManager->find($id);

$fightManager = new FightsManager();

$monster = $fightManager->createMonster();

$results = $fightManager->fight($hero, $monster);

$heroManager->update($hero);

include_once 'partials/header.php';

?>


<div class="d-flex justify-content-between p-4">
    <div>
        <p> <?= $hero->getName() ?></p>
        <p> HP : <?= $hero->getLifePoint() ?></p>
        <p> <?= $hero->getClass() ?></p>
        <p>Mana : <?= $hero->getMana() ?></p>
    </div>

    <div>
        <p> <?= $monster->getName() ?> </p>
        <p>HP : <?= $monster->getLifePoint() ?></p>
    </div>
</div>

<div class="d-flex justify-content-center">
    <table>
        <tbody>
<?php foreach ($results as $result) { ?>
        <tr>
            <?= $result ?>
        </tr>
<?php } ?>
        </tbody>
    </table>
</div>

<?php include_once 'partials/footer.php'; ?>











