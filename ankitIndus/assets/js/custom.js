function editAddNewRow() {
    $.ajax({
        url: "app/ajax/addNewRow.php",
        method: "POST",
        data: {
            getOrderItem: 1
        },
        success: function (a) {
            $("#editInvoiceItem").append(a), $(".select2").select2();
            var t = 0;
            $(".si_number").each((function () {
                $(this).html(++t)
            }))
        }
    })
}
$("#empTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/member_data.php"
    },
    columns: [{
        data: "member_id"
    }, {
        data: "name"
    }, {
        data: "gstno"
    }, {
        data: "address"
    }, {
        data: "con_num"
    }, {
        data: "total_buy"
    }, {
        data: "gst_type"
    }, {
        data: "action"
    }]
}), $("#suppliarTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/suppliar_data.php"
    },
    columns: [{
        data: "suppliar_id"
    }, {
        data: "name"
    }, {
        data: "sup_gstno"
    }, {
        data: "address"
    }, {
        data: "con_num"
    }, {
        data: "total_buy"
    }, {
        data: "total_paid"
    }, {
        data: "sup_gst_type"
    }, {
        data: "action"
    }]
}), $("#staffTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/staff_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "name"
    }, {
        data: "designation"
    }, {
        data: "con_no"
    }, {
        data: "email"
    }, {
        data: "address"
    }, {
        data: "action"
    }]
}), $("#addCatForm").submit((function (a) {
    a.preventDefault();
    var t = $("#addCatForm").serialize();
    $.ajax({
        type: "POST",
        url: "app/action/add_catagory.php",
        data: t,
        success: function (a) {
            "yes" == $.trim(a) && (alert("Catagory added successfull"), location.reload())
        }
    })
})), $("#catagoryTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/catagory_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "name"
    }, {
        data: "description"
    }, {
        data: "action"
    }]
}), $("#ex_catagoryTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/ex_catagory_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "name"
    }, {
        data: "description"
    }, {
        data: "action"
    }]
}), $("#addProduct").submit((function (a) {
    a.preventDefault();
    var t = $("#product_name").val(),
        e = $("#brand").val(),
        d = $("#p_catagory").val();
    if ("" != t && "" != e && null != d) {
        var r = $("#addProduct").serialize();
        $.ajax({
            type: "POST",
            url: "app/action/add_product.php",
            data: r,
            success: function (a) {
                "yes" == $.trim(a) ? ($(".addProductError-area").show(), $("#addProductError").html("Product added successfull"), $("#addProduct")[0].reset()) : ($(".addProductError-area").show(), $("#addProductError").html(a))
            }
        })
    } else $(".addProductError-area").show(), $("#addProductError").html("please filled out all required filled")
})), $("#productTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/product_data.php"
    },
    columns: [{
        data: "product_id"
    }, {
        data: "product_name"
    }, {
        data: "brand_name"
    }, {
        data: "catagory_name"
    }, {
        data: "product_gst"
    }, {
        data: "hnscode"
    }, {
        data: "quantity"
    }, {
        data: "buy_price"
    }, {
        data: "sell_price"
    }, {
        data: "action"
    }]
}), $("#otherProductTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/factoryProduct_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "product_id"
    }, {
        data: "product_name"
    }, {
        data: "brand_name"
    }, {
        data: "catagory_name"
    }, {
        data: "quantity"
    }, {
        data: "product_expense"
    }, {
        data: "sell_price"
    }, {
        data: "action"
    }]
}), $("#purchaseTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/purchase_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "product_name"
    }, {
        data: "purchase_date"
    }, {
        data: "purchase_quantity"
    }, {
        data: "purchase_price"
    }, {
        data: "purchase_sell_price"
    },
    // {
    //     data: "purchase_net_total"
    // }, {
    //     data: "purchase_due_bill"
    // }, 
    {
        data: "return_status"
    }, {
        data: "action"
    }]
}), $("#purchasereturnTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/purchase_return_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "sell_id"
    }, {
        data: "suppliar_name"
    }, {
        data: "return_date"
    }, {
        data: "product_name"
    }, {
        data: "return_quantity"
    }, {
        data: "subtotal"
    }, {
        data: "discount"
    }, {
        data: "netTotal"
    }]
}), $("#sellTable").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/sell_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "customer_name"
    }, {
        data: "order_date"
    }, {
        data: "sub_total"
    }, {
        data: "total_gst"
    }, {
        data: "bill_amount"
    },{
        data: "return_status"
    }, {
        data: "payment_type"
    }, {
        data: "action"
    }]
}), $("#sell_returnList").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/sell_return_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "customer_name"
    }, {
        data: "invoice_id"
    }, {
        data: "return_date"
    }, {
        data: "amount"
    }]
}), $("#expenseList").DataTable({
    processing: !0,
    serverSide: !0,
    serverMethod: "post",
    ajax: {
        url: "app/ajax/expense_data.php"
    },
    columns: [{
        data: "id"
    }, {
        data: "ex_date"
    }, {
        data: "expense_for"
    }, {
        data: "amount"
    }, {
        data: "expense_cat"
    }, {
        data: "ex_description"
    }, {
        data: "action"
    }]
}), $(document).ready((function () {
    function a() {
        $.ajax({
            url: "app/ajax/addNewRow.php",
            method: "POST",
            data: {
                getOrderItem: 1
            },
            success: function (a) {
                $("#invoiceItem").append(a), $(".select2").select2();
                var t = 0;
                $(".si_number").each((function () {
                    $(this).html(++t)
                }))
            }
        })
    }

    function t() {
        let subtotal = 0;
        let totalGst = 0;

        // Sum all .tprice values
        $(".tprice").each(function () {
            subtotal += parseFloat($(this).val()) || 0;
        });

        // Sum all .gstprice values
        $(".gstprice").each(function () {
            totalGst += parseFloat($(this).val()) || 0;
        });

        // Final bill amount = subtotal + totalgst
        let billAmount = subtotal + totalGst;

        // Set values in respective fields
        $("#subtotal").val(subtotal.toFixed(2));
        $("#totalgst").val(totalGst.toFixed(2));
        $("#billamount").val(billAmount.toFixed(2));
    }


    a(), $("#addNewRowBtn").on("click", (function (t) {
        t.preventDefault(), a()
    })), $(document).on("click", ".cancelThisItem", (function (a) {
        a.preventDefault(), $(this).parent().parent().remove(), t(0)
    })), $(document).on("change", ".pid", "#customer_name", (function (a) {
        a.preventDefault();
        var e = $(this).val(),
            d = $(this).parent().parent();
        var t = $("#customer_name").val();
        $.ajax({
            url: "app/ajax/single_sell_item.php",
            method: "POST",
            dataType: "json",
            data: {
                getSellSingleInfo: 1,
                id: e,
                custid: t
            },
            success: function (a) {
                // Set all values from the response
                d.find(".qaty").val(a.quantity);
                d.find(".oldPrice").val(a.oldPrice);
                d.find(".hnscode").val(a.hnscode);
                d.find(".gst").val(a.product_gst);
                d.find(".discount").val(a.discount);
                d.find(".oqty").val(1);
                d.find(".price").val(a.sell_price);
                d.find(".pro_name").val(a.product_name);

                // Calculate base total price
                let qty = parseFloat(d.find(".oqty").val()) || 0;
                let price = parseFloat(d.find(".price").val()) || 0;
                let discount = parseFloat(d.find(".discount").val()) || 0;
                let gst = parseFloat(d.find(".gst").val()) || 0;
                let total = qty * price; // 200
                let dis = (total * discount) / 100;
                let totalPrice = total - dis; // 200 - 20 = 180
                d.find(".tprice").val(totalPrice);

                // Calculate GST amount
                let gstAmount = (totalPrice * gst) / 100;
                d.find(".gstprice").val(gstAmount.toFixed(2));

                // Call another function, probably for UI refresh or total calculation
                t(0);
            }
        })
    })),

        $(document).on("keyup", ".oqty", function () {
            var e = $(this);
            var d = e.closest("tr"); // Assuming this is in a table row

            var oqty = parseFloat(e.val()) || 0;
            var availableQty = parseFloat(d.find(".qaty").val()) || 0;
            var price = parseFloat(d.find(".price").val()) || 0;
            var discount = parseFloat(d.find(".discount").val()) || 0;
            var gst = parseFloat(d.find(".gst").val()) || 0;

            if (oqty > availableQty) {
                alert("Please enter a valid quantity");
                e.val(""); // Optional: clear the invalid value
                d.find(".tprice").val("");
                d.find(".gstprice").val("");
            } else {
                let total = oqty * price; // 200
                let dis = (total * discount) / 100;
                let totalPrice = total - dis; // 200 - 20 = 180
                d.find(".tprice").val(totalPrice.toFixed(2));
                var gstAmount = (totalPrice * gst) / 100;
                d.find(".gstprice").val(gstAmount.toFixed(2));
                t(0); // Update totals or UI
            }
        }),
        $(document).on("keyup", ".discount", function () {
            var e = $(this);
            var d = e.closest("tr"); // Assuming this is in a table row

            var discount = parseFloat(e.val()) || 0;
            var availableQty = parseFloat(d.find(".qaty").val()) || 0;
            var price = parseFloat(d.find(".price").val()) || 0;
            var oqty = parseFloat(d.find(".oqty").val()) || 0;
            var gst = parseFloat(d.find(".gst").val()) || 0;

            if (oqty > availableQty) {
                alert("Please enter a valid quantity");
                e.val(""); // Optional: clear the invalid value
                d.find(".tprice").val("");
                d.find(".gstprice").val("");
            } else {
                let total = oqty * price; // 200
                let dis = (total * discount) / 100;
                let totalPrice = total - dis; // 200 - 20 = 180
                d.find(".tprice").val(totalPrice.toFixed(2));
                var gstAmount = (totalPrice * gst) / 100;
                d.find(".gstprice").val(gstAmount.toFixed(2));
                t(0); // Update totals or UI
            }
        }),


        $(document).on("change", "#customer_name", (function (a) {
            a.preventDefault();
            var t = $("#customer_name").val();
            $.ajax({
                url: "app/ajax/find_customer_due.php",
                method: "POST",
                dataType: "json",
                data: {
                    getcusTotalDue: 1,
                    id: t
                },
                success: function (a) {
                    $("#prev_due").val(a.total_due)
                }
            })
        })), $("#discount").on("keyup", (function (a) {
            a.preventDefault(), t($(this).val())
        })),

        $(document).on("keyup", ".price", function (a) {
            a.preventDefault();

            var row = $(this).closest("tr"); // Use .closest("tr") for cleaner structure
            var qty = parseFloat(row.find(".oqty").val()) || 0;
            var price = parseFloat($(this).val()) || 0;
            var discount = parseFloat(row.find(".discount").val()) || 0;
            var gst = parseFloat(row.find(".gst").val()) || 0;
            let total = qty * price; // 200
            let dis = (total * discount) / 100;
            let totalPrice = total - dis; // 200 - 20 = 180
            // Calculate total price after discount

            row.find(".tprice").val(totalPrice.toFixed(2));
            // Calculate GST on total price
            var gstAmount = (totalPrice * gst) / 100;
            row.find(".gstprice").val(gstAmount.toFixed(2));

            // Update totals or UI
            t(0);
        });


    $(document).on("keyup", "#s_discount_amount", (function (a) {
        a.preventDefault();
        var t = $("#s_discount_amount").val(),
            e = $("#subtotal").val() - t;
        $("#netTotal").val(e)
    })),
        $("#paidBill").on("keyup", (function (a) {
            a.preventDefault();
            var t = $(this).val(),
                e = $("#netTotal").val() - t;
            $("#dueBill").val(e)
        })),

        $("#sellBtn").on("click", function (e) {
            e.preventDefault();

            // Get serialized form data
            var formData = $("#sellForm").serialize();

            // Validate customer and payment method
            var customer = $("#customer_name").val().trim();
            var paymentMethod = $("#payMethode").val().trim();

            if (customer && paymentMethod) {
                 $("#sellBtn").prop("disabled", true).text("Processing...");
                $.ajax({
                    url: "app/action/sell.php",
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        if (!isNaN(response)) {
                            //window.location.href = "index.php?page=view_sell&&view_id=" + response;
                            window.open("index.php?page=view_sell&&view_id=" + response, "_blank");
                            location.reload();
                        } else {
                            alert("Failed to make sell. Please try again.");
                            $("#sellBtn").prop("disabled", false).text("Sell");
                        }
                    },
                    error: function () {
                        alert("Something went wrong with the request.");
                        $("#sellBtn").prop("disabled", false).text("Sell");
                    }
                });
            } else {
                alert("You missed some required fields.");
                $("#sellBtn").prop("disabled", false).text("Sell");
            }
        });

})),// Highlight if product already added
    $(document).on('change', '.pid', function () {
        var selectedProductId = $(this).val();
        var currentSelect = $(this);
        var isDuplicate = false;

        $('.pid').each(function () {
            if ($(this).val() === selectedProductId && this !== currentSelect[0]) {
                isDuplicate = true;

                // Scroll to the existing row
                $('html, body').animate({
                    scrollTop: $(this).closest('tr').offset().top - 100
                }, 500);

                // Highlight existing row
                $(this).closest('tr').addClass('duplicate-row');
                setTimeout(() => {
                    $(this).closest('tr').removeClass('duplicate-row');
                }, 2000);

                // Reset current select
                currentSelect.val(null).trigger('change');

                return false;
            }
        });
    }); $(document).on("click", "#editSellBtn", (function (a) {
        a.preventDefault();
        var t = confirm("Are You sure want to edit this sell"),
            e = $("#payMethode").val();
        t ? null != e ? $.ajax({
            url: "app/action/edit_sell.php",
            method: "POST",
            data: $("#editSellForm").serialize(),
            success: function (a) {
                var t = a;
                1 != isNaN(t) ? window.location.href = "index.php?page=view_sell&&view_id=" + t : alert(a)
            }
        }) : alert("please select a payment methode") : alert("Your data are save")
    })), $("#customer_blance_report_data").DataTable({
        processing: !0,
        serverSide: !0,
        serverMethod: "post",
        ajax: {
            url: "app/ajax/customer_blance_report_data.php"
        },
        columns: [{
            data: "member_id"
        }, {
            data: "member_name"
        }, {
            data: "company"
        }, {
            data: "phone_number"
        }, {
            data: "cus_total_transaction"
        }, {
            data: "cus_paid_total"
        }, {
            data: "cus_due_toal"
        }]
    }), $("#suppliar_blance_report_data").DataTable({
        processing: !0,
        serverSide: !0,
        serverMethod: "post",
        ajax: {
            url: "app/ajax/suppliar_blance_report_data.php"
        },
        columns: [{
            data: "supplier_id"
        }, {
            data: "supplier_name"
        }, {
            data: "company"
        }, {
            data: "phone_number"
        }, {
            data: "net_total"
        }, {
            data: "paid_bill"
        }, {
            data: "due_bill"
        }]
    }), $(document).on("keyup", ".returnQty", (function (a) {
        var t = $(this),
            e = $(this).parent().parent();
        t.val() - 0 > e.find(".orderQty").val() - 0 && alert("Return quantity must not getter than order quantity")
    })), $("#returnSellBtn").on("click", (function (a) {
        a.preventDefault();
        $(".orderQty").val(), $(".returnQty").val();
        confirm("Are You sure want to edit this sell") ? $.ajax({
            url: "app/action/sell_return.php",
            method: "POST",
            data: $("#returnSell").serialize(),
            success: function (a) {
                "yes" == $.trim(a) ? alert("Product return successfull") : alet(a)
            }
        }) : alert("Your data are save")
    })), $("#EditaddNewRowBtn").on("click", (function (a) {
        a.preventDefault(), editAddNewRow()
    })); 