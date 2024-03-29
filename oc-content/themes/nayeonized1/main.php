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
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <?php osc_show_widgets('header') ; $breadcrumb = osc_breadcrumb('&raquo;', false);
            if( $breadcrumb != '') { ?>
            <div class="breadcrumb">
                <?php echo $breadcrumb; ?>
                <div class="clear"></div>
            </div>
        <?php
           }
        ?>
        <div class="content home">
            <div id="main">
                <?php
                    $total_categories   = osc_count_categories() ;
                    $col1_max_cat       = ceil($total_categories/3);
                    $col2_max_cat       = ceil(($total_categories-$col1_max_cat)/2);
                    $col3_max_cat       = $total_categories-($col1_max_cat+$col2_max_cat);
                ?>
                <div class="categories">
                    <?php osc_goto_first_category() ; ?>
                    
                    <?php while ( osc_has_categories() ) { ?>
                        <div class="category">
                            <?php if (osc_category_name() != "News" && osc_category_name() != "Episode Guide")  {?>
                            <h1><strong><a class="category cat_<?php echo osc_category_id() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span></strong></h1>
                            <?php } ?>
                            <?php if ( osc_count_subcategories() > 0 ) { ?>
                                <ul>
                                    <?php while ( osc_has_subcategories() ) { ?>
                                        <li><a class="category cat_<?php echo osc_category_id() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                    <?php } ?>
               </div>
               <div id="content_wrapper" >
                    <div id="slider">
                        <iframe src="slider/slider.html" frameborder="0" height="315" width="700" scrolling="no"></iframe>
                    </div>
                    <div class="form_publish">
                    <?php osc_current_web_theme_path('inc.search.php') ; ?>
                    </div>
                    <div class="latest_ads">
                        <h1><strong><?php _e('Latest Posts', 'modern') ; ?></strong></h1>
                        <?php if( osc_count_latest_items() == 0) { ?>
                            <p class="empty"><?php _e('No Latest Posts', 'modern') ; ?></p>
                        <?php } else { ?>
                            <table border="0" cellspacing="0">
                                 <tbody>
                                    <?php $class = "even"; ?>
                                    <?php while ( osc_has_latest_items() ) { ?>
                                     <tr class="<?php echo $class. (osc_item_is_premium()?" premium":"") ; ?>">
                                            <?php if( osc_images_enabled_at_items() ) { ?>
                                             <td class="photo">
                                                <?php if( osc_count_item_resources() ) { ?>
                                                    <a href="<?php echo osc_item_url() ; ?>">
                                                        <img src="<?php echo osc_resource_thumbnail_url() ; ?>" width="75" height="56" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" />
                                                    </a>
                                                <?php } else { ?>
                                                    <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title="" />
                                                <?php } ?>
                                             </td>
                                            <?php } ?>
                                             <td class="text">
                                                 <h3><a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a></h3>
                                                 <p><strong><?php echo osc_item_category() ?> | <?php while ( osc_has_item_meta() ) { ?> <?php if ( osc_item_meta_name() == "Language *" ) { ?> <?php echo osc_item_meta_value(); ?> <?php } ?><?php } ?></strong></p>
                                                 <p><em><?php echo osc_highlight( strip_tags( osc_item_description() ) ) ; ?></em></p>
                                             </td>                                       
                                         </tr>
                                        <?php $class = ($class == 'even') ? 'odd' : 'even' ; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if( osc_count_latest_items() == osc_max_latest_items() ) { ?>
                            <p class='pagination'><?php echo osc_search_pagination(); ?></p>
                                <p class="see_more_link"><a href="<?php echo osc_search_show_all_url();?>"><strong><?php _e("See all posts", 'modern'); ?> &raquo;</strong></a></p>
                            <?php } ?>
                        <?php View::newInstance()->_erase('items') ; } ?>
                    </div>
                </div>
                <div style="clear:both">
                </div>
            </div>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>