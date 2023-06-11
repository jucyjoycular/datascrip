const handlerBackToFront = () => {
  location.href = base_url + "withdraw";
};

const handlerWithdraw = () => {
  const nominalMoney = $("#nominal").val();
  const nominalCurrency = $("#platformCurrency").val();

  if (nominalCurrency == "") {
    message_topright("error", "Currency can not be empty");
    return false;
  }

  if ($("#bank").val() == "") {
    message_topright("error", "Information account can not be empty");
    return false;
  }

  postData(
    base_url + "Withdraw/withdrawTransaction",
    {
      nominalMoney,
      nominalCurrency,
    },
    "POST"
  ).then((response) => {
    if (response.status == 201) {
      location.href =
        base_url + "withdraw/transaction?id=" + response.data.id_widtdraw;
    }
    if (response.status == 400) {
      message_topright("error", "Withdraw failed, please try again");
      return false;
    }
  });
};

const handlerPaidWithdraw = (event) => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const idWithdraw = Object.fromEntries(urlSearchParams.entries()).id;
  const total_currency = $("#total_currency").val();


  Swal.fire({
    title: "Are you sure?",
    text: "Paid data?",
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
        url: base_url + "Withdraw/transactionWithdrawRequest",
        data: { idWithdraw,total_currency },
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
          if (response.status) {
            message_topright("success", response.message);
            setTimeout(() => {
              Swal.fire({
                title: `<div class="d-flex align-items-center justify-content-center">
                          <div class="spinner-border me-3" role="status" aria-hidden="true"></div>
                          <strong>Loading...</strong>
                        </div>`,
                showConfirmButton: false,
                timer: 1500,
              });
              location.href = base_url + "withdraw/transaction-response";
            }, 1500);
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

const handlerSumWithdrawCurrency = (value) => {
  const withdraw = $("#nominal_idrsx").val();
  const priceOneCurrency = 20000;
  const setTopUp = parseInt(value.replaceAll(".", ""));
  const totalGetCurrency = setTopUp * withdraw;


  if (value < 2) {
    message_topright("error", "minimal withdraw 2 currency");
    $("#platformCurrency").val("");
    $("#nominal").val("");
    return false;
  }

  // if (totalGetCurrency.toString().includes(".")) {
  // 	message_topright(
  // 		"error",
  // 		"nominal pastikan kelipatan dari harga 1 currency"
  // 	);
  // 	return false;
  // }

  if (value == "") {
    $("#nominal").val("");
  } else {
    $("#nominal").val(totalGetCurrency);
  }
};

const handlerAddRekeningMember = () => {
  $(".btnAddRekening").hide();
  $(".btnSaveRekening").show();

  $("#bank").removeClass("border-0");
  $("#bank").removeAttr("disabled");

  $("#bank_num").removeClass("border-0");
  $("#bank_num").removeAttr("disabled");

  $("#bank_acc").removeClass("border-0");
  $("#bank_acc").removeAttr("disabled");
};

const handlerEditRekeningMember = () => {
  $(".btnEditRekening").hide();
  $(".btnSaveRekening").show();

  $("#bank").removeClass("border-0");
  $("#bank").removeAttr("disabled");

  $("#bank_num").removeClass("border-0");
  $("#bank_num").removeAttr("disabled");

  $("#bank_acc").removeClass("border-0");
  $("#bank_acc").removeAttr("disabled");
};

const handlerSaveRekeningMember = () => {
  const bank = $("#bank").val();
  const bank_num = $("#bank_num").val();
  const bank_acc = $("#bank_acc").val();

  if (bank == "") {
    message_topright("error", "Bank can not be empty");
    return false;
  }

  if (bank_num == "") {
    message_topright("error", "No Account can not be empty");
    return false;
  }

  if (bank_acc == "") {
    message_topright("error", "Fullname can not be empty");
    return false;
  }

  postData(
    base_url + "Withdraw/saveRekening",
    {
      bank,
      bank_num,
      bank_acc,
    },
    "POST"
  ).then((response) => {
    if (response.status) {
      message_topright("success", response.message);
      postData(base_url + "Withdraw/getRekening", {}, "GET").then((result) => {
        $(`.dataAccountMember`)
          .fadeOut("slow", function () {
            $(this).hide();
          })
          .fadeIn("slow", function () {
            $(this).show();
            $("#bank").addClass("border-0");
            $("#bank").attr("disabled", "disabled");

            $("#bank_num").addClass("border-0");
            $("#bank_num").attr("disabled", "disabled");

            $("#bank_acc").addClass("border-0");
            $("#bank_acc").attr("disabled", "disabled");

            $(".btnAddRekening").hide();
            $(".btnSaveRekening").hide();
            $(".btnEditRekening").show();
          });
      });
    } else {
      message_topright("success", response.message);
      return false;
    }
  });
};
