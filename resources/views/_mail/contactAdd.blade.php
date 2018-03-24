<div >
	{{ $item['name'] }} 留下了提問
	<div>
		<br>
	</div>
	<div>
		聯絡信箱 {{ $item['email'] }}
	</div>
	<div>
		<br>
	</div>
	<div>
		訊息提問:
	</div>

	<div>
		{{ nl2br($item['content']) }}
	</div>

</div>