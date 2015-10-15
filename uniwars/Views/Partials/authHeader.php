<h1>Welcome <?= $this->playerName; ?></h2>
<h3>Money: <?= $this->university->getMoney() ?> |
	Lectures: <?= $this->university->getLectures() ?>
</h3>
<a href="<?= $this->url('stages'); ?>">
	Stages
</a>