<table border="1">
	<tr>
		<th>Name</th>
		<th>Level</th>
		<th>Money</th>
		<th>Lectures</th>
		<th>Action</th>
		<?php foreach ($this->playerStages as $stage): ?>
		<?php $level = \uniwars\Repositories\LevelRepository::create()->getOne($stage->getLevel()->getLevelId() + 1, $stage->getStage()->getId()); ?>
		<tr>
			<td><?= $stage->getStage()->getName(); ?></td>
			<td><?= $stage->getLevel()->getLevelId(); ?></td>
			<td><?= $level->getMoneyConsume(); ?></td>
			<td><?= $level->getLecturesConsume(); ?></td>
			<td>
				<a href="<?= $this->url('stages', 'increase', ['id'=>$stage->getStage()->getId()]); ?>">
					Increase to level #<?= $stage->getLevel()->getLevelId()+1; ?>
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tr>
</table>
