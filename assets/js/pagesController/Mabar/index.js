const urlOrigin = window.location.href.split('/')
const urlParams = urlOrigin[urlOrigin.length - 1].split('?')

const urlSearchParams = new URLSearchParams(window.location.search);
const gameCategory = Object.fromEntries(urlSearchParams.entries()).game;
const gameId = Object.fromEntries(urlSearchParams.entries()).number;

$(document).ready(function () {
	if (urlParams[0] == 'mabar') {
		if (urlOrigin.includes('mabar')) {
			setTimeout(() => $("#showModalChatApp").modal('show'), 800)
		}
		if (typeof gameCategory !== 'undefined') {
			handlerGetDataCategoryByGame(gameCategory, gameId);
			$(`#tab${gameId - 1}`).prop('checked', true)
		} else {
			handlerGetDataCategoryByGame($('#firstCategoryGame').val(), $('#id_game').val());
		}
	}
})

const getTypeHasClassActive = () => {
	let response = [];
	$(".mabar-sidebar h6").each(function (i, v) {
		if ($(this).hasClass('active')) {
			if (response.length == 0) {
				response.push({
					contenxt: $(this).html(),
					value: $(this).attr('data-value')
				})
			} else {
				response[0]['contenxt'] = $(this).html();
				response[0]['value'] = $(this).attr('data-value');
			}
		}
	})

	return Object.assign({}, ...response);
}

const getCategoryGameClassActive = () => {
	let tempCategoryGame = [];
	$("input[name*='tabs']").each(function () {
		if ($(this).is(':checked')) {
			$('#categoryGameName').html($(this).val())

			if (tempCategoryGame.length == 0) {
				tempCategoryGame.push({
					categorygame: $(this).val(),
					id: $(this).attr('data-idGame'),
				})
			} else {
				tempCategoryGame[0]['categorygame'] = $(this).val();
				tempCategoryGame[0]['id'] = $(this).attr('data-idGame');
			}
		}
	})

	return Object.assign({}, ...tempCategoryGame);
}

const handlerGetDataCategoryByGame = (categoryGame, id) => {

	// const typeMabar = getTypeHasClassActive()

	$('#categoryGameName').html(categoryGame)
	// $('#type').html(typeMabar.contenxt)
	path = window.location.pathname;
	window.history.pushState(null, null, path + `?number=${id}&game=${categoryGame}`);

	postData(base_url + 'Mabar/getDataTalentByParams', {
		type: null,
		id,
		typeGame: 'Mabar'
	}, 'POST')
		.then((response) => {
			initDataCategory(response);
		});
}

const handlerJenis = (event, type) => {
	if (type == 'mabar') {
		$('.mabar').removeClass('active')
		$('.scream').removeClass('active')

		$('.mabar').addClass('active')
	}

	if (type == 'scream') {
		$('.mabar').removeClass('active')
		$('.screan').removeClass('active')


		$('.scream').addClass('active')
	}

	getTypeHasClassActive()
	$("input[name*='tabs']").each(function () {
		if ($(this).is(':checked')) {
			handlerGetDataCategoryByGame(`${$(this).val()}`, `${$(this).attr('data-idGame')}`)
		}
	})
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

const handlerSearchcategory = (talentName) => {
	// const typeMabar = getTypeHasClassActive();
	const categoryGame = getCategoryGameClassActive()

	// $('#type').html(typeMabar.contenxt)

	path = window.location.pathname;
	window.history.pushState(null, null, path + `?number=${categoryGame.id}&game=${categoryGame.categorygame}`);
	// window.history.pushState(null, null, path + `?game=${categoryGame}`);
	// $("input[name*='tabs']").prop('checked', false);

	if (talentName == "") {
		initDataCategory([]);
		return false;
	}

	postData(base_url + 'Mabar/getDataTalentByParams', {
		type: 'search',
		id: categoryGame.id,
		talentName,
		typeGame: 'Mabar'
	}, 'POST')
		.then((response) => {
			initDataCategory(response);
		});
}

const initDataCategory = (response) => {
	// $('.tabs-depo').hide();
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
		// $(this).show();
		$('.tabs-depo').show();
		$('#initDataCategory').empty();
		if (response.length > 0) {
			$.each(response, function (i, v) {

				$("#initDataCategory").append(`
					<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3" data-aos="fade-up" data-aos-delay="${(i + 1) * 100}">
						<div class="card border-0 text-white" style="background: var(--color-secondary);box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
							<a href="${v.profile != "" ? base_url + `assets/img/imageMember/${v.profile}` : base_url + `assets/img/imageMember/default.png`}" data-lightbox="image-${i + 1}">
								<img src="${v.profile != "" ? base_url + `assets/img/imageMember/${v.profile}` : base_url + `assets/img/imageMember/default.png`}" data-talent="${v.description}" class="card-img-top" height="250" style="border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;cursor:pointer">
							</a>
							
							<div class="card-body">
								<div class="container">
									<h5 class="fw-semibold" style="font-size: 18px">${v.nama_talent}</h5>
									
									<div class="d-flex align-items-center justify-content-lg-start">
										<img src="${base_url + "assets/aset/CurrencyIcon/Currency Icon 1.png"}" width="35" class="img-fluid rounded-circle me-2">
										<h5 class="fw-semibold" style="font-size: 17px">${v.fee_per_match} <span class="fw-normal" style="font-size: 15px">/ Match</span></h5>
									</div>
									<div class="row align-items-center justify-content-center mt-4">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-sm-12">
											<button type="button" class="btn-authentication me-2 mb-3" onclick="handlerJoinMabar('${v.id_talent}', '${v.fee_per_match}', '${v.nama_talent}', 'chat')">Join Chat Room</button>
										</div>
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-sm-12">
											<button type="button" class="btn-authentication me-2 mb-3" onclick="handlerJoinMabar('${v.id_talent}', '${v.fee_per_match}', '${v.nama_talent}', 'join')">Join Mabar</button>
										</div>
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-sm-12">
											<button type="button" class="btn-authentication me-2 mb-3" onclick="handlerJoinMabar('${v.id_talent}', '${v.fee_per_match}', '${v.nama_talent}', 'donate')">Donate</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>`);

			})
		} else {
			$("#initDataCategory").append(`
				<div class="text-center">
					<img src="${base_url + 'assets/img/empty.png'}" class="img-responsive img-fluid"/>
					<h4 class="title-profile text-danger">The talent you are looking for is empty</h4>
				</div>
			`);
		}
	});
}

const handlerJoinMabar = (idTalent, feePerMatch, namaTalent, type) => {

	if ($("#sessionLogin").val() == "") {
		message_topright("error", "you have not logged in");
		setTimeout(() => {
			location.href = base_url + "login";
		}, 2000);
		return false;
	}

	if (type == 'chat') {


	    $.ajax({
                type: "POST",
                url: base_url + "Mabar/chat_room",
                data: { id_talent : idTalent },
                dataType: 'json', 
            }).done(function(response){
            	 document.location.href = response.redirect;
            });

	} else {


		$('#modalTalentMabar').modal('show');

	const categoryGame = getCategoryGameClassActive()

	if (type == 'join') {
		$("#modalTalentMabar .modal-title").html(`Join Mabar with ${namaTalent}`)
		$("#labelModalMabar").html('Berapa Kali Bermain?')
		$("#btnSaveModalMabar").html('Join Mabar')
	}

	if (type == 'donate') {
		$("#modalTalentMabar .modal-title").html(`Donate Coins to ${namaTalent}`)
		$("#labelModalMabar").html('Berapa Koin?')
		$("#btnSaveModalMabar").html('Donate')
	}

	


	$("#btnSaveModalMabar").attr('data-post', JSON.stringify({
		idTalent, feePerMatch, namaTalent, type, categoryGameId: categoryGame.id
	}))

	}


	

}

const hanndlerSaveModalMabar = (event) => {
	const dataPost = JSON.parse(event.currentTarget.getAttribute('data-post'))
	const freetext = $('#freeText').val()

	const newData = {
		"number": freetext,
	};
	Object.assign(dataPost, newData)

	if (freetext == "") {
		message_topright("error", "Complete the missing data");
		return false;
	}

	Swal.fire({
		title: "Are you sure?",
		text: `${dataPost.type == 'join' ? `join mabar with ${dataPost.namaTalent}` : `donate to ${dataPost.namaTalent}`} ?`,
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
				url: base_url + "Mabar/handlerRequestMabar",
				data: { dataPost },
				beforeSend: function () {
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
						if (dataPost.type == 'join') {
							setTimeout(() => {
								Swal.fire({
									title: `<div class="d-flex align-items-center justify-content-center">
											<div class="spinner-border me-3" role="status" aria-hidden="true"></div>
											<strong>Loading...</strong>
										  </div>`,
									showConfirmButton: false,
									timer: 1200,
								});
								location.href = base_url + `mabar/room/${dataPost.idTalent}/${dataPost.categoryGameId}`;
							}, 1200);
						} else {
							setTimeout(() => {
								Swal.fire({
									title: `<div class="d-flex align-items-center justify-content-center">
											<div class="spinner-border me-3" role="status" aria-hidden="true"></div>
											<strong>Loading...</strong>
										  </div>`,
									showConfirmButton: false,
									timer: 1200,
								});
								location.reload();
							}, 1200);
						}

					}

					if (response.status == false) {
						message_topright("error", response.message);
					}
				},
				error: function (xhr) {
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

const handlerPreviewTalentImage = (event, imgUrl, talentName) => {
	const dataTalent = event.currentTarget.getAttribute('data-talent');
	$("#modalTalentPreview").modal('show');

	$("#modalTalentPreview .modal-title").html(talentName);
	$('#initPreviewImgTalent').attr('src', base_url + `assets/img/imageMember/${imgUrl}`)
	$('#initPreviewDescTalent').html(dataTalent)
}