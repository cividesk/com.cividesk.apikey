{* this template is used to add/edit the API Key for a contact *}

<div class="form-item">
    <fieldset><legend>{ts}API Key{/ts}</legend>
        <div class="crm-block crm-form-block crm-cividesk-api-form-block">
            
            <table class="form-layout-compressed">
                <tr style="display:none;" class="crm-apikey-form-block">
                    <td class="label"></td>
                    <td><div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="top"}</div></td>
                </tr>
                <tr style="display:none;" class="crm-apikey-form-block">
                    <td class="label"></td>
                    <td></td>
                </tr>
                <tr class="crm-apikey-form-block">
                    <td class="label">{$form.api_key.label}</td>
                    <td>
                        <div style="float:left">{$form.api_key.html}</div>
                        <div style="float:left;margin-left:10px;"><a id="api_key_generate" class="button" href="javascript:void(0);" accesskey="N"><span>Generate</span></a></div>
                    </td>  
                </tr>
                <tr class="crm-apikey-form-block">
                    <td class="label"></td>
                    <td><div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="bottom"}</div></td>
                </tr>
            </table>
        </div>
    </fieldset>
</div>
                                            
<style type="text/css">
{literal}
#crm-container .crm-error {
    padding: 0;
}
{/literal}
</style>
                 

{literal}
<script type="text/javascript">
cj(function(){
  cj('#api_key_generate').on('click', function(){
      cj('#api_key').val(randomString(24));
      return true;
  });
});

function randomString(length, charset)
{
    var text = "";
    charset = charset || "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < length; i++ )
        text += charset.charAt(Math.floor(Math.random() * charset.length));

    return text;
}
</script>
{/literal}
                                    