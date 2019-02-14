<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th>
				<?php echo __("First name") ?>
			</th>
			<th>
				<?php echo __("Last name") ?>
			</th>
			<th>
				<?php echo __("Image") ?>
			</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
		<?php if(isset($deleted) && $deleted == $user->id) {continue;} ?>
		<tr>
			<td>
				<?php echo $user->first_name ?>
			</td>
			<td>
				<?php echo $user->last_name ?>
			</td>
			<td>
				<img src="<?php echo $user->avatar ?>" alt="">
			</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $user->id)); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user->id)); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user->id), array('confirm' => __('Are you sure you want to delete # %s?', $user->id))); ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
	</ul>
</div>
