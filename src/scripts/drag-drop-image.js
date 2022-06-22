var // where files are dropped + file selector is opened
	dropRegion = document.querySelector(".drop-region");
	
if ($(dropRegion).length >= 1) {

	var imagePreviewRegion = dropRegion.closest('table').querySelector('.image-preview');
	// var realInput = dropRegion.querySelector('.drop-region-input');

	document.body.addEventListener("change", function(event) {
		if (event.srcElement.classList.value == 'drop-region-input') {
			imagePreviewRegion = event.srcElement.closest('table').querySelector('.image-preview');
			var files = event.srcElement.files;
			handleFiles(files);
		}
	});

	function preventDefault(e) {
		e.preventDefault();
		e.stopPropagation();
	}

	dropRegion.addEventListener('dragenter', preventDefault, false)
	dropRegion.addEventListener('dragleave', preventDefault, false)
	dropRegion.addEventListener('dragover', preventDefault, false)
	dropRegion.addEventListener('drop', preventDefault, false)

	function handleDrop(e) {
		var dt = e.dataTransfer,
			files = dt.files;

		if (files.length) {
			handleFiles(files);
		} else {
			// check for img
			var html = dt.getData('text/html'),
				match = html && /\bsrc="?([^"\s]+)"?\s*/.exec(html),
				url = match && match[1];

			if (url) {
				uploadImageFromURL(url);
				return;
			}
		}

		function uploadImageFromURL(url) {
			var img = new Image;
			var c = document.createElement("canvas");
			var ctx = c.getContext("2d");

			img.onload = function() {
				c.width = this.naturalWidth; // update canvas size to match image
				c.height = this.naturalHeight;
				ctx.drawImage(this, 0, 0); // draw in image
				c.toBlob(function(blob) { // get content as PNG blob

					// call our main function
					handleFiles([blob]);
				}, "image/png");
			};
			img.onerror = function() {
				alert("Error in uploading");
			}
			img.crossOrigin = ""; // if from different origin
			img.src = url;
		}
	}

	dropRegion.addEventListener('drop', handleDrop, false);

	function handleFiles(files) {
		for (var i = 0, len = files.length; i < len; i++) {
			if (validateImage(files[i]))
				previewAnduploadImage(files[i]);
		}
	}

	function validateImage(image) {
		// check the type
		var validTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/bmp'];
		if (validTypes.indexOf(image.type) === -1) {
			alert("Invalid File Type");
			return false;
		}

		// check the size
		var maxSizeInBytes = 10e6; // 10MB
		if (image.size > maxSizeInBytes) {
			alert("File too large");
			return false;
		}
		return true;
	}

	function createInput (inputName, inputVal){
		var inputField = document.createElement("input");
		inputField.type = "text";
		inputField.className = "image-data";
		inputField.name = inputName;
		inputField.value = inputVal;

		return inputField;
	}

	function previewAnduploadImage(image) {
		// container
		var imgView = document.createElement("tr");
		imgView.className = "image-view";
		imagePreviewRegion.appendChild(imgView);

		var buttonDeleteTd = document.createElement("td");
		buttonDeleteTd.className = "mobile-button-delete-wrap";
		var buttonDelete = document.createElement("button");
		buttonDelete.className = "mobile-button-delete js-delete-uploaded-img";
		buttonDelete.setAttribute('data-image-name', image.name);
		buttonDelete.setAttribute('data-toggle','modal');
		buttonDelete.setAttribute('data-target','#deleteImgModal');

		buttonDeleteTd.appendChild(buttonDelete);
		imgView.appendChild(buttonDeleteTd);

		var imgIcon = document.createElement("td");
		imgIcon.className = "mobile-image-icon";
		var imgTypeSplit = image.type.split('/');
		var imgIconContainer = document.createElement("span");
		imgIconContainer.className = "mobile-image-container";
		if(imgTypeSplit[1] == "jpg" || imgTypeSplit[1] == "jpeg") {
			imgIconContainer.style.background = "#7D9BC2";
		}
		if(imgTypeSplit[1] == "gif") {
			imgIconContainer.style.background = "#C77B18";
		}
		if(imgTypeSplit[1] == "pdf" || imgTypeSplit[1] == "png") {
			imgIconContainer.style.background = "#C71841";
		}
		imgIconContainer.append(imgTypeSplit[1]);
		imgIcon.appendChild(imgIconContainer);
		imgView.appendChild(imgIcon);

		var imgName = document.createElement("td");
		imgName.className = "image-name " + image.name;
		imgName.innerHTML = image.name;
		imgView.appendChild(imgName);

		// previewing image
		// var img = document.createElement("img");
		// img.className = "imgage-img";
		// imgView.appendChild(img);

		// read the image...
		// var imputImgData = createInput ('image-data', "");
		var reader = new FileReader();
		reader.onload = function(e) {
			// img.src = e.target.result;
			var imputImgData = createInput ('image-data', e.target.result);
			imgName.appendChild(imputImgData);
		}
		reader.readAsDataURL(image);

		// create field for image name
		var imputImgName = createInput ('image-name', image.name);
		imgName.appendChild(imputImgName);

		var imputImgSize = createInput ('image-size', image.size);
		imgName.appendChild(imputImgSize);

		var imputImgType = createInput ('image-type', image.type);
		imgName.appendChild(imputImgType);

		
		var imgSize = document.createElement("td");
		imgSize.className = "image-size";

		var newSize = image.size / 1000;

		if (newSize >= 1000) {
			newSize = (newSize / 1000).toFixed(2) + " mb";
		} else {
			newSize = newSize.toFixed(2) + " kb";
		}

		imgSize.innerHTML = newSize;
		imgView.appendChild(imgSize);

		var imgWrap = document.createElement("td");
		imgWrap.className = "success-or-error";
		imgView.appendChild(imgWrap);

		var imgSuccess = document.createElement("img");
		imgSuccess.src = "images/checked.svg";
		imgWrap.appendChild(imgSuccess);

	}
}