const handlerCopyIdAccountMember = (event) => {
    const idAccount = $("#idAccountMember");
    // Copy the text inside the text field
    navigator.clipboard.writeText(idAccount.html());
    message_topright("success", "Copy ID Account successfully");
}

const handlerChoosePricing = (idPricing, ammountPricing, event) => {
    $("#modalPaymentmethod").modal('show');
    $("#idPricing").val(idPricing);
    $("#ammountPricing").val(ammountPricing);
}

const handlerClosePaymentMethod = () => {
    $("input[name*='metodePembayaran']")
    .map(function () {
      return this.checked = false;
    })
    .get();
    $("#idPricing").val('');
    $("#ammountPricing").val('');
    $("#modalPaymentmethod").modal('hide');
}

const handlerSubscriptions = () => {
    const idPricing = $("#idPricing").val()
    const ammountPricing = $("#ammountPricing").val()
    const paymentMethod = $("input[name*='metodePembayaran']")
    .map(function () {
      if (this.checked == true) {
        return this.value;
      }
    })
    .get();

    if (paymentMethod.length == 0) {
        message_topright("error", "Payment Method not yet selected");
        return false;
    }

    postData(base_url + "Wallet/subscriptionsAction",
    {
        ammountPricing,
        idPricing,
        paymentMethod: paymentMethod.toString(),
    },"POST").then((response) => {
        if (response.status == 201) {
            $("input[name*='metodePembayaran']").map(function () {
                return this.checked = false;
            }).get();
            $("#idPricing").val('');
            $("#ammountPricing").val('');

            $("#modalPricingSubscription").modal('hide');
            $("#modalPaymentmethod").modal('hide');
            $("#modalPricingSubscriptions").modal('show');

            $(".btnNextSubscription").attr('data-id', response.data.subscriptions.id)
            
            $("#nominal").html(`Rp. ${response.data.subscriptions.nominal_idr}`);
            $("#bank").html(`${response.data.subscriptions.bank}`);
            $("#bankNum").html(`${response.data.subscriptions.bank_num}`);
            $("#bankAcc").html(`${response.data.subscriptions.bank_acc}`);
            
        }
        if (response.status == 400) {
            message_topright("error", "Subcriptions failed, please try again");
            return false;
        }
    });
}

const handlerBackToFront = () => {
    $("#modalPricingSubscriptions").modal('hide');
    $("#modalPricingSubscription").modal('show');
};

const handlerNextPaymentSubscriptions = (event) => {
    const idSubscriptions = event.currentTarget.getAttribute('data-id');

    postData(base_url + "Wallet/getSubscriptionsTemp",
    {
        idSubscriptions
    },"POST").then((response) => {
        $("#modalPricingSubscriptions").modal('hide');
        $("#modalPaymentSubscriptions").modal('show');
        
        $(".btnSubmitSubscription").attr('data-id', response.id)
        $(".btnBackSubscription").attr('data-id', response.id)

        $("#bankPayment").html(`${response.bank}`);
        $("#bankNumPayment").html(`${response.bank_num}`);
        $("#totalPayment").html(`Rp. ${response.nominal_idr}`);
    });
};

const handlerBackToStep1 = (event) => {
    const idSubscriptions = event.currentTarget.getAttribute('data-id');
    $("#receipt").val('');

    postData(base_url + "Wallet/getSubscriptionsTemp",
    {
        idSubscriptions
    },"POST").then((response) => {
        $("#modalPaymentSubscriptions").modal('hide');
        $("#modalPricingSubscriptions").modal('show');
        
        $(".btnNextSubscription").attr('data-id', idSubscriptions)

        $("#nominal").html(`Rp. ${response.nominal_idr}`);
        $("#bank").html(`${response.bank}`);
        $("#bankNum").html(`${response.bank_num}`);
        $("#bankAcc").html(`${response.bank_acc}`);
    });
};

const handlerSubmitSubscriptions = (event) => {
    const idSubscriptions = event.currentTarget.getAttribute('data-id');
  
    if ($("#receipt").val() == "") {
      message_topright("error", "Receipt of Payment is required");
      return false;
    }
  
    let formData = new FormData();
    formData.append("idSubscriptions", idSubscriptions);
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
          url: base_url + "Wallet/subcriptionsProses",
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
                        
                        setTimeout(() => {
                            $("#modalPaymentSubscriptions").modal('hide');
                            $("#modalTransactionSuccess").modal('show');
                        }, 1200)
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