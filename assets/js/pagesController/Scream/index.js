const urlOrigin = window.location.href.split('/')
const urlParams = urlOrigin[urlOrigin.length - 1].split('?')

const urlSearchParams = new URLSearchParams(window.location.search);
const gameCategory = Object.fromEntries(urlSearchParams.entries()).game;
const gameId = Object.fromEntries(urlSearchParams.entries()).number;

$(document).ready(function () {
	if (urlOrigin.includes('room')) {
		setTimeout(() => $("#showModalChatApp").modal('show'), 800)
	}
	if (urlParams[0] == 'scream') {
		if (typeof gameCategory !== 'undefined') {
			handlerGetDataCategoryByGame(gameCategory, gameId);
			$(`#tab${gameId - 1}`).prop('checked', true)
		} else {
			handlerGetDataCategoryByGame($('#firstCategoryGame').val(), $('#id_game').val());
		}
	}
})

const handlerGetDataCategoryByGame = (categoryGame, id) => {
	$('#categoryGameName').html(categoryGame)
	path = window.location.pathname;
	window.history.pushState(null, null, path + `?number=${id}&game=${categoryGame}`);

	postData(base_url + 'Scream/getDataCategoryByGame', {
		type: null,
		categoryGame,
		id
	}, 'POST')
		.then((response) => {
			initDataCategory(response);
		});
}

const resetUrlPushState = () => {
	let url = window.location.href;
	if (url.indexOf("?") != -1) {
		let resUrl = url.split("?");

		if (typeof window.history.pushState == 'function') {
			window.history.pushState({}, "Hide", resUrl[0]);
		}
	}
}

const handlerSearchcategory = (categoryGame) => {
	$('#categoryGameName').html(categoryGame)
	path = window.location.pathname;
	window.history.pushState(null, null, path + `?game=${categoryGame}`);
	$("input[name*='tabs']").prop('checked', false);

	if (categoryGame == "") {
		initDataCategory([]);
		return false;
	}

	postData(base_url + 'Scream/getDataCategoryByGame', {
		type: 'search',
		categoryGame
	}, 'POST')
		.then((response) => {
			initDataCategory(response);
		});
}

const initDataCategory = (response) => {
	$('.tabs-depo').hide();
	$('#initDataCategory').empty();

	$('#initDataCategory').fadeToggle(300, function () {
		$(this).hide();
		$("#initDataCategory").append(`
			<div class="d-flex align-items-center justify-content-center">
				<div class="spinner-border me-3" role="status" aria-hidden="true"></div>
				<strong>Loading...</strong>
			</div>
		`);
	}).fadeIn(500, function () {
		$(this).show();
		$('.tabs-depo').show();
		$('#initDataCategory').empty();
		if (response.length > 0) {
			$.each(response, function (i, v) {
				$("#initDataCategory").append(`
					<div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 col-xs-12 mb-3" data-aos="fade-up" data-aos-delay="${(i + 1) * 100}">
						<div class="card border-0 text-white" style="background: var(--color-secondary);">
							<img src="${base_url + 'backend/assets/upload/category_scream/' + v.filename}" class="card-img-top" height="250" style="border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
							<div class="card-body">
								<div class="container">
									<div class="row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
											<img src="${base_url + 'assets/img/logo.png'}" width="45" class="img-fluid rounded-circle">
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 my-auto">
											<span class="fw-semibold" style="font-size: 16px">${v.category_name}</span>
										</div>

										
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 mt-3">
											<p style="font-size: 13px; color:var(--color-secondary-light)" class="my-auto">${v.description}</p>
										</div>
									</div>
									<button type="button" onclick="handlerClickCategooryToDetail('${v.category_id}','${v.id_game}', '${v.nama_game}')" class="btn-authentication mt-4">View</button>
								</div>
							</div>
						</div>
					</div>`);
			})
		} else {
			$("#initDataCategory").append(`
				<div class="text-center">
					<img src="${base_url + 'assets/img/empty.png'}" class="img-responsive img-fluid"/>
					<h4 class="title-profile text-danger">The category you are looking for is empty</h4>
				</div>
			`);
		}
	});
}

const handlerClickCategooryToDetail = (categoryId, id_game, namaGame) => {
	location.href = base_url + "scream/regist_scream/" + categoryId + "/" + id_game + `?number=${id_game}&game=${namaGame}`;
}

const handlerRegistrationScream = (
	event,
	id_cat,
	id_game,
	sessionLogin,
	id_scream
) => {

	const url = window.location.href;

	console.log({
		id_cat,
		id_game,
		sessionLogin,
		id_scream
	});


	if (sessionLogin == "") {
		message_topright("error", "you have not logged in");
		setTimeout(() => {
			location.href = base_url + "login";
		}, 2000);
	} else {
		Swal.fire({
			title: "Are you sure?",
			text: "to register in scrim?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, Sure",
			cancelButtonText: "No, Close"
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					type: "POST",
					url: base_url + "Scream/regist_process",
					data: { id_cat, id_game, id_scream },
					beforeSend: function() {
						event.srcElement.disabled = true
						Swal.fire({
							title: `<div class="d-flex align-items-center justify-content-center">
										<div class="spinner-border me-3" role="status" aria-hidden="true"></div>
										<strong>Loading...</strong>
									</div>`,
							showConfirmButton: false,
							allowOutsideClick: false
						});
					},
					dataType: "JSON",
					success: function (response) {
						event.srcElement.disabled = false
						if (response.status == true) {
							message_topright("success", response.message);
							setTimeout(() => {
								Swal.fire({
								  title: `<div class="d-flex align-items-center justify-content-center">
											<div class="spinner-border me-3" role="status" aria-hidden="true"></div>
											<strong>Loading...</strong>
										  </div>`,
								  showConfirmButton: false,
								  timer: 1200,
								});
								location.href = base_url + "scream/room/" + id_cat + "/" + id_game + "/" + id_scream;
							  }, 1200);

						}

						if (response.status == false) {
							message_topright("error", response.message);
						}

					},
					error: function(xhr) {
						event.srcElement.disabled = false
						Swal.fire({
							title: `<div class="d-flex align-items-center justify-content-center">
										<div class="spinner-border me-3" role="status" aria-hidden="true"></div>
										<strong>Loading...</strong>
									</div>`,
							showConfirmButton: false,
							allowOutsideClick: false,
							timer: 10
						});
					}
				});
			}
		});
	}
};