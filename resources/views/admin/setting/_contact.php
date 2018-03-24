<div  v-if="item.keyID == 'contact' ">
		<div class="form-group">
		<label>公司名稱</label>
		<input class="form-control" placeholder="" v-model="item.content.companyName"  />
	</div>

	<div class="form-group">
		<label>公司地址</label>
		<input class="form-control" placeholder="" v-model="item.content.companyAddressText" />
	</div>

	<div class="form-group">
		<label>負責人</label>
		<input class="form-control" placeholder="" v-model="item.content.person"  />
	</div>

	<div class="form-group">
		<label>聯絡電話</label>
		<input class="form-control" placeholder="" v-model="item.content.phone" />
	</div>

	<div class="form-group">
		<label>聯絡信箱</label>
		<input class="form-control" placeholder="" v-model="item.content.email" />
	</div>

	<div class="form-group">
		<label>傳真</label>
		<input class="form-control" placeholder="" v-model="item.content.fax" />
	</div>

	<div class="form-group">
		<label>營業時間</label>
		<input class="form-control" placeholder="" v-model="item.content.businessTime" />
	</div>

	<div class="form-group">
		<label>Google map iframe embed html</label>
		<textarea class="form-control" placeholder="" v-model="item.content.iframe" >
								</textarea>
	</div>

</div>
