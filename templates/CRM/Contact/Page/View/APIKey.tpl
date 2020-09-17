{* this template is used to display the 'API Key' tab for a contact *}

<div class="form-item">
    <fieldset><legend>{ts}Api Key{/ts}</legend>
        <div class="crm-block crm-form-block crm-cividesk-apikey-form-block">

            {if $isAdmin || $isMyself}

            {if $apiKey}
            <div class="label" style="float:left">{ts}Api Key{/ts}:&nbsp;</div>
            <div style="float:left"><strong>{$apiKey}</strong></div><br />
            <br />
            {/if}

            <div class="action-link">
                <a class="button" href="{$addApiKeyUrl}" ><span><i class="crm-i fa-plus"></i> {if $apiKey}{ts}Edit Api Key{/ts}{else}{ts}Add Api Key{/ts}{/if}</span></a>
            </div>

            {else}
            <div>{ts}You are NOT authorized to display this API Key.{/ts}</div>
            {/if}

        </div>
    </fieldset>
</div>

