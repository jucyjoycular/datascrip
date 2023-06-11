const urlSearchParams = new URLSearchParams(window.location.search);
const type = Object.fromEntries(urlSearchParams.entries()).type;

$(document).ready(function () {
	let bannerMember = document.querySelectorAll(".profile-card");
	bannerMember.forEach((el) => {
		if (el.getAttribute("data-img") == "") {
			el.style.background = "var(--color-secondary)";
		} else {
			el.style.background = `url(${el.getAttribute("data-img")}) center center`;
			el.style.backgroundSize = `center`;
			el.style.backgroundPosition = `center`;
			el.style.backgroundRepeat = `no-repeat`;
		}
	});

	if (typeof type !== "undefined") {
		if (type == "room-registration") {
			console.log("scroll");
			window.scrollTo(0, document.body.scrollHeight);
		}
	}
});

const handlerPreviewImgMember = () => {
	const file = document.querySelector("input[name*='imgMember']").files[0];
	const reader = new FileReader();

	$(".showImgMember").empty();
	reader.addEventListener(
		"load",
		function () {
			let result = reader.result;

			$(".showImgMember").append(`
                <img src="${result}" class="rounded-circle mb-3" alt="" width="150" height="150">
            `);
		},
		false
	);

	if (file) {
		reader.readAsDataURL(file);
	}
};

const handlerPreviewBannerMember = () => {
	const file = document.querySelector("input[name*='bannerMember']").files[0];
	const reader = new FileReader();

	// $(".showImgMember").empty();
	reader.addEventListener(
		"load",
		function () {
			let result = reader.result;

			$(".showBannerMember").css("background", `url(${result}) center center`);
			$(".showBannerMember").css("background-size", `cover`);
		},
		false
	);

	if (file) {
		reader.readAsDataURL(file);
	}
};

const handlerChangeImgMemberRequest = () => {
	if ($("#imgMember").val() == "") {
		message_topright("error", "file can not be empty");
		return false;
	}

	let newForm = new FormData();
	newForm.append("file", $("#imgMember")[0].files[0]);

	$.ajax({
		type: "POST",
		url: base_url + "User/Profile/changeImgMemberRequest",
		data: newForm,
		enctype: "multipart/form-data",
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (response) {
			if (response.status == true) {
				message_topright("success", response.message);
				// $(`.profile-card`)
				// 	.fadeOut("slow", function () {
				// 		$(this).hide();
				// 	})
				// 	.fadeIn("slow", function () {
				// 		$(this).show();
				// 	});
				$("#imgMember").val("");
			} else {
				message_topright("error", response.message);
			}
		},
	});
};

const handlerChangeBannerMemberRequest = () => {
	if ($("#bannerMember").val() == "") {
		message_topright("error", "file can not be empty");
		return false;
	}

	let newForm = new FormData();
	newForm.append("file", $("#bannerMember")[0].files[0]);

	$.ajax({
		type: "POST",
		url: base_url + "User/Profile/changeBannerMemberRequest",
		data: newForm,
		enctype: "multipart/form-data",
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (response) {
			if (response.status == true) {
				message_topright("success", response.message);
				// $(`.profile-card`)
				// 	.fadeOut("slow", function () {
				// 		$(this).hide();
				// 	})
				// 	.fadeIn("slow", function () {
				// 		$(this).show();
				// 	});
				$("#bannerMember").val("");
			} else {
				message_topright("error", response.message);
			}
		},
	});
};

const handlerToRedirectRoom = (categoryId, tierId, roomId) => {
	location.href = `tournament/room/${categoryId}/${tierId}/${roomId}`;
};

const handlerToRedirectScream = (categoryId, gameID, screamId) => {
	location.href = `scream/room/${categoryId}/${gameID}/${screamId}`;
};
