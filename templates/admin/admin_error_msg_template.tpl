<div class="error" {if $error_msg==""}style="display:none;"{/if}>
<img src="{$baseUrl}images/warning.gif" alt="Warning!" class="error_div_warning" align="absmiddle" /> <span>{$error_msg}</span>.
<br clear="all"/>
</div>
{if $update_msg!=""}
<div id='update_msg' {*class='update_msg'*}>{$update_msg}</div>
{/if}

{if $error_warning_msg!=""}
<div id='error_warning_msg'>
<img src="{$baseUrl}images/warning_green.gif" alt="Warning!" class="error_div_warning" align="absmiddle" /> <span style="color:#45941F">{$error_warning_msg}</span>
</div>
{/if}