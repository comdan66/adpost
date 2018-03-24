<div  v-if="item.keyID == 'adApprove' ">

	<div class="form-group">
		<label>廣告自動審核通過</label>
		<br>

		<label class="btn btn-success">
			<input type="checkbox" v-model="item.content.isAutoApprove" />
			自動審核通過</label>

	</div>

</div>