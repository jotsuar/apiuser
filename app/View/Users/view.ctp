<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('First name'); ?></dt>
		<dd>
			<?php echo h($user->first_name); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last name'); ?></dt>
		<dd>
			<?php echo h($user->last_name); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<img src="<?php echo $user->avatar ?>" alt="">
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user->id)); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user->id), array('confirm' => __('Are you sure you want to delete # %s?', $user->id))); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
