{* this template is used to display the 'API Key' tab for a contact *}

<div class="form-item">
    <fieldset><legend>{ts}API Key{/ts}</legend>
        <div class="crm-block crm-form-block crm-cividesk-apikey-form-block">
            
            {if $isAdmin || $isMyself}

            {if $apiKey}
            <div class="label" style="float:left">Your API key is:&nbsp;</div>
            <div style="float:left"><strong>{$apiKey}</strong></div><br />
            <br />
            {/if}

            <div class="action-link">
                <a class="button" href="{$addApiKeyUrl}" accesskey="N"><span><div class="icon add-icon"></div>{if $apiKey}Edit{else}Add{/if} API Key</span></a>
            </div>

            {else}
            <div>You are NOT authorized to display this API Key.</div>
            {/if}   
                
        </div>
    </fieldset>
</div>

