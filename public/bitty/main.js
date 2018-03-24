var uploadUrl = '/storage/photo/';

//vue ----------------------------------------------------------------------------------------
// vue list
var vueConfig = {
	// uploadUrl: 'https://d1jjjfa1mlyr2v.cloudfront.net/u/',
	uploadUrl : uploadUrl,
	messageSaveSuccess : '儲存成功',
	pageSizeDefault : 10
};

function getDatetime() {
	// var xxx = xxx.replace(/\/Date\((-?\d+)\)\//, '$1');
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var day = date.getDate();
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var seconds = date.getSeconds();
	if (month < 10) {
		month = '0' + month;
	}
	if (day < 10) {
		day = '0' + day;
	}
	if (hours < 10) {
		hours = '0' + hours;
	}
	if (minutes < 10) {
		minutes = '0' + minutes;
	}
	if (seconds < 10) {
		seconds = '0' + seconds;
	}
	return (year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds);
}

var vueListData = {
	el : '#vue',
	data : {
		items : [],
		uploadUrl : vueConfig.uploadUrl,

		condition : {
			search : {	},
			orderField : 'id',
			orderType : 'desc',
			page : 1,
			pageSize : vueConfig.pageSizeDefault,
		},
		totalItem : 0,
		pageTotal : 0,
		itemInterval : 0,
		getListUrl : 'getList',
		displayPageFrom : 1,
		displayPageTo : 100,

	},
	mounted : function() {
		this.getList();
	},
	methods : {
		nextPage : function() {

			if (this.condition.page >= this.pageTotal) {
				// this.condition.page = this.pageTotal;
			} else {
				this.condition.page++;
				this.getList();
			}

		},
		prevPage : function() {

			if (this.condition.page <= 1) {
				// this.condition.page = this.pageTotal;
			} else {
				this.condition.page--;
				this.getList();
			}

		},

		afterGetList : function() {

			//get middle

			// alert(this.condition.page);

			var middlePage = this.condition.page;

			this.displayPageFrom = middlePage - 2;
			this.displayPageTo = middlePage + 2;

			if (this.displayPageFrom <= 1) {

				this.displayPageFrom = 1;
			}

			if (this.displayPageTo >= 1) {

				this.displayPageTo = this.displayPageTo;
			}

			// alert(this.displayPageFrom);
			// alert(this.displayPageTo);

		},
		getList : function() {

			var url = this.getListUrl;

			this.$http.post(url, this._data.condition).then(function(r) {

				this.items = r.body.items;

				this.pageTotal = r.body.pageTotal;
				this.totalItem = r.body.totalItem;

				var itemInterval = this.pageSize;

				if (this.page >= this.pageTotal) {
				}

				itemInterval = this.items.length;
				// this.totalItem - ((this.condition.page ) * this.condition.pageSize);

				this.itemInterval = itemInterval;

				this.afterGetList();

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
			this.condition.orderField = x;
			this.getList();
		},
		changePage : function(page) {
			this.condition.page = page;
			this.getList();

		},
		inputSearch : function() {
			this.condition.page = 1;
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

//helper----------------------------------------------------
function log(xxx) {
	console.log(xxx);
}

function logoutDo() {

	var url = '/login/logoutDo';
	$.ajax({
		url : url,
		type : 'get',
		dataType : 'json',
		success : function(r) {

			location.reload();

		}
	});

}

function searchDo(e, event) {

	if (event.which == 13) {
		var name = $(e).val();
		if (name != '') {
			document.location = '/post/listing?name=' + name;
		}

	}

}

function isEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function getQuery(x) {
	try {
		var url = new URL(location.href);
		return url.searchParams.get(x);
	} catch(e) {
		return null;
	}
}

function getQueryString(key) {
	var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
	var result = window.location.search.substr(1).match(reg);
	return result ? decodeURIComponent(result[2]) : null;
}

function getURLParameters(paramName) {
	var sURL = window.document.URL.toString();
	if (sURL.indexOf("?") > 0) {
		var arrParams = sURL.split("?");
		var arrURLParams = arrParams[1].split("&");
		var arrParamNames = new Array(arrURLParams.length);
		var arrParamValues = new Array(arrURLParams.length);

		var i = 0;
		for ( i = 0; i < arrURLParams.length; i++) {
			var sParam = arrURLParams[i].split("=");
			arrParamNames[i] = sParam[0];
			if (sParam[1] != "")
				arrParamValues[i] = unescape(sParam[1]);
			else
				arrParamValues[i] = "No Value";
		}

		for ( i = 0; i < arrURLParams.length; i++) {
			if (arrParamNames[i] == paramName) {
				//alert("Parameter:" + arrParamValues[i]);
				return arrParamValues[i];
			}
		}
		return null;
	}
}

