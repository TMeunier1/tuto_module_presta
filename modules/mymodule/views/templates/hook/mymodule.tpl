<!-- Block mymodule -->
<div id="mymodule_block_home" class="block">
  <h4>Welcome!</h4>
  <div class="block_content">
    <p>{l s='Hello %s!' sprintf=$my_module_name mod='mymodule'}
        {if !isset($my_module_name) || !$my_module_name}
            {capture name='my_module_tempvar'}{l s='World' mod='mymodule'}{/capture}
            {assign var='my_module_name' value=$smarty.capture.my_module_tempvar}
        {/if}
    </p>
    <p> {l s='You have %s products' sprintf=$my_module_total mod='mymodule'}</p>
    <ul>
      <li><a href="{$my_module_link}" title="Click this link">{l s='Click me!'}</a></li>
    </ul>
  </div>
</div>
<!-- /Block mymodule -->
