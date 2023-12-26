$(document).ready(function () {
    $('.js_menu_wrap').click(function (e) {
        e.preventDefault();
        $('.menu-wrap').toggleClass('hidden');
    })
    $('.js_menu_footer').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $(this).parent().find('ul').toggleClass('hidden');
    })
    $('.js_menu_top').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $(this).parent().find('.js_megamenu').toggleClass('hidden');
    })
    $('.js_menu_child').click(function (e) {
        var id = $(this).attr('data-id');
        e.preventDefault();
        $('.js_menu_child').removeClass('active');
        $(this).toggleClass('active');
        $('.js_group_child').addClass('hidden');
        $('.js_group_child_' + id).removeClass('hidden');
    })
    $(document).on('click', '.js_view_category', function (e) {
        e.preventDefault();
        var type = $(this).attr('data-type');
        $('.view_category a').removeClass('active');
        $(this).addClass('active')
        if (type == 'row') {
            $('.grid_category_product').removeClass('lg:grid-cols-2').addClass('lg:grid-cols-1');
        } else {
            $('.grid_category_product').removeClass('lg:grid-cols-1').addClass('lg:grid-cols-2');
        }
    })
    $(document).on('click', '.js_tab_accordion', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $(this).find('.tab-accordion-title').toggleClass('plus')
        $('.tab-content-' + id).toggleClass('hidden');
    })
    $('.js-tp-search,.js-btnCloseSearch').click(function () {
        $('.js-header-search').toggleClass('hidden')
    });
    $('.tp-cart').click(function () {
        $('.offcanvas-overlay').toggleClass('hidden');
        $('#offcanvas-cart').toggleClass('hidden');
    });
    $(".offcanvas-close, .offcanvas-overlay").on("click", function (e) {
        e.preventDefault();
        $('.offcanvas-overlay').addClass('hidden');
        $('#offcanvas-cart').addClass('hidden ');
    });

})

function changeActiveTab(event, tabID) {
    $('.tab-content .tab').addClass('hidden');
    $('#' + tabID).removeClass('hidden');
    $('.changeActiveTab').removeClass('active');
    $('.' + tabID).addClass('active');
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

$(function () {
    /*show hide loading customers */
    $(function () {
        $('#submit-auth-loading').hide();
        $("#form-auth").submit(function (event) {
            $('#submit-auth').hide();
            $('#submit-auth-loading').show();
        });
    })

    /*START: tăng giảm số lượng */
    $(document).on('click', '.card-inc', function (e) {
        e.preventDefault();
        var quantity = parseInt($(this).parent().find('.card-quantity').val());
        var max_quantity = parseInt($(this).parent().find('.card-quantity').attr('max'));
        if (quantity >= max_quantity) {
            quantity = max_quantity;
        } else {
            quantity += 1;
        }
        $(this).parent().find('.card-quantity').val(quantity);
        $(this).parent().parent().parent().parent().find('.addtocart').attr('data-quantity', quantity);
    });
    $(document).on('click', '.card-dec', function (e) {
        e.preventDefault();
        var quantity = parseInt($(this).parent().find('.card-quantity').val());
        if (quantity <= 1) {
            quantity = 1;
        } else {
            quantity -= 1;
        }
        $(this).parent().find('.card-quantity').val(quantity);
        $(this).parent().parent().parent().parent().find('.addtocart').attr('data-quantity', quantity);
    });
    $(document).on('change keyup', '.card-quantity', function () {
        var quantity = $(this).val();
        $(this).parent().parent().parent().parent().find('.addtocart').attr('data-quantity', quantity);
    });
    /* change input số lượng => view giỏ hàng*/
    $(document).on('keyup change', '.product-details .card-quantity', function () {
        var quantity = parseInt($(this).val());
        var max_quantity = parseInt($(this).attr('max'));
        if (quantity >= max_quantity) {
            $(this).val(max_quantity)
            $(this).parent().parent().parent().find('.addtocart').attr('data-quantity', max_quantity);

        } else {
            $(this).val(quantity)
            $(this).parent().parent().parent().find('.addtocart').attr('data-quantity', quantity);
        }
    });
    /*END: tăng giảm số lượng */
    /*START: chọn thuộc tính version*/
    $(document).on('click', '.swatch-option', function () {
        let _this = $(this).parent();
        let __this = $(this).parent().parent().parent();
        //xóa selected có trong thẻ li của ul chứa li click
        _this.find('.swatch-option').removeClass('selected')
        //tìm đến li click thêm class selected
        _this.find(this).addClass('selected');
        //remove class selected ở ul cha
        _this.parent().find('ul').removeClass('selected');
        _this.addClass('done');
        let count_version = __this.find('.addtocart').attr('data-count-version');
        let check = __this.find('.swatch-option.selected').length;
        let attr = '';
        __this.find('.swatch-option.selected').each(function (key, index) {
            let id = $(this).attr('data-id');
            attr = attr + ';' + id;
        });
        if (count_version == check) {
            let URL = BASE_URL_AJAX + "ajax/product/get-version-product";
            $.post(URL, {
                    attr: attr,
                    id: __this.find('.addtocart').attr('data-id'),
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                function (data) {
                    //kiểm tra hết hàng
                    if (data.getVersionproduct.status_version == 1) {
                        __this.find('.addtocart').addClass('disabled');
                    } else {
                        __this.find('.card-price').html(numberWithCommas(data.getVersionproduct.price_version) + '₫');
                        //thực hiện add attr giỏ hàng
                        __this.find('.addtocart').attr('data-price', data.getVersionproduct.price_version);
                        __this.find('.addtocart').attr('data-title-version', data.getVersionproduct.title_version);
                        __this.find('.addtocart').attr('data-id-version', data.getVersionproduct.id_sort);
                    }
                });
            return false;
        }
    });
    /*END: chọn thuộc tính version */
    /*START: submit thêm vào giỏ hàng*/
    /*
    $(document).on('click', '.addtocart', function() {
        let _this = $(this).parent().parent().parent();
        let id = $(this).attr('data-id');
        let count_version = $(this).attr('data-count-version');
        let count_version_check = _this.find('ul li.selected').length;
        _this.find('.list-version').removeClass('selected');
        if (count_version_check == count_version) {
            let URL = BASE_URL_AJAX + "ajax/cart/add-to-cart";
            $.ajax({
                type: 'POST',
                url: URL,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    id_version: $(this).attr('data-id-version'),
                    quantity: $(this).attr('data-quantity'),
                },
                success: function(data) {
                    let json = JSON.parse(data);
                    if (json.error == '') {
                        loadDataCart(json);
                        _this.find('ul').removeClass('done');
                        _this.find('ul li.selected').removeClass('selected');
                        toastr.success(json.message, 'Thông báo!')
                    } else {
                        toastr.error(json.error, 'Error!')
                    }

                }
            });
        } else {
            _this.find('.list-version').not('.done').addClass('selected');
        }
    });
    */

    $(document).on('click', '.addtocart:not(.disabled)', function () {
        let _this = $(this);
        let id = $(this).attr('data-id');
        let URL = BASE_URL_AJAX + "ajax/cart/add-to-cart";
        let cart = $(this).attr('data-cart');
        let image = $(this).attr('data-src');
        $.ajax({
            type: 'POST',
            url: URL,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                image: image,
                title_version: $(this).attr('data-title-version'),
                id_version: $(this).attr('data-id-version'),
                quantity: $(this).attr('data-quantity'),
                price: $(this).attr('data-price'),
                type: $(this).attr('data-type'),
            },
            success: function (data) {
                let json = JSON.parse(data);
                if (json.error == '') {
                    if (cart == 1) {
                        window.location.href = BASE_URL_AJAX + "gio-hang/thanh-toan";
                    } else {
                        if (json.total_items > 0) {
                            $('#cart-none-header').hide();
                            $('#cart-show-header').show();
                            $('#header-cart-action').show();
                        }
                        if( !_this.hasClass('single-product') ){
                            flyingCart(_this);
                            var productItem = _this.parents('.product-item');
                            if( productItem ){
                                _this.remove();
                                productItem.append(json.html_action_add_cart)
                            }
                        }
                        loadDataCart(json);
                        toastr.success(json.message, 'Thông báo!');
                    }
                } else {
                    toastr.error(json.error, 'Error!')
                }
            },
            error: function (jqXhr, json, errorThrown) {
                toastr.error("Thêm sản phẩm vào giỏ hàng không thành công", 'Error!')
            },
        });
    });

    function addToCart( _this, buttonAddToCart, qty ) {
        let id = buttonAddToCart.attr('data-id');
        let URL = BASE_URL_AJAX + "ajax/cart/add-to-cart";
        let cart = buttonAddToCart.attr('data-cart');
        let image = buttonAddToCart.attr('data-src');
        console.log(id);
        $.ajax({
            type: 'POST',
            url: URL,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                image: image,
                title_version: buttonAddToCart.attr('data-title-version'),
                id_version: buttonAddToCart.attr('data-id-version'),
                quantity: buttonAddToCart.attr('data-quantity'),
                price: buttonAddToCart.attr('data-price'),
                type: buttonAddToCart.attr('data-type'),
            },
            success: function (data) {
                let json = JSON.parse(data);
                if (json.error == '') {
                    if (cart == 1) {
                        window.location.href = BASE_URL_AJAX + "gio-hang/thanh-toan";
                    } else {
                        if (json.total_items > 0) {
                            $('#cart-none-header').hide();
                            $('#cart-show-header').show();
                            $('#header-cart-action').show();
                        }
                        loadDataCart(json);
                        if( _this.hasClass('plus') ) {
                            toastr.success(json.message, 'Thông báo!')
                        }
                    }
                    if( _this.hasClass('plus') ) {
                        flyingCart(_this);
                    }
                    _this.parents('.action-product').find('.data').attr('data-quantity', qty).text(qty);
                } else {
                    toastr.error(json.error, 'Error!')
                }
            },
            error: function (jqXhr, json, errorThrown) {
                toastr.error("Thêm sản phẩm vào giỏ hàng không thành công", 'Error!')
            },
        });
    }

    $(document).on('click', '.action-product .plus', function (e) {
        e.preventDefault();
        var _this = $(this);
        var type = 'update';
        var rowid = _this.parents('.action-product').attr('data-rowid');
        var quantity = parseInt(_this.parents('.action-product').find('.data').attr('data-quantity'));
        var max_quantity = parseInt(_this.parent().find('.card-quantity').attr('max'));
        if (quantity >= max_quantity) {
            quantity = max_quantity;
        } else {
            quantity += 1;
        }
        //addToCart( _this, _this.parents('.action-product'), quantity );
        ajax_cart_update(rowid, quantity, type, _this.parents('.action-product'));
    });

    $(document).on('click', '.action-product .minus', function (e) {
        e.preventDefault();
        var _this = $(this);
        var type = 'update';
        var rowid = _this.parents('.action-product').attr('data-rowid');
        var quantity = parseInt($(this).parents('.action-product').find('.data').attr('data-quantity'));
        var checkQty = quantity - 1;
        if( checkQty == 0 ){
            type = 'delete';
        }
        if (quantity <= 1) {
            quantity = 1;
        } else {
            quantity -= 1;
        }
        ajax_cart_update(rowid, quantity, type, _this.parents('.action-product'));
    });

    function flyingCart(elementSelected) {
        let cart = '';
        if ($(window).width() < 991) {
            cart = $('.mobile-menu .mobileCart');
        }
        else {
            cart = $('.shopping-cart');
        }
        let imgtodrag = elementSelected.parents('.product-item').find(".flying-image").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone().offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            }).css({
                'opacity': '',
                'position': 'absolute',
                'height': '80px',
                'width': '80px',
                'z-index': '100',
                'border-radius': '100%',
                'box-shadow': 'rgba(0, 0, 0, 0.15) 0px 5px 15px 0px',
            }).appendTo($('body')).animate({
                'top': cart.offset().top + 20,
                'left': cart.offset().left + 30,
                'width': 50,
                'height': 50,
                'opacity': '0.7'
            }, 1000, 'easeInOutExpo');
            imgclone.animate({
                'width': 0,
                'height': 0,
                'opacity': '0.5'
            }, function () {
                $(this).detach()
            });
        }
    }

    /*END: submit thêm vào giỏ hàng*/
    /*xóa giỏ hàng*/
    $(document).on('click', '.cart-remove', function (e) {
        e.preventDefault();
        let rowid = $(this).attr('data-rowid');
        ajax_cart_update(rowid, 0, 'delete');
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.load-more-product', function (e) {

        e.preventDefault();
        let _this = $(this);
        let id = _this.attr('data-id');
        let count = _this.attr('data-count');
        let limit = _this.attr('data-limit');

        $.ajax({
            type: 'POST',
            url: BASE_URL_AJAX + "load-more-product",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                count: count,
                limit: limit,
            },
            success: function (data) {
                let json = JSON.parse(data);
                if( json.html != '' ){
                    _this.attr('data-count', json.count);
                    _this.parents('.content-product').find('.render-data').append(json.html);
                }
                if( json.check == false )
                    _this.remove();
            }
        });

    });

    /*tăng giỏ hàng item => view giỏ hàng*/
    $(document).on('click', '.cart-plus', function () {
        let _this = $(this).parent().find('.card-quantity');
        var quantity = parseInt(_this.val());
        var max_quantity = parseInt(_this.attr('max'));
        if (quantity >= max_quantity) {
            toastr.error('Hết hàng', 'Error!');
            quantity = max_quantity;
            return false;
        } else {
            quantity += 1;
        }
        _this.val(quantity);
        // $(this).parent().parent().find('.addtocart').attr('data-quantity', quantity);
        let rowid = $(this).attr('data-rowid');
        ajax_cart_update(rowid, quantity, 'update');
    });

    /*giảm giỏ hàng item => view giỏ hàng*/
    $(document).on('click', '.cart-minus', function () {
        let _this = $(this).parent().find('.card-quantity');
        var quantity = parseInt(_this.val());
        if (quantity <= 1) {
            quantity = 1;
        } else {
            quantity -= 1;
        }
        _this.val(quantity);
        // $(this).parent().parent().find('.addtocart').attr('data-quantity', quantity);
        let rowid = $(this).attr('data-rowid');
        ajax_cart_update(rowid, quantity, 'update');

    });
    /* change input số lượng => view giỏ hàng*/
    $(document).on('change', '.cart_item .card-quantity', function () {
        var quantity = parseInt($(this).parent().find('.card-quantity').val());
        var max_quantity = parseInt($(this).parent().find('.card-quantity').attr('max'));
        if (quantity >= max_quantity) {
            $(this).parent().find('.card-quantity').val(max_quantity)
        } else {
            $(this).parent().find('.card-quantity').val()
        }
        let rowid = $(this).parent().parent().parent().attr('data-rowid');
        setTimeout(ajax_cart_update(rowid, quantity, 'update'), 800);
    });

    /*update cart*/
    function ajax_cart_update(rowid, quantity, type, elementUpdate) {
        $.ajax({
            type: 'POST',
            url: BASE_URL_AJAX + "ajax/cart/update-cart",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                rowid: rowid,
                quantity: quantity,
                type: type
            },
            success: function (data) {
                let json = JSON.parse(data);
                if (json.error == '') {
                    toastr.success(json.message, 'Thông báo!')
                    $('#main-cart').html(json.html);
                    loadDataCart(json);
                    if (json.total > 0 && json.total_items > 0) {
                        //thực hiện add coupon nếu có
                        $('.cart-discount').html(json.coupon_html);
                    }
                    if (json.total_items > 0) {
                        $('#cart-html-header').css('display', 'block');
                        $('#cart-html-header').hide();

                        // $('#header-cart-action').css('display', 'block');
                    } else {
                        $('#cart-html-header').css('display', 'none');
                        $('#cart-html-header').show();

                        // $('#header-cart-action').hide();
                    }
                    var productItem = elementUpdate.parents('.product-item').find('.data');
                    if( productItem ){
                        productItem.attr('data-quantity', json.total_rowid).html(json.total_rowid);
                        if( json.htmlActionAddCart && json.htmlActionAddCart != '' ){
                            elementUpdate.parents('.product-item').find('.nav-img').append(json.htmlActionAddCart);
                            elementUpdate.parents('.product-item').find('.action-product').remove();
                        }
                    }
                    if( type == 'update' ){
                        flyingCart(elementUpdate);
                    }
                } else {
                    toastr.error(json.error, 'Error!')
                }
            }
        });
    }

    function loadDataCart(json) {
        $('.cart-html-header').html(json.html_header);
        $('.cart-html-cart').html(json.html);
        $('.cart-quantity').html(json.total_items);
        $('.cart-coupon-price').html(numberWithCommas(json.coupon_price) + '₫');
        $('.cart-total').html(numberWithCommas(json.total) + '₫');
        $('.cart-total-final').html(numberWithCommas(json.total_coupon) + '₫');

        if( json.total_items == 0 ){
            $('.cart-html-header').html('<div class="text-center py-4">Giỏ hàng chưa có sản phẩm</div>');
        }
    }

    function checkShippingLocation(  ) {

    }



    /*START:mã giảm giá */
    $(document).on('click', '#apply_coupon', function (e) {
        e.preventDefault();
        let name = $('#coupon_code').val();
        $.ajax({
            type: 'POST',
            url: BASE_URL_AJAX + 'ajax/cart/add-coupon',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                name: name,
                fee_ship: $('input[name="fee_ship"]').val()
            },
            success: function (data) {
                $('.lds-show-1').addClass('hidden');
                let json = JSON.parse(data);
                $('.message-container').show();
                if (json.error == '') {
                    $('.message-danger').hide();
                    //coupon show html
                    $('.cart-coupon-html').html(json.html);
                    //cập nhập lại tổng tiền
                    $('.cart-total-final').html(json.total);
                    toastr.success(json.message, 'Thông báo!')
                } else {
                    $('.message-success').hide();
                    $('.message-danger').show();
                    $('.danger-title').html('').html(json.error);
                }
            }
        });
    });
    /*END:mã giảm giá */
    /** START: xóa mã giảm giá */
    $(document).on('click', '.remove-coupon', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: BASE_URL_AJAX + 'ajax/cart/delete-coupon',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: $(this).attr('data-id'),
                fee_ship: $('input[name="fee_ship"]').val()
            },
            success: function (data) {
                $('.lds-show-1').addClass('hidden');
                let json = JSON.parse(data);
                if (json.error == '') {
                    //coupon show html
                    $('.cart-coupon-html').html(json.html);
                    //cập nhập lại tổng tiền
                    $('.cart-total-final').html(json.total);
                    toastr.success(json.message, 'Thông báo!')
                } else {
                    toastr.error(json.error, 'Error!')
                }
            }
        });
    });
    /** END: xóa mã giảm giá */


    /*upload image comment*/
    $(document).on('click', '.write-review__button--image', function (e) {
        $(".write-review__file").click();
    });
    var inputFile = $('input.write-review__file');
    var uploadURI = BASE_URL_AJAX + 'comment/upload-images-comment';
    var processBar = $('#progress-bar');
    $('input.write-review__file').change(function (event) {
        var filesToUpload = inputFile[0].files;
        if (filesToUpload.length > 0) {
            var formData = new FormData();
            for (var i = 0; i < filesToUpload.length; i++) {
                var file = filesToUpload[i];
                formData.append('file[]', file, file.name);
            }
            // console.log(formData);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: uploadURI,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('.error_comment').removeClass('alert alert-danger');
                    $('.write-review__images').show();
                    var json = JSON.parse(data);
                    $('.write-review__images').append(json.html);
                    load_src_img();
                },
                error: function (jqXhr, json, errorThrown) {
                    // this are default for ajax errors
                    var errors = jqXhr.responseJSON;
                    $('.error_comment').removeClass('alert alert-success').addClass(
                        'alert alert-danger');
                    $('.error_comment').html('').html(errors.message);
                },
            });
        }
    });

    function load_src_img() {
        var outputText = '';
        $('.write-review__images img').each(function () {
            var divHtml = $(this).attr('src');
            outputText += divHtml + '-+-';
        });
        $('#form-comment input[name="images"]').attr('value', outputText.slice(0, -3));
    }

    $(document).on('click', '.js_delete_image_cmt', function () {
        var me = $(this);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            url: uploadURI,
            type: 'post',
            data: {
                file: me.attr('data-file'),
                delete: 'delete'
            },
            success: function () {
                $('.error_comment').removeClass('alert alert-danger').removeClass(
                    'alert alert-danger');
                me.parent().remove();
                load_src_img();
            },
            error: function (jqXhr, json, errorThrown) {
                // this are default for ajax errors
                var errors = jqXhr.responseJSON;
                var errorsHtml = "";
                $.each(errors["errors"], function (index, value) {
                    errorsHtml += value + "/ ";
                });
                $('.error_comment').removeClass('alert alert-success').addClass(
                    'alert alert-danger');
                $(".error_comment").html(errorsHtml).show();
            },
        });
    });
    /*end: upload images*/
    /*START: submit comment*/
    $('#form-comment').submit(function (event) {
        event.preventDefault();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            url: BASE_URL_AJAX + "comment/products/post-comment",
            type: 'POST',
            dataType: "JSON",
            data: {
                rating: $('#form-comment input[name="rating"]').val(),
                images: $('#form-comment input[name="images"]').val(),
                fullname: $('#form-comment input[name="fullname"]').val(),
                phone: $('#form-comment input[name="phone"]').val(),
                message: $('#form-comment textarea[name="message"]').val(),
                module_id: $('#form-comment input[name="module_id"]').val(),
            },
            success: function (data) {
                if (data == 200) {
                    $('.error_comment .alert-danger').hide();
                    $('.error_comment .alert-success').show();
                    $('.error_comment .js_text_success').html("Gửi bình luận thành công!");
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else {
                    $('.error_comment .alert-danger').show();
                    $('.error_comment .alert-success').hide();
                    $('.error_comment .js_text_danger').html("Có lỗi xảy ra");
                }
            },
            error: function (jqXhr, json, errorThrown) {
                // this are default for ajax errors
                var errors = jqXhr.responseJSON;
                $('.error_comment .alert-danger').show();
                $('.error_comment .alert-success').hide();
                if (errors.message == "Unauthenticated.") {
                    $('.error_comment .js_text_danger').html(
                        "Bạn phải đăng nhập để sử dụng tính năng này");
                } else {
                    $('.error_comment .js_text_danger').html(errors.message);
                }
            },
        });
    });
    /*END: submit comment*/

    /*START: reply comment*/
    $(document).on('click', '.js_btn_reply', function (e) {
        e.preventDefault();
        let _this = $(this);
        let text = _this.text();
        if (text == "Bỏ bình luận") {
            _this.parent().find('.reply-comment').html('');
            _this.html('Bình luận');
        } else {
            let param = {
                'parentid': _this.attr('data-id'),
                'name': _this.attr('data-name'),
            };
            let reply = get_comment_html(param);
            $('.reply-comment').html('');
            $('.js_btn_reply').html('Bình luận');
            _this.parent().find('.reply-comment').html(reply);
            _this.attr('data-comment', 0);
            _this.html('Bỏ bình luận');
        }

    });

    function get_comment_html(param = '') {
        let comment = '';
        comment += '<div class="flex">';
        comment += '<div class="reply_comment_avatar mt-5 mr-2">';
        comment += '<img src="../../images/90e54b0a7a59948dd910ba50954c702e.png" alt="avatar">';
        comment += '</div>';
        comment += '<div class="reply_comment_wrapper mt-5">';
        comment += '<span class="font-semibold mb-1">@' + param.name + '</span>';
        comment += '<input value="" type="text" name="" placeholder="Họ và tên" class="js_input_reply_cmt mt-2" required=""><span class="reply_fullname"></span>';
        comment += '<div class="relative">';
        comment += '<textarea placeholder="Viết câu trả lời" class="js_textarea_reply_cmt" required></textarea><span class="reply_message"></span>';
        comment += '<button type="button" class="js_reply_comment_submit" data-parent-id="' + param.parentid + '">';
        comment += '<img src="../../images/92f01c5a743f7c8c1c7433a0a7090191.png" alt="icon submit">';
        comment += '</button>';
        comment += '</div>';
        comment += '</div>';
        comment += '</div>';
        comment += '<div class="reply_comment_error">';
        comment += '<div class="alert-success bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-5" style="display: none" role="alert">';
        comment += '<div class="flex items-center">';
        comment += '<div class="py-1">';
        comment += '<svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">';
        comment += '<path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"></path>';
        comment += '</svg>';
        comment += '</div>';
        comment += '<div>';
        comment += '<p class="font-bold js_text_success"></p>';
        comment += '</div>';
        comment += '</div>';
        comment += '</div>';
        comment += '<div class="alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert" style="display: none">';
        comment += '<strong class="font-bold">Lỗi!</strong>';
        comment += '<span class="block sm:inline js_text_danger"></span>';
        comment += '</div>';
        comment += '</div>';
        return comment;
    }

    $(document).on('click', '.js_reply_comment_submit', function () {
        var parent_id = $(this).attr('data-parent-id');
        let fullname = $('.js_input_reply_cmt').val();
        let message = $('.js_textarea_reply_cmt').val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            url: BASE_URL_AJAX + "comment/reply-comment",
            type: 'POST',
            dataType: "JSON",
            data: {
                parent_id: parent_id,
                message: message,
                fullname: fullname,
            },
            success: function (data) {
                $('.reply_comment_error .alert-danger').hide();
                $('.reply_comment_error .alert-success').show();
                $('.reply_comment_error .js_text_success').html("Phản hồi bình luận thành công!");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            },
            error: function (jqXhr, json, errorThrown) {
                // this are default for ajax errors
                var errors = jqXhr.responseJSON;
                $('.reply_comment_error .alert-danger').show();
                $('.reply_comment_error .alert-success').hide();
                if (errors.message == "Unauthenticated.") {
                    $('.reply_comment_error').html('').html(
                        "Bạn phải đăng nhập để sử dụng tính năng này");
                } else {
                    if (fullname == '') {
                        $('.js_input_reply_cmt').css('border-color', 'red')
                    }
                    if (fullname == '') {
                        $('.js_textarea_reply_cmt').css('border-color', 'red')
                    }
                    $('.reply_comment_error .js_text_danger').html(errors.message);
                }

            },
        });
        return false;
    });
    /*END: reply comment */
    $(document).on('click', '.paginate_cmt a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var sort = $('.filter_item.active .filter_text').attr('data-sort');
        get_list_object_cmt(page, sort, true);
    });
    $(document).on('click', '.filter_text', function (event) {
        event.preventDefault();
        var sort = $(this).attr('data-sort');
        $('.filter_item').removeClass('active');
        $(this).parent().addClass('active');
        get_list_object_cmt(1, sort, false);
    });

    function get_list_object_cmt(page = 1, sort = 'id', animate = true) {
        setTimeout(function () {
            $.post(BASE_URL_AJAX + 'comment/get-list-comment', {
                    page: page,
                    module_id: $('#form-comment input[name="module_id"]').val(),
                    sort: sort,
                    "_token": $('meta[name="csrf-token"]').attr("content")
                },
                function (data) {
                    $('#getListComment').html(data);
                    console.log(animate);
                    if (animate === true) {
                        $('html, body').animate({
                            scrollTop: $("#getListComment").offset().top
                        }, 200);
                    }

                }
            );
        }, 210);
    }

    $(document).on('click', '.scrollCmt', function (event) {
        $('html, body').animate({
            scrollTop: $("#section-rating-comment").offset().top
        }, 500);
    });
    $("form.checkout").submit(function (event) {
        $('.lds-show').removeClass('hidden');
        $('.offcanvas-overlay').removeClass('hidden');
    });

    $(document).on('change', '#city', function (e, data) {
        let _this = $(this);
        change_city(_this, '#district');
    });

    $(document).on('change', '#district', function (e, data) {
        let _this = $(this);
        change_district(_this, '#ward');
    });

    $(document).on('change', '#ship_city', function (e, data) {
        let _this = $(this);
        var cityID = _this.val();
        var districtID = $('#ship_district').val();
        change_city(_this, '#ship_district');
        $('.ship-information').html(getShipInfo());
        loadPriceShipment(cityID, districtID);
    });

    $(document).on('change', '#ship_district', function (e, data) {
        let _this = $(this);
        var cityID = $('#ship_city').val();
        var districtID = _this.val();
        change_district(_this, '#ship_ward');
        $('.ship-information').html(getShipInfo());
        loadPriceShipment(cityID, districtID);
    });

    $(document).on('change', '#ship_ward', function (e, data) {
        let _this = $(this);
        $('.ship-information').html(getShipInfo());
    });

    function change_city( _this, obj ) {
        let param = {
            'id': _this.val(),
            'type': 'city',
            'trigger_district': (typeof (data) != 'undefined') ? true : false,
            'text': 'Chọn Quận/Huyện',
            'select': 'districtid'
        }
        getLocation(param, obj);
    }

    function getShipInfo() {
        var ship_city = $('#ship_city').val();
        var ship_district = $('#ship_district').val();
        var ship_ward = $('#ship_ward').val();
        var alert = '';
        if( ship_city == '' ){
            alert = "Vui lòng chọn đầy đủ thông tin <b>Tỉnh thành</b>, <b>Quận huyện</b>, <b>Phường xã</b>."
        }
        if( ship_district == '' ){
            alert = "Vui lòng chọn đầy đủ thông tin <b>Tỉnh thành</b>, <b>Quận huyện</b>, <b>Phường xã</b>."
        }
        if( ship_ward == '' ){
            alert = "Vui lòng chọn đầy đủ thông tin <b>Tỉnh thành</b>, <b>Quận huyện</b>, <b>Phường xã</b>."
        }
        var param = {
            'ship_city': ship_city,
            'ship_district': ship_district,
            'ship_ward': ship_ward,
        }
        if( alert == '' ){
            let formURL = BASE_URL_AJAX + 'gio-hang/get-ship-infor';
            $.post(formURL, {
                    param: param,
                    "_token": $('meta[name="csrf-token"]').attr("content")
                },
                function (data) {
                    $('.ship-information').html(data.alert);

                });
        } else
            return alert;
    }

    function change_district( _this, obj ) {
        var id = _this.val();
        if (id == null) {
            id = districtid;
        }
        let param = {
            'id': id,
            'type': 'district',
            'trigger_ward': (typeof (data) != 'undefined') ? true : false,
            'text': 'Chọn Phường/Xã',
            'select': 'wardid'
        }
        getLocation(param, obj);
    }

    /* if (typeof (cityid) != 'undefined' && cityid != '') {
        $('#city').val(cityid).trigger('change', [{
            'trigger': true
        }]);

    }
    if (typeof (districtid) != 'undefined' && districtid != '') {
        $('#district').val(districtid).trigger('change', [{
            'trigger': true
        }]);
    } */


    function create_custom_dropdowns() {
        $('.select-filter').each(function (i, select) {
            if (!$(this).next().hasClass('dropdown-select')) {
                $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                var dropdown = $(this).next();
                var options = $(select).find('option');
                var selected = $(this).find('option:selected');
                dropdown.find('.current').html(selected.data('display-text') || selected.text());
                options.each(function (j, o) {
                    var display = $(o).data('display-text') || '';
                    dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                });
            }
        });

        $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
    }

// Event listeners

// Open/close
    $(document).on('click', '.dropdown-select', function (event) {
        if($(event.target).hasClass('dd-searchbox')){
            return;
        }
        $('.dropdown-select').not($(this)).removeClass('open');
        $(this).toggleClass('open');
        if ($(this).hasClass('open')) {
            $(this).find('.option').attr('tabindex', 0);
            $(this).find('.selected').focus();
        } else {
            $(this).find('.option').removeAttr('tabindex');
            $(this).focus();
        }
    });

// Close when clicking outside
    $(document).on('click', function (event) {
        if ($(event.target).closest('.dropdown-select').length === 0) {
            $('.dropdown-select').removeClass('open');
            $('.dropdown-select .option').removeAttr('tabindex');
        }
        event.stopPropagation();
    });

    function filter(){
        var valThis = $('#txtSearchValue').val();
        $('.dropdown-select ul > li').each(function(){
            var text = $(this).text();
            (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
        });
    };

    // Search
    // Option click
    $(document).on('click', '.dropdown-select .option', function (event) {
        $(this).closest('.list').find('.selected').removeClass('selected');
        $(this).addClass('selected');
        var text = $(this).data('display-text') || $(this).text();
        $(this).closest('.dropdown-select').find('.current').text(text);
        $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
    });

    // Keyboard events
    $(document).on('keydown', '.dropdown-select', function (event) {
        var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
        // Space or Enter
        //if (event.keyCode == 32 || event.keyCode == 13) {
        if (event.keyCode == 13) {
            if ($(this).hasClass('open')) {
                focused_option.trigger('click');
            } else {
                $(this).trigger('click');
            }
            return false;
            // Down
        } else if (event.keyCode == 40) {
            if (!$(this).hasClass('open')) {
                $(this).trigger('click');
            } else {
                focused_option.next().focus();
            }
            return false;
            // Up
        } else if (event.keyCode == 38) {
            if (!$(this).hasClass('open')) {
                $(this).trigger('click');
            } else {
                var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
                focused_option.prev().focus();
            }
            return false;
            // Esc
        } else if (event.keyCode == 27) {
            if ($(this).hasClass('open')) {
                $(this).trigger('click');
            }
            return false;
        }
    });

    $(document).ready(function () {
        create_custom_dropdowns();
    });

    function getLocation(param, object) {
        if ( districtid == '' || param.trigger_district == false) districtid = 0;
        if ( wardid == '' || param.trigger_ward == false) wardid = 0;
        let formURL = BASE_URL_AJAX + 'gio-hang/get-location';
        $.post(formURL, {
                param: param,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function (data) {
                $('.lds-show-1').addClass('hidden');
                let json = JSON.parse(data);
                if (param.select == 'districtid') {
                    if (param.trigger_district == true) {
                        $(object).html(json.html).val(districtid);
                        $('#ward').html(json.textWard);
                        $('#ship_ward').html(json.textWard);
                    } else {
                        $(object).html(json.html).val(districtid);
                        $('#ward').html(json.textWard);
                        $('#ship_ward').html(json.textWard);
                    }
                } else if (param.select == 'wardid') {
                    $(object).html(json.html).val(wardid);
                }
            });
    }

    /*tính phí vận chuyển*/
    $(document).on('change', '#district', function (e) {
        var cityID = $('select#city').val();
        var districtID = $(this).val();
        loadPriceShipment(cityID, districtID);
    })

    function loadPriceShipment(cityID, districtID) {
        $.post(BASE_URL_AJAX + 'gio-hang/get-shipping', {
                cityID: cityID,
                districtID: districtID,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function (data) {
                $('.lds-show-1').addClass('hidden');
                if (data != '[]') {
                    var json = JSON.parse(data);
                    $('.list_shipping').html(json.html);
                    $('.js_fee_shipping').html(numberWithCommas(json.fee_ship) + '₫');
                    $('input[name="fee_ship"]').val(json.fee_ship);
                    $('input[name="title_ship"]').val(json.title_ship);
                    $('.cart-total-final').html(numberWithCommas(json.totalCart) + '₫');
                    $('.js_box_shipping').removeClass('hidden')
                }
            });
    }

    $(document).on('click', '.js_change_fee_shipping', function (e) {
        $('.js_checked_ship').addClass('hidden');
        $(this).find('.js_checked_ship').removeClass('hidden');
        var title = $(this).attr('data-title');
        var fee = $(this).attr('data-fee');
        $('input[name="title_ship"]').val(title);
        $('input[name="fee_ship"]').val(fee);
        $('.js_fee_shipping').html(numberWithCommas(fee) + '₫');
        $.post(BASE_URL_AJAX + 'gio-hang/change-shipping', {
                fee: fee,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function (data) {
                $('.lds-show-1').addClass('hidden');
                $('.cart-total-final').html(numberWithCommas(data.totalCart) + '₫');
            });
    });

});


function handleSelectPayment(id) {
    $('.shadow_payment').addClass('hidden');
    $('.shadow_payment_' + id).removeClass('hidden');
}
