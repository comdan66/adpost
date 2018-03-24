<div  v-if="item.keyID == 'about' ">
	<div class="form-group">
		<label>簡述</label>
		<textarea class="form-control" placeholder="" v-model="item.content.brief"  ></textarea>
	</div>

	<div class="form-group">
		<label>介紹</label>

		<table class="table table-bordered dataTable">
			<thead>
				<tr>
					<td style="width:70px">圖片</td>
					<td>簡述</td>
					<td style="width:80px">刪除</td>
				</tr>
			</thead>
			<tbody>

				<tr v-for="(x,i) of item.content.items">
					<!-- <td><img src="uploadUrl + x.photo"></td> -->
					<td><label> <img v-bind:src="uploadUrl + x.photo" >
						<br />
						<!-- <i class="fa fa-plus"></i> -->
						<input hidden class="form-control" type="file"   accept="image/*" v-on:change="uploadFile($event, i)" />
					</label></td>
					<td>					<textarea class="form-control" v-model="x.brief"></textarea></td>
					<td  style="width:80px">
					<button class="btn btn-danger" v-on:click="removeBrief(i)">
						刪除
					</button></td>
				</tr>

			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
					<button class="btn btn-success" v-on:click="addBrief()">
						新增
					</button></td>
				</tr>
			</tfoot>
		</table>

	</div>
</div>