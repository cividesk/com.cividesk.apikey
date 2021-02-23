{* this template is used to display the 'API Key' tab for a contact *}

<div class="form-item">
  <fieldset><legend>{ts}API Key{/ts}</legend>
    <div class="crm-block crm-form-block crm-cividesk-apikey-form-block">
      {if $isAdmin || $isMyself}
        {if $apiKey}
          <div class="label" style="float:left">{ts}Your API key is{/ts}:&nbsp;</div>
          <div style="float:left"><strong>{$apiKey}</strong></div><br />
          <br />
        {/if}
        <div class="action-link">
          {if $apiKey}
            {crmButton href="$addApiKeyUrl" class="edit-apikey" title="Edit API Key" icon="fa-pencil"}{ts}Edit API Key{/ts}{/crmButton}
          {else}
            {crmButton href="$addApiKeyUrl" class="add-apikey" title="Add API Key" icon="fa-plus"}{ts}Add API Key{/ts}{/crmButton}
          {/if}
        </div>
      {else}
        <div>{ts}You are not authorized to display this API Key.{/ts}</div>
      {/if}
    </div>
  </fieldset>
</div>

