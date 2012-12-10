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
        <div class="subpage">
            <div class="categories">
                        <?php osc_goto_first_category() ; ?>
                        
                        <?php while ( osc_has_categories() ) { ?>
                            <div class="category">
                                <h1><strong><a class="category cat_<?php echo osc_category_id() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span></strong></h1>
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
            <div class="subpage_content">
                <h1><?php echo osc_static_page_title() ; ?></h1>
                <hr />
                <div><?php echo osc_static_page_text() ; ?></div>
            </div>
            <div style="clear:both"></div>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>