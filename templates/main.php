<main>
    <section>
        <h2>La próxima <?= $type ?> de Marvel</h2>
        <img src="<?= $poster_url ?>" width="300" alt="Poster de <?= $title ?>" style="border-radius: 16px">
    </section>
    <hgroup>
        <h2><?= $until_message ?></h2>
        <p>Fecha de estreno: <?= $release_date ?></p>
        <p>El siguiente estreno es <?= $following_production['title'] ?></p>
    </hgroup>
</main>