<div  v-if="item.keyID == 'index' ">
	<div class="form-group">
		<label>首頁圖片</label>
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
		<label>影音標題</label>
		<input class="form-control" placeholder="" v-model="item.content.videoTitle"  />
	</div>

	<div class="form-group">
		<label>影音簡述</label>
		<textarea class="form-control" placeholder="" v-model="item.content.videoBrief" ></textarea>
	</div>

	<div class="form-group">
		<label>圖文標題</label>
		<input class="form-control" placeholder="" v-model="item.content.photoTitle"  />
	</div>

	<div class="form-group">
		<label>圖文簡述</label>
		<textarea class="form-control" placeholder="" v-model="item.content.photoBrief" ></textarea>
		<!-- <input class="form-control" placeholder="" v-model="item.content.photoBrief" /> -->
	</div>
</div>