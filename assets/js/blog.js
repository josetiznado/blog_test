var Blog;
(function () {
    Blog = {
        system_url: null,
        comments: null,
        events: function () {
            $('#submit').click(function (e) {
                var result = Blog.validate('comments_form');
                if (result) {
                    var data = {};
                    data.name = $('#name').val();
                    data.comment = $('#comment').val();
                    data.parent_comment = '';// $('#parent_comment');
                    $.post(Blog.system_url + 'index.php/Blogs/saveComment', data, function (response) {
                        if (response.success) {
                            Blog.loadComment(response.id, response.date, data.name, data.comment, data.parent_comment);
                        }
                    }, 'json');
                }
            });
        },
        validate: function (form) {
            $.validity.messages.required = "There are some required fields.";
            $.validity.setup({outputMode: "summary"});
            $.validity.start();
            $(form + ' .required').require();
            var result = $.validity.end();
            if (!result.valid) {
                $('#hidden_sumary').hide();
                var html = $(".validity-summary-container").html();
                new PNotify({
                    title: 'Error',
                    text: html,
                    type: 'error',
                    stack: {"dir1": "up", "dir2": "left"},
                    addclass: "stack-bottomright",
                    buttons: {
                        sticker: false
                    },
                    hide: false
                });
                PNotify.prototype.options.delay = 50;
            }
            // Return whether it's okay to proceed with the Ajax:
            return result.valid;
        },
        /**
         * 
         * @param date date
         * @param string name
         * @param string comment
         * @param int parent_id
         */
        loadComment: function (id, date, name, comment, parent_comment) {
            if (parent_comment > 0) {
                $('#' + parent_comment + ' .replied_comments').prepend("<div class='comment_item' id='" + id + "'></div>");
            } else {
                $('#comments_list').prepend("<div class='comment_item' id='" + id + "'></div>");
            }
            $('#' + id).append(date + " ");
            $('#' + id).append("<b>" + name + "</b>:");
            $('#' + id).append("<p class='comment_text'>" + comment + "</p>");

            if (parent_comment > 0) {
                return false;
            }
            $('#' + id).append("<p class='reply_container'><label class='reply_link'>Reply</label></p>");
            $('#' + id + ' .reply_link').click(function () {
                Blog.addReplyForm(id);
            });
            $('#' + id).append("<p class='replied_comments'></p>");
        },
        addReplyForm: function (id) {
            var $reply_form = $('#comments_form_temp').clone();
            $reply_form.attr('id', id + '_reply').show();
            $('#' + id + ' .reply_container').append($reply_form);
            $('#' + id + '_reply #submit_reply').click(function () {
                var result = Blog.validate('#' + id + '_reply');
                if (result) {
                    var data = {};
                    data.name = $('#' + id + ' #name_reply').val();
                    data.comment = $('#' + id + ' #comment_reply').val();
                    data.parent_comment = id;
                    $.post(Blog.system_url + 'index.php/Blogs/saveComment', data, function (response) {
                        if (response.success) {
                            Blog.loadComment(response.id, response.date, data.name, data.comment, data.parent_comment);
                            $('#' + id + '_reply').remove();
                        }
                    }, 'json');
                }
            });
            $('#' + id + '_reply #cancel_reply').click(function () {
                $('#' + id + '_reply').remove();
            });
        },
        loadComments() {
            $.each(Blog.data.comments, function (k, v) {
                Blog.loadComment(v.id, v.date, v.name, v.comment, v.parent_comment);
            });
            $.each(Blog.data.replies, function (k, v) {
                Blog.loadComment(v.id, v.date, v.name, v.comment, v.parent_comment);
            });
            $('.replied_comments').each(function (k, v) {
                if ($(v).find('div').length >= 3) {
                    $(v).parent().find('.reply_container').remove();
                }
            });
        }
    };
})();