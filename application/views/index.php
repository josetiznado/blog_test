<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.validity.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pnotify.custom.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    </head>
    <body>
        <div id="container">
            <h3>What was first, the egg or the chicken?</h3>
            <hr>
            <h4>Comments</h4>
            <div id="comments_list">

            </div>
            <br/>
            <br/>
            <h4>Add new comment</h4>
            <form id="comments_form">
                <div class="row">
                    <div class="col-md-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control required" id="name" title="Name"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="name" class="">Comment</label>
                        <textarea class="form-control required" id="comment" title="Comment"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <input type="button" class="form-control btn btn-default" id="submit" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>

        <form id="comments_form_temp" style="display: none;" class="reply_form">
            <div class="row">
                <div class="col-md-3">
                    <label for="name_reply">Name</label>
                    <input type="text" class="form-control required" id="name_reply" title="Name"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="comment_reply" class="">Comment</label>
                    <textarea class="form-control required" id="comment_reply" title="Comment"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <input type="button" class="form-control btn btn-default" id="submit_reply" value="Submit"/>
                </div>
                <div class="col-md-1">
                    <input type="button" class="form-control btn btn-danger" id="cancel_reply" value="Cancel"/>
                </div>
            </div>
        </form>

        <div class="validity-summary-container" style="display: none;" id="hidden_sumary"><ul></ul></div>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validity.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pnotify.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/blog.js"></script>
        <script type="text/javascript">
            $(function () {
                Blog.system_url = '<?php echo base_url() ?>';
                Blog.events();
                Blog.data = <?php echo json_encode($comments); ?>;
                Blog.loadComments();
            });
        </script>
    </body>
</html>