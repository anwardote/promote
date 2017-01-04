$('document').ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('form input').val()
        }
    });

    $(".nav-tabs").on("click", "a", function (e) {
        e.preventDefault();
        var _valid = validateFields();
        if (_valid == false) {
            return false;
        }
        $(this).tab('show');
    }).on("click", "span", function () {
        var anchor = $(this).siblings('a');
        $(anchor.attr('href')).remove();
        $(this).parent().prev().addClass('active');
        $(this).parent().remove();
        $(".nav-tabs li").children('a').last().click();
        $(".tab-content .tab-pane").last().addClass('active');

        reArrange();
        return false;
    });

    $(document).on('click', '.add-contact', function (e) {
        e.preventDefault();
        var _valid = validateFields();
        if (_valid == false) {
            return false;
        }
        var id = parseInt($("#tab-length").val()) + 1;
        var _liId = $(".nav-tabs li").length + 1;
        $('.nav-tabs').append('<li><a href="#contact_' + id + '">Profile ' + _liId + '</a><span>x</span></li>');
        reArrange();
        var _rhtml = createHtml(id);
        $('.tab-content').append(_rhtml);
        $('.tab-content').find('.active').removeClass('active');
        $('.tab-content .tab-pane').last().addClass('active');
        $("#tab-length").val(id);
    });

    function reArrange() {
        var _lihtml = "";
        $(".nav-tabs li").each(function (i) {
            var _liId = i + 1;
            var _attr = $(this).find('a').attr('href');
            var _text = $(this).find('a').text();
            if (_text.indexOf("Profile") == 0) {
                _lihtml += "<li><a href=" + _attr + ">Profile " + _liId + "</a><span>x</span></li>";
            } else {
                _lihtml += "<li><a href=" + _attr + ">" + _text + "</a><span>x</span></li>";
            }
        });

        $('.nav-tabs').html(_lihtml);
        $('.nav-tabs').find('.active').removeClass('active');
        $('.nav-tabs li').last().addClass('active');

    }

    function createHtml(id) {
        var _html = '<div class="tab-pane active" id="contact_' + id + '"><div class="panel-body">';
        _html += '<div class="row"><div class="col-sm-9">';
        _html += '<div class="form-group">';
        _html += '<label for="company_name">Company Name: </label><input id="company_name" class="form-control company_name" placeholder="" name="company_name[' + id + ']" type="text">';
        _html += '</div>';
        _html += '<div class="form-group">';
        _html += '<label for="Your URL\'s">Your URL\'s: </label><input id="urls" class="form-control urls" placeholder="" name="urls[' + id + ']" type="text">';
        _html += '</div>';
        _html += '<div class="form-group">';
        _html += '<label for="Phone">Phone: </label><input id="c_phone" class="form-control c_phone" placeholder="" name="c_phone[' + id + ']" type="text">';
        _html += '</div>';
        _html += '<div class="form-group">';
        _html += '<label for="Logo(s)">Logo(s): </label><input name="logos[' + id + ']" type="file">';
        _html += '</div>';
        _html += '<div class="form-group">';
        _html += '<p row="' + id + '" count="' + id + '"><label for="Copay statement">Copay statement: </label><input id="copay_statement" class="form-control copay_statement" placeholder="" name="copay_statement[' + id + '][1]" type="text"></p><a href="javascript:void(0)" class="addMore">Add More</a>';
        _html += '</div>';
        _html += '<div class="form-group">';
        _html += '<label for="Moniker\'s">Moniker\'s: </label><input id="monikers" class="form-control monikers" placeholder="" name="monikers[' + id + ']" type="text">';
        _html += '</div>';
        _html += '<div class="form-group">';
        _html += '<input id="default" class="form-control default" placeholder="" name="Default" type="radio" value="Company' + id + '"> <span>Make this tab default</span>';
        _html += '</div>';
        _html += '</div></div>';
        _html += '</div></div>';
        return _html;
    }

    $(document).on('click', '.addMore', function (e) {
        var i = $(this).parent('div').find('p').length + 1;
        var _id = $(this).parents('div').find('.tab-pane.active').attr('id');
        var j = $(this).parent('div').find('p').last().attr('row');
        var _col = $('.tab-content #' + _id).find('p').first().attr('count');
        var _row = $('.tab-content #' + _id).find('p').first().attr('row');
        j++;
        var field_type = $(this).parent('div').find('p input[type="text"], p img, p input[type="file"]').last().attr('type');
        var field_name = $(this).parent('div').find('p input[type="text"]').last().attr('id');
        if (field_type == "file") {
            $(this).parent('div').find('p').last().after('<p row="' + j + '" count="' + _col + '" class="input-float-left"><input type="file" name="logos[' + _col + '][' + i + ']"><a href="javascript:void(0)" class="glyphicon glyphicon-minus-sign remove"></a></p>');
        } else {
            var _default = $.trim(field_name + '_default');
            $(this).parent('div').find('p').last().after('<p row="' + _row + '" count="' + _col + '" ><input type="' + field_type + '" id="' + field_name + '" name="' + field_name + '[' + _row + '][' + i + ']" placeholder="" class="form-control ' + field_name + '"><a href="javascript:void(0)" class="glyphicon glyphicon-minus-sign remove"></a></p>');
        }
        return false;
    });

    $(document).on('click', '.remove', function (e) {
        var i = $(this).closest("div").find("p").length;
        var _id = $(this).attr('data-id');
        var _data_name = $(this).attr('data-name');
        var class_name = $(this).closest("p").find('input[type="text"]').attr('id');
        if (typeof (class_name) == "undefined") {
            class_name = "logos";
        }
        var self = this;
        if (i > 1) {
            if (typeof (_id) != "undefined" && typeof (_data_name) != "undefined") {
                if (confirm("Are you sure want to delete?")) {
                    $.ajax({
                        url: 'profile_delete',
                        type: "post",
                        dataType: 'json',
                        data: {id: _id, name: _data_name, column_name: class_name},
                        success: function (data) {
                            if (data == 1) {
                                var remv = _data_name.replace(".", "");
                                $('.' + remv).remove();
                                $(self).closest("p").remove();
                                return false;
                            }
                        }
                    });
                } else {
                    return false;
                }
            } else {
                $(this).parents('p').remove();
            }
        }
        return false
    });

    $(document).on('click', '.company-profile', function (e) {
        $('.alert-success').css("display", "none");
        var _valid = validateFields();
        if (_valid == false) {
            return false;
        }
        $('#profile').removeAttr('disabled');
        $('#letusdo').attr('disabled', 'disabled');
        $("#companyProfile").submit();
    });

    $(document).on('click', '.update-launch', function (e) {
        $('.alert-success').css("display", "none");
        var _valid = validateFields();
        if (_valid == false) {
            return false;
        }
        $('#let-us-do').removeAttr('disabled');
        $('#profile').attr('disabled', 'disabled');

        $("#companyProfile").submit();
    });

    function validateFields() {
        var company_name = $('#companyProfile .tab-pane.active .company_name').val();
        var url = $('#companyProfile .tab-pane.active .urls').val();
        var c_phone = $('#companyProfile .tab-pane.active .c_phone').val();
        var copay_statement = $('#companyProfile .tab-pane.active .copay_statement').val();
        var monikers = $('#companyProfile .tab-pane.active .monikers').val();
        var logo = $('#companyProfile .tab-pane.active input[type="file"]').val();
        var old_logo = $('#companyProfile .tab-pane.active input[type="hidden"]').val();

        var error = 0;
        $.each($('#companyProfile .tab-pane.active .copay_statement'), function () {
            var c_statement = $(this).val();
//            if (c_statement == "") {
//                $('.comMsg').html("<div class='alert alert-danger'>Co-pay statement cannot be empty</div>");
//                $('html, body').animate({scrollTop: $('.comMsg').position().top}, 'slow');
//                error = 1;
//                
//                $38 before deductible
//                $10 copay after deductible
//                Waived medical: $49
//                You will need the primary<br> member's last 4 digits of SSN and Date of Birth.
//            }
        });
        if (error == 1) {
            return false;
        }

        if (company_name == "") {
            $('.comMsg').html("<div class='alert alert-danger'>Company Name can not be empty</div>");
            $('html, body').animate({scrollTop: $('.comMsg').position().top}, 'slow');
            return false;
        } else if (url == "") {
            $('.comMsg').html("<div class='alert alert-danger'>Url can not be empty</div>");
            $('html, body').animate({scrollTop: $('.comMsg').position().top}, 'slow');
            return false;
        } else if (c_phone == "") {
            $('.comMsg').html("<div class='alert alert-danger'>Phone number can not be empty</div>");
            $('html, body').animate({scrollTop: $('.comMsg').position().top}, 'slow');
            return false;
        } else if (monikers == "") {
//            $('.comMsg').html("<div class='alert alert-danger'>Monikers can not be empty</div>");
//            $('html, body').animate({scrollTop: $('.comMsg').position().top}, 'slow');
//            return false;
        } else if (typeof old_logo == "undefined") {
            if (logo == "") {
                $('.comMsg').html("<div class='alert alert-danger'>Logo can not be empty</div>");
                $('html, body').animate({scrollTop: $('.comMsg').position().top}, 'slow');
                return false;
            }
        }
        $('.alert-success').css('display', 'none');
    }

//    function isValidURL(url) {
//        var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
//
//        if (RegExp.test(url)) {
//            return true;
//        } else {
//            return false;
//        }
//    }
});