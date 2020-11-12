<?php
/**
 * REDCap External Module: Copy Change Reason
 * Adds a button underneath each "reason for change" text area on the Data Import Tool summary page. Click the button to copy the text to all other "reason for change" text areas.
 * @author Luke Stevens, Murdoch Children's Research Institute
 */
namespace MCRI\CopyChangeReason;

use ExternalModules\AbstractExternalModule;

class CopyChangeReason extends AbstractExternalModule
{
        public function redcap_module_import_page_top($project_id) {
                global $Proj;
                //if (!$Proj->project['require_change_reason']) { return; }
                if (!$GLOBALS['require_change_reason']) { return; }
                ?>
                <script type="text/javascript">
                    (function($, window, document) {
                        $(document).ready(function(){
                            const a=$('<a class="btn btn-xs text-primaryrc text-right" style="float:right;" href="javascript:;"><small><i class="far fa-copy mr-1"></i>Copy to all<i class="fas fa-arrows-alt-v ml-1"></i></small></a>');
                            setTimeout(function(){
                                var ta=$('textarea.change_reason');
                                $(ta).each(function(){
                                    $(a).clone()
                                        .insertAfter(this)
                                        .on('click', function(){
                                            var reas=$(this).parent().find('textarea').val();
                                            $(ta).each(function(){
                                                $(this).val(reas);
                                            });
                                        });
                                });
                            }, 2000);
                        });
                    }(window.jQuery, window, document));
                </script>
                <?php
        }
}