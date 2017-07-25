function addDelButtons() {
	var delUserButtons = document.querySelectorAll(".del-movie");
	for (var i = 0; i < delUserButtons.length; i++) {
		delUserButtons[i].addEventListener('click', function() {
			// if (!confirm('Delete movie?')) {
			// 	return;
			// }
			var id = this.id;
			var elem = this;
			// alert("delete movie with id=" + id);

			var xhr = new XMLHttpRequest();
			xhr.open('POST', rootURL + 'movie/delete', true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send("id=" + id);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					if (xhr.responseText == "0") {
						alert("Deleting was not successful");
					}
					else {
						// alert(xhr.responseText);
						elem.parentElement.parentElement.remove();
						location.reload();					
					}		
				};
			};

		});
	};
};

window.onload = function() {
	addDelButtons();
}