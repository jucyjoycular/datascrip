$(document).ready(function () {
	$("#initHistoryMember").DataTable();
	handlerGetHistoryAll();
});

const handlerGetHistoryAll = () => {
	$("#historyAll").removeClass("active");
	$("#historyPaid").removeClass("active");
	$("#historyPending").removeClass("active");
	$("#historyCancel").removeClass("active");

	$("#historyAll").addClass("active");

	$("#initHistoryMember > tbody").empty();

	$("#initHistoryMember > tbody").append(`
        <tr class="text-center">
            <td colspan="5">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border me-3" role="status" aria-hidden="true"></div>
                    <strong>Loading...</strong>
                </div>
            </td>
        </tr>
    `);
	setTimeout(() => {
		postData(
			base_url + "History/getTransactionMember",
			{ type: "all" },
			"POST"
		).then((response) => {
			initDataHistory(response);
		});
	}, 1000);
};

const handlerGetHistoryPaid = () => {
	$("#historyAll").removeClass("active");
	$("#historyPaid").removeClass("active");
	$("#historyPending").removeClass("active");
	$("#historyCancel").removeClass("active");

	$("#historyPaid").addClass("active");

	$("#initHistoryMember > tbody").empty();

	$("#initHistoryMember > tbody").append(`
        <tr class="text-center">
            <td colspan="5">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border me-3" role="status" aria-hidden="true"></div>
                    <strong>Loading...</strong>
                </div>
            </td>
        </tr>
    `);
	setTimeout(() => {
		postData(
			base_url + "History/getTransactionMember",
			{
				type: "paid",
			},
			"POST"
		).then((response) => {
			initDataHistory(response);
		});
	}, 1000);
};

const handlerGetHistoryPending = () => {
	$("#historyAll").removeClass("active");
	$("#historyPaid").removeClass("active");
	$("#historyPending").removeClass("active");
	$("#historyCancel").removeClass("active");

	$("#historyPending").addClass("active");

	$("#initHistoryMember > tbody").empty();

	$("#initHistoryMember > tbody").append(`
        <tr class="text-center">
            <td colspan="5">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border me-3" role="status" aria-hidden="true"></div>
                    <strong>Loading...</strong>
                </div>
            </td>
        </tr>
    `);
	setTimeout(() => {
		postData(
			base_url + "History/getTransactionMember",
			{ type: "pending" },
			"POST"
		).then((response) => {
			initDataHistory(response);
		});
	}, 1000);
};

const handlerGetHistoryCancel = () => {
	$("#historyAll").removeClass("active");
	$("#historyPaid").removeClass("active");
	$("#historyPending").removeClass("active");
	$("#historyCancel").removeClass("active");

	$("#historyCancel").addClass("active");

	$("#initHistoryMember > tbody").empty();

	$("#initHistoryMember > tbody").append(`
        <tr class="text-center">
            <td colspan="5">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border me-3" role="status" aria-hidden="true"></div>
                    <strong>Loading...</strong>
                </div>
            </td>
        </tr>
    `);
	setTimeout(() => {
		postData(
			base_url + "History/getTransactionMember",
			{ type: "cancel" },
			"POST"
		).then((response) => {
			initDataHistory(response);
		});
	}, 1000);
};

const initDataHistory = (response) => {
		
	if ($.fn.DataTable.isDataTable('#initHistoryMember')) {
		$('#initHistoryMember').DataTable().destroy();
	}
	$("#initHistoryMember > tbody").empty();

	if (response.length > 0) {
		$.each(response, function (i, v) {
			$("#initHistoryMember > tbody").append(`
                    <tr class="text-center">
                        <td>${v.order_number}</td>
                        <td>${v.date}</td>
                        <td>${v.type}</td>
                        <td>
                            <span class="badge ${
															v.status == "Pending"
																? "text-bg-primary"
																: v.status == "Paid"
																? "text-bg-success"
																: v.status == "Cancel"
																? "text-bg-danger"
																: ""
														}">
                                ${v.status}
                            </span>
                        </td>
                        <td>${v.total}</td>
                    </tr>
                `);
		});
	} else {
		$("#initHistoryMember > tbody").append(
			`<tr class="text-center"><td colspan="5" class="text-danger">Data not found</td></tr>`
		);
	}

	$('#initHistoryMember').DataTable();
};
