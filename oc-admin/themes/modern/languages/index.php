<?php
    /**
     * OSClass – software for creating and publishing online classified advertising platforms
     *
     * Copyright (C) 2010 OSCLASS
     *
     * This program is free software: you can redistribute it and/or modify it under the terms
     * of the GNU Affero General Public License as published by the Free Software Foundation,
     * either version 3 of the License, or (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
     * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
     * See the GNU Affero General Public License for more details.
     *
     * You should have received a copy of the GNU Affero General Public
     * License along with this program. If not, see <http://www.gnu.org/licenses/>.
     */

    function addHelp() {
        echo '<p>' . __("Add, edit or delete the language in which your OSClass is displayed, both the part that's viewable by users and the admin panel.") . '</p>';
    }
    osc_add_hook('help_box','addHelp');

    function customPageHeader(){ ?>
        <h1><?php _e('Settings') ; ?>
            <a href="#" class="btn ico ico-32 ico-help float-right"></a>
            <a href="<?php echo osc_admin_base_url(true) ; ?>?page=languages&amp;action=add" class="btn btn-green ico ico-32 ico-add-white float-right" ><?php _e('Add language') ; ?></a>
        </h1>
<?php
    }
    osc_add_hook('admin_page_header','customPageHeader');

    function customPageTitle($string) {
        return sprintf(__('Languages &raquo; %s'), $string);
    }
    osc_add_filter('admin_title', 'customPageTitle');

    //customize Head
    function customHead() { ?>
        <script type="text/javascript">
            $(document).ready(function(){
                // check_all bulkactions
                $("#check_all").change(function(){
                    var isChecked = $(this+':checked').length;
                    $('.col-bulkactions input').each( function() {
                        if( isChecked == 1 ) {
                            this.checked = true;
                        } else {
                            this.checked = false;
                        }
                    });
                });

                // dialog delete
                $("#dialog-language-delete").dialog({
                    autoOpen: false,
                    modal: true,
                    title: '<?php echo osc_esc_js( __('Delete listing') ); ?>'
                });

                // dialog bulk actions
                $("#dialog-bulk-actions").dialog({
                    autoOpen: false,
                    modal: true
                });
                $("#bulk-actions-submit").click(function() {
                    $("#datatablesForm").submit();
                });
                $("#bulk-actions-cancel").click(function() {
                    $("#datatablesForm").attr('data-dialog-open', 'false');
                    $('#dialog-bulk-actions').dialog('close');
                });
                // dialog bulk actions function
                $("#datatablesForm").submit(function() {
                    if( $("#bulk_actions option:selected").val() == "" ) {
                        return false;
                    }

                    if( $("#datatablesForm").attr('data-dialog-open') == "true" ) {
                        return true;
                    }

                    $("#dialog-bulk-actions .form-row").html($("#bulk_actions option:selected").attr('data-dialog-content'));
                    $("#bulk-actions-submit").html($("#bulk_actions option:selected").text());
                    $("#datatablesForm").attr('data-dialog-open', 'true');
                    $("#dialog-bulk-actions").dialog('open');
                    return false;
                });
            });

            // dialog delete function
            function delete_dialog(item_id) {
                $("#dialog-language-delete input[name='id[]']").attr('value', item_id);
                $("#dialog-language-delete").dialog('open');
                return false;
            }
        </script>
        <?php
    }
    osc_add_hook('admin_header','customHead');

    $iDisplayLength = __get('iDisplayLength');
    $aData          = __get('aLanguages'); 

    osc_current_admin_theme_path( 'parts/header.php' );
?>
<h2 class="render-title"><?php _e('Manage Languages'); ?> <a href="<?php echo osc_admin_base_url(true) ; ?>?page=languages&amp;action=add" class="btn btn-mini"><?php _e('Add new'); ?></a></h2>
<div class="relative">
    <div id="language-toolbar" class="table-toolbar">
        <div class="float-right">
            
        </div>
    </div>
    <form class="" id="datatablesForm" action="<?php echo osc_admin_base_url(true) ; ?>" method="post" data-dialog-open="false">
        <input type="hidden" name="page" value="languages" />
        <div id="bulk-actions">
            <label>
                <select id="bulk_actions" name="action" class="select-box-extra">
                    <option value=""><?php _e('Bulk Actions') ; ?></option>
                    <option value="enable_selected" data-dialog-content="<?php printf(__('Are you sure you want to %s the selected languages?'), strtolower(__('Enable (Website)'))); ?>"><?php _e('Enable (Website)') ; ?></option>
                    <option value="disable_selected" data-dialog-content="<?php printf(__('Are you sure you want to %s the selected languages?'), strtolower(__('Disable (Website)'))); ?>"><?php _e('Disable (Website)') ; ?></option>
                    <option value="enable_bo_selected" data-dialog-content="<?php printf(__('Are you sure you want to %s the selected languages?'), strtolower(__('Enable (oc-admin)'))); ?>"><?php _e('Enable (oc-admin)') ; ?></option>
                    <option value="disable_bo_selected" data-dialog-content="<?php printf(__('Are you sure you want to %s the selected languages?'), strtolower(__('Disable (oc-admin)'))); ?>"><?php _e('Disable (oc-admin)') ; ?></option>
                    <option value="delete" data-dialog-content="<?php printf(__('Are you sure you want to %s the selected languages?'), strtolower(__('Delete'))); ?>"><?php _e('Delete') ?></option>
                </select> <input type="submit" id="bulk_apply" class="btn" value="<?php echo osc_esc_html( __('Apply') ) ; ?>" />
            </label>
        </div>
        <div class="table-contains-actions">
            <table class="table" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-bulkactions"><input id="check_all" type="checkbox" /></th>
                        <th><?php _e('Name') ; ?></th>
                        <th><?php _e('Short name') ; ?></th>
                        <th><?php _e('Description') ; ?></th>
                        <th><?php _e('Enabled (website)') ; ?></th>
                        <th><?php _e('Enabled (oc-admin)') ; ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($aData['aaData'])>0) { ?>
                <?php foreach( $aData['aaData'] as $array) { ?>
                    <tr>
                    <?php foreach($array as $key => $value) { ?>
                        <?php if( $key==0 ) { ?>
                        <td class="col-bulkactions">
                        <?php } else { ?>
                        <td>
                        <?php } ?>
                        <?php echo $value; ?>
                        </td>
                    <?php } ?>
                    </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                    <td colspan="6" class="text-center">
                    <p><?php _e('No data available in table') ; ?></p>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <div id="table-row-actions"></div> <!-- used for table actions -->
        </div>
    </form>
</div>
<?php 
    osc_show_pagination_admin($aData);
?>
<form id="dialog-language-delete" method="get" action="<?php echo osc_admin_base_url(true); ?>" id="display-filters" class="has-form-actions hide">
    <input type="hidden" name="page" value="languages" />
    <input type="hidden" name="action" value="delete" />
    <input type="hidden" name="id[]" value="" />
    <div class="form-horizontal">
        <div class="form-row">
            <?php _e('Are you sure you want to delete this language?'); ?>
        </div>
        <div class="form-actions">
            <div class="wrapper">
            <a class="btn" href="javascript:void(0);" onclick="$('#dialog-language-delete').dialog('close');"><?php _e('Cancel'); ?></a>
            <input id="language-delete-submit" type="submit" value="<?php echo osc_esc_html( __('Delete') ); ?>" class="btn btn-red" />
            </div>
        </div>
    </div>
</form>
<div id="dialog-bulk-actions" title="<?php _e('Bulk actions'); ?>" class="has-form-actions hide">
    <div class="form-horizontal">
        <div class="form-row"></div>
        <div class="form-actions">
            <div class="wrapper">
                <a id="bulk-actions-cancel" class="btn" href="javascript:void(0);"><?php _e('Cancel'); ?></a>
                <a id="bulk-actions-submit" href="javascript:void(0);" class="btn btn-red" ><?php echo osc_esc_html( __('Delete') ); ?></a>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<?php osc_current_admin_theme_path( 'parts/footer.php' ) ; ?>