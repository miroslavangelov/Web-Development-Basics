<?php foreach($this->universities as $university): ?>
<div style="<?= ($university->getId() === $_SESSION["university_id"]) ? 'color:red' : ''; ?>">
	<a href="<?= $this->url('universities', 'change', ['id' => $university->getId()]); ?>">
		<?= $university->getName(); ?>
		<?= $university->getMoney(); ?>
		<?= $university->getLectures(); ?>
	</a>
</div>
<?php endforeach; ?>