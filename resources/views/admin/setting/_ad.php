<div  v-if="item.keyID == 'ad' ">
	<div class="form-group">
		<label>圖片</label>
		<div class="clear"></div>

		<div v-for="(photo, photoIndex) of item.content.photoJson" class="col-md-3 photoJsonFrame">
			<div class="photoJson">
				<div class="text-right">
					<!-- <i v-on:click="removePhotoJson(photoIndex)" class="fa fa-close pointer"></i> -->
				</div>
				<img v-bind:src="uploadUrl + photo">

			</div>
		</div>
		<div class="col-md-3 photoJsonFrame">
			<div class="photoJson add">
				<label> <i class="fa fa-plus"></i>
					<input hidden class="form-control" type="file" multiple=""  accept="image/*" v-on:change="uploadFiles($event, 'photoJson')" />
				</label>

			</div>
		</div>
	</div>

	<div class="clear"></div>

	<div class="form-group">
		<label>標題</label>
		<input class="form-control" placeholder="" v-model="item.content.title"  />
	</div>

	<div class="form-group">
		<label>簡述</label>
		<textarea class="form-control" placeholder="" v-model="item.content.brief" ></textarea>
	</div>
</div>