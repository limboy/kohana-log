<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://tablesorter.com/jquery.tablesorter.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://tablesorter.com/themes/blue/style.css" />
<script>
$(function(){
	$('#log_table').tablesorter({
		'headers': {
			2: {sorter: false},
			3: {sorter: false},
			4: {sorter: false},
			5: {sorter: false},
			6: {sorter: false},
			7: {sorter: false},
			8: {sorter: false}
		},
		'widgets': ['zebra']
	});
})
</script>
<table id="log_table" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
	<thead>
		<tr>
			<th>time</th>
			<th>type</th>
			<th>message</th>
			<th>client</th>
			<th>uri</th>
			<th>agent</th>
			<th>referer</th>
			<th>cookie</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($logs as $log) 
{
	//$time = date::fuzzy_span(strtotime($log['time']));
	$message = text::limit_chars($log['message'], 50);
	$agent = text::limit_chars($log['agent'], 50);
	$referer = $log['referer'] == '""'?'':text::limit_chars($log['referer'], 50);
	$cookie = text::limit_chars($log['cookie'], 50);
	$color = 'white';
	if ($log['type'] == Kohana::ERROR)
	{
		$color = '#f96';
	}
	if ($log['type'] == Kohana::INFO)
	{
		$color = '#9cf';
	}

	echo <<<EOT
	<tr>
		<td>{$log['time']}</td>
		<td style="background:{$color}">{$log['type']}</td>
		<td title="{$log['message']}">$message</td>
		<td>{$log['client']}</td>
		<td>{$log['uri']}</td>
		<td title="{$log['agent']}">$agent</td>
		<td title="{$log['referer']}">$referer</td>
		<td title="{$log['cookie']}">$cookie</td>
	</tr>
EOT;
}
?>
</tbody>
</table>
