/**
 * JS For YourSyle
 */

YourStyle = function() {}

/**
 * Add/Delete to my tiles
 * @uri /yourstyle/group/:gid
 */
YourStyle.prototype.tilesToFromMy = function(e) {
	e = e || window.event;
	e.preventDefault();
	var ob = e.target || e.srcElement;
	
	var isDelete = (/toMy$/.test(ob.href) ? false : true);
	as.ajax(ob.href, function(response) {
		if (isDelete) {
			ob.innerHTML = '� ��� ����';
			ob.href = ob.href.replace('fromMy', 'toMy');
		} else {
			ob.innerHTML = '������ �� ���� �����';
			ob.href = ob.href.replace('toMy', 'fromMy');
		}
	});
}

/**
 * Add/Delete to my tiles
 * @uri /yourstyle/tile/:tid
 */
YourStyle.prototype.tileToFromMy = function(e) {
	e = e || window.event;
	e.preventDefault();
	var ob = e.target || e.srcElement;
	
	var isDelete = (/toMy$/.test(ob.href) ? false : true);
	as.ajax(ob.href, function(response) {
		var textOb = as.$$('h3', as.parent(ob, 'div'));
		
		if (isDelete) {
			ob.innerHTML = '��������';
			textOb.innerHTML = textOb.innerHTML.replace(' � ��', '');
			ob.href = ob.href.replace('fromMy', 'toMy');
		} else {
			ob.innerHTML = '������';
			textOb.innerHTML += ' � ��';
			ob.href = ob.href.replace('toMy', 'fromMy');
		}
	});
}

/**
 * Vote for set
 */
YourStyle.prototype.setVote = function(e) {
	e = e || window.event;
	e.preventDefault();
	var ob = e.target || e.srcElement;
	
	as.ajax(ob.href, function(response) {
		if (!response) return;
		
		var before = prev(ob);
		before.innerHTML += '<p>� ���</p>';
		
		var after = as.after('p', ob);
		after.innerHTML = ob.innerHTML;
		as.remove(ob);
	});
}

/**
 * Open editor in a new window
 */
as.ready.add(function() {
	as.w('a.newWindow').each(function() {
		as.e.click(this, function(e) {
			e = e || window.event;
			e.preventDefault();
			var ob = e.target || e.srcElement;

			window.open(ob.href, 'yourstyle - editor - popcornenws');
		});
	});
});