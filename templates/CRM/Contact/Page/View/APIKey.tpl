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
          {if $apiKey}
            {crmButton href="$addApiKeyUrl" class="edit-apikey" title="Edit API Key" icon="fa-pencil"}Edit API Key{/crmButton}
          {else}
            {crmButton href="$addApiKeyUrl" class="add-apikey" title="Add API Key" icon="fa-plus"}Add API Key{/crmButton}
          {/if}
        </div>
      {else}
        <div>You are NOT authorized to display this API Key.</div>
      {/if}
    </div>
  </fieldset>
</div>

