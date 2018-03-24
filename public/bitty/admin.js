var uploadUrl = '/storage/photo/';
//vue ----------------------------------------------------------------------------------------
// vue list
var vueConfig = {
	// uploadUrl: 'https://d1jjjfa1mlyr2v.cloudfront.net/u/',
	uploadUrl : uploadUrl,
	messageSaveSuccess : '儲存成功',
	pageSizeDefault : 50
};

var vueListData = {
	el : '#vue',
	data : {
		items : [],
		uploadUrl : vueConfig.uploadUrl,
		search : {
		},
		orderField : 'id',
		orderType : 'desc',
		page : 1,
		pageSize : vueConfig.pageSizeDefault,
		pageTotal : 0,
		isFirstTime : true,
		text : {
			notFound : '找不到資料'
		}
	},
	mounted : function() {

		//init by parameters
		try {
			var search = location.search.substring(1);
			var paramters = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}');
			for (var i in paramters) {
				this.search[i] = paramters[i];
			}
		} catch(e) {
		}
		this.getList();
	},
	methods : {
		getList : function() {
			var url = 'getList';
			this.$http.post(url, this._data).then(function(r) {
				this.isFirstTime = false;
				this.items = r.body.items;
				this.pageTotal = r.body.pageTotal;
			});

		},
		changeOrder : function(x) {
			if (this.orderField != x) {
				this.orderType = 'asc';
			} else {
				if (this.orderType == 'asc') {
					this.orderType = 'desc';
				} else {
					this.orderType = 'asc';
				}
			}
			this.orderField = x;
			this.getList();
		},
		changePage : function(page) {
			this.page = page;
			this.getList();

		},
		inputSearch : function() {
			this.page = 1;
			this.getList();
		},
		deleteItem : function(index) {
			if (confirm('確認刪除?')) {

				var id = this.items[index].id;
				var self = this;

				var url = 'deleteDo';
				this.$http.post(url, {
					id : id
				}).then(function(r) {

					if (r.body) {
						this.items.splice(index, 1);
					} else {
						alert('刪除失敗QQ');
					}

				});

			}
		},
	},
	created : function() {
	}
};

var vueItemData = {
	el : '#vue',
	data : {
		item : {},
		uploadUrl : vueConfig.uploadUrl,
	},
	mounted : function() {
		this.setSummernote();

		//init by parameters
		try {
			var search = location.search.substring(1);
			var paramters = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}');
			for (var i in paramters) {
				this.item[i] = paramters[i];
			}
		} catch(e) {
		}

	},

	methods : {
		checkForm : function() {
			return true;

		},
		setSummernote : function() {
			var self = this;
			var summernoteOption = {
				toolbar : [['fontsize', ['fontsize']], ['style', ['bold', 'italic', 'underline', 'clear']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['insert', ['picture', 'link', 'video']], ['fontname', ['fontname']], ['table', ['table']], ['insert', ['link', 'picture', 'video']], ['view', ['fullscreen', 'codeview', 'help']]],
				minHeight : 400,
				maxHeight : 'calc(100vh - 100px)',
				callbacks : {
					onImageUpload : function(files) {
						var data = new FormData();
						for (var i = files.length - 1; i >= 0; i--) {
							data.append('files[]', files[i]);
						}
						var summernoteObject = this;
						self.$http.post('/admin/_helper/uploadFiles', data).then(function(r) {
							for (var i in r.body) {
								var x = r.body[i];
								var imgUrl = self.uploadUrl + x.fileName;
								// window.alert(imgUrl);
								$(summernoteObject).summernote('insertImage', imgUrl);
							}

						});

					},
					onChange : function(contents, $editable) {
						var name = $(this)[0]['name'];
						vue.item[name] = contents;
					}
				}
			};
			$('*[summernote]').summernote(summernoteOption);
		},

		removePhotoJson : function(index) {
			this.item.photoJson.splice(index, 1);
		},
		setMainPhoto : function(index) {
			this.item.photo = this.item.photoJson[index].photo;
		},
		changePhoto : function(index) {
			fileUploadIndex = index;

			uploadPhotoType = 'relatedUrlJson';
			$('#formFileUpload input[type=file]').click();

		},

		uploadFile : function(event, key) {
			var self = this;
			var files = event.target.files;

			console.log(files);

			//single file veriosn
			if (files.length > 0) {
				var file = files[0];
				var reader = new FileReader();
				reader.onload = function() {
					var data = new FormData();
					// data.append('file', event.target.files);
					data.append('file', files[0]);
					self.$http.post('/_helper/uploadFile', data).then(function(r) {
						self.item[key] = r.body.fileName;
					});

				};
				reader.onerror = function() {
				};
				reader.readAsDataURL(file);

			}
		},
		uploadFiles : function(event, key) {
			// var self = this;
			var files = event.target.files;
			if (files.length > 0) {
				var data = new FormData();
				for (var i = 0; i < files.length; i++) {
					data.append('files[]', files[i]);
				}
				// window.alert(key);
				this.$http.post('/admin/_helper/uploadFiles', data).then(function(r) {
					// console.log(r);
					for (var i in r.body) {
						var x = r.body[i];
						var a = {
							photo : x.fileName
						};
						// this.item[key].push(x.fileName);
						this.item[key].push(a);
					}

				});

			}

		},

		saveDo : function() {
			//send post
			var url = 'updateDo';

			if (this.checkForm()) {
				this.$http.post(url, this._data.item).then(function(r) {
					alert('儲存完成');
					this.item.id = r.body.model.id;
					// location.reload();
				});
			}

		}
	}

};

//vue ----------------------------------------------------------------------------------------

var uploadPhotoType = '';

function toPage(x) {
	document.location = x;
}

function isEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function isPhone(strPhone) {
	var cellphone = /^09[0-9]{8}$/;
	if (cellphone.test(strPhone)) {
		return true;
	} else {
		return false;
	}
}

function isAdmin() {
	if (admin['roleID'] == '1') {
		return true;
	} else {
		return false;
	}
}

function typeText(a, v) {
	if (a == null) {
		return '--';
	} else {
		if ( typeof (a[v]) != 'undefined') {
			return a[v];
		} else {
			return '--';
		}
	}
}

function log(x) {
	console.log(x);
}

function setDatetimepicker() {

	$('*[datetimepicker]').datetimepicker({
		dateFormat : 'yy-mm-dd',
		timeFormat : 'HH:mm',
		format : 'YYYY-MM-DD HH:mm:ss',
		icons : {
			time : "fa fa-clock-o",
			date : "fa fa-calendar",
			up : "fa fa-arrow-up",
			down : "fa fa-arrow-down"
		}
	});
}

function summernoteUpload(file, el) {
	var form_data = new FormData();
	form_data.append('file', file);

	$.ajax({
		data : form_data,
		type : "POST",
		dataType : 'json',
		// url : getUrl('uploadPhotoDo'),
		url : 'uploadFileDo',
		cache : false,
		contentType : false,
		processData : false,
		success : function(r) {
			var imgUrl = uploadUrl + r['files'][0]['fileName'];
			$(el).summernote('editor.insertImage', imgUrl);
		}
	});

}

function setSummernote() {

	$('textarea[summernote]').summernote({

		toolbar : [['fontsize', ['fontsize']], //
		//['style', ['style']], // no style button
		['style', ['bold', 'italic', 'underline', 'clear']], //
		['color', ['color']], //
		['para', ['ul', 'ol', 'paragraph']], //
		['height', ['height']], //
		['insert', ['picture', 'link', 'video']], // no insert buttons
		['fontname', ['fontname']], //
		['table', ['table']], //
		['insert', ['link', 'picture', 'video']], //
		['view', ['fullscreen', 'codeview', 'help']] //
		],

		minHeight : 300,
		maxHeight : 'calc(100vh - 120px)',
		callbacks : {
			onImageUpload : function(files, editor, welEditable) {
				// sendFile(files[0], editor, welEditable);
				for (var i = files.length - 1; i >= 0; i--) {
					summernoteUpload(files[i], this);
				}
			},

			onChange : function(contents, $editable) {
				// alert(contents);
				// log($(this));
				// log($(this)[0]['name']);
				var name = $(this)[0]['name'];
				vue.item[name] = contents;

			}
		}
	});

}


$(document).ready(function() {

	$(window).trigger('resize');

	if ( typeof (data) != 'undefined') {
		if (data != null) {
			assignFormValue('form', data);
		} else {

		}
	}

	setDatepicker();
	setDaterangepicker();

	// setDatetimepicker();
	// setSummernote();

	/*
	$('*[select2]').select2().on("change", function(e) {

	log(e);
	log($(this).val());
	var fieldName = $(this).attr('name');

	fieldName = fieldName.replace('[]', '');
	log(fieldName);
	formData[fieldName] = $(this).val();

	});
	*/
	// setFileUpload();

});

function setDaterangepicker() {

	$("*[daterangepicker]").daterangepicker({
		locale : {
			format : 'YYYY-MM-DD'
		}
	});

}

$.fn.singleDatePicker = function() {
	// $(this).on("apply.daterangepicker", function(e, picker) {
	//     picker.element.val(picker.startDate.format(picker.locale.format));
	// });

	var self = this;
	return $(this).daterangepicker({
		singleDatePicker : true,
		autoUpdateInput : false,
		locale : {
			format : 'YYYY-MM-DD'
		}
	}, function(r) {

		var name = $(self).attr('name');

		var date = new Date(r._d);
		var year = date.getFullYear();
		var month = date.getMonth() + 1;
		var day = date.getDate();

		if (month < 10) {
			month = '0' + month;
		}
		if (day < 10) {
			day = '0' + day;
		}

		alert(name);

		vue.item[name] = year + '-' + month + '-' + day;

	});
};

function setDatepicker() {
	// var option = {
	// dateFormat : 'yy-mm-dd',
	// changeYear : true
	// };

	//origin version
	/*
	var option = {
	dateFormat : 'yyyy-mm-dd',
	changeYear : true,
	//monthNames : ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
	yearRange : '-100:+10',
	// minDate : '-20y',
	//maxDate : '+0d',
	};
	*/
	/*
	var option = {
	format : 'yyyy-mm-dd',
	changeYear : true,
	//monthNames : ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
	yearRange : '-100:+10',
	// minDate : '-20y',
	//maxDate : '+0d',
	};

	$("*[datepicker]").datepicker(option);
	*/

	// $("*[datepicker]").singleDatePicker();

	$("*[datepicker]").daterangepicker({
		singleDatePicker : true,
		autoUpdateInput : false,
		locale : {
			format : 'YYYY-MM-DD'
		}
	}, function(r) {

		// var name = $(self).attr('name');
		// log(this);
		var name = $(this.element).attr('name');

		var date = new Date(r._d);
		var year = date.getFullYear();
		var month = date.getMonth() + 1;
		var day = date.getDate();

		if (month < 10) {
			month = '0' + month;
		}
		if (day < 10) {
			day = '0' + day;
		}

		vue.item[name] = year + '-' + month + '-' + day;

	});

	/*

	 $("*[datepicker]").daterangepicker({
	 singleDatePicker : true,
	 autoUpdateInput : false,

	 singleClasses : "picker_1",

	 locale : {
	 format : 'YYYY-MM-DD'
	 }
	 }, function(chosen_date) {
	 $('yourinput').val(chosen_date.format('YYYY-MM-DD'));
	 });
	 */
}

/*
 function setDatetimepicker() {
 var option = {
 timeFormat : 'HH:mm:ss',
 dateFormat : 'yy-mm-dd',
 changeYear : true
 };
 $("input[rel=datetimepicker]").datetimepicker(option);
 }
 */

function int(v) {
	return parseInt(v);
}

function float(v) {
	return parseFloat(v);
}

function isUrl(str) {
	var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
	'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
	'((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
	'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
	'(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
	'(\\#[-a-z\\d_]*)?$', 'i');
	// fragment locator

	// fragment locater
	if (!pattern.test(str)) {
		// alert("Please enter a valid URL.");
		return false;
	} else {
		return true;
	}
}

function isMobile() {
	if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
		return true;

	} else {
		return false;
	}
}

function getQueryParams(qs) {
	qs = qs.split("+").join(" ");
	var params = {},
	    tokens,
	    re = /[?&]?([^=]+)=([^&]*)/g;
	while ( tokens = re.exec(qs)) {
		params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
	}
	return params;
}

function htmlEncode(value) {
	return $('<div/>').text(value).html();
}

function htmlDecode(value) {
	return $('<div/>').html(value).text();
}

function htmlEscape(str) {
	return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

//guid
var getGuid = (function() {
	function s4() {
		return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
	}

	return function() {
		return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
	};
})();

function getCurrentDate() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1;
	//January is 0!
	var yyyy = today.getFullYear();

	if (dd < 10) {
		dd = '0' + dd;
	}

	if (mm < 10) {
		mm = '0' + mm;
	}

	today = yyyy + '/' + mm + '/' + dd;
	return today;
}