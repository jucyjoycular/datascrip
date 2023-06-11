const handlerBackToFront = () => {
  location.href = base_url + "topup";
};

const handlerBackToStep1 = (id) => {
  location.href = base_url + `topup/transaction?id=${id}&step=1`;
};

const handlerTopup = (event) => {
  $("#btn-next1").prop("disabled", true);
  const nominalMoney = $("#nominal").val();
  const nominalCurrency = $("#platformCurrency").val();
  const description = $("#description-topup").val();
  const paymentMethod = $("input[name*='metodePembayaran']")
    .map(function () {
      if (this.checked == true) {
        return this.value;
      }
    })
    .get();

  if (nominalCurrency == "") {
    message_topright("error", "Currency can not be empty");
    $("#btn-next1").prop("disabled", false);
    return false;
  }

  if (paymentMethod.length == 0) {
    message_topright("error", "Payment Method not yet selected");
    $("#btn-next1").prop("disabled", false);
    return false;
  }

  postData(
    base_url + "Topup/topupTransaction",
    {
      nominalMoney,
      nominalCurrency,
      paymentMethod: paymentMethod.toString(),
      description,
    },
    "POST"
  ).then((response) => {
    if (response.status == 201) {
      $("#btn-next1").prop("disabled", false);
      location.href =
        base_url + "topup/transaction?id=" + response.data.id_topup + "&step=1";
    }
    if (response.status == 400) {
      message_topright("error", "Topup failed, please try again");
      $("#btn-next1").prop("disabled", false);
      return false;
    }
  });
};
const handlerSummaryTopup = () => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const idTopup = Object.fromEntries(urlSearchParams.entries()).id;
  location.href = base_url + "topup/payment?id=" + idTopup + "&step=2";
};
const handlerSubmitTopup = (event) => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const idTopup = Object.fromEntries(urlSearchParams.entries()).id;

  if ($("#receipt").val() == "") {
    message_topright("error", "Receipt of Payment is required");
    return false;
  }

  let formData = new FormData();
  formData.append("idTopup", idTopup);
  if ($("#receipt").val() == "") {
    formData.append("files", null);
  } else {
    formData.append("files", $("#receipt")[0].files[0]);
  }

  Swal.fire({
    title: "Are you sure?",
    text: "Submit data?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Sure",
    cancelButtonText: "No, Close",
  }).then((result) => {
    if (result.value == true) {
      $.ajax({
        type: "POST",
        url: base_url + "Topup/paymentTopupRequest",
        data: formData,
        contentType: false,
        processData: false,
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
        dataType: "json",
        success: function (response) {
          event.srcElement.disabled = false
          if (response.status) {
            let type = response.file == "" ? "pending" : "success";
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
              location.href =
                base_url + `topup/transaction-response?type=${type}`;
            }, 1200);
          } else {
            message("Error!", response.message, "error");
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
};

const handlerSumTopUpCurrency = (value) => {
  const priceOneCurrency = $("#nominal_idrs").val();
  const setTopUp = parseInt(value.replaceAll(".", ""));
  const totalGetCurrency = setTopUp * priceOneCurrency;

  if (setTopUp < 1) {
    message_topright("error", "minimal topup 1 currency");
    $("#platformCurrency").val("");
    return false;
  }

  if (value == "") {
    $("#nominal").val("");
  } else {
    $("#nominal").val(totalGetCurrency);
  }
};
