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

    osc_show_flash_message() ;
?>
<!-- container -->
<div class="container">
<!-- header -->
<div id="header">
    <!--<a id="logo" href="<?php echo osc_base_url() ; ?>"><?php echo logo_header(); ?></a>-->
    <div id="topbanner">
        <img src="oc-content/themes/nayeonized1/images/header01.png" width="1000" height="209" border="0" usemap="#Map" />
        <map name="Map" id="Map">
          <area shape="rect" coords="23,2,426,208" href="<?php echo osc_base_url() ; ?>" />
          <area shape="rect" coords="827,10,904,83" href="#" />
          <area shape="rect" coords="908,10,971,85" href="#" />
        </map>
    </div>
    <div id="user_menu">
        <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
            <div class="form_publish">
                <strong class="publish_button"><a href="<?php echo osc_item_post_url_in_category() ; ?>"><?php _e("Publish a link or site", 'modern');?></a></strong>
            </div>
        <?php } ?>
    </div>
    <div id="navbar">
        <img src="oc-content/themes/nayeonized1/images/navbar.png" alt="" border="0" usemap="#theimageMap" id="theimage" />
        <map name="theimageMap" id="theimageMap">
          <area shape="rect" coords="39,16,133,56" href="<?php echo osc_base_url() ; ?>" />
          <area shape="rect" coords="148,16,232,57" href="index.php?page=page&id=21" />
          <area shape="rect" coords="262,15,380,58" href="index.php?page=page&id=22" />
          <area shape="rect" coords="409,14,474,58" href="index.php?page=page&id=23" />
          <area shape="rect" coords="503,13,647,57" href="index.php?page=page&id=24" />
          <area shape="rect" coords="671,14,812,58" href="index.php?page=page&id=25" />
          <area shape="rect" coords="845,14,938,57" href="index.php?page=page&id=26" />
        </map>
    </div>
</div>
<div class="clear"></div>
<!-- /header -->
<?php
    osc_show_widgets('header') ;

    $breadcrumb = osc_breadcrumb('&raquo;', false);
    if( $breadcrumb != '') { ?>
    <div class="breadcrumb">
        <?php echo $breadcrumb; ?>
        <div class="clear"></div>
    </div>
<?php
    }
?>