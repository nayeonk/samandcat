<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
        
        <style>
        .active {
            color: gray;
            font-family: arial;
            font-style: italic;
        }
        </style>
        <!-- only item-post.php -->
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
        <?php ItemForm::location_javascript_new(); ?>
        <?php if(osc_images_enabled_at_items()) ItemForm::photos_javascript(); ?>
        <script type="text/javascript">
            function uniform_input_file(){
                photos_div = $('div.photos');
                $('div',photos_div).each(
                    function(){
                        if( $(this).find('div.uploader').length == 0  ){
                            divid = $(this).attr('id');
                            if(divid != 'photos'){
                                divclass = $(this).hasClass('box');
                                if( !$(this).hasClass('box') & !$(this).hasClass('uploader') & !$(this).hasClass('row')){
                                    $("div#"+$(this).attr('id')+" input:file").uniform({fileDefaultText: fileDefaultText,fileBtnText: fileBtnText});
                                }
                            }
                        }
                    }
                );
            }
            
            setInterval("uniform_plugins()", 250);
            function uniform_plugins() {
                
                var content_plugin_hook = $('#plugin-hook').text();
                content_plugin_hook = content_plugin_hook.replace(/(\r\n|\n|\r)/gm,"");
                if( content_plugin_hook != '' ){
                    
                    var div_plugin_hook = $('#plugin-hook');
                    var num_uniform = $("div[id*='uniform-']", div_plugin_hook ).size();
                    if( num_uniform == 0 ){
                        if( $('#plugin-hook input:text').size() > 0 ){
                            $('#plugin-hook input:text').uniform();
                        }
                        if( $('#plugin-hook select').size() > 0 ){
                            $('#plugin-hook select').uniform();
                        }
                    }
                }
            }
            <?php if(osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') { ?>
            $().ready(function(){
                $("#price").blur(function(event) {
                    var price = $("#price").attr("value");
                    <?php if(osc_locale_thousands_sep()!='') { ?>
                    while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
                        price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
                    }
                    <?php }; ?>
                    <?php if(osc_locale_dec_point()!='') { ?>
                    var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
                    if(tmp.length>2) {
                        price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
                    }
                    <?php }; ?>
                    $("#price").attr("value", price);
                });
            });
            <?php }; ?>
            $().ready(function(){
                //$(".description textarea").attr("value", "All description must be written in English.");
                $(".description textarea").addClass('active').val("All description must be written in English.");
                //$("#meta_link").attr("value", "(i.e. http://www.youtube.com)");

                $(".description textarea").one("focus", function() {
                    $(this).val("");
                });

                
            });
        </script>
        <!-- end only item-post.php -->


    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
         <?php osc_show_widgets('header') ;
             $breadcrumb = osc_breadcrumb('&raquo;', false);
            if( $breadcrumb != '') { ?>
            <div class="breadcrumb">
            <?php echo $breadcrumb; ?>
            <div class="clear"></div>
            </div>
        <?php
           }
        ?>
        <div class="content add_item">
            <h1><strong><?php _e('Publish a listing', 'modern'); ?></strong></h1>
            <ul id="error_list"></ul>
            <form name="item" action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data">
                <fieldset>
                <input type="hidden" name="action" value="item_add_post" />
                <input type="hidden" name="page" value="item" />
                    <div class="box general_info">
                        <h2><?php _e('General Information', 'modern'); ?></h2>
                        <div class="row">
                            <label for="catId"><?php _e('Category', 'modern'); ?> *</label>
                            <?php ItemForm::category_select(null, null, __('Select a category', 'modern')); ?>
                        </div>
                        <div class="row">
                            <?php ItemForm::multilanguage_title_description(); ?>
                        </div>
                        <?php ItemForm::plugin_post_item(); ?>
                    </div>
                    <?php if( osc_price_enabled_at_items() ) { ?>
                    <div class="box price">
                        <label for="price"><?php _e('Price', 'modern'); ?></label>
                        <?php ItemForm::price_input_text(); ?>
                        <?php ItemForm::currency_select(); ?>
                    </div>
                    <?php } ?>
                    <?php if( osc_images_enabled_at_items() ) { ?>
                    <div class="box photos">
                        <h2><?php _e('Screenshot or Images *', 'modern'); ?></h2>
                        If submitting with a link, the screenshot of the website or thumbnail of the video is required. <br/>
                        If photos only, upload photo.<br/>
                        <strong>Pick up to 4 photos (accepts .jpg and .png) </strong> <br/><br/>
                        <div id="photos">
                            <div class="row">
                                <input type="file" name="photos[]" />
                            </div>
                        </div>
                        <a href="#" onclick="addNewPhoto(); uniform_input_file(); return false;"><?php _e('Add new photo', 'modern'); ?></a>
                    </div>
                    <?php } ?>
                
                    
                    <!-- seller info -->
                    <?php if(!osc_is_web_user_logged_in() ) { ?>
                    <div class="box seller_info">
                        <h2><?php _e("Publisher's information", 'modern'); ?></h2>
                        <div class="row">
                            <label for="contactName"><?php _e('Name', 'modern'); ?></label>
                            <?php ItemForm::contact_name_text() ; ?>
                        </div>
                        <div class="row">
                            <label for="contactEmail"><?php _e('E-mail', 'modern'); ?> *</label>
                            <?php ItemForm::contact_email_text() ; ?>
                        </div>
                    </div>
                    <?php }; ?>
                    
                    <?php if( osc_recaptcha_items_enabled() ) {?>
                    <div class="box">
                        <div class="row">
                            <?php osc_show_recaptcha(); ?>
                        </div>
                    </div>
                    <?php }?>  
                <div class="clear"></div>
                <button  type="submit"><?php _e('Publish', 'modern'); ?></button>
                </fieldset>
            </form>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>