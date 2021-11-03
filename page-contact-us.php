<?php get_header(); ?>
<main id="content" class="content">

    <?php while (have_posts()) : the_post(); ?>

        <?php do_action('basic_before_page_article'); ?>
        <article class="post page" id="pageid-<?php the_ID(); ?>">

            <?php do_action('basic_before_page_title');  ?>
            <h1><?php the_title(); ?></h1>
            <?php do_action('basic_after_page_title');  ?>

            <?php do_action('basic_before_page_content_box');  ?>
            <div class="entry-box clearfix">
                <?php do_action('basic_before_page_content');  ?>
                <?php //the_content(); 
                ?>
                <form id="frmContactUs">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" required /></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" required /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" id="submit" name="submit" /></td>
                        </tr>
                        <tr id="resutl_msg">

                        </tr>
                    </table>
                </form>
                <style>
                    #frmContactUs table td {
                        border: 0px;
                    }

                    #frmContactUs .false {
                        color: red;
                    }

                    #frmContactUs .true {
                        color: green;
                    }

                    .bg-success {
                        background-color: green;
                        border-radius: 4px;
                    }
                    .bg-warning {
                        background-color: red;
                        border-radius: 4px;
                    }

                    .text-white {
                        color: #fff;
                    }
                    .text-dark {
                        color: #000;
                    }
                </style>

                <script>
                    ;
                    (function($) {
                        $("#frmContactUs").submit(function(event) {
                            event.preventDefault();
                            const url = "<?php echo admin_url('admin-ajax.php') ?>";
                            const data = $("#frmContactUs").serialize();
                            // two things need 1. action 2. data 
                            formData = new FormData();
                            formData.append('action', "constact_us");
                            formData.append('fData', data);
                            $.ajax({
                                url: url,
                                data: formData,
                                processData: false,
                                contentType: false,
                                type: 'post',
                                success: function(result) {
                                    if (result.success === true) {
                                        $('#resutl_msg').html(`<td></td>
                            <td class="bg-success text-white">${result.data}</td>`);
                                    } else {
                                        $('#resutl_msg').html(`<td></td>
                            <td class="bg-warning text-dark"> ${result.data}</td>`);
                                    }
                                }
                            })

                        });
                    })(jQuery);
                </script>

                <?php do_action('basic_after_page_content');  ?>
            </div>
            <?php do_action('basic_after_page_content_box');  ?>

        </article>
        <?php do_action('basic_after_page_article'); ?>


    <?php

        if (comments_open() || get_comments_number()) {
            do_action('basic_before_page_comments_area');
            comments_template();
            do_action('basic_after_page_comments_area');
        }

    endwhile; ?>

</main> <!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>