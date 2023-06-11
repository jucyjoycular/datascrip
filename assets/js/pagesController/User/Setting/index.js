const urlSearchParams = new URLSearchParams(window.location.search);
const tabs = Object.fromEntries(urlSearchParams.entries()).tabs;

// console.log(tabs);
// return false;

const resetUrlPushState = () => {
  let url = window.location.href;
  if (url.indexOf("?") != -1) {
    let resUrl = url.split("?");

    if (typeof window.history.pushState == "function") {
      window.history.pushState({}, "Hide", resUrl[0]);
    }
  }
};

$(document).ready(function () {
  $("#showPassword").show("slow");
  // resetUrlPushState();

  if (typeof tabs !== "undefined") {
    if (tabs == "1") {
      $("#showPassword").show("slow");
      $("#showHistory").hide("slow");
      $("#showDeleteAccount").hide("slow");
    }
    if (tabs == "2") {
      $("#showPassword").hide("slow");
      $("#showHistory").show("slow");
      $("#showDeleteAccount").hide("slow");
    }

    if (tabs == "3") {
      $("#showPassword").hide("slow");
      $("#showHistory").hide("slow");
      $("#showDeleteAccount").show("slow");
    }
  }

  $("#initHistoryMember").DataTable();
  handlerGetHistoryAll();
});

const chkSettingProfile = (event) => {
  //master path - original path
  const path = window.location.pathname;

  if (event.currentTarget.value == "0") {
    $("#showPassword").show("slow");
    $("#showHistory").hide("slow");
    $("#showDeleteAccount").hide("slow");

    //Redirectss original path to this
    // window.history.pushState(null, null, path + `?tabs=1`);
  }
  if (event.currentTarget.value == "1") {
    $("#showPassword").hide("slow");
    $("#showHistory").show("slow");
    $("#showDeleteAccount").hide("slow");

    // window.history.pushState(null, null, path + `?tabs=2`);
  }

  if (event.currentTarget.value == "2") {
    $("#showPassword").hide("slow");
    $("#showHistory").hide("slow");
    $("#showDeleteAccount").show("slow");

    // window.history.pushState(null, null, path + `?tabs=3`);
  }
};

const handlerDeleteAccount = () => {
  if ($("#reason").val() == "") {
    message_topright("error", "Reason can not be empty");
    return false;
  }

  if ($("#username").val() == "") {
    message_topright("error", "Username can not be empty");
    return false;
  }

  if ($("#passwordDelete").val() == "") {
    message_topright("error", "Password can not be empty");
    return false;
  }

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Ingin delete data opname?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Yakin",
    cancelButtonText: "Tidak, Tutup",
  }).then((result) => {
    if (result.value == true) {
      postData(
        base_url + "User/Setting/deleteAccountRequest",
        {
          reason: $("#reason").val(),
          username: $("#username").val(),
          password: $("#passwordDelete").val(),
        },
        "POST"
      ).then((response) => {
        if (response.status == true) {
          Swal.fire({
            title: '<span ><i class="bi bi-spinner"></i> Loading...</span>',
            text: response.message,
            showConfirmButton: false,
            timer: 2000,
          });

          setInterval(() => {
            location.href = base_url + "Auth/logout";
          }, 2000);
        } else {
          message_topright("error", response.message);
        }
      });
    }
  });
};

/*********************************************** History ********************************************************/

const handlerGetHistoryAll = () => {
  $("#historyAll").removeClass("active");
  $("#historyPaid").removeClass("active");
  $("#historyPending").removeClass("active");
  $("#historyCancel").removeClass("active");

  $("#historyAll").addClass("active");

  if ($.fn.DataTable.isDataTable('#initHistoryMember')) {
    $('#initHistoryMember').DataTable().destroy();
  }

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

  if ($.fn.DataTable.isDataTable('#initHistoryMember')) {
    $('#initHistoryMember').DataTable().destroy();
  }

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

  if ($.fn.DataTable.isDataTable('#initHistoryMember')) {
    $('#initHistoryMember').DataTable().destroy();
  }

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

  if ($.fn.DataTable.isDataTable('#initHistoryMember')) {
    $('#initHistoryMember').DataTable().destroy();
  }

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
  console.log(response);
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
							<span class="badge ${v.status == "Pending"
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
      `<tr class="text-center"><td class="text-danger"></td><td>Data not found</td><td></td><td></td><td></td></tr>`
    );
  }

  $("#initHistoryMember").DataTable();
};

/*********************************************** History ********************************************************/
